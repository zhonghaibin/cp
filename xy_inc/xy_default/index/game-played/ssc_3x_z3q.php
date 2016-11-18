<?php $z3Pl=$this->getPl($this->type, 16);$z6Pl=$this->getPl($this->type, 17); ?>
<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp" action="tzSscHhzxInput" played="前" length="3" z3min="<?=$z3Pl['bonusPropBase']?>" z6min="<?=$z6Pl['bonusPropBase']?>" z3max="<?=$z3Pl['bonusProp']?>" z6max="<?=$z6Pl['bonusProp']?>">
	<textarea id="textarea-code"></textarea>
</div>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($z3Pl)?>, true);
})
</script>
