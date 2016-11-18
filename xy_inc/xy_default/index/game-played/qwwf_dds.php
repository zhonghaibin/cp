<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp pp11" action="tzAllSelect" length="1">
    &nbsp
	<input type="button" value="5单0双" class="code reset2" />
	<input type="button" value="4单1双" class="code reset2" />
	<input type="button" value="3单2双" class="code reset2" />
	<input type="button" value="2单3双" class="code reset2" />
	<input type="button" value="1单4双" class="code reset2" />
	<input type="button" value="0单5双" class="code reset2" />
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>