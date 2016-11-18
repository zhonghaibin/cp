<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
	<title><?=$this->settings['webName']?></title>
	<link href="/oacss/css/layout.css" rel="stylesheet">
	<link href="/oacss/css/style-default.css" rel="stylesheet">
	<script language="javascript" type="text/javascript" src="/oacss/js/jquery.js"></script>
	<script language="javascript" src="/oacss/js/jquery.dialogUI.js"></script>
	<script type="text/javascript" src="/oacss/js/zDrag.js"></script>
	<script type="text/javascript" src="/oacss/js/zDialog.js"></script>
	<script type="text/javascript" src="/oacss/js/main.js"></script>
	<script type="text/javascript" src="/skin/main/game.js"></script>
    <script type="text/javascript" src="/skin/main/function.js"></script>
    <script type="text/javascript" src="/skin/main/onload.js"></script>
	<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<?php $this->display('inc_header.php');?>
</head>
<body style="width: 100%; padding: 0px; margin: 0px;">
<!--div id="mainbody"-->
<div id="mainbody" style="margin-top:-16px;">
<form id="topForm" name="topForm" method="post" action="" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="topForm" value="topForm">
			<div id="divbg"><img src="/images/bg/body.jpg"></div> 
			<div class="header">
				<div class="logo"></div>
				<ul class="nav" id="enav">
					<li class="account" data="/index.php/safe/info">
						会员中心
					</li>
					<li class="bank-info" data="/index.php/cash/recharge">
						充值提现
					</li>
					<li class="history" data="/index.php/record/search">
						游戏记录
					</li>
					<li class="report" data="/index.php/report/count">
						盈亏报表
					</li>
					<?php if($this->user['type']){?>
					<li class="proxy" data="/index.php/team/memberList">
						代理中心
					</li>
					<?}else{?>
					<li class="proxy" data="/index.php/report/membercoin">
						账变记录
					</li>
				    <?}?>
					<li class="notice" data="/index.php/score/rotate">
						活动中心
					</li>
					<li class="about" data="/index.php/notice/info">
						系统公告
					</li>
				</ul>
			</div>
			<div class="main" >
				<div class="notice-area" stype="margin-top:0px;backgtound-color:#F00; ">
					<div class="msg" >
						<img style="width:20px;padding-bottom:5px" src="/images/t.gif" class="notice_message">消息 (<span class="msg-num"><?php $this->display('index/inc_msg.php');?></span> )
					</div>
					
					<div class="guest">
						<a href="#" style="color:#00ffcb" title="点击与在线客服对话" onclick="wjkf168();">在线客服</a>
					</div>
					<div class="khd">
							<a href="http://<?=$_SERVER['HTTP_HOST']?>/ssc.exe" title="下载客户端">客户端</a>
					</div>

					<div class="guest"><a href="/index.php/display/sign" dataType="json" call="indexSign" target="ajax">签到</a>
					</div>
					
					<div class="guest"><a href="/index.php/user/logout">退出</a>
					</div>
					<ul class="msg-list">
						<li>
							<img style="width:20px;margin-top:6px;margin-right:5px;" src="/images/t.gif" class="notice_gb">
						</li>
					</ul>
					<div id="enotice" style="text-align:left;line-height:35px;height:35px;overflow:hidden;font-size:12px;font-color:#FFFFFF;" onmouseover="iScrollAmount=0" onmouseout="iScrollAmount=1">	
                    <div id="news-marquee">
					     <marquee style="cursor: pointer;" onClick="HotNewsHistory();" onMouseOut="this.start();" onMouseOver="this.stop();" direction="up" scrolldelay="15" scrollamount="1" id="msgNews"><?=$this->settings['webGG']?></marquee>
				    </div>
					</div>
				</div>
				<div class="fn-panel clearfix">
  <div class="method-type" id="eleftMenu">
        <div class="userinfo"><?php $this->display('index/inc_user.php');?></div>
						<ul class="method-list high-game">
							<li class="fkffc" data="/index.php/index/game/5/72">
								香港分分彩<font style="color:#ffde00;font-size:12px;">【火爆】</font>
							</li>
							<li class="fkffc" data="/index.php/index/game/26/72">
								香港二分彩<font style="color:#ffde00;font-size:12px;">【热】</font>
							</li>
							<li class="xjssc" data="/index.php/index/game/34/308">
								香港六合彩<font style="color:#ffde00;font-size:12px;">【新】</font>
							</li>
							<li class="cqssc" data="/index.php/index/game/1/6">
								重庆时时彩<font style="color:#ffde00;font-size:12px;">【热】</font>
							</li>
							<li class="xjssc" data="/index.php/index/game/3/6">
								江西时时彩
							</li>
							<li class="hljssc" data="/index.php/index/game/12/6">
								新疆时时彩
							</li>
						</ul>
						<ul class="method-list low-game">
							<li class="fk3d" data="/index.php/index/game/9/16">
								福彩3D<font style="color:#ffde00;font-size:12px;">【热】</font>
							</li>
							<li class="fc3d" data="/index.php/index/game/10/16">
								排列三
							</li>
							<li class="fc3d" data="/index.php/index/game/20/26">
								北京PK10
							</li>
						</ul>
						<ul class="method-list special-game">
							<li class="sd115" data="/index.php/index/game/7/10">
								山东十一选五
							</li>
							<li class="jx115" data="/index.php/index/game/16/10">
								江西十一选五
							</li>
							<li class="xjssc" data="/index.php/index/game/6/10">
								广东十一选五
							</li>
							<li class="cq115" data="/index.php/index/game/15/10">
								上海十一选五
							</li>
						</ul>
						<!--ul class="method-list low-game">
							<li  class="gd115" data="/index.php/box/receive">站内信</li>
						</ul-->
						<ul class="method-list special-game">
							<li class="qqllc" data="/index.php/score/rotate">幸运大转盘</li>
							<li class="hljssc" data="/index.php/score/dodbqb">夺宝奇兵</li>
						</ul>
					</div>
					<!--game-method-panel-->
					<div class="game-panel">
						<iframe name="main" id="mainiframe" allowtransparency="true" style="background-color-transparent;width:920px;padding:0px;" src="/index.php/index/game/1/6" frameborder="0" height="750px" scrolling="no"></iframe>
					</div>
				</div>
				<div style="height:65px;background:#002b29" id="lmain">
					<table width="100%" style="text-align:center;" align="center">
						<tbody><tr>
							<td><img src="/oacss/images/hezuo.png" title="合作团队" style="cursor:pointer"></td>
							<td><div class="s_mainsplit"></div></td>
							<td><img src="/oacss/images/fczx.png"></td>
							<td><div class="s_mainsplit"></div></td>
							<td><img src="/oacss/images/alipay.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td width="80px" align="center"><img style="vertical-align:middle;" src="/oacss/images/copyright_1.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td width="80px" align="center"><img src="/oacss/images/copyright_2 (1).png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td><img src="/oacss/images/first_cagayan.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td><img src="/oacss/images/copyright_3.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td><img src="/oacss/images/yl.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td><img src="/oacss/images/copyright_4.png"></td>
							<td><div class="s_mainsplit" style="vertical-align:middle;"></div></td>
							<td><img src="/oacss/images/copyright_5.png"></td>
						</tr>
					</tbody></table>
				</div>
			</div><input type="hidden" name="javax.faces.ViewState" id="javax.faces.ViewState" value="j_id3" autocomplete="off">
</form>
</div>
</body>
</html>