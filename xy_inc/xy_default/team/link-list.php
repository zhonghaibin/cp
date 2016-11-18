<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '推广链接 - 代理中心'); ?>
<!--//复制程序 flash+js-->
<script type="text/javascript" src="/skin/js/swfobject.js"></script>
<script language="JavaScript">
function Alert(msg) {
	alert(msg);
}
function thisMovie(movieName) {
	 if (navigator.appName.indexOf("Microsoft") != -1) {   
		 return window[movieName];   
	 } else {   
		 return document[movieName];   
	 }   
 } 
function copyFun(ID) {
	thisMovie(ID[0]).getASVars($("#"+ID[1]).attr('value'));
}
</script>
<!--//复制程序 flash+js------end-->
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
                <li class="aafbfg"><a href="/index.php/team/coinall">团队统计</a></li>
                <li class="aafbfg"><a href="/index.php/team/coin">团队帐变</a></li>
                <li class="aafbfg"><a href="/index.php/team/cashRecord">团队提现</a></li>
                <li class="fontback"><a href="/index.php/team/linkList"><font style="color:#890e0e;">推广链接</font></a></li>
                <?php if($this->user['fanDian'] == '13.0' || $this->user['fanDian'] == '12.9'){?>
                <li class="aafbfg"><a href="/index.php/team/shareBonus">代理分红</a></li>
                <?}?>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="youxi1">
<div class="search">   
	<h2>
    <input class="an" type="submit" value="添加链接" onclick="window.location='/index.php/team/addlink'">
    </h2>
</div>
    <div class="biao-cont">
    <?php
	$sql="select * from {$this->prename}links where enable=1 and uid={$this->user['uid']}";
	if($_GET['uid']=$this->user['uid']) unset($_GET['uid']);
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	?>
<table width="900" border="0" cellspacing="0" cellpadding="0">
		<tr class="top">
			<td>编号</td>
            <td>类型</td>
			<td>返点</td>
			<td>操作</td>
		</tr>
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$var['lid']?></td>
			<td><?php if($var['type']){echo'代理';}else{echo '会员';}?></td>
			<td><?=$var['fanDian']?>%</td>
			<td><a href="/index.php/team/linkUpdate/<?=$var['lid']?>" style="color:#333;" target="modal"  width="420" title="修改注册链接" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a> | <a href="/index.php/team/getLinkCode/<?=$var['lid']?>" style="color:#333;" target="modal" width="420"  title="获取链接" modal="true" button="取消:defaultCloseModal">获取链接</a> | <a  href="/index.php/team/linkDelete/<?=$var['lid']?>" button="确定删除:dataAddCode" modal="true" title="删除注册链接" width="420" target="modal"  style="color:#333;">删除</a> </td>
           
		</tr>
	<?php } ?>
</table>
	<?php 
        $this->display('inc_page.php',0,$data['total'],$this->pageSize, '/index.php/team/linkList-{page}');
    ?>
    </div>
</div>
</div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>