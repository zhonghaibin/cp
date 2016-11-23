<!DOCTYPE HTML>
<html>
<head>
<title>EW享赢</title>
<meta charset="UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="Keywords" content=" ">
<meta name="Description" content=" ">
<link href="/oacss/css/login.css" rel="stylesheet" type="text/css">
<link href="/oacss/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/skin/main/onload.js"></script>
<script type="text/javascript" src="/skin/main/reglogin.js"></script>
<script type="text/javascript" src="/skin/js/gamecommon.js"></script>
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="/oacss/css/ie8-and-down.css">
<script src="/oacss/js/css3-mediaqueries.js"></script>
<![endif]-->
</head>
<body>
<div class="indexwrap"><div id="index" class="radius">
   <div class="indexL">
    <div class="loginlogo"><img src="/oacss/images/logo.png"/></div>
    <p class="topic"><span class="topicline">用户登录</span> USER LOGIN</p>
    <form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
	<ul class="login">
		<li class="login_id"><input type="text" name="username" id="username" class="input" placeholder="用户名"> </li>
		<li class="login_pass"><input type="password" name="password" id="password" class="input" placeholder="密码"> </li>
	    <li class="login_pw">
		<input type="text" name="vcode"  id="captcha" class="input_s " placeholder="验证码" autocomplete="off">
        <img  src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()" class="flow" style="right:-90px;top:5px;width:80px;height:40px;">
        <a href="javascript:void(0);" onclick="./images/cods.jpg';" class="flow" style="right:-160px;top:16px;">忘记密码</a>
        </li>
	</ul>
        <input type="submit" class="go" onclick="" value="登录">
	</form>
    
   
   </div>
   <div class="button-wrapper">
        <div class="b5">
          <a href=""><img src="/oacss/images/cods.jpg" title="微信二维码"></a>
      	   <span style="    display: block; color: #3e3e3e; margin-top: 20px;font-size: 14px;">扫描二维码关注享赢微信</span>
		</div>
	
		
		<div style="text-align:center;">
			<div style="background-color:#FFAFFE;width:160px;margin:0 auto;">
				<a href="javascript:void(0);" onclick="wjkf168()" class="a-btn b3"><span class="a-btn-text">在线客服</span></a>
			</div>
		</div>
	</div>
   <p class="clear"></p>
</div></div>
 <script type='text/javascript'>
function wjkf168(){
	<?php if($this->settings['kefuStatus']){ ?>
	var newWin=window.open("<?=$this->settings['kefuGG']?>","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
	<?php }else{?>
	alert("暂时还没开通");
	<?php }?>
	return false;
}
function qqkf(){
	<?php if($this->settings['qqkefuStatus']){ ?>
	var newWin=window.open("http://wpa.qq.com/msgrd?uin=<?=$this->settings['qqkefuGG']?>&site=qq&menu=yes","","height=600, width=800, top=0, left=0,toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
	if(!newWin||!newWin.open||newWin.closed){newWin=window.open('about:blank');}else{return false;}
	<?php }else{?>
	alert("暂时还没开通");
	<?php }?>
	return false;
}
</script>    
</body>
</html>