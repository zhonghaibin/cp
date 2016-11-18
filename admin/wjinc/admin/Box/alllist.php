<?php

    // 用户名限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$_REQUEST['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere=" and from_username='{$_REQUEST['username']}'";
	}else{
		$userWhere="";
	}

	// 日期限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$timeWhere=' and time between '. strtotime($_REQUEST['fromTime']).' and '.strtotime($_REQUEST['toTime']);
	}elseif($_REQUEST['fromTime']){
		$timeWhere=' and time >='. strtotime($_REQUEST['fromTime']);
	}elseif($_REQUEST['toTime']){
		$timeWhere=' and time <'. strtotime($_REQUEST['toTime']);
	}else{
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $timeWhere=' and time between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	}

	$sql="select mid, title, content, from_username, time from {$this->prename}message_sender where 1 $userWhere $timeWhere order by time DESC";
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
        <td><a href="/admin778899.php/box/allmidinfo/<?=$var['mid']?>" button="" title="消息内容" width="510" modal="true" target="modal"><?=$var['mid']?></a></td> 
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
           <a href="/admin778899.php/box/alldeleteall/" dataType="json" class="removeAllRecord" onajax="alllistrecordBeforeDelete" call="alllistdeleteBet" target="ajax"><input name="delall" type="button" value="永久删除" /></a>
		</td>
    </tr>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/alllist-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>