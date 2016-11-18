<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '添加链接－代理中心'); ?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:70px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:70px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:70px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{
		color:#890e0e;  background-image:url(/oacss/images/bg_61.png); width:70px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:5px;
		}
</style>
</head> 
 
<body>
<div id="mainbody"> 
<div class="pagetop"></div>
<div class="pagemain">
<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
            	<li class="aafbfg"><a href="/index.php/team/memberList">会员管理</a></li>
				<li class="aafbfg"><a href="/index.php/team/onlineMember">在线会员</a></li>
                <li class="aafbfg"><a href="/index.php/team/gameRecord">团队记录</a></li>
                <li class="aafbfg"><a href="/index.php/team/report">团队盈亏</a></li>
<li class="aafbfg"><a href="/index.php/team/coinall">团队统计</a></li>
<li class="fontback"><a href="/index.php/team/coin"><font style="color:#890e0e;">团队帐变</font></a></li>
<li class="aafbfg"><a href="/index.php/team/cashRecord">团队提现</a></li>
<li class="aafbfg"><a href="/index.php/team/linkList">推广链接</a></li>
<?php if($this->user['fanDian'] == '13.0' || $this->user['fanDian'] == '12.9'){?>
<li class="aafbfg"><a href="/index.php/team/shareBonus">代理分红</a></li>
<?}?>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="mima1">
<form action="/index.php/team/insertLink" method="post" target="ajax" onajax="teamBeforeAddLink" call="teamAddLink">
<input name="uid" type="hidden" id="uid" value="<?=$this->user['uid']?>" />
   <h2>添加注册链接：</h2>
    <ul>
	 <li><span>账号类型：</span><label><input type="radio" name="type" value="1" title="代理" checked="checked" />代理</label>&nbsp;&nbsp;<label><input name="type" type="radio" value="0" title="会员" />会员</label></li>
     <li><span>返点：</span><input type="text" name="fanDian" max="<?=$this->user['fanDian']?>" class="text4" fanDianDiff=<?=$this->settings['fanDianDiff']?>  />&nbsp;&nbsp;0-<?=$this->user['fanDian']?>%</li>
     <li class="tijiao"><input id="addlink" class="an" type="submit" value="增加链接" ><input type="reset" id="resetlink" class="an" value="重置" onClick="this.form.reset()" /></li>
    </ul>
</form>
  </div>
  <div class="bank"></div>
</div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>