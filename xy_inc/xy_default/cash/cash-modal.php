<?php
	$sql="select c.*, u.username user, u.coin coin, b.name bankName from {$this->prename}member_cash c,{$this->prename}members u, {$this->prename}bank_list b where b.isDelete=0 and c.id={$args[0] and b.id=c.bankId and c.uid=u.uid}";
	$cashInfo=$this->getRow($sql, $args[0]);
?>
<div class="cash-modal popupModal">
	<table width="100%" cellpadding="2" cellspacing="2">
		<tr>
			<td class="title">用户</td>
			<td><?=$cashInfo['user']?></td>
		</tr>
		<tr>
			<td class="title">提现金额</td>
			<td><?=$cashInfo['amount']?>元</td>
		</tr>
		<tr>
			<td class="title">提现前可用资金</td>
			<td><?=number_format($cashInfo['coin'])?>元</td>
		</tr>
		<tr>
			<td class="title">银行</td>
			<td><?=$cashInfo['bankName']?></td>
		</tr>
		<tr>
			<td class="title">账号</td>
			<td><?=$cashInfo['account']?></td>
		</tr>
		<tr>
			<td class="title">开户名</td>
			<td><?=$cashInfo['username']?></td>
		</tr>
        <tr>
			<td class="title">申请时间</td>
			<td><?=date("Y-m-d H:i:s",$cashInfo['actionTime'])?></td>
		</tr>
	</table>
</div>