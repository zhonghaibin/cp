<?php
	$para=$_GET;
	//print_r($para);
	
	// 用户限制
	if($para['username'] && $para['username']!="管理员"){
		$para['username']=wjStrFilter($para['username']);
		if(!ctype_alnum($para['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and u.username like '%{$para['username']}%'";
	}

	// IP限制
	if($para['ip']=ip2long($para['ip'])){
		$para['ip']=wjStrFilter($para['ip']);
		$ipWhere=" and l.actionIp='{$para['ip']}'";
	}

	// 日志类型限制
	if($para['type']=intval($para['type'])){
		$typeWhere="and l.type={$para['type']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and l.actionTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime<$fromTime";
	}else{
		$timeWhere=' and l.actionTime>'.strtotime('00:00');
	}

	$sql="select l.*, u.username from {$this->prename}admin_log l, {$this->prename}sysmember u where l.uid=u.uid $timeWhere $typeWhere $userWhere $ipWhere order by l.id desc";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
	<table class="tablesorter" cellspacing="0">
	<input type="hidden" value="<?=$this->user['username']?>" />
	<thead>
		<tr>
			<th>时间</th>
			<th>管理员</th>
			<th>操作类型</th>
			<th>登录IP</th>
			<th>操作描述</th>
			<th>对应ID</th>
			<th>操作对象</th>
		</tr>
	</thead>
	<tbody id="nav01">
	<?php if($data['data']) foreach($data['data'] as $var){	?>
		<tr>
			<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
			<td><?=$var['username']?></td>
			<td><?=$this->adminLogType[$var['type']]?></td>
			<td><?=long2ip($var['actionIP'])?></td>
			<td><?=$this->ifs($var['action'], '--')?></td>
			<td><?=$this->ifs($var['extfield0'], '--')?></td>			
			<td><?=$this->ifs($var['extfield1'], '--')?></td>			
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="10">暂时没有Log</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/controlLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction');
	?>
	</footer>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>