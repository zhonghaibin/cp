<?php
	$sql="select id,name,logo,home,sort,isDelete from {$this->prename}bank_list";
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
			    <td>ID</td>
			    <td>标识</td>
				<td>名称</td>
				<td>地址</td>
				<td>排序</td>
				<td>开关</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody id="nav01">
		<?php if($data['data']) foreach($data['data'] as $var){ ?>
			<tr>
			    <td><?=$var['id']?></td>
			    <td><img onclick="window.open('<?=$var['home']?>')" class="pointer" src="/<?=$var['logo']?>" width="139" height="38" border="0"/></td>
				<td><?=$var['name']?></td>
				<td><?=$var['home']?></td>
				<td><?=$var['sort']?></td>
				<td><?=$this->iff($var['isDelete'], '关', '开')?></td>
				<td><a href="/admin778899.php/system/switchBankStatus3/<?=$var['id']?>" target="ajax" call="ReloadBanklist"><?=$this->iff($var['isDelete'], '开启', '关闭')?></a> | <a href="#" onclick="sysEditBanklist(<?=$var['id']?>)">修改</a> | <a href="/admin778899.php/system/deleteBank2/<?=$var['id']?>" target="ajax" call="sysReloadBank">删除</a></td>
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