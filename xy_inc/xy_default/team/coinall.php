<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '团队统计－代理中心'); 
  $teamAll=$this->getRow("select sum(u.coin) coin, count(u.uid) count from {$this->prename}members u where u.isDelete=0 and concat(',', u.parents, ',') like '%,{$this->user['uid']},%'");
  $teamAll2=$this->getRow("select count(u.uid) count from {$this->prename}members u where u.isDelete=0 and u.parentId={$this->user['uid']}");
?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:70px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:70px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:70px; height:30px; background-image:url(/oacss/images/bg2681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{
		color:#890e0e;  background-image:url(/oacss/images/bg2_61.png); width:70px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:5px;
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
                <li class="fontback"><a href="/index.php/team/coinall"><font style="color:#890e0e;">团队统计</font></a></li>
                <li class="aafbfg"><a href="/index.php/team/coin">团队帐变</a></li>
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
 <div class="tuandui1">
<h2>团队金额：</h2>
    <ul>
     <li><span>账号类型：</span><b><?=$this->iff($this->user['type'], '代理', '会员')?></b></li>
     <li><span>我的账号：</span><b><?=$this->user['username']?></b></li>
     <li><span>可用余额：</span><b><?=$this->user['coin']?> 元</b></li>
     <li><span>团队余额：</span><b><?=$teamAll['coin']?> 元</b></li>
     <li><span>直属下级：</span><b><?=$teamAll2['count']?> 个</b></li>
     <li><span>所有下级：</span><b><?=($teamAll['count']-1)?> 个</b></li>
    </ul>
    <div class="clear"></div>
 </div>
</div>
 <div class="foot"></div>
</div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>