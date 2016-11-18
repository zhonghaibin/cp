<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>申请代理－<?=$this->settings['webName']?></title>
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<link rel="stylesheet" href="/cl/standard.css">
<link rel="stylesheet" href="/cl/wj43.css">
<link rel="stylesheet" href="/cl/about.css">
</head>
<body lim:visitorcapacity="1">
<?php $this->display('inc_header3.php'); ?>
<!-- CONTENT start -->
<div class="innerMain">

  <!-- SECURITY start -->
	<section id="security">
		<!--<div class="hr"></div>-->
   	  <div class="pic banner8">
        <div class="quote-shadow"></div>
        <div class="banner-mask">
        	<div class="wrap">
            <div class="quote">
            <span style="font-size:30px;">商场上在商言商</span><br>
            <span style="font-size:24px;">为你的未来拿出你的实力</span>
            <div class="line">&nbsp;</div>
            <charle class="size22">YOUR FUTURE IS UNDER</charle><br>
            <charle class="size12">YOUR MIND</charle><br>
            <charle class="size15">IT'S ALL ABOUT YOUR POWER</charle></div>
            </div>
        </div>
        </div>
		<div class="hr"></div>
    	<div class="title wrap">申请代理
    	  <charle>agents</charle>
          <div class="intro">
			<p>黄金城娱乐为代理提供申请通道,只要你有实力,只要你有量。<br>只要你有兴趣成为黄金城娱乐的代理,那就请填写此表。 </p>
          </div>
        </div>
		<!-- daili start -->
        <div class="wrap daili">
		<form action="/index.php/user/inAgent" method="post" onajax="checkBeforSubmit" enter="true" call="checkSubmit" target="ajax" >
			<div>1.以前代理过哪些平台</div>
			<input id="content1" name="content1" class="inputs" maxlength="40"> (* 请简写平台名，如果有多个平台用'，'隔开)
			<div>2.你的团队每日销量</div>
			<input id="content2" name="content2" class="inputs" maxlength="7" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" > (* 仅限输入七位以内数字，单位：万)
			<div>3.你的QQ号码</div>
			<input id="content3" name="content3" class="inputs" maxlength="12" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" >(* 仅限输入十二位以内数字)
			<div><input class="inputbtn" value="立即申请" onclick="$(this).closest('form').submit()" type="button"></div>
            <clear></clear>
        </form>
        </div><!-- daili end -->
		<clear></clear>
        </section>
  <!-- SECURITY end -->
  </div>
<?php $this->display('inc_footer2.php'); ?>
<script type="text/javascript" src="/skin/js/onload.js"></script>
<script>
$(function() {
    $(".wjalert").live("click",function(){
		alert("对不起，请先登录");
		return false;
	})
});
function checkBeforSubmit(){
	var u=this.content1.value;
	var v=this.content2.value;
	var y=this.content3.value;
	if(!u){alert("请输入您以前代理过哪些平台");}
	else if(!v){alert("请输入您的团队每日销量");}
	else if(!y){alert("请输入您的QQ号码");}
	else{return true;}
	return false;
}
function checkSubmit(err, data){
	if(err){
		alert(err);
		
	}else{
		alert(data);
		this.reset();
	}
}
</script>
</body></html>