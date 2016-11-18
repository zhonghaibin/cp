<?php
	//$sql="select r.*, mb.username accountName, mb.account account, b.name bankName from {$this->prename}member_recharge r,{$this->prename}members u,{$this->prename}member_bank mb, {$this->prename}bank_list b where r.uid=u.uid and mb.id=r.mBankId and mb.bankId=b.id and b.isDelete=0 and r.id={$args[0]}";
	$sql="select r.* from {$this->prename}member_recharge r where r.id={$args[0]}";
	$rechargeInfo=$this->getRow($sql, $args[0]);
	if($rechargeInfo['mBankId']){
		$sql="select mb.username accountName, mb.account account, b.name bankName from {$this->prename}members u,{$this->prename}member_bank mb, {$this->prename}bank_list b where b.isDelete=0 and u.uid={$rechargeInfo['uid']} and mb.id={$rechargeInfo['mBankId']} and mb.bankId=b.id";
		$bankInfo=$this->getRow($sql);
	}
?>
<div class="recharge-modal popupModal">
<input type="hidden" value="<?=$this->user['username']?>" />
	<table width="100%" cellpadding="2" cellspacing="2">
		<tr>
			<td class="title">用户</td>
			<td><?=$rechargeInfo['username']?></td>
		</tr>
		<tr>
			<td class="title">充值金额</td>
			<td><?=$rechargeInfo['amount']?>元</td>
		</tr>
		<tr>
			<td class="title">充值前资金</td>
			<td><?=number_format($rechargeInfo['coin'],2)?>元</td>
		</tr>
		<tr>
			<td class="title">充值银行</td>
			<td><?=$this->ifs($bankInfo['bankName'], '--')?></td>
		</tr>
		<tr>
			<td class="title">银行账号</td>
			<td><?=$this->ifs($bankInfo['account'], '--')?></td>
		</tr>
		<tr>
			<td class="title">开户名</td>
			<td><?=$this->ifs($bankInfo['accountName'], '--')?></td>
		</tr>
        <tr>
			<td class="title">充值时间</td>
			<td><?=date("Y-m-d H:i:s",$rechargeInfo['rechargeTime'])?></td>
		</tr>
	</table>
</div>
