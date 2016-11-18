<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp pp11" action="tz11x5Select" length="7" >
	<span class="title2"></span>
	<input type="button" value="01" class="code min d" />
	<input type="button" value="02" class="code min s" />
	<input type="button" value="03" class="code min d" />
	<input type="button" value="04" class="code min s" />
	<input type="button" value="05" class="code min d" />
	<input type="button" value="06" class="code min s" />
	<input type="button" value="07" class="code min d" />
	<input type="button" value="08" class="code min s" />
	<input type="button" value="09" class="code min d" />
	<input type="button" value="10" class="code min s" />
    <input type="button" value="11" class="code min d" />
	<input type="button" value="12" class="code min s" />
	<input type="button" value="13" class="code min d" />
	<input type="button" value="14" class="code min s" />
	<input type="button" value="15" class="code min d" />
	<input type="button" value="16" class="code min s" />
	<input type="button" value="17" class="code min d" />
	<input type="button" value="18" class="code min s" />
	<input type="button" value="19" class="code min d" />
	<input type="button" value="20" class="code min s" />
	<div class="clearfix"></div><span class="title2"></span>
    <input type="button" value="21" class="code min d" />
	<input type="button" value="22" class="code min s" />
	<input type="button" value="23" class="code min d" />
	<input type="button" value="24" class="code min s" />
	<input type="button" value="25" class="code min d" />
	<input type="button" value="26" class="code min s" />
	<input type="button" value="27" class="code min d" />
	<input type="button" value="28" class="code min s" />
	<input type="button" value="29" class="code min d" />
	<input type="button" value="30" class="code min s" />
    <input type="button" value="31" class="code min d" />
	<input type="button" value="32" class="code min s" />
	<input type="button" value="33" class="code min d" />
	<input type="button" value="34" class="code min s" />
	<input type="button" value="35" class="code min d" />
	<input type="button" value="36" class="code min s" />
	<input type="button" value="37" class="code min d" />
	<input type="button" value="38" class="code min s" />
	<input type="button" value="39" class="code min d" />
	<input type="button" value="40" class="code min s" />
   <div class="clearfix"></div><span class="title2"></span>
    <input type="button" value="41" class="code max d" />
	<input type="button" value="42" class="code max s" />
	<input type="button" value="43" class="code max d" />
	<input type="button" value="44" class="code max s" />
	<input type="button" value="45" class="code max d" />
	<input type="button" value="46" class="code max s" />
	<input type="button" value="47" class="code max d" />
	<input type="button" value="48" class="code max s" />
	<input type="button" value="49" class="code max d" />
    <input type="button" value="50" class="code max s" />
    <input type="button" value="51" class="code max d" />
	<input type="button" value="52" class="code max s" />
	<input type="button" value="53" class="code max d" />
	<input type="button" value="54" class="code max s" />
	<input type="button" value="55" class="code max d" />
	<input type="button" value="56" class="code max s" />
	<input type="button" value="57" class="code max d" />
	<input type="button" value="58" class="code max s" />
	<input type="button" value="59" class="code max d" />
	<input type="button" value="60" class="code max s" />
    <div class="clearfix"></div><span class="title2"></span>
    <input type="button" value="61" class="code max d" />
	<input type="button" value="62" class="code max s" />
	<input type="button" value="63" class="code max d" />
	<input type="button" value="64" class="code max s" />
	<input type="button" value="65" class="code max d" />
	<input type="button" value="66" class="code max s" />
	<input type="button" value="67" class="code max d" />
	<input type="button" value="68" class="code max s" />
	<input type="button" value="69" class="code max d" />
	<input type="button" value="70" class="code max s" />
    <input type="button" value="71" class="code max d" />
	<input type="button" value="72" class="code max s" />
	<input type="button" value="73" class="code max d" />
	<input type="button" value="74" class="code max s" />
	<input type="button" value="75" class="code max d" />
	<input type="button" value="76" class="code max s" />
	<input type="button" value="77" class="code max d" />
	<input type="button" value="78" class="code max s" />
	<input type="button" value="79" class="code max d" />
	<input type="button" value="80" class="code max s" />
	<div class="clearfix"></div><span class="title2"></span>
	<input type="button" value="清" class="action none" />
    <input type="button" value="双" class="action even" />
    <input type="button" value="单" class="action odd" />
    <input type="button" value="小" class="action small" />
    <input type="button" value="大" class="action large" />
    <input type="button" value="全" class="action all" />
</div>
<?php
	
	$maxPl=$this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>