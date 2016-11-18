<?php

    // 日期限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$timeWhere=' and s.time between '. strtotime($_REQUEST['fromTime']).' and '.strtotime($_REQUEST['toTime']);
	}elseif($_REQUEST['fromTime']){
		$timeWhere=' and s.time >='. strtotime($_REQUEST['fromTime']);
	}elseif($_REQUEST['toTime']){
		$timeWhere=' and s.time <'. strtotime($_REQUEST['toTime']);
	}else{
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $timeWhere=' and s.time between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	}

	$sql="select s.mid, s.title, s.content, s.from_username, s.time from {$this->prename}message_sender s, {$this->prename}sysmember a where s.from_uid={$this->user['uid']} and s.from_deleted=0 $timeWhere and s.from_uid=a.uid order by s.time DESC";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<input type="hidden" value="<?=$this->user['username']?>" />
<table class="tablesorter" cellspacing="0"> 
<thead> 
    <tr> 
	    <th width="60">选项</th>
        <th width="60">编号</th>
		<th width="90">发送者</th>
        <th width="300">主题</th>
		<th>内容</th>
		<th width="120">发送时间</th>
    </tr> 
</thead> 
<tbody id="nav01"> 
<?php
	if($data['data']) foreach($data['data'] as $var){?>
    <tr> 
	    <td><INPUT  type="checkbox" value="<?=$var['mid']?>" name="chk_only"></td>
		<td><?=$var['mid']?></td>
        <td><?=htmlspecialchars($var['from_username'])?></td>
		<td style="text-align:left; padding-left:10px;"><?=$this->CsubStr(htmlspecialchars($var['title']),0,25)?></td>
		<td><?=$this->CsubStr(htmlspecialchars($var['content']),0,65)?></td>
        <td><?=date('m/d H:i',$var['time'])?></td>
    </tr>
<?php }else{ ?>
		<tr>
			<td colspan="6" align="center">暂时没有消息。</td>
		</tr>
	<?php } ?>
    <tr>
    	<td colspan="6" style="text-align:left; padding-left:10px;">
           <label>&nbsp&nbsp&nbsp&nbsp<INPUT  id="chk_All" type="checkbox" value="All" name="chk_All">&nbsp&nbsp全选</label>&nbsp&nbsp
           <a href="/admin778899.php/box/senddelete/" dataType="json" class="removeAllRecord" onajax="sendrecordBeforeDelete" call="senddeleteBet" target="ajax"><input name="delall" type="button" value="删 除" /></a>
		</td>
    </tr>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/sendbox-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>