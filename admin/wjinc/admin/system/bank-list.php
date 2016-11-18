<?php
	$sql="select m.*, b.name bankName, b.logo bankLogo, b.home bankHost from {$this->prename}sysadmin_bank m, {$this->prename}bank_list b where b.id=m.bankId and b.isDelete=0 and m.admin=1";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3 class="tabs_involved">银行设置
			<div class="submit_link wz"><input type="submit" value="添加银行" onclick="sysEditBank()" class="alt_btn"></div>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0" width="100%">
		<thead>
			<tr>
			    <td>标识</td>
				<td>银行</td>
				<td>持卡人</td>
				<td>账号</td>
				<td>状态(开/关)</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody id="nav01">
		<?php if($data['data']) foreach($data['data'] as $var){ ?>
			<tr>
			    <td><img onclick="window.open('<?=$var['bankHost']?>')" class="pointer" src="/<?=$var['bankLogo']?>" width="139" height="38" border="0"/></td>
				<td><?=$var['bankName']?></td>
				<td><?=$var['username']?></td>
				<td><?=$var['account']?></td>
				<td><?=$this->iff($var['enable'], '开', '关')?></td>
				<td><a href="/admin778899.php/system/switchBankStatus2/<?=$var['id']?>" target="ajax" call="sysReloadBank"><?=$this->iff($var['enable'], '关闭', '开启')?></a> | <a href="#" onclick="sysEditBank(<?=$var['id']?>)">修改</a> | <a href="/admin778899.php/system/deleteBank2/<?=$var['id']?>" target="ajax" call="sysReloadBank">删除</a></td>
			</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="5">暂时没有银行信息，请点右上角按钮添加银行</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/notice-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction');
	?>
	</footer>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>