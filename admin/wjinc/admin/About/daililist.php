<?php

	// 日期限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$timeWhere=' time between '. strtotime($_REQUEST['fromTime']).' and '.strtotime($_REQUEST['toTime']);
	}elseif($_REQUEST['fromTime']){
		$timeWhere=' time >='. strtotime($_REQUEST['fromTime']);
	}elseif($_REQUEST['toTime']){
		$timeWhere=' time <'. strtotime($_REQUEST['toTime']);
	}else{
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $timeWhere=' time between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	}

	$sql="select * from {$this->prename}inagent where 1 $timeWhere order by time DESC";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<input type="hidden" value="<?=$this->user['username']?>" />
<table class="tablesorter" cellspacing="0"> 
<thead> 
    <tr> 
        <th width="60">选项</th>
		<th width="60">编号</th>
        <th>代理过的平台</th>
		<th>团队每日销量</th>
		<th>QQ</th>
        <th width="140">时间</th>
    </tr> 
</thead> 
<tbody id="nav01"> 
<?php
	if($data['data']) foreach($data['data'] as $var){?>
        <tr>
			<td><INPUT type="checkbox" value="<?=$var['id']?>" name="chk_only"></td>
			<td><?=$var['id']?></td>
			<td style="color:#5E2612"><?=$var['name']?></td>
			<td style="color:red"><?=$var['amount']?></td>
			<td style="color:blue"><?=$var['qq']?></td>
			<td><?=date("Y-m-d H:i:s",$var['time'])?></td>
		</tr>
   <?php }else{ ?>
		<tr>
			<td colspan="8" align="center">暂无申请记录。</td>
		</tr>
	<?php } ?>
	<tr>
    	<td colspan="8" style="text-align:left; padding-left:10px;">
           <label>&nbsp&nbsp&nbsp&nbsp<INPUT  id="chk_All" type="checkbox" value="All" name="chk_All">&nbsp&nbsp全选</label>&nbsp&nbsp
           <a href="/admin778899.php/About/deletedaili" dataType="json" class="removeAllRecord" onajax="receiverecordBeforeDelete" call="receivedeleteBet" target="ajax"><input name="delall" type="button" value="删 除" /></a>
		</td>
    </tr>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/daililist-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>