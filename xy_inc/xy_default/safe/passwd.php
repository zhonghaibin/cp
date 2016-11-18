<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心－个人资料'); ?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:10px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{
		color:#890e0e;  background-image:url(/oacss/images/bg_61.png); width:88px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:10px;
		}
</style>
</head> 
<body>
<div class="pagetop"></div>
<div class="pagemain">
	<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
			    <li class="aafbfg"><a href="/index.php/box/receive">站内信</a></li>
            	<li class="aafbfg"><a href="/index.php/safe/info">个人资料</a></li>
                <li class="fontback"><a href="/index.php/safe/passwd"><font style="color:#890e0e;">密码管理</font></a></li>
                <li class="aafbfg"><a href="/index.php/report/coin">账变记录</a></li>
				<li class="aafbfg"><a href="/index.php/wanfa/wf">玩法介绍</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="mima1">
 	<form action="/index.php/safe/setPasswd" method="post" target="ajax" onajax="safeBeforSetPwd" call="safeSetPwd">
 	<h2>登陆密码管理：</h2>
    <ul>
     <li><span>原始密码：</span><input type="password" name="oldpassword" class="text4" /></li>
     <li><span>新密码：</span><input type="password" name="newpassword" class="text4" /></li>
     <li><span>确认密码：</span><input type="password"  class="text4 confirm" /></li>
     <li class="tijiao"><input id="setpass" class="an" type="submit" value="修改密码" ><input type="reset" id="resetpass" class="an" value="重置" onClick="this.form.reset()" /></li>
    </ul>
    </form>
</div>
  <?php if($args[0]){ ?>
  <div class="mima1">		
  	<form action="/index.php/safe/setCoinPwd2" method="post" target="ajax" onajax="safeBeforSetCoinPwd2" call="safeSetPwd">
 	<h2>资金密码管理：</h2>
    <ul>
     <li><span>原始密码：</span><input type="password"  name="oldpassword" class="text4" /></li>
     <li><span>新密码：</span><input type="password" name="newpassword" class="text4" /></li>
     <li><span>确认密码：</span><input type="password" class="text4 confirm" /></li>
     <li class="tijiao"><input id="setcoinP2" class="an" type="submit" value="修改密码" ><input type="reset" id="resetcoinP2" class="an" value="重置" onClick="this.form.reset()" /></li>
    </ul>
    </form>
</div>	
<?php }else{?>
<div class="mima1">
 	<form action="/index.php/safe/setCoinPwd" method="post" target="ajax" onajax="safeBeforSetCoinPwd" call="safeSetPwd">
 	<h2>资金密码管理：</h2>
    <ul>
     <li><span>密码：</span><input type="password" name="newpassword" class="text4" /></li>
     <li><span>确认密码：</span><input type="password" class="text4 confirm" /></li>
     <li class="tijiao"><input id="setcoinP" class="an" type="submit" value="修改密码" ><input type="reset" id="resetcoinP" class="an" value="重置" onClick="this.form.reset()" /></li>
    </ul>
    </form>
</div> 
<?php }?>
<div class="bank"></div>
</div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>