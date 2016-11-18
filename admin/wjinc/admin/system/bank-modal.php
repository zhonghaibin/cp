<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<input type="hidden" value="<?=$this->user['username']?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/skin/admin/layout.css" media="all" />
</head>
<body>
<form name="system_addBank" action="/admin778899.php/system/updateBank" enctype="multipart/form-data" method="POST">
<?php
	$banks=$this->getRows("select id, name from {$this->prename}bank_list where isDelete=0 order by sort");
	if($args[0]){
		$bankId=intval($args[0]);
		$bank=$this->getRow("select * from {$this->prename}sysadmin_bank where id=$bankId");
		echo '<input type="hidden" name="id" value="', $bank['id'], '"/>';
	}
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
			<td>银行名称</td> 
			<td>
				<select name="bankId">
				<?php if($banks) foreach($banks as $var){ ?>
					<option value="<?=$var['id']?>" <?=$this->iff($bank['bankId']==$var['id'], 'selected')?>><?=$var['name']?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr> 
			<td>账号</td> 
			<td><input type="text" name="account" value="<?=$bank['account']?>"/></td>
		</tr>
		<tr> 
			<td>持卡人</td> 
			<td><input type="text" name="username" value="<?=$bank['username']?>"/></td>
		</tr>
		<tr> 
			<td>状态</td> 
			<td>
				<label><input type="radio" value="1" name="enable" checked="checked"/>开启</label>
				<label><input type="radio" value="0" name="enable"/>关闭</label>
			</td> 
		<tr> 
	</tbody> 
</table>
</form>
</body>
</html>