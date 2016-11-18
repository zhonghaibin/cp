<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">新增会员</h3></header>
<table>
<tr><td width="360">
	<form action="/admin778899.php/member/added" method="post" target="ajax" onajax="beforeAddMember" call="addMember">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			<tr>
				<td><span class="aq-txt">账号类型：</span></td>
				<td>
					<label><input name="type" type="radio" value="1" title="代理" checked="checked" />代理</label>
					<label><input name="type" type="radio" value="0" title="会员" style="margin-left:30px;" />会员</label>
				</td>
			</tr>
			<tr>
				<td><span class="aq-txt">用户名：</span></td>
				<td><input type="text" name="username" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">密码：</span></td>
				<td><input name="password" type="password" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">确认密码：</span></td>
				<td><input id="cpasswd" type="password" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">联系 Q Q：</span></td>
				<td><input type="text" name="qq" class="t-c" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">返点%：</span></td>
				<td><input type="text" name="fanDian" class="t-c" value="" max="<?=$this->settings['fanDianMax']?>" fanDianDiff=<?=$this->settings['fanDianDiff']?>/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="alt_btn" value="增加成员"/></td>
			</tr>
		</table>
	</form>
	</td>
	<td>
		<table class="tablesorter table2" cellspacing="0"  width="100%" style="border:#ccc solid 1px;">
			<thead>
			<tr>
				<td colspan="3"><strong>新增会员成功</strong></td>
			</tr>
			</thead>
			<tr>
				<td><span class="aq-txt">用户名：</span></td>
				<td><input type="text" id="username" class="t-c" value="" /></td>
				<td><input type="button" class="copy" src="#username" value="复制"/></td>
			</tr>
			<tr>
				<td><span class="aq-txt">密码：</span></td>
				<td><input type="text" id="password" class="t-c" value="" /></td>
				<td><input type="button" class="copy" src="#password" value="复制"/></td>
			</tr>
		</table>
	</td>
</tr>
</table>
</article>