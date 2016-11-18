<script>
function dbqbSettings(err, data){
	if(err){
		error(err);
	}else{
		success('修改夺宝设置成功');
	}
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">夺宝配置</h3></header>
	<form name="system_install" action="/admin778899.php/Dbqb/updateSettings" method="post" target="ajax" call="dbqbSettings" onajax="dbqbSettingsBefor">
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>夺宝奇兵开关</td>
				<td>
					<label><input type="radio" value="1" name="switchWeb" <?=$this->iff($this->dbqbsettings['switchWeb'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchWeb" <?=$this->iff(!$this->dbqbsettings['switchWeb'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>账户余额大于</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->dbqbsettings['scoin']?>" name="scoin"/>&nbsp元，方可参加活动。
				</td>
			</tr>
			<tr>
				<td>今日消费必须满</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->dbqbsettings['xcoin']?>" name="xcoin"/>&nbsp元，方可参加活动。
				</td>
			</tr>
			<tr>
				<td>活动时间</td>
				<td>
					从 <input type="time" value="<?=$this->dbqbsettings['FromTime']?>" name="FromTime" class="textWid1"/> 到 <input type="time" value="<?=$this->dbqbsettings['ToTime']?>" name="ToTime" class="textWid1"/><br><br>*请开启mysql事件功能，默认宝箱数量重置时间为00:10，服务器时间务必核对好北京时间
				</td>
			</tr>
			<tr>
				<td>宝箱数量</td>
				<td>
					每次开启&nbsp<input type="text" class="textWid1" value="<?=$this->dbqbsettings['num']?>" name="num"/>&nbsp个宝箱，抢完为止。
				</td>
			</tr>
			<tr>
				<td>宝箱金额配置(*隔开)</td>
				<td>
					<textarea name="value" cols="56" rows="5"><?=$this->dbqbsettings['value']?></textarea>
				</td>
			</tr>
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
		    &nbsp&nbsp&nbsp&nbsp(保存并清空缓存后生效)
			<input type="submit" value="保存修改设置" title="保存设置" class="alt_btn">&nbsp;&nbsp;
			<input type="button" onclick="load('Dbqb/dbqbsettings')" value="重置" title="重置原来的设置" >
		</div>
	</footer>
	</form>
</article>