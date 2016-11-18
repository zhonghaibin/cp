<?php
class Index extends WebLoginBase{
	public $pageSize=10;
	
	public final function game($type=null, $groupId=null, $played=null){
		if($type) $this->type=intval($type);
		if($groupId){
			$this->groupId=intval($groupId);
		}else{
			// 默认进入定位胆玩法
			$this->groupId=6;
		}
		if($played) $this->played=intval($played);
		$this->getSystemSettings();
		$this->display('main.php');
	}
	
  //平台首页
	public final function main(){
		$this->display('index.php');
	}
	
	public final function group($type, $groupId){
		$this->type=intval($type);
		$this->groupId=intval($groupId);
		$this->display('index/load_tab_group.php');
	}
	
	public final function played($type,$playedId){
		$playedId=intval($playedId);
		$sql="select type, groupId, playedTpl from {$this->prename}played where id=?";
		$data=$this->getRow($sql, $playedId);
		$this->type=intval($type);
		if($data['playedTpl']){
			$this->groupId=$data['groupId'];
			$this->played=$playedId;
			$this->display("index/game-played/{$data['playedTpl']}.php");
		}else{
			$this->display('index/game-played/un-open.php');
		}
	}
	
	// 加载玩法介绍信息
	public final function playTips($playedId){
		$this->display('index/inc_game_tips.php', 0, intval($playedId));
	}
	
	public final function getQiHao($type){
		$type=intval($type);
		$thisNo=$this->getGameNo($type);
		return array(
			'lastNo'=>$this->getGameLastNo($type),
			'thisNo'=>$this->getGameNo($type),
			'diffTime'=>strtotime($thisNo['actionTime'])-$this->time,
			'validTime'=>$thisNo['actionTime'],
			'kjdTime'=>$this->getTypeFtime($type)
		);
	}
	
	// 弹出追号层HTML
	public final function zhuiHaoModal($type){
		$this->display('index/game-zhuihao-modal.php');
	}
	
	// 追号层加载期号
	public final function zhuiHaoQs($type, $mode, $count){
		$this->type=intval($type);
		$this->display('index/game-zhuihao-qs.php', 0, $mode, $count);
	}
	
	// 加载历史开奖数据
	public final function getHistoryData($type){
		$this->type=intval($type);
		$this->display('index/inc_data_history.php');
	}

	// 加载历史开奖数据2
	public final function getHistoryData2($type){
		$this->type=intval($type);
		$this->display('index/inc_data_history2.php');
	}

	// 加载历史开奖数据3
	public final function getHistoryData3($type){
		$this->type=intval($type);
		$this->display('index/inc_data_history3.php');
	}

	// 加载历史开奖数据2
	public final function getHistoryDataiframe($type){
		$this->type=intval($type);
		$this->display('index/inc_data_iframe.php');
	}

	// 历史开奖HTML
	public final function historyList($type){
	    $this->type=intval($type);
		$this->display('index/history-list.php',$pageSize,$type);
	}
	
	public final function getLastKjData($type){
		$ykMoney=0;
		$czName='重庆时时彩';
		$this->type=intval($type);
		if(!$lastNo=$this->getGameLastNo($this->type)) throw new Exception('查找最后开奖期号出错');
		if(!$lastNo['data']=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'"))
		throw new Exception('获取数据出错');
		
		$thisNo=$this->getGameNo($this->type);
		$lastNo['actionName']=$czName;
		$lastNo['thisNo']=$thisNo['actionNo'];
		$lastNo['diffTime']=strtotime($thisNo['actionTime'])-$this->time;
		$lastNo['kjdTime']=$this->getTypeFtime($type);
		return $lastNo;
	}
	
	// 加载人员信息框
	public final function userInfo(){
		$this->display('index/inc_user.php');
	}

	// 加载消息
	public final function msg(){
		$this->display('index/inc_msg.php');
	}
}