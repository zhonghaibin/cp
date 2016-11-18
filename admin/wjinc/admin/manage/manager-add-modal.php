<div class="manager-edit">
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/admin778899.php/manage/addManager" target="ajax" method="post" call="manageAddManager" onajax="manageBeforeAddManager">
	<table class="tablesorter left" cellspacing="0"> 
	<tbody> 
		<tr> 
			<td>用户名</td> 
			<td><input type="text" value="" name="username"/></td> 
		</tr> 
		<tr> 
			<td>密码</td> 
			<td><input type="password" value="" name="password"/></td> 
		</tr> 
		<tr> 
			<td>再次输入密码</td> 
			<td><input type="password" value="" class="cpwd"/></td> 
		</tr> 
	</tbody> 
	</table>
</form>
</div>