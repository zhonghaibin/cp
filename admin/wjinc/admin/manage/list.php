<?php
	$sql="select uid, username, isDelete, enable from {$this->prename}sysmember where admin=1";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($sql);
	$sql="select * from {$this->prename}sysadmin_session where uid=? order by id desc limit 1";
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3 class="tabs_involved">管理员管理
			<div class="submit_link wz">
				<input type="button" value="添加管理员" onclick="manageAddManagerModal()" class="alt_btn">
			</div>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<td>UID</td>
				<td>用户名</td>
				<td>登录IP</td>
				<td>状态</td>
				<td>最后登录时间</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody>
		<?php
			if($data['data']) foreach($data['data'] as $var){
				if(!$var['isDelete']){
				$login=$this->getRow($sql, $var['uid']);
		?>
			<tr>
				<td><?=$var['uid']?></td>
				<td><?=$var['username']?></td>
				<td><?=$this->ifs(long2ip($login['loginIP']),'--')?></td>
				<td><?=$this->iff($login['isOnLine'] && ceil(strtotime(date('Y-m-d H:i:s', time()))-strtotime(date('Y-m-d H:i:s',$login['accessTime'])))<$GLOBALS['conf']['member']['sessionTime'], '<font color="#FF0000">在线</font>', '离线')?></td> 
				<td><?=$this->iff($login['loginTime'],date('Y-m-d H:i:s', $login['loginTime']),'--')?></td>
                <?php
				if($var['username']=='admin'){
				?>
				<td><a href="/admin778899.php/manage/pwdManagerModal/<?=$var['uid']?>" target="ajax" call="manageChangePwdModal">修改密码</a></td>
                 <?php
				}else{
				?>
                <td><a href="/admin778899.php/manage/pwdManagerModal/<?=$var['uid']?>" target="ajax" call="manageChangePwdModal">修改密码</a> | <a href="/admin778899.php/manage/deleteManager/<?=$var['uid']?>" target="ajax" call="manageDeleteManager" dataType="json">删除</a></td>
                 <?php
				}
				?>
			</tr>
		<?php 
				}else{?>
                
			    <tr style="color:#999999;">
				<td><?=$var['uid']?></td>
				<td><?=$var['username']?></td>
				<td><?=$this->ifs(long2ip($login['loginIP']),'--')?></td>
				<td>已被删除</td>
				<td><?=$this->iff($login['loginTime'],date('Y-m-d H:i:s', $login['loginTime']),'--')?></td>
                <td><a href="/admin778899.php/manage/backNormalManager/<?=$var['uid']?>" target="ajax" call="manageBackNormalManager" dataType="json">还原</a> | <a href="/admin778899.php/manage/clearManager/<?=$var['uid']?>" target="ajax" onajax="beforeClearManager" call="manageClearManager" dataType="json">清除</a></td>
                
			</tr>
		<?php			}
		} ?>
		</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/coinLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction');
	?>
	</footer>
</article>