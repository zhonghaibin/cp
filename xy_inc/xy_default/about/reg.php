<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>申请试玩－<?=$this->settings['webName']?></title>
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

   <!-- REG start -->
	<section id="security">
    	<!--<div class="hr"></div>-->
   	  <div class="pic banner7">
        <div class="quote-shadow"></div>
        <div class="banner-mask">
        	<div class="wrap">
            <div class="quote">
            <span style="font-size:30px;">全方位安全服务</span><br>
            <span style="font-size:24px;">信息和资金安全保障</span>
            <div class="line">&nbsp;</div>
            <charle class="size22">YOUR SAFETY AND DEBIT</charle><br>
            <charle class="size12">ARE UNDER </charle><br>
            <charle class="size15">THE BEST SECURITY ALL AROUND YOU</charle></div>
            </div>
        </div>
        </div>
		<div class="hr"></div>
    	<div class="title wrap">试玩账户
    	  <charle>trialAccount</charle>
        </div>
        
        <!-- SECURITY autoreg start -->
        <div class="wrap autoreg" id="#reg">
            <div class="picword">
            	<img src="/cl/about/reg_intro.jpg" alt="黄金城娱乐 黄金城 在线注册">
                <p>黄金城娱乐官方试玩平台，在这里提供玩家试玩的通道。<br><br>试玩账户注册条款如下：<br>
				（1）黄金城娱乐为玩家提供舒畅的试玩环境，会对每位试玩账户发放10000元试玩资金； <br>
				（2）为了避免不必要的争议，暂时限制了试玩账户的充值/提现/客服/代理等功能；<br>
				（3）为了保障正式账户顺利游戏，试玩账户将会被不定期删除；<br>
				（4）试玩账户仍然可以参与活动，夺宝奇兵小游戏，获得礼金；<br>
				（5）试玩账户性质为普通用户，也就是说无法创建下级会员。<a href="/index.php/about/register" target="_blank" class="blackbtn">申请试玩账户<span> +</span></a></p>
            </div>
            <clear></clear>
        </div><!-- SECURITY autoreg end -->
        
        
        </section>
  <!-- REG end -->
</div>
<!-- CONTENT end -->
<?php $this->display('inc_footer2.php'); ?>
<script>
$(function() {
    $(".wjalert").live("click",function(){
		alert("对不起，请先登录");
		return false;
	})
});
</script>
</body></html>