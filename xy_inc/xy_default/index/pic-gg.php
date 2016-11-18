<html>
<style>
.ui-widget-content {
border: 1px solid #aaaaaa;
background: #ffffff url(/images/loginbg/10.jpg) 60% 60% repeat-x;
color: #222222;
}
</style>
<div id="abc"></div>
</html>
<script type="text/javascript">
var content="<?=$this->settings['picGG']?>";
$('#abc').html(unescape(content)).dialog({
	title:<?=json_encode($this->settings['picGGTitle'])?>,
	width:683,
	height:500,
	resizable:false,
	mode:true,
	position:['center']
});
</script>