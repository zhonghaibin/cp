<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '帐变列表'); ?>
<script type="text/javascript">
$(function(){
	$('.search form input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});

	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});

	$('.bottompage a[href]').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});
});
function searchCoinLog(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
</script>
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
	<div class="search">
  	  <form action="/index.php/team/searchCoin" dataType="html" target="ajax" call="searchCoinLog">
       <select name="liqType">
            <option value="">所有帐变类型</option>
            <option value="1">账户充值</option>
            <option value="2">游戏返点</option>
            <option value="6">奖金派送</option>
            <option value="7">撤单返款</option>
            <option value="106">账户提现</option>
            <option value="8">提现失败</option>
            <option value="107">提现成功</option>
            <option value="9">系统充值</option>
            <option value="51">活动礼金</option>
            <option value="53">消费佣金</option>
			<option value="55">注册佣金</option>
            <option value="101">投注扣款</option>
            <option value="102">追号扣款</option>
			<option value="109">上级充值</option>
			<option value="110">给下级充值扣款</option>
        </select>
        <select name="userType">
            <option value="1">我自己</option>
            <option value="2" selected>直属下线</option>
             <option value="3">所有下线</option> 
       </select>
        <input value="用户名" name="username" style="border:1px solid #999;height: 20px;width:80px;padding-left:5px;font-size:12px;font-family: '微软雅黑';color: #999;"/>
        <input type="text" name="fromTime" class="datainput"  value="<?=$this->iff($_REQUEST['fromTime'],$_REQUEST['fromTime'],date('Y-m-d H:i:s',$GLOBALS['fromTime']))?>"/>至<input type="text" name="toTime"  class="datainput" value="<?=$this->iff($_REQUEST['toTime'],$_REQUEST['toTime'],date('Y-m-d H:i:s',$GLOBALS['toTime']))?>"/>
         
      <input type="button" value="查 询" class="btn chazhao">
  </form> 
    </div>
    <div class="display biao-cont">
        <?
            $this->display('team/coin-log.php');
        ?>
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>
  
   
 