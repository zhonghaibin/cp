<?php
	$sql="select groupName from {$this->prename}played_group where id=?";
	$groupName=$this->getValue($sql, $this->groupId);

	$sql="select id, name, playedTpl, enable  from {$this->prename}played where enable=1 and groupId=? order by sort";
	$playeds=$this->getRows($sql, $this->groupId);
	if(!$playeds) {echo '<div style="height:150px;margin-top:50px;text-align:center;color:#f00">暂无玩法</div>';return;} 
	if(!$this->played) $this->played=$playeds[0]['id'];
	
?>
<!--div class="game-btn2" style="margin-top:-20px"-->
<div class="game-btn2" style="margin-top:-20px">
	<?php
		if($playeds) foreach($playeds as $played){
			if($this->played==$played['id']){
				$tpl=$played['playedTpl'];
			}
			if($played['enable']){
	?>
	<div class="ul-li<?=($played['id']==$this->played)?' current':''?>"><a data_id="<?=$played['id']?>" href="/index.php/index/played/<?=$this->type?>/<?=$played['id']?>"><?=$played['name']?></a></div>
	<? }} ?>
    <div class="clear"></div>
</div>
<?php if($this->type!=34){?>
<div id="game-helptips"><?php $this->display("index/inc_game_tips.php", 0 ,$this->played); ?></div>
<?}?>
<div class="num-table" id="num-select" >
<?php 
	if(!$played['enable']) {echo '<div style="height:100px;text-align:center;color:#f00">暂无玩法</div>';return;} 
	$this->display("index/game-played/$tpl.php"); ?>
</div>