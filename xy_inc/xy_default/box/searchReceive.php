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

	$sql="select s.mid, r.is_readed, s.title, s.from_username, s.time from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.to_uid={$this->user['uid']} and r.is_deleted=0 $timeWhere $stateWhere and r.mid=s.mid order by s.time DESC";
	$list=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_REQUEST, '', '&');
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr class="top">
			<td width="60">选项</td>
            <td>状态</td>
            <td class="tl">主题</td>
			<td>发件人</td>
			<td>时间</td>
		</tr>
	</thead>
	<tbody>
	  <?php if($list['data']) foreach($list['data'] as $var){ ?>
		 <tr class="viewbox" tourl="/index.php/box/detail/<?=$var['mid']?>" dataid="<?=$var['mid']?>" >
			<td><INPUT  type="checkbox" value="<?=$var['mid']?>" name="chk_only"></td>
			<td><?if($var['is_readed']){echo '已读';}else{echo '<span style="color:#FF0000">未读</span>';}?></td>
			<td class="tl"><?if($var['is_readed']){echo '<img src="/skin/images/box/unread.png" align="absmiddle" />';}else{echo '<img src="/skin/images/box/readed.png" align="absmiddle" />';}?><?=$this->CsubStr(htmlspecialchars($var['title']),0,25)?></td>
			<td><?=htmlspecialchars($var['from_username'])?></td>
			<td><?=date("Y-m-d H:i",$var['time'])?></td>
		 </tr>
	  <?php }else{ ?>
		<tr>
			<td colspan="5" align="center">暂无消息。</td>
		</tr>
	<?php } ?>
		<tr>
    	  <td colspan="5" class="tl">
              <label>&nbsp&nbsp&nbsp&nbsp<INPUT  id="chk_All" type="checkbox" value="All" name="chk_All">&nbsp&nbsp全选</label>&nbsp&nbsp
              <a href="/index.php/box/delete/" dataType="json" class="removeAllRecord" onajax="recordBeforeDelete" call="deleteBet" target="ajax"><input name="delall" style="width:50px;" type="button" value="删 除" /></a>
		  </td>
        </tr>
	</tbody>
</table>
<?php 
	$this->display('inc_page.php',0,$list['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/{$this->type}?$params");
?>