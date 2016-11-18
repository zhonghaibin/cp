<?php
	$sql="select * from {$this->prename}members where ";
	if($_GET['username'] && $_GET['username']!='用户名'){
		$_GET['username']=wjStrFilter($_GET['username']);
		if(!ctype_alnum($_GET['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		// 按用户名查找时
		// 只要符合用户名且是自己所有下级的都可查询
		// 用户名用模糊方式查询
		$sql.="username like '%{$_GET['username']}%' and concat(',',parents,',') like '%,{$this->user['uid']},%'";
	}else{
		unset($_GET['username']);
		switch($_GET['type']){
			case 0:
				// 所有人
				$sql.="concat(',',parents,',') like '%,{$this->user['uid']},%'";
			break;
			case 1:
				// 我自己
				$sql.="uid={$this->user['uid']}";
			break;
			case 2:
				// 直属下级
				if(!$_GET['uid']) $_GET['uid']=$this->user['uid'];
				$sql.="parentId={$_GET['uid']}";
			break;
			case 3:
				// 所有下级
				$sql.="concat(',',parents,',') like '%,{$this->user['uid']},%' and uid!={$this->user['uid']}";
			break;
		}
	}
	
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	$params=http_build_query($_GET, '', '&');
	//echo $params;
?>
<table width="100%" class='table_b'>
	<thead>
		<tr class="table_b_th">
			<td>用户名</td>
            <td>用户类型</td>
            <td>返点</td>
			<td>余额</td>
			<td>状态</td>
			<td>在线</td>
			<td>Q Q</td>
			<td>注册时间</td>
			<td width="17%">操作</td>
		</tr>
	</thead>
	<tbody class="table_b_tr">
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
	 <?php $login=$this->getRow("select * from {$this->prename}member_session where uid=? order by id desc limit 1", $var['uid']);?>
		<tr>
			<td><?=$var['username']?></td>
            <td><?=$this->iff($var['type'],'代理','会员')?></td>
            <td><?=$var['fanDian']?>%</td>
			<td><?=$var['coin']?></td>
			
			<td><?=$this->iff($var['enable'],'正常','冻结')?></td>
            <td><?=$this->iff($login['isOnLine'] && ($this->time-$login['accessTime']<900), '<font color="#FF0000">在线</font>', '离线')?></td>
			<td><?=$this->iff($var['qq'],$var['qq'],'无')?></td>
			<td><?=date('Y-m-d',$var['regTime'])?></td>
            <?php if($this->user['uid']!=$var['uid'] && $var['parentId']==$this->user['uid']){ ?>
			<td><a href="/index.php/team/userUpdate/<?=$var['uid']?>" style="color:#333;" target="modal"  width="420" title="修改用户" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a>&nbsp;&nbsp;
			<?php if($this->settings['recharge']==1){?>
			<a href="/index.php/team/userUpdate2/<?=$var['uid']?>" style="color:#333;" target="modal"  width="420" title="给下级充值" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">充值</a>&nbsp;&nbsp;
            <?}?>
			<a class="caozuo" href="/index.php/team/searchMember?type=2&uid=<?=$var['uid']?>">查看下级</a></td>
            <?php }else{ ?>
            <td><a class="caozuo" href="/index.php/team/searchMember?type=2&uid=<?=$var['uid']?>">查看下级</a></td>
            <?php } ?>
		</tr>
	<?php } ?>
</table>
<?php 
	$this->display('inc_page.php',0,$data['total'],$this->pageSize, '/index.php/team/searchMember-{page}?'.$params);
?>