<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="renderer" content="webkit"/>
<?php $this->display('inc_skin.php', 0 , '会员中心－个人资料'); ?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:10px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.aafbfg2{ float:left; width:88px; height:25px;background-color:#FF0000;margin-left:45px;margin-right:30px;background-repeat:no-repeat; text-align:center; line-height:25px;}
	.fontback{
		color:#890e0e;background-image:url(/oacss/images/bg_61.png); width:88px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:10px;
		}
</style>
<script>
$(function(){
  $("#a1").click(function(){
    $("#wanfa").attr('src','/index.php/wanfa/ssc/1'); 
  });
  $("#a2").click(function(){
    $("#wanfa").attr('src','/index.php/wanfa/ssc/6'); 
  });
  $("#a3").click(function(){
    $("#wanfa").attr('src','/index.php/wanfa/ssc/9'); 
  });
  $("#a4").click(function(){
    $("#wanfa").attr('src','/index.php/wanfa/ssc/20'); 
  });
})
</script>
</head> 
<body>
<div class="pagetop"></div>
<div class="pagemain">
	<div style="width:880px; height:70px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
			    <li class="aafbfg"><a href="/index.php/box/receive">站内信</a></li>
            	<li class="aafbfg"><a href="/index.php/safe/info">个人资料</a></li>
                <li class="aafbfg"><a href="/index.php/safe/passwd">密码管理</a></li>
                <li class="aafbfg"><a href="/index.php/report/coin">账变记录</a></li>
				<li class="fontback"><a href="/index.php/wanfa/wf"><font style="color:#890e0e;">玩法介绍</font></a></li>
            </ul>
        </div>
    </div>
	<div style="width:100%; height:30px; margin-top:7px;">
	  <div style="width:100px; float:left; height:30px;"></div>
       <ul style="margin:0px; padding:0px; list-style-type:none; font-size:15px; color:#5c5c5c; font-weight:bold;">
	        <li style="float:left;"  class="aafbfg2"><a id="a1" href="#">时时彩</a></li>
	        <li style="float:left;"  class="aafbfg2"><a id="a2" href="#">11选5</a></li>
	        <li style="float:left;"  class="aafbfg2"><a id="a3" href="#">3D/P3</a></li>
	        <!--li style="float:left;"  class="aafbfg2"><a id="a4" href="#">pk10</a></li-->
      </ul>
   </div>
</div>
<iframe name="wanfa" id="wanfa" src="/index.php/wanfa/ssc/1"  scrolling="auto" frameborder="0" height="660px" width="880px"></iframe>
 </body>
</html>