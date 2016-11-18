<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />

<div class="pp pp11" action="tzKLSFSelect" length="1" >

	<input type="button" value="19" class="code d max" />
	<input type="button" value="20" class="code s max" />
</div>

<?php
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>

