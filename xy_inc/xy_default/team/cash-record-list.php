<?php
	$sql="select c.*, b.name bankName, u.username from {$this->prename}members u, {$this->prename}bank_list b, {$this->prename}member_cash c where c.uid=u.uid and b.isDelete=0 and c.bankId=b.id";
	
	// 时间条件限制
	if($_GET['fromTime'] && $_GET['toTime']){
		$sql.=' and c.actionTime between '.strtotime($_GET['fromTime']).' and '.strtotime($_GET['toTime']);
	}elseif($_GET['fromTime']){
		$sql.=' and c.actionTime>='.strtotime($_GET['fromTime']);
	}elseif($_GET['toTime']){
		$sql.=' and c.actionTime<'.strtotime($_GET['toTime']);
	}else{
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $sql.=' and c.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
	}
	
	// 用户名限制
	if($_GET['username'] && $_GET['username']!='用户名'){
		$_GET['username']=wjStrFilter($_GET['username']);
		if(!ctype_alnum($_GET['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$sql.=" and u.username like '%{$_GET['username']}%' and concat(',',u.parents,',') like '%,{$this->user['uid']},%'";
	}else{
		// 从属关系限制
		unset($_GET['username']);
		switch($_GET['type']=intval($_GET['type'])){
			case 1:
				//我自己
				$sql.=" and uid={$this->user['uid']}";
			break;
			case 2:
				//直属下线
				if(!$_GET['uid']) $_GET['uid']=$this->user['uid'];
				$sql.=" and u.parentId={$_GET['uid']}";
			break;
			case 3:
				// 所有下级
				$sql.="concat(',',u.parents,',') like '%,{$this->user['uid']},%' and u.uid!={$this->user['uid']}";
			break;
			default:
				// 所有人
				$sql.=" and concat(',',u.parents,',') like '%,{$this->user['uid']},%'";
			break;
		}
	}
	//echo $sql;
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_GET, '', '&');
	
	$stateName=array('已到帐', '正在办理', '已取消', '已支付', '失败');
?>
<table width="100%" class='table_b'>
	<thead>
		<tr class="table_b_th">
			<td>提现金额</td>
			<td>用户帐号</td>
			<td>申请时间</td>
			<td>提现银行</td>
			<td>银行尾号</td>
			<td>状态</td>
		</tr>
	</thead>
	<tbody class="table_b_tr">
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$var['amount']?></td>
			<td><?=$var['username']?></td>
			<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
			<td><?=$var['bankName']?></td>
			<td><?=preg_replace('/^.*(.{4})$/', '\1', $var['account'])?></td>
			<td>
			<?php
				if($var['state']==3 && $var['uid']==$this->user['uid']){
					echo '<div class="sure" id="', $var['id'], '"></div>';
				}else{
					echo $stateName[$var['state']];
				}
			?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php 
	$this->display('inc_page.php',0,$data['total'],$this->pageSize, '/index.php/team/searchCashRecord-{page}?'.$params);
?>