<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '添加会员－代理中心'); ?>
<script type="text/javascript">
function khao(fanDian, bFanDian){
	$('input[name=fanDian]').val(fanDian);
	return false;
}
</script>
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
	<form action="/index.php/team/insertMember" method="post" target="ajax" onajax="teamBeforeAddMember" call="teamAddMember">
 	<h2>新增成员：</h2>
    <ul>
     <li><span>账号类型：</span><label><input type="radio" name="type" value="1" title="代理" checked="checked" />代理</label>&nbsp;&nbsp;<label><input name="type" type="radio" value="0" title="会员" />会员</label></li>
     <li><span>用户名：</span><input type="text" name="username" class="text4" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" /></li>
     <li><span>密码：</span><input type="password" name="password" class="text4" /></li>
     <li><span>确认密码：</span><input type="password" id="cpasswd" class="text4" /></li>
     <li><span>联系QQ：</span><input type="text" name="qq" class="text4" /></li>
	 <li><span>返点：</span><input type="text" name="fanDian" class="text4" max="<?=$this->user['fanDian']?>" value=""  fanDianDiff=<?=$this->settings['fanDianDiff']?> onkeyup="if(isNaN(value))execCommand('undo')" onafterpaste="if(isNaN(value))execCommand('undo')" />0-<?=$this->iff(($this->user['fanDian']-$this->settings['fanDianDiff'])<=0,0,$this->user['fanDian']-$this->settings['fanDianDiff'])?>%</li>
	 <li><span>验证码：</span><input name="vcode" type="text" style="width:142px; height:22px; vertical-align:middle;"/><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></li>
     <li class="tijiao"><input id="addmenber" class="an" type="submit" value="增加成员" ><input type="reset" id="resetmenber" class="an" value="重置" onClick="this.form.reset()" /></li>
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