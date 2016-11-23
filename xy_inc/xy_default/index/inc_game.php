
<div class="game-main" style="width:920px;margin-top:-21px">
<div id="bet-game">
	<div class="game-btn">
	<?php
		if($_COOKIE['mode']){
			$mode=$_COOKIE['mode'];
		}else{
			$mode=2.00;
		}
		$this->getSystemSettings();
		$this->getTypes();
		$sql="select id, groupName, enable from {$this->prename}played_group where enable=1 and type=? order by sort";
		$groups=$this->getObject($sql, 'id', $this->types[$this->type]['type']);
		if($this->groupId && !$groups[$this->groupId]) unset($this->groupId);
		
		if($groups) foreach($groups as $key=>$group){
			if(!$this->groupId) $this->groupId=$group['id'];
	?>
		<div class="ul-li<?=($this->groupId==$group['id'])?' current':''?>">
        	<a class="cai" href="/index.php/index/group/<?=$this->type .'/'.$group['id']?>"><span class="content"><?=$group['groupName']?></span></a>
		</div>
	<?php } ?>
    <div class="clear"></div>
	</div>
	<div class="game-cont">
		<?php $this->display('index/inc_game_played.php'); ?>

		<div class="num-table" style="height:auto;" id="game-dom">
			<div class="fandian">
				<div class="fandian-k">
					<span class="spn8">奖金/返点：</span>
					<div class="fandian-box">
						<input type="button" class="min" value="" step="-0.1"/>
						<div id="slider" class="slider" value="<?=$this->ifs($_COOKIE['fanDian'], 0)?>" data-bet-count="<?=$this->settings['betMaxCount']?>" data-bet-zj-amount="<?=$this->settings['betMaxZjAmount']?>" max="<?=$this->user['fanDian']?>" game-fan-dian="<?=$this->settings['fanDianMax']?>" fan-dian="<?=$this->user['fanDian']?>" game-fan-dian-bdw="<?=$this->settings['fanDianBdwMax']?>" fan-dian-bdw="<?=$this->user['fanDianBdw']?>" min="0" step="0.1" slideCallBack="gameSetFanDian"></div>
						<input type="button" class="max" value="" step="0.1"/>
					</div>
					<span id="fandian-value" class="fdmoney"><?=$maxPl?>/0%</span>
				</div>
				<div class="danwei">
					<span class="spn8">模式：</span>
					<?php if($this->settings['yuanmosi']==1){?>
					<label>元<input type="radio" value="2.000" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian0']?>" name="danwei" <?=$this->iff($mode=='2.000','checked')?> /></label><?}?>
					<?php if($this->settings['jiaomosi']==1){?>
					<label>角<input type="radio" value="0.200" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian1']?>" name="danwei" <?=$this->iff($mode=='0.200','checked')?> /></label><?}?>
					<?php if($this->settings['fenmosi']==1){?>
					<label>分<input type="radio" value="0.020" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian2']?>" name="danwei" <?=$this->iff($mode=='0.020','checked')?> /></label><?}?>
					<?php if($this->settings['limosi']==1){?>
					<label>厘<input type="radio" value="0.002" data-max-fan-dian="<?=$this->settings['betModeMaxFanDian3']?>" name="danwei" <?=$this->iff($mode=='0.002','checked')?> /></label><?}?>
				</div>
				<div class="beishu">
                <span class="spn8">倍数：</span><input type="button" class="surbeishu" value=""/><input id="beishu" value="<?=$this->ifs($_COOKIE['beishu'],1)?>" class="txt"/><input type="button" class="addbeishu" value=""/></div>
                <div class="tztj-btn"><div class="tztj-hover" onclick="gameActionAddCode()"></div></div>
				<button class="tz-top-btn" onclick="gameActionRemoveCode()">清空号码</button>
			</div>
		</div>
        <div class="line"></div>
		<div class="touzhu">
			<div class="touzhu-top">
                <div class="prompt" id="game-tip-dom"></div>
				<div class="clear"></div>
			</div>
            <div class="line"></div>
			<div class="touzhu-cont">
				<table width="100%">
				</table>
			</div>
            <div class="line"></div>
			<div class="touzhu-bottom">
				<div class="tz-tongji">总投注数：<span id="all-count">0</span>注&nbsp;&nbsp;&nbsp;&nbsp;购买金额：<span id="all-amount">0.00</span>元</div>
				<div class="tz-buytype">
                                    <div class="tz-true-btn"><div class="tz-true-hover" id="btnPostBet">确定投注</div></div>
					<label class="zh-true-btn"><input type="checkbox" name="zhuiHao" value="1" /></label>
					
				</div>

			</div>
		</div>
	</div>
</div>
<div id="znz-game" style="display:none;"></div>
</div>