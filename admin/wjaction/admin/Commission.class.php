<?php
class Commission extends AdminBase{
	public $pageSize=15;

	public final function conCommissionList(){
		$this->display('commission/con-list.php');
	}

	public final function lossCommissionList(){
		$this->display('commission/loss-list.php');
	}

	public final function updateCommStatus(){

		if(!isset($_GET['commStatusName'])) throw new Exception('参数出错');
		$commStatusName = $_GET['commStatusName'];
		$sql = "update {$this->prename}members set $commStatusName=0";
		$this->update($sql);
		echo '更新发放状态成功！！！';
	}
	public final function conComSingle($uid){
		if(!$uid=intval($uid)) throw new Exception('参数出错');

		$yesterday = date("Y-m-d",strtotime("-1 day"));
		$fromTime = strtotime($yesterday.' 00:00:00');
		$toTime = strtotime($yesterday.' 24:00:00');
		//$toTime = time();
		// 加载系统设置
		// and betAmount > ".floatval($this->settings['conCommissionBase1'])."
		$this->getSystemSettings();
		//echo floatval($this->settings['conCommissionBase1']);
		//exit;
		$sql="select u.username, u.coin, u.uid, u.type, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount from xy_members u left join xy_bets b on u.uid=b.uid and b.isDelete=0 and b.actionTime between $fromTime and $toTime where 1 and u.uid={$uid} group by u.uid";
		$res = $this->getRows($sql);
		$userbets = $res[0];
		$betAmount = $userbets['betAmount'];
		$this->beginTransaction();
		try{
			
			if(floatval($this->settings['conCommissionBase']) > $betAmount && floatval($this->settings['conCommissionBase1']) <= $betAmount){
			//执行消费佣金第一规则
			//$sql="select parentId from {$this->prename}members where `uid`=?";
			$log=array(
				'liqType'=>53,
				'info'=>'下级['.$userbets['username'].']消费佣金',
				'extfield0'=>$uid,
				'extfield1'=>$userbets['username']
			);

			if($parentId=$userbets['parentId']){
				if($pro=floatval($this->settings['conCommissionParentAmount3'])){
					//$log['coin']=$pro * $coin /100;
					$log['coin']=$pro;
					$log['uid']=$parentId;
					$this->addCoin($log);
					$sql="select username from {$this->prename}members where `uid`=?";
					$parentName = $this->getValue($sql,$parentId);
					$this->addLog(20,$this->adminLogType[20].'['.$parentName.'<='.$userbets['username'].']',$uid,$userbets['username']);
				}
			}
			}else if(floatval($this->settings['conCommissionBase']) <= $betAmount){
				//执行消费佣金第二规则
					$log=array(
						'liqType'=>53,
						'extfield0'=>$uid
					);

					if($parentId=$userbets['parentId']){
						if($pro=floatval($this->settings['conCommissionParentAmount'])){
							//$log['coin']=$pro * $coin /100;
							$log['coin']=$pro;
							$log['uid']=$parentId;
							$log['info']='下级['.$userbets['username'].']消费佣金';
							$log['extfield1']=$userbets['username'];
							$this->addCoin($log);
							$sql="select username from {$this->prename}members where `uid`=?";
							$parentName = $this->getValue($sql,$parentId);
							$this->addLog(20,$this->adminLogType[20].'['.$parentName.'<='.$userbets['username'].']',$uid,$userbets['username']);
						}
						$sql="select parentId,username from {$this->prename}members where `uid`=?";
						$res=$this->getRows($sql, $parentId);
						$parent=$res[0];
						if($parentId=$parent['parentId']){
							if($pro=floatval($this->settings['conCommissionParentAmount2'])){
								//$log['coin']=$pro * $coin /100;
								$log['coin']=$pro;
								$log['uid']=$parentId;
								$log['info']='下级['.$parent['username'].'<='.$userbets['username'].']消费佣金';
								$log['extfield1']=$parent['username'].'<='.$userbets['username'];
								$this->addCoin($log);
								$sql="select username from {$this->prename}members where `uid`=?";
								$parentName = $this->getValue($sql,$parentId);
								$this->addLog(20,$this->adminLogType[20].'['.$parentName.'<='.$parent['username'].'<='.$userbets['username'].']',$uid,$userbets['username']);
							}
						}
					}
			}
			$sql="update {$this->prename}members set conCommStatus=1 where uid=$uid";
			if($this->update($sql)){
				$this->commit();
				echo "消费佣金发放成功";
			}
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
		

	public final function lossComSingle($uid){
			if(!$uid=intval($uid)) throw new Exception('参数出错');

			$yesterday = date("Y-m-d",strtotime("-1 day"));
			$fromTime = strtotime($yesterday.' 00:00:00');
			$toTime = strtotime($yesterday.' 24:00:00');
		//$toTime = time();
		// 加载系统设置
		// and betAmount > ".floatval($this->settings['conCommissionBase1'])."
			$this->getSystemSettings();
		//echo floatval($this->settings['conCommissionBase1']);
		//exit;
			$sql="select u.username, u.coin, u.uid, u.type, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount, (select sum(coin) from xy_coin_log l where l.`uid`=u.`uid` and liqType in(2,3) and l.actionTime between $fromTime and $toTime) fanDianAmount from xy_members u left join xy_bets b on u.uid=b.uid and b.isDelete=0 and b.actionTime between $fromTime and $toTime where 1 and u.uid={$uid} group by u.uid";
			$res = $this->getRows($sql);
			$userloss = $res[0];

			$sql2="select sum(coin) from {$this->prename}coin_log where uid=? and liqType in(50,51,52,53,56) and l.actionTime between $fromTime and $toTime";
			$userloss['brokerageAmount'] = $this->getValue($sql, $uid);

			$lossAmount = $userloss['zjAmount'] - $userloss['betAmount'] + $userloss['fanDianAmount'] + $userloss['brokerageAmount'];
			//var_dump($lossAmount);
			//exit;
			$this->beginTransaction();
			try{
			
				if(floatval($this->settings['lossCommissionBase']) > abs($lossAmount) && floatval($this->settings['lossCommissionBase1']) <= abs($lossAmount)){
			//执行亏损佣金第一规则
			//$sql="select parentId from {$this->prename}members where `uid`=?";
			$log=array(
				'liqType'=>56,
				'info'=>'下级['.$userloss['username'].']亏损佣金',
				'extfield0'=>$uid,
				'extfield1'=>$userloss['username']
			);

			if($parentId=$userloss['parentId']){
				if($pro=floatval($this->settings['lossCommissionParentAmount3'])){
					//$log['coin']=$pro * $coin /100;
					$log['coin']=$pro;
					$log['uid']=$parentId;
					$this->addCoin($log);
					$sql="select username from {$this->prename}members where `uid`=?";
					$parentName = $this->getValue($sql,$parentId);
					$this->addLog(21,$this->adminLogType[21].'['.$parentName.'<='.$userloss['username'].']',$uid,$userloss['username']);
				}
			}
			}else if(floatval($this->settings['lossCommissionBase']) <= abs($lossAmount)){
				//执行亏损佣金第二规则
					$log=array(
						'liqType'=>56,
						'extfield0'=>$uid
					);

					if($parentId=$userloss['parentId']){
						if($pro=floatval($this->settings['lossCommissionParentAmount'])){
							//$log['coin']=$pro * $coin /100;
							$log['coin']=$pro;
							$log['uid']=$parentId;
							$log['info']='下级['.$userloss['username'].']亏损佣金';
							$log['extfield1']=$userloss['username'];
							$this->addCoin($log);
							$sql="select username from {$this->prename}members where `uid`=?";
							$parentName = $this->getValue($sql,$parentId);
							$this->addLog(21,$this->adminLogType[21].'['.$parentName.'<='.$userloss['username'].']',$uid,$userloss['username']);
						}
						$sql="select parentId,username from {$this->prename}members where `uid`=?";
						$res=$this->getRows($sql, $parentId);
						$parent=$res[0];
						if($parentId=$parent['parentId']){
							if($pro=floatval($this->settings['lossCommissionParentAmount2'])){
								//$log['coin']=$pro * $coin /100;
								$log['coin']=$pro;
								$log['uid']=$parentId;
								$log['info']='下级['.$parent['username'].'<='.$userloss['username'].']亏损佣金';
								$log['extfield1']=$parent['username'].'<='.$userloss['username'];
								$this->addCoin($log);
								$sql="select username from {$this->prename}members where `uid`=?";
								$parentName = $this->getValue($sql,$parentId);
								$this->addLog(21,$this->adminLogType[21].'['.$parentName.'<='.$parent['username'].'<='.$userloss['username'].']',$uid,$userloss['username']);
							}
						}
					}
			}
			$sql="update {$this->prename}members set lossCommStatus=1 where uid=$uid";
			if($this->update($sql)){
				$this->commit();
				echo "亏损佣金发放成功";
			}
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}

	}
}
?>
