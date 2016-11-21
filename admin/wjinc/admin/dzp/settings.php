<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">大转盘配置</h3></header>
	<form name="system_install" action="/admin778899.php/Dzp/updateSettings" method="post" target="ajax" call="dbqbSettings" onajax="dbqbSettingsBefor">
	<table class="tablesorter left" cellspacing="0" width="100%">
		<thead>
			<tr>
				<td width="160" style="text-align:left;">配置项目</td>
				<td style="text-align:left;">配置值</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>大转盘开关</td>
				<td>
					<label><input type="radio" value="1" name="switchWeb" <?=$this->iff($this->dzpsettings['switchWeb'],'checked="checked"')?>/>开启</label>
					<label><input type="radio" value="0" name="switchWeb" <?=$this->iff(!$this->dzpsettings['switchWeb'],'checked="checked"')?>/>关闭</label>
				</td>
			</tr>
			<tr>
				<td>单次消耗积分</td>
				<td>
					<input type="text" class="textWid1" value="<?=$this->dzpsettings['score']?>" name="score"/>&nbsp个
				</td>
			</tr>
			<tr>
				<td>中奖物品及概率</td>
				<td>0°-35°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods035']?>" name="goods035"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance035']?>" name="chance035"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin035']?>" name="coin035"/>元，是否为实物
				<label><input type="radio" value="1" name="shiwu035" <?=$this->iff($this->dzpsettings['shiwu035'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu035" <?=$this->iff(!$this->dzpsettings['shiwu035'],'checked="checked"')?>/>否</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span style="color:#FF0000">*12点钟方向为起点逆时针走势，总概率相加必须为100%，不是现金奖品现金值请默认为0元</span></td>
			</tr>
			<tr>
			   <td></td>
			   <td>37°-71°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods3771']?>" name="goods3771"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance3771']?>" name="chance3771"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin3771']?>" name="coin3771"/>元，是否为实物<label><input type="radio" value="1" name="shiwu3771" <?=$this->iff($this->dzpsettings['shiwu3771'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu3771" <?=$this->iff(!$this->dzpsettings['shiwu3771'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>73°-107°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods73107']?>" name="goods73107"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance73107']?>" name="chance73107"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin73107']?>" name="coin73107"/>元，是否为实物<label><input type="radio" value="1" name="shiwu73107" <?=$this->iff($this->dzpsettings['shiwu73107'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu73107" <?=$this->iff(!$this->dzpsettings['shiwu73107'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>109°-143°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods109143']?>" name="goods109143"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance109143']?>" name="chance109143"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin109143']?>" name="coin109143"/>元，是否为实物<label><input type="radio" value="1" name="shiwu109143" <?=$this->iff($this->dzpsettings['shiwu109143'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu109143" <?=$this->iff(!$this->dzpsettings['shiwu109143'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>145°-179°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods145179']?>" name="goods145179"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance145179']?>" name="chance145179"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin145179']?>" name="coin145179"/>元，是否为实物<label><input type="radio" value="1" name="shiwu145179" <?=$this->iff($this->dzpsettings['shiwu145179'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu145179" <?=$this->iff(!$this->dzpsettings['shiwu145179'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>181°-215°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods181215']?>" name="goods181215"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance181215']?>" name="chance181215"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin181215']?>" name="coin181215"/>元，是否为实物<label><input type="radio" value="1" name="shiwu181215" <?=$this->iff($this->dzpsettings['shiwu181215'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu181215" <?=$this->iff(!$this->dzpsettings['shiwu181215'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>217°-251°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods217251']?>" name="goods217251"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance217251']?>" name="chance217251"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin217251']?>" name="coin217251"/>元，是否为实物<label><input type="radio" value="1" name="shiwu217251" <?=$this->iff($this->dzpsettings['shiwu217251'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu217251" <?=$this->iff(!$this->dzpsettings['shiwu217251'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>253°-287°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods253287']?>" name="goods253287"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance253287']?>" name="chance253287"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin253287']?>" name="coin253287"/>元，是否为实物<label><input type="radio" value="1" name="shiwu253287" <?=$this->iff($this->dzpsettings['shiwu253287'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu253287" <?=$this->iff(!$this->dzpsettings['shiwu253287'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>289°-323°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods289323']?>" name="goods289323"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance289323']?>" name="chance289323"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin289323']?>" name="coin289323"/>元，是否为实物<label><input type="radio" value="1" name="shiwu289323" <?=$this->iff($this->dzpsettings['shiwu289323'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu289323" <?=$this->iff(!$this->dzpsettings['shiwu289323'],'checked="checked"')?>/>否</label></td>
			</tr>
			<tr>
			   <td></td>
			   <td>325°-359°方向奖品：<input type="text" class="textWid1" value="<?=$this->dzpsettings['goods325359']?>" name="goods325359"/>,中奖概率：<input type="text" class="textWid1" value="<?=$this->dzpsettings['chance325359']?>" name="chance325359"/>%，现金<input type="text" class="textWid1" value="<?=$this->dzpsettings['coin325359']?>" name="coin325359"/>元，是否为实物<label><input type="radio" value="1" name="shiwu325359" <?=$this->iff($this->dzpsettings['shiwu325359'],'checked="checked"')?>/>是</label>
				<label><input type="radio" value="0" name="shiwu325359" <?=$this->iff(!$this->dzpsettings['shiwu325359'],'checked="checked"')?>/>否</label></td>
			</tr>
		</tbody>
	</table>
	<footer>
		<div class="submit_link">
			<input type="submit" value="保存修改设置" title="保存设置" class="alt_btn">&nbsp;&nbsp;
			<input type="button" onclick="load('Dzp/dzpsettings')" value="重置" title="重置原来的设置" >
		</div>
	</footer>
	</form>
</article>