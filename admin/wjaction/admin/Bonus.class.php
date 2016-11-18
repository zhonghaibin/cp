<?php
class Bonus extends AdminBase{
	public $pageSize=15;

	public final function shareBonus(){
		$this->display('bonus/bonus-list.php');
	}

	public final function bonusLog(){
		$this->display('bonus/bonus-log.php');
	}

	public final function shareBonusModal($uid){
		$this->display('bonus/share-bonus-modal.php',0,$uid);

	}

	public final function bonusLogActionModal($id){
		
		$sql="select * from {$this->prename}bonus_log where id=?";
		$data=$this->getRow($sql, $id);
		if(!$data) throw new Exception('参数出错');

		$this->display('bonus/bonus-log-action.php', 0, $data);
	}


	public final function bonusLogDealWith($id){
		if(!$id=intval($id)) throw new Exception('参数出错');

		$para = $_POST;

		if($para['bonusStatus'] == 1){
			$this->updateRows($this->prename .'bonus_log', $para, 'id='.$id);
			echo '处理成功！！！';
		}
	}

	public final function bonusLogDelete($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="select bonusStatus from {$this->prename}bonus_log where id=?";
		$bonusStatus = $this->getValue($sql, $id);

		if($bonusStatus == 1){
			$this->updateRows($this->prename .'bonus_log', array('isDelete'=>1), 'id='.$id);
			echo '操作成功';
		}
	}

	public final function shareBonusSingle($uid){
		if(!$uid=intval($uid)) throw new Exception('参数出错');
		$para=$_POST;

		if(!isset($para['lossAmount']) || empty($para['lossAmount'])) throw new Exception('参数出错');
		if(!isset($para['bonusAmount']) || empty($para['bonusAmount'])) throw new Exception('参数出错');
		if(!isset($para['startTime']) || empty($para['startTime'])) throw new Exception('参数出错');
		if(!isset($para['endTime']) || empty($para['endTime'])) throw new Exception('参数出错');

		$para['uid'] = $uid;
		$para['username'] = $this->getValue('select username from xy_members where uid=?',$uid);
		
		$sql = 'select id from xy_bonus_log where uid='.$uid.' and startTime='.$para['startTime'].' and endTime='.$para['endTime'];
		$bonusId = $this->getValue($sql);
	
		if($bonusId) throw new Exception('该用户本期分红已经发放');

		$para['bonusTime'] = time();

		if($this->insertRow('xy_bonus_log',$para)){
			$this->addLog(22,$this->adminLogType[22].'['.$para['username'].']',$this->lastInsertId(),$para['username']);
			echo '分红发放成功';
		}else{
			throw new Exception('未知错误');
		}
	}

	public function statLossAmount($uid,$fromTime,$toTime){
		if(!$uid) return 0;
		if(!$fromTime || !$toTime) return 0;

		$betTimeWhere="and actionTime between $fromTime and $toTime";
		$cashTimeWhere="and c.actionTime between $fromTime and $toTime";
		$rechargeTimeWhere="and r.actionTime between $fromTime and $toTime";
		$fanDiaTimeWhere="and actionTime between $fromTime and $toTime";
		$fanDiaTimeWhere2="and l.actionTime between $fromTime and $toTime";
		$brokerageTimeWhere=$fanDiaTimeWhere2;
		$logTimeWhere=$fanDiaTimeWhere;

		$userWhere="and u.uid={$uid} ";
		$sql="select u.username, u.coin, u.uid, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount, (select sum(l.coin) from xy_coin_log l where l.`uid`=u.`uid` and l.liqType in(50,51,52,53,56) $brokerageTimeWhere) brokerageAmount from xy_members u left join xy_bets b on u.uid=b.uid and b.isDelete=0 $betTimeWhere where 1 $userWhere";

		$homeUdata=$this->getRows($sql .' group by u.uid');
		$homeUid = $homeUdata[0]['uid'];
		$childUidarr = $this->getRows("select uid,name from {$this->prename}members where parentId=$homeUid");

		$count=array();
		$sql="select sum(coin) from {$this->prename}coin_log where uid=? and liqType in(2,3) $fanDiaTimeWhere";


		foreach($homeUdata as $var){
		
			$count['fanDianAmount']=$this->getValue($sql, $var['uid']);
			$count['betAmount']=$var['betAmount'];
			$count['zjAmount']=$var['zjAmount'];
			$count['brokerageAmount']=$var['brokerageAmount'];
		}

		foreach($childUidarr as $child){
				$childrenarr = $this->getRows("SELECT uid FROM `xy_members` WHERE parents LIKE '%$child[uid]%'");
				$childrenUids = implode(',',array_column($childrenarr,'uid'));
				$childrenWhere = 'and u.uid in('.$childrenUids.') ';

				$childarr=$this->getRow("select sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount from xy_members u left join xy_bets b on u.uid=b.uid and b.isDelete=0 $betTimeWhere $childrenWhere");
				$childarr['fanDianAmount'] =$this->getValue("select sum(l.coin) from {$this->prename}coin_log l, {$this->prename}members u where l.liqType between 2 and 3 and l.uid=u.uid $fanDiaTimeWhere2 $childrenWhere", $child['uid']);
				$childarr['brokerageAmount'] =$this->getValue("select sum(l.coin) from {$this->prename}coin_log l, {$this->prename}members u where l.liqType in(50,51,52,53,56) and l.uid=u.uid $brokerageTimeWhere $childrenWhere", $child['uid']);

				$childrenAmout = $childarr['betAmount']+$childarr['zjAmount']+$childarr['fanDianAmount']+$childarr['brokerageAmount'];
				if(!$childrenAmout) continue;

				$count['betAmount']+=$childarr['betAmount'];
				$count['zjAmount']+=$childarr['zjAmount'];
				$count['fanDianAmount']+=$childarr['fanDianAmount'];
				$count['brokerageAmount']+=$childarr['brokerageAmount'];
		}
		
		return $count['zjAmount']-$count['betAmount']+$count['fanDianAmount']+$count['brokerageAmount'];
	}
}

if(!function_exists('array_column')){ 
    	function array_column($input, $columnKey, $indexKey=null){ 
        	$columnKeyIsNumber      = (is_numeric($columnKey)) ? true : false; 
        	$indexKeyIsNull         = (is_null($indexKey)) ? true : false; 
        	$indexKeyIsNumber       = (is_numeric($indexKey)) ? true : false; 
        	$result                 = array(); 
        	foreach((array)$input as $key=>$row){ 
            	if($columnKeyIsNumber){ 
                $tmp            = array_slice($row, $columnKey, 1); 
                $tmp            = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null; 
            }else{ 
                $tmp            = isset($row[$columnKey]) ? $row[$columnKey] : null; 
            } 
            if(!$indexKeyIsNull){ 
                if($indexKeyIsNumber){ 
                    $key        = array_slice($row, $indexKey, 1); 
                    $key        = (is_array($key) && !empty($key)) ? current($key) : null; 
                    $key        = is_null($key) ? 0 : $key; 
                }else{ 
                    $key        = isset($row[$indexKey]) ? $row[$indexKey] : 0; 
                } 
            } 
            $result[$key]       = $tmp; 
        } 
        return $result; 
    	} 
	} 
