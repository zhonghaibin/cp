<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<?php foreach(array('冠军') as $var){ ?>
<div class="pp pp11" delimiter=" " action="tzAllSelect" length="1" >
	<div class="title"><?=$var?></div>
	<input type="button" value="01" class="code min d" />
	<input type="button" value="02" class="code min s" />
	<input type="button" value="03" class="code min d" />
	<input type="button" value="04" class="code min s" />
	<input type="button" value="05" class="code min d" />
	<input type="button" value="06" class="code max s" />
	<input type="button" value="07" class="code max d" />
	<input type="button" value="08" class="code max s" />
	<input type="button" value="09" class="code max d" />
	<input type="button" value="10" class="code max s" />

	&nbsp;&nbsp;
	
	<input type="button" value="清" class="action none" />
    <input type="button" value="双" class="action even" />
    <input type="button" value="单" class="action odd" />
    <input type="button" value="小" class="action small" />
    <input type="button" value="大" class="action large" />
    <input type="button" value="全" class="action all" />
</div>
<?php
	}
	
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>