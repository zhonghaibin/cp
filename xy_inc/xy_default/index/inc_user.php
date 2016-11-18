<?php $this->freshSession();$this->updateSessionTime();
		$ngrade=$this->getValue("select max(level) from {$this->prename}member_level where minScore <= {$this->user['scoreTotal']}");
		if($ngrade>$this->user['grade']){
			$sql="update xy_members set grade={$ngrade} where uid=?";
			$this->update($sql, $this->user['uid']);
		}else{$ngrade=$this->user['grade'];}
		$date=strtotime('00:00:00');
?>
    <div class="userinfo">
        <div class="user-name">客户：<span><?=$this->user['username']?></span></div>
        <div class="user-amount">余额：<span id="ebalance"><?=$this->user['coin']?></span><a href="#" onclick="reloadMemberInfo()"><img src="/images/t.gif" class="refresh" title="刷新余额"></a></div>
        <div class="user-amount-icon" title="充值" id="eDpIcon"></div>
	</div>