<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php 	$codeNum=$this->getValue("select codeNum from {$this->prename}played where id={$this->played}"); ?>
<div maxlen="<?=$codeNum?>" class="pp" action="tz11x5WeiInput" length="2" >
	<div id="wei-shu" length="2">
		<label><input type="checkbox" value="16" />万</label>
		<label><input type="checkbox" value="8" />千</label>
		<label><input type="checkbox" value="4" />百</label>
		<label><input type="checkbox" value="2" />十</label>
		<label><input type="checkbox" value="1" />个</label>
	</div>
	<textarea id="textarea-code"></textarea>
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
