<?php
	$data=$this->getRows("select * from {$this->prename}type where isDelete=0 order by sort");
	//print_r($data);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">彩种设置</h3></header>
	<table class="tablesorter" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td>彩种名称</td>
				<td>彩种简称</td>
				<td title="开奖前关闭投注间隔时间，以秒为单位">停止投注间隔</td>
				<td>开启/关闭</td>
				<td>排序</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody id="nav01">
		<?php if($data) foreach($data as $var){ ?>
			<tr>
				<td><input name="title" value="<?=$var['title']?>"/></td>
				<td><input name="shortName" value="<?=$var['shortName']?>"/></td>
				<td><input type="text" name="data_ftime"  class="textWid1" placeholder="秒" value="<?=$var['data_ftime']?>"/></td>
				<td><input type="checkbox" name="enable" value="1" <?=$this->iff($var['enable'],'checked')?>/></td>
               
				<td><input type="text" name="sort"  class="textWid1" value="<?=$var['sort']?>"/></td>
				<td><a href="/admin778899.php/system/updateType/<?=$var['id']?>" target="ajax" method="POST" onajax="sysBeforeUpdateType" call="sysUpdateType">保存修改</a></td>
			</tr>
		<?php  } ?>
		</tbody>
	</table>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>