<?php
	if(!$args[0]) $args[0]=166;		// 默认查看玩法
	$chiTypes=$this->getRows("select a.playid,b.name from {$this->prename}lhc_ratio a left join {$this->prename}played b on b.id=a.playid group by a.playid,b.name order by a.playid");
	$groups=$chiTypes;
	$sql="select * from {$this->prename}lhc_ratio where playid=?";
	$playeds=$this->getRows($sql, $args[0])
?>
<article class="module width_full">
	<header>
		<h3 class="tabs_involved">玩法设置
			<ul class="tabs" style="margin-right:25px;">
			<?php foreach($chiTypes as $chiType){ ?>
				<li <?=$this->iff($args[0]==$chiType['playid'], 'class="active"')?>><a href="lhc/rte/<?=$chiType['playid']?>"><?=$chiType['name']?></a></li>
			<?php } ?>
			</ul>
		</h3>
	</header>
	<?php if($playeds){ ?>
	<table class="tablesorter" cellspacing="0">
		<tbody>
		<?php foreach($playeds as $played){ ?>
			<tr>
				<td width="10%"><?=$played['rName']?></td>
				<td width="20%">赔率：<input type="text" name="Rte" style="width:100px;" value="<?=$played['Rte']?>"></td>
				<td><a href="/admin778899.php/lhc/updateLHCRte/<?=$played['id']?>" target="ajax" method="post" onajax="sysBeforeUpdatePlayed" call="reloadPlayed">保存修改</a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<?php }else{ ?>
		暂时没有玩法
	<?php } ?>
</article>