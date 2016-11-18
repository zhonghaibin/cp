<?php
class Display extends WebLoginBase{
	public final function freshKanJiang($type=null, $groupId=null, $played=null){
		if($type) $this->type=intval($type);
		if($groupId) $this->groupId=intval($groupId);
		if($played) $this->played=intval($played);
		$this->display('index/inc_data_current.php');
	}
	
	public final function sign(){
		$minCoin=10;			// 最底签到资金
		$liqType=50;		// 流动资金类型：签到
		$liqInfo='签到活动';
		
		// 查看可用资金
		if($this->user['coin']<$minCoin) throw new Exception(sprintf('只有可用资金大于%.2f元时才能参与每日签到活动。', $minCoin));
		
		// 读取签到每次赠送资金
		// 如果资金为0，表示关闭这活动
		$this->getSystemSettings();
		if(!$coin=floatval($this->settings['huoDongSign'])) throw new Exception('很遗憾，每日签到活动已经结束。');
		
		// 只有绑定银行卡才能参与签到活动
		$sql="select bankId from {$this->prename}member_bank where `uid`={$this->user['uid']} and enable=1 order by id limit 1";
		if(!$this->getValue($sql)) throw new Exception('只有绑定银行卡后才能参与签到活动');
		//throw new Exception($sql);
		
		// 查询当日是否已经签到过
		$sql="select count(*) from {$this->prename}coin_log where actionTime>=? and liqType=$liqType and `uid`={$this->user['uid']}";
		if($this->getValue($sql, strtotime('00:00'))) throw new Exception('对不起，今天您已经签到过了，请明天再来');
		$this->addCoin(array(
			'info'=>$liqInfo,
			'liqType'=>$liqType,
			'coin'=>$coin
		));
		return '签到成功,系统赠送您'.$coin.'元!请注意查收。';
	}
}