<?php
	$sql="select * from xy_pay";
	$data=$this->getPage($sql);
?>
<article class="module width_full">
	<header>
		<h3 class="tabs_involved">接口管理
			<div class="submit_link wz">
				<input type="button" value="添加接口" onclick="payAddModal()" class="alt_btn">
			</div>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<td>ID</td>
				<td>商家名</td>
				<td>商户编号</td>
				<td>商户key</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody>
		<?php
			if($data['data']) foreach($data['data'] as $var){
		?>
			<tr>
				<td><?=$var['sid']?></td>
				<td><?=$var['name']?></td>
				<td><?=$var['number']?></td>
				<td><?=$var['mkey']?></td>
				<td><a href="/admin778899.php/pays/deletepay/<?=$var['sid']?>" target="ajax" call="payDelete" dataType="json">删除</a></td>
			</tr>
		<?} ?>
		</tbody>
	</table>
</article>