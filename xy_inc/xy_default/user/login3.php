<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<title><?=$this->settings['webName']?></title>
<meta content="IE=EmulateIE8" http-equiv="X-UA-Compatible" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name=”renderer” content=”webkit” />
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="/oacss/css/base.css" rel="stylesheet" type="text/css">
<link href="/oacss/css/login2.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="/skin/main/onload.js"></script>
<script type="text/javascript" src="/skin/main/reglogin.js"></script>
<script type="text/javascript" src="/skin/js/gamecommon.js"></script>
</head>
<body>
<div id="divbg" >  
<div id="divbg1"><b></b></div>
<img id="bianse" src="/images/<?=mt_rand(0,11)?>.jpg">
</div>
			<div class="PageHeader">                        
			  <div class="CT w1280">
			    <ul class="fr">
			      <li onclick="wjkf168()">
			      	<div class="c_onlineLive" title="在线客服"></div>
			      </li>
			      <li onclick="qqkf();">
			      	<div class="c_onlineQQ" title="QQ客服咨询"></div>
			      </li>
			    </ul>
			  	<div class="fl login_t">
			  		<a href="#"></a>
			  	</div>
			  	
			    <div class="cb"></div>
			   </div>
			</div>
			
			<div class="Page_CT">
				<div class="w1280">
				    <div class="fr CTR">
                    <form action="/index.php/user/logined" method="post" onajax="userBeforeLogin" enter="true" call="userLogin" target="ajax">
						<h4>账户登录</h4>
						<p class="txt name">
							<input tabindex="0" id="username" name="username" placeholder="请输入您的登录名" type="text">
						</p>
						<p class="txt psw">
							<input tabindex="0" id="password" name="password" placeholder="请输入您的密码" type="password">
						</p>
						<p class="login"><a href="#" onclick="$(this).closest('form').submit()">登　录</a></p>
						<p class="tr"><a tabindex="0" href="/海盛国际.exe" class="hkd">客户端下载</a><a tabindex="0" href="#" class="fr mt10 mr10 wjm" title="找回密码">忘记登入密码？</a></p>
                    </form> 
					</div>
				    <div class="fl CTL">
				       <p>竭诚为客户提供更好的购彩体验</p>
					   <p style="margin-top:30px;">可能是最好的彩票平台</p>
				    </div>
				    <p class="cb"></p>
				</div>
			</div>
            <div class="PageFooter">
			   <ul>
		    <li><a href="#">关于我们</a></li>
		    <li>|</li>
		    <li><a href="#">常见问题</a></li>
		    <li>|</li>
		    <li><a href="#">联系我们</a></li>
		    <li>|</li>
		    <li><a href="#">服务条款</a></li>
		    <li>|</li>
		    <li><a href="#">隐私政策责任</a></li>
		    <li>|</li>
		    <li><a href="#">免责声明</a></li>
		
		  </ul>
		</div>
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
