<?php

    // 用户名限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$_GET['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere=" and s.from_username='{$_REQUEST['username']}'";
	}else{
		$userWhere="";
	}

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

	// 消息类型限制
	switch($_REQUEST['state']){
		    case 1:
				$stateWhere=' and r.is_readed=0';
			break;
			case 2:
				$stateWhere=' and r.is_readed=1';
			break;
			case 3:
				$stateWhere=' and r.is_readed between 0 and 1';
			break;
			default:
				$stateWhere=' and r.is_readed between 0 and 1';
	}

	$sql="select s.mid, r.is_readed, s.title, s.content, s.from_username, s.time from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.to_uid={$this->user['uid']} and r.is_deleted=0 $timeWhere $stateWhere $userWhere and r.mid=s.mid order by s.time DESC";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<input type="hidden" value="<?=$this->user['username']?>" />
<table class="tablesorter" cellspacing="0"> 
<thead> 
    <tr> 
        <th width="60">选项</th>
		<th width="60">编号</th>
        <th width="60">状态</th>
		<th width="300">主题</th>
		<th>内容</th>
		<th width="100">发件人</th>
        <th width="90">时间</th> 
		<th width="50">操作</th>
    </tr> 
</thead> 
<tbody id="nav01"> 
<?php
	if($data['data']) foreach($data['data'] as $var){?>
        <tr>
			<td><INPUT type="checkbox" value="<?=$var['mid']?>" name="chk_only"></td>
			<td><a href="/admin778899.php/box/midinfo/<?=$var['mid']?>" button="" title="消息内容" width="510" modal="true" target="modal"><?=$var['mid']?></a></td>
			<td><?if($var['is_readed']){echo '已读';}else{echo '<span style="color:#FF0000">未读</span>';}?></td>
			<td style="text-align:left; padding-left:10px;"><?if($var['is_readed']){echo '<img src="/skin/images/box/unread.png" align="absmiddle" />';}else{echo '<img src="/skin/images/box/readed.png" align="absmiddle" />';}?><?=$this->CsubStr(htmlspecialchars($var['title']),0,25)?></td>
			<td><?=$this->CsubStr(htmlspecialchars($var['content']),0,65)?></td>
			<td><?=htmlspecialchars($var['from_username'])?></td>
			<td><?=date("m/d H:i",$var['time'])?></td>
			<td><div class="answer"><a href="/admin778899.php/box/answer/<?=$var['mid']?>" class="myanswer" target="modal" width="600" title="回复" modal="true" button=""><input value="回 复" class="bnt" type="button"></a></div></td>
		</tr>
   <?php }else{ ?>
		<tr>
			<td colspan="8" align="center">暂无消息。</td>
		</tr>
	<?php } ?>
	<tr>
    	<td colspan="8" style="text-align:left; padding-left:10px;">
           <label>&nbsp&nbsp&nbsp&nbsp<INPUT  id="chk_All" type="checkbox" value="All" name="chk_All">&nbsp&nbsp全选</label>&nbsp&nbsp
           <a href="/admin778899.php/box/receivelist" dataType="json" class="removeAllRecord" onajax="receiverecordBeforeDelete" call="receivedeleteBet" target="ajax"><input name="delall" type="button" value="删 除" /></a>
		</td>
    </tr>
</tbody> 
</table>
<footer>
	<?php
		$rel=get_class($this).'/receivebox-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>