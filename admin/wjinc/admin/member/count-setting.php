<?php
	$sql="select * from {$this->prename}params_fandianset order by fanDian desc";
	$data=$this->getRows($sql);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">用户等级限额设置</h3>
        <!--div  class="submit_link wz">
            <a href="/admin778899.php/member/addUserCount" target="modal"  width="420" title="添加用户限额" ><input type="button"  class="alt_btn" value="添加"/></a>
        </div-->
      </header>
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<th>返点</th>
			<th>用户限额</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody id="nav01">
	<?php if($data) foreach($data as $level){ ?>
		<tr>
			<td><input type="text" name="fanDian" value="<?=$level['fanDian']?>" /></td>
			<td><input type="text" name="userCount" value="<?=$level['userCount']?>" /></td>
            <td><a href="/admin778899.php/member/updateUserCount/<?=$level['id']?>" target="ajax" method="post" onajax="sysBeforeUpdateUserCount" call="reloadUserCount">保存修改</a> | <a href="/admin778899.php/system/delUserCount/<?=$level['id']?>" target="ajax" call="sysReloadUserCount" title="是否删除？">删除</a></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>