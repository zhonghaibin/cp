<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<input type="hidden" value="<?=$this->user['username']?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>银行管理</title>
<link rel="stylesheet" type="text/css" href="/skin/admin/layout.css" media="all" />
</head>
<body>
<form name="system_addBanklist" action="/admin778899.php/system/updateBanklist" enctype="multipart/form-data" method="POST">
<?php
	$banks=$this->getRows("select * from {$this->prename}bank_list where isDelete=0 order by sort");
	if($banks) foreach($banks as $var){ ?>
?>
<table class="tablesorter left" cellspacing="0" width="100%">
	<thead> 
		<tr> 
			<td>项目</td> 
			<td>值</td> 
		</tr> 
	</thead>
	<tbody>
	    <tr> 
			<td>银行ID</td> 
			<td><input type="text" name="id" value="<?=$var['id']?>"/></td>
		</tr>
		<tr>
		<tr> 
			<td>银行名称</td> 
			<td><input type="text" name="name" value="<?=$var['name']?>"/></td>
		</tr>
		<tr> 
			<td>银行logo</td> 
			<td><input type="text" name="logo" value="<?=$var['logo']?>"/></td>
		</tr>
		<tr> 
			<td>银行网址</td> 
			<td><input type="text" name="home" value="<?=$var['home']?>"/></td>
		</tr>
		<tr> 
			<td>银行顺序</td> 
			<td><input type="text" name="sort" value="<?=$var['sort']?>"/></td>
		</tr>
		<tr> 
			<td>状态</td> 
			<td>
				<label><input type="radio" value="0" name="isDelete" checked="checked"/>开启</label>
				<label><input type="radio" value="1" name="isDelete"/>关闭</label>
			</td> 
		<tr> 
	</tbody> 
</table>
<?}?>
</form>
</body>
</html>