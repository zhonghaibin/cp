<script>
function dzyhSettings(err, data){
	if(err){
		error(err);
	}else{
		success('修改电子银行设置成功');
	}
}
$("#ckzdsj").keyup(function(){
   var ckzdsj=$("#ckzdsj").val();
   $("#month").html(ckzdsj);
});
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">电子银行配置</h3></header>
	<form name="system_install" action="/admin778899.php/Dzyh/updateSettings" method="post" target="ajax" call="dzyhSettings" onajax="dzyhSettingsBefor">
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>存款开关</td>
				<td>
					<label><input type="radio" value="1" name="switchck" <?=$this->iff($this->dzyhsettings['switchck'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchck" <?=$this->iff(!$this->dzyhsettings['switchck'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>提款开关</td>
				<td>
					<label><input type="radio" value="1" name="switchtk" <?=$this->iff($this->dzyhsettings['switchtk'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchtk" <?=$this->iff(!$this->dzyhsettings['switchtk'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>存款按最少</td>
				<td>
					<input type="text" id="ckzdsj" class="textWid1" value="<?=$this->dzyhsettings['ckzdsj']?>" name="ckzdsj"/>&nbsp小时计算，如果存款没有达到&nbsp<span id="month"><?=$this->dzyhsettings['ckzdsj']?></span>&nbsp小时就取款，那么只能取得本金，无利息。
				</td>
			</tr>
			<tr>
				<td>最低存款</td>
				<td>
					<input type="text" id="ckzdje" class="textWid1" value="<?=$this->dzyhsettings['ckzdje']?>" name="ckzdje"/>&nbsp元，最高存款&nbsp<input type="text" id="ckzgje" class="textWid1" value="<?=$this->dzyhsettings['ckzgje']?>" name="ckzgje"/>&nbsp元
				</td>
			</tr>
			<tr>
				<td>最低提款</td>
				<td>
					<input type="text" id="tkzdje" class="textWid1" value="<?=$this->dzyhsettings['tkzdje']?>" name="tkzdje"/>&nbsp元，最高提款&nbsp<input type="text" id="tkzgje" class="textWid1" value="<?=$this->dzyhsettings['tkzgje']?>" name="tkzgje"/>&nbsp元
				</td>
			</tr>
			<tr>
				<td>存款</td>
				<td>
					<input type="text" class="textWid1" readonly="true" value="<?=$this->dzyhsettings['ckdate1']?>" name="ckdate1"/>&nbsp日，日利息为&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['cklv1']?>" name="cklv1"/>&nbsp%，例如，存款&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckeg1']?>" name="ckeg1"/>&nbsp元，那么&nbsp<?=$this->dzyhsettings['ckdate1']?>&nbsp天后提出，可得到利息<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100?>*<?=$this->dzyhsettings['ckdate1']?>=<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100*$this->dzyhsettings['ckdate1']?>元。
				</td>
			</tr>
			<tr>
				<td>存款</td>
				<td>
					<input type="text" class="textWid1" readonly="true" value="<?=$this->dzyhsettings['ckdate2']?>" name="ckdate2"/>&nbsp日，日利息为&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['cklv2']?>" name="cklv2"/>&nbsp%，例如，存款&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckeg2']?>" name="ckeg2"/>&nbsp元，那么&nbsp<?=$this->dzyhsettings['ckdate2']?>&nbsp天后提出，可得到利息<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100?>*<?=$this->dzyhsettings['ckdate2']?>=<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100*$this->dzyhsettings['ckdate2']?>元。
				</td>
			</tr>
			<tr>
				<td>存款</td>
				<td>
					<input type="text" class="textWid1"  readonly="true" value="<?=$this->dzyhsettings['ckdate3']?>" name="ckdate3"/>&nbsp日，日利息为&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['cklv3']?>" name="cklv3"/>&nbsp%，例如，存款&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckeg3']?>" name="ckeg3"/>&nbsp元，那么&nbsp<?=$this->dzyhsettings['ckdate3']?>&nbsp天后提出，可得到利息<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100?>*<?=$this->dzyhsettings['ckdate3']?>=<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100*$this->dzyhsettings['ckdate3']?>元。
				</td>
			</tr>
			<!--<tr>
				<td>存款</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckdate4']?>" name="ckdate4"/>&nbsp个月(<?=$this->dzyhsettings['ckdate4']*30?>天)，日利息为&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['cklv4']?>" name="cklv4"/>&nbsp%，例如，存款&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckeg4']?>" name="ckeg4"/>&nbsp元，那么&nbsp<?=$this->dzyhsettings['ckdate4']?>&nbsp个月后提出，可得到利息<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100?>*<?=$this->dzyhsettings['ckdate4']*30?>=<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100*$this->dzyhsettings['ckdate4']*30?>元。
				</td>
			</tr>
			<tr>
				<td>存款</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckdate5']?>" name="ckdate5"/>&nbsp年(<?=$this->dzyhsettings['ckdate5']*12*30?>天)，日利息为&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['cklv5']?>" name="cklv5"/>&nbsp%，例如，存款&nbsp<input type="text" class="textWid1" value="<?=$this->dzyhsettings['ckeg5']?>" name="ckeg5"/>&nbsp元，那么&nbsp<?=$this->dzyhsettings['ckdate5']?>&nbsp年后提出，可得到利息<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100?>*<?=$this->dzyhsettings['ckdate5']*360?>=<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100*$this->dzyhsettings['ckdate5']*360?>元。
				</td>
			</tr>-->
					<input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['ckdate4']?>" name="ckdate4"/> <input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['cklv4']?>" name="cklv4"/> <input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['ckeg4']?>" name="ckeg4"/>
					<input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['ckdate5']?>" name="ckdate5"/> <input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['cklv5']?>" name="cklv5"/> <input type="hidden" class="textWid1" value="<?=$this->dzyhsettings['ckeg5']?>" name="ckeg5"/>
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
		    &nbsp&nbsp&nbsp&nbsp(保存并清空缓存后生效)
			<input type="submit" value="保存修改设置" title="保存设置" class="alt_btn">&nbsp;&nbsp;
			<input type="button" onclick="load('dzyh/dzyhsettings')" value="重置" title="重置原来的设置" >
		</div>
	</footer>
	</form>
</article>