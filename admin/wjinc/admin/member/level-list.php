<?php
	$sql="select * from {$this->prename}member_level order by level";
	$data=$this->getRows($sql);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/admin778899.php/member/setLevel"  method="post" target="ajax" call="setMemberLevel">
	<header><h3 class="tabs_involved">等级设置</h3></header>
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<th>级别</th>
			<th>级别名称</th>
			<th>需要积分</th>
			<th>每日提现次数</th>
		</tr>
	</thead>
	<tbody id="nav01">
	<?php if($data) foreach($data as $level){ ?>
		<tr>
			<td><?=$level['level']?></td>
			<td><input type="text" name="data[<?=$level['id']?>][levelName]" value="<?=$level['levelName']?>" /></td>
			<td><input type="text" name="data[<?=$level['id']?>][minScore]" value="<?=$level['minScore']?>" /></td>
			<td><input type="text" name="data[<?=$level['id']?>][maxToCashCount]" value="<?=$level['maxToCashCount']?>" /></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<footer>
		<div class="submit_link"><input type="submit" class="alt_btn" value="提交修改"/></div>
	</footer>
</form>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>