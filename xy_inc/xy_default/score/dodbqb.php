<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '活动中心'); ?>
<link href="/skin/css/dzp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/skin/js/jquery.vticker.js"></script>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{float:left;color:#890e0e;width:88px;height:30px;background-image:url(/oacss/images/bg_61.png);margin-left:5px;text-align:center; line-height:30px;background-repeat:no-repeat;}
</style>
<script>
function indexdbqb(err, data){
	if(err){
		winjinAlert(err,"alert");
	}else{
		reloadMemberInfo();
		winjinAlert(data,"alert");
	}
} 
</script>
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
			    <li class="aafbfg"><a href="/index.php/score/dodzyh">电子银行</a></li>
			    <li class="fontback"><a href="/index.php/score/dodbqb">夺宝奇兵</a></li>
			    <li class="aafbfg"><a href="/index.php/score/rotate">幸运大转盘</a></li>
            	<li class="aafbfg"><a href="/index.php/score/goods/current">积分兑换</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
    <!--main content start-->
    <style type="text/css">.ct2{width:96%;border:0px;border-collapse: 0px;font-size:14px;margin:auto;padding-bottom:8px}
.ct2 td{line-height:28px;color:black;border-bottom:1px dotted #626262;height:42px;}
.ct2 td strong{color:#000}
.ct2 .nl{width:22.6%;color:black;text-align:right;padding-right:11px;font-weight:bold;}
.helpinfo{font-size:12px;padding-left:20px;color:black;}
.ct2 .w160{width:160px;}
.ld .lt .th td{border:0px;line-height:36px;height:36px;background:url("/images/v1/left.png") repeat-x 0px -228px;color:#222;text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.subbtn {border: 0;text-align:center;font-size:12px;color:#fff;cursor:pointer;background:url("/images/subbtn.gif") no-repeat;font-weight:bold;
</style>
<script type="text/javascript">
$(function(){ 
	$('#lottery_list_container_1').vTicker({
		speed:1000, 
		pause:0,
		showItems:8,
		animation:'fade',
		mousePause:true,
		height:300,
		direction:'up' 
    });
});
</script>
</head>
<body onbeforeunload="checkLeave()">
<div class="nxgkt2" id="nxgkt2">
<div class="nxgK">
<div class="xiugaiK" id="contect0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ct2">
<tbody>
<tr>
<td align="right">
<strong style="font-size:15px">活动主题：</strong>
</td>
<td style="line-height:20px;padding:5px 10px">
<font style="font-size:16px;color:#F30;font-weight:bold;">夺宝奇兵</font>
</td>
</tr>
<tr>
</tr>
<tr>
<td align="right"><strong style="font-size:15px">活动内容说明:</strong></td>
<td style="color:green;padding-left:10px;">
1, 每天一次抢宝活动，开启<font color="red">&nbsp<?=$this->dbqbsettings['allnum']?>&nbsp</font>个宝箱,抢完为止。<br>
2, <font color="blue">今日消费</font> 必须满<font color="red">&nbsp<?=$this->dbqbsettings['xcoin']?>&nbsp</font>元，否则无法参加！！<br>
3, 参与活动的账户， <font color="blue">帐户余额</font> 达到<font color="red">&nbsp<?=$this->dbqbsettings['scoin']?>&nbsp</font>元以上(包含&nbsp<?=$this->dbqbsettings['scoin']?>&nbsp元)，方可参加。<br>
4, 抢宝时间：<font color="red"><?=$this->dbqbsettings['FromTime']?>-<?=$this->dbqbsettings['ToTime']?></font>。<br>
5, 通过下方<font color="#0086A8">【点我开抢】</font>，自助抢宝。<br>
6, 每个IP，只允许一个帐户参加每场活动。<br>
7, 平台将对本次活动全程监控，活动禁止违规操作，如有发现，一律严惩！<br>
</td></tr><tr></tr><tr><td class="info" style="" colspan="2" align="center"><img alt="" src="/images/dbqb.jpg" width="780" height="168"></td>
</tr>
<tr><td style="padding-left:10px;" colspan="2" align="center">
<div style="background:url(/images/subbtn.gif) no-repeat;background-position:center;"><a href="/index.php/score/dbqbed" dataType="json" call="indexdbqb" target="ajax" style="color:#FFF;">点我开抢</a></div></td></tr>
<td align="right">
<strong style="font-size:15px">最近夺宝排行:</strong></td>
<td style="font-size:12px;line-height:25px;">
<div style="overflow: hidden; position: relative;" id="lottery_list_container_1">
<ul id="lottery_list_container" style="margin-left:20px">
<?php 
	$data=$this->getRows("select s.*,u.username from {$this->prename}dbqb_swap s, {$this->prename}members u where s.uid=u.uid order by s.swapTime desc");
	foreach($data as $var){?>
        <li style='color:#000'>恭喜 【<span class="c1"><?=preg_replace('/^(\w{2}).*(\w{2})$/','\1***\2',htmlspecialchars($var['username']))?></span>】，喜夺 <span style='color:red;'><?=$var['coin']?>元</span> 的宝箱!</li>
<?}?>
</ul>
</div>
</td>
</tr>
</tbody>
</table>
</div></div></div>
<div id="wanjinDialog"></div>
</body>
</html>