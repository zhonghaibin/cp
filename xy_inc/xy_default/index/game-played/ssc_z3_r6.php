<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<div class="pp" action="ssc_z3_r6" length="3" random="combineRandom">
	<div id="wei-shu" length="3">
		<label style="color:#FFF"><input type="checkbox" name="ss" value="16" />万</label>
		<label style="color:#FFF"><input type="checkbox" name="ss" value="8" />千</label>
		<label style="color:#FFF"><input type="checkbox" name="ss" value="4" checked />百</label>
		<label style="color:#FFF"><input type="checkbox" name="ss" value="2" checked />十</label>
		<label style="color:#FFF"><input type="checkbox" name="ss" value="1" checked />个</label>
	</div><span style="color:yellow;margin-left:10px;">温馨提示：你选择了 <span style="color:#F00" id="select"></span> 个位置，系统自动根据位置组合成 <span style="color:#F00" id="num"></span> 个方案。</span><br/>
	<input type="button" name="kk" value="0" class="code min s" />
	<input type="button" name="kk" value="1" class="code min d" />
	<input type="button" name="kk" value="2" class="code min s" />
	<input type="button" name="kk" value="3" class="code min d" />
	<input type="button" name="kk" value="4" class="code min s" />
	<input type="button" name="kk" value="5" class="code max d" />
	<input type="button" name="kk" value="6" class="code max s" />
	<input type="button" name="kk" value="7" class="code max d" />
	<input type="button" name="kk" value="8" class="code max s" />
	<input type="button" name="kk" value="9" class="code max d" />
	&nbsp;
	<input type="button" value="清" class="action none" />
    <input type="button" value="双" class="action even" />
    <input type="button" value="单" class="action odd" />
    <input type="button" value="小" class="action small" />
    <input type="button" value="大" class="action large" />
    <input type="button" value="全" class="action all" />
</div>
<?php $maxPl=$this->getPl($this->type, $this->played); ?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?=json_encode($maxPl)?>);
})
</script>
<script type="text/javascript">  
   var m=$("input:checkbox:checked").length;
   $("#select").html(m);
   $("#num").html(Combination(m, 3));
   $("input:checkbox").click(function(){
       var m=$("input:checkbox:checked").length;
       $("#select").html(m); 
       $("#num").html(Combination(m, 3));
   });
 function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}
</script>