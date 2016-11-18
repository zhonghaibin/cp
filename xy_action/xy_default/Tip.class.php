
<?php
class Tip extends WebBase{
	 //提示页面
	public final function show($actype){
		$actype=intval($actype);
		$this->display('tips.php', 0, $actype);
	}
	/**
	 *  提款成功提示
	 */
	public final function getTKTip(){
		$sql="select id from {$this->prename}member_cash where (state=0 or state=4) and isDelete=0 and flag=0 and uid={$this->user['uid']} order by id desc";
		if($data=$this->getCol($sql)){
			
			if($cookie=$_COOKIE['cash-TKtip']){
				$cookie=explode(',',$cookie);
				if(!array_diff($data, $cookie)) return array('flag'=>false);
			}
			$this->query("update {$this->prename}member_cash set flag=1 where id={$data[0]}");
			$gdata=$this->getRow("select amount,state,info,bankId from {$this->prename}member_cash where id={$data[0]}");
			$amount=$gdata['amount'];
			$state=$gdata['state'];
			$info=$gdata['info'];
			$bankId=$gdata['bankId'];
			
			$data=implode(',', $data);
			if($data) setcookie('cash-TKtip', $data);

			if($state==4){
				return array(
					'flag'=>true,
					'message'=>'提款失败！<br/>原因：'.$info
				);
			}else{
				return array(
					'flag'=>true,
					'message'=>'提款成功！<br/>金额：'.$amount.'元'
				);	
			}///end state
		}
	}
	
	/**
	 *  充值成功提示  //state=1 前台充值  state=9 后台充值
	 */
	public final function getCZTip(){
		$sql="select id from {$this->prename}member_recharge where (state=1 or state=9) and isDelete=0 and flag=0 and uid={$this->user['uid']} order by id desc";
		if($data=$this->getCol($sql)){
			
			if($cookie=$_COOKIE['cash-CZtip']){
				$cookie=explode(',',$cookie);
				if(!array_diff($data, $cookie)) return array('flag'=>false);
			}
	
			$gRs=$this->getCol("select case when state=9 then amount else rechargeAmount end CZAmount from {$this->prename}member_recharge where id={$data[0]}");
			$CZAmount=$gRs[0];
			$this->query("update {$this->prename}member_recharge set flag=1 where id={$data[0]}");
			
			$data=implode(',', $data);
			if($data) setcookie('cash-CZtip', $data);	
			if($CZAmount>0){
				return array(
					'flag'=>true,
					'message'=>'充值成功！<br>系统充值：'.$CZAmount.'元'
				);
			}else{
				return array(
					'flag'=>true,
					'message'=>'扣款成功！<br>系统扣款：'.abs($CZAmount).'元'
				);
		   }/////
		}
		
	}
	
/**
	 *  盈亏提示
	 */
	public final function getYKTip($type, $ctionNo){
		$type=intval($type);
	 if($type && $ctionNo){
		$this->type=$type;
		$ykMoney=0;
		//获取彩种
		$czName=$this->getValue("select title from {$this->prename}type where id={$this->type}");
		
		$whereStr=" where type={$this->type} and uid={$this->user['uid']} and actionNo='{$ctionNo}' and isDelete=0 and flag=0 and length(lotteryNo)>0";
		
		if($this->getCol("select id from {$this->prename}bets {$whereStr}")){
			$ykMoney=$this->getValue("select IFNULL(sum(bonus-(mode*beiShu*actionNum*(1-fanDian/100))),'0') tMoney from {$this->prename}bets {$whereStr}");
			
			if($ykMoney>0){
				$messager=$czName." 第".$ctionNo."期：<br />盈亏 <font style='color:#F00;font-weight:bold;font-size:14px;'>".round($ykMoney,2)."</font> 元";
			
			}else{
				$messager=$czName." 第".$ctionNo."期：<br />盈亏 <font style='color:#060;font-weight:bold;font-size:14px;'>".round($ykMoney,2)."</font> 元";
			
			}
			$this->query("update {$this->prename}bets set flag=1 {$whereStr}");
			return array(
				'flag'=>true,
				'message'=>$messager
			);
		 }
	}}

	/**
	 *  站内信提示
	 */
	public final function getZNX(){
		$sql="select id from {$this->prename}message_receiver where is_deleted=0 and is_readed=0 and flag=0 and to_uid={$this->user['uid']} order by id desc";
		if($data=$this->getCol($sql)){
			
			if($cookie=$_COOKIE['ZNXtip']){
				$cookie=explode(',',$cookie);
				if(!array_diff($data, $cookie)) return array('flag'=>false);
			}
	
			$this->query("update {$this->prename}message_receiver set flag=1 where id={$data[0]}");
			$data=implode(',', $data);
			if($data) setcookie('ZNXtip', $data);	
			return array(
				'flag'=>true,
				'message'=>'您有新的短消息,请注意查收!<br />',
				'buttons'=>'前往查看:goToDealWithZNX|忽略:defaultCloseModal'
			);
		}
		
	}
}