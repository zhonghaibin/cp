<?php
	$sql="select type, time, number, data from xy_data where type={$args[0]}";
	$sql=$sql." order by number desc";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
    $typename=$this->getValue("select title from xy_type where id=?",$args[0]);
?>
<div class="bet-info popupModal">
<table width="100%">
	<tbody class="ht-cont">
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$typename?></td>
			<td><?=$var['number']?></td>
			<td><?=$var['data']?></td>
			<td><?=date('H:i', $var['time'])?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
	$this->display('inc_page.php',0,$data['total'],$this->pageSize, '/index.php/index/historyList-{page}/'.$args[0]);
?>
</div>