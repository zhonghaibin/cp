<?php
	$sql="select u.username, u.coin, u.uid, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount,(select sum(c.amount) from xy_member_cash c where c.state=0 and c.`uid`=u.`uid`) cashAmount,(select sum(r.amount) from xy_member_recharge r where r.state in(1,2,9) and r.`uid`=u.`uid`) rechargeAmount, (select sum(l.coin) from xy_coin_log l where l.liqType in(50,51,52,53) and l.`uid`=u.`uid`) brokerageAmount from xy_members u left join xy_bets b on u.uid=b.uid and b.isDelete=0 where u.uid=?";
	$var=$this->getRow($sql, $args[0]);

	$var['fanDianAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where uid=? and liqType between 2 and 3", $args[0]);
	$var['rechargeAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where uid=? and liqType=1", $args[0]);
	$var['cashAmount']=$this->getValue("select sum(abs(fcoin)) from {$this->prename}coin_log where uid=? and liqType=107", $args[0]);
	//print_r($parentData);

?>
<div>
	<table cellpadding="2" cellspacing="2" class="popupModal">
	<input type="hidden" value="<?=$this->user['username']?>" />
		<tr>
			<td class="title" width="180">用户名：</td>
			<td><input type="text" readonly="readonly" value="<?=$var['username']?>"/></td>
		</tr>
        	<td class="title">投注总额</td>
            <td><input type="text" readonly="readonly" value="<?=$this->ifs($var['betAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">中奖总额</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['zjAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">总返点</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['fanDianAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">总佣金</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['brokerageAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">充值</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['rechargeAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">提现</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['cashAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">余额</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['coin'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">个人总结算</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['zjAmount']-$var['betAmount']+$var['fanDianAmount']+$var['brokerageAmount'], '--')?>"/></td>
		</tr>
	</table>
</div>