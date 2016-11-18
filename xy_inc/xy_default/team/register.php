<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<title><?=$this->settings['webName']?> - 注册</title>
<link href="/oacss/css/revsi.css" rel="stylesheet" type="text/css">
<link href="/oacss/css/base.css" rel="stylesheet" type="text/css">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/skin/main/onload.js"></script>
<script type="text/javascript" src="/skin/main/reglogin.js"></script>
<script type="text/javascript" src="/skin/main/game.js"></script>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script type="text/javascript">
function registerBeforSubmit(){
	var type=$('[name=type]:checked',this).val();
	if(!this.username.value) throw('没有输入用户名');
	if(!/^\w{4,16}$/.test(this.username.value)) throw('用户名由4到16位的字母、数字及下划线组成');
	if(!this.password.value) throw('请输入密码');
	if(this.password.value.length<6) throw('密码至少6位');
	if(!this.cpasswd.value) throw('请输入确认密码');
	if(this.cpasswd.value!=this.password.value) throw('两次输入密码不一样');
}
function registerSubmit(err,data){
	if(err){
		alert(err);
		 $("#vcode").trigger("click");
	}else{
		alert(data);
		location='/index.php/user/login';
	}
}
		document.onkeydown = keyDown;
		function keyDown(e){
			if(event.keyCode == 13){
				$(this).closest('form').submit()
			}
		}
</script> 
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
</head>
<body>
<div class="page_top">
<div class="w1280 CT">
<ul class="fr">
<li onclick="wjkf168();">
<div class="c_onlineLive" title="在线客服"></div>
</li>
<li onclick="qqkf();">
<div class="c_onlineQQ" title="QQ客服咨询"></div>
</li>
</ul>
<div class="fl login_t">
<a href="#"></a>
</div>
<div class="cb">
<img src="/images/nv.png" style="margin-top:10px;">
</div>
</div>
</div>
<div class="page_center">
<div class="w1280">
<div class="fr mt20">
<div class="right">
<h4>账户注册</h4>
<?php if($args[0]){ ?>
<form action="/index.php/user/reg" method="post" onajax="registerBeforSubmit" enter="true" call="registerSubmit" target="ajax">
<input type="hidden" name="codec" value="<?=$args[0]?>" />
<ul>
<li style="padding-left:13px;">
<span class="s_clor">*</span>
<span class="name1">用户名：</span>
<input class="text" placeholder="请输入用户名" type="text" onKeyUp="value=value.replace(/[\W]/g,'')" maxLength=15  name="username" id="username">
</li>
<li>
<span class="s_clor">*</span>
<span class="name">登陆密码：</span>
<input class="text" id="epwd" placeholder="请输入密码" type="password" onKeyUp="value=value.replace(/[\W]/g,'')" maxLength=13 name="password" id="password">
</li>
<li>
<span class="s_clor">*</span>
<span class="name">确认密码：</span>
<input class="text" id="checkpwd" placeholder="请确认密码" type="password"  onKeyUp="value=value.replace(/[\W]/g,'')" maxLength=13 name="cpasswd"  id="cpasswd">
</li>
<li style="padding-left:33px;">
<span class="s_clor">*</span>
<span class="name">QQ：</span>
<input class="text" id="enickname" placeholder="请输入QQ号" type="text"  onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxLength=11 name="qq" id="qq">
</li>
<li style="padding-left:13px;">
<span class="s_clor">*</span>
<span class="name">验证码：</span>
<input name="vcode" class="text" style="width:93px" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxLength=4 type="text" id="vcode" /><img width="89" height="32" border="0" style="cursor:pointer;" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/>
</li>
<div class="login"><a href="#" onclick="$(this).closest('form').submit()">注册</a></div>
</ul>
</div>
</form>
    <?php }else{?>
    <div style="text-align:center; margin-top:100px;margin-bottom:250px; line-height:60px; color:#ff0033; font-size:20px; font-weight:bold;">链接已失效！</div>
    <?php }?>
<div class="wz">
<p style="text-align:center;">因高端服务而服务高端</p>
<p style="margin-top:30px;text-align:center;">开创亚洲最透明彩票平台</p>
</div>
</div>
<div class="fl">
</div>
</div>
<div class="cb"></div>
</div>
</body></html>