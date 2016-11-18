<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '游戏记录'); ?>
<script type="text/javascript">
$(function(){
	
	$('.search form input[name=betId]')
	.focus(function(){
		if(this.value=='输入单号') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='输入单号';
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
function recordSearch(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .pagecurrent').attr('href')
	);
}

function deleteBet(err, code){
	if(err){
		alert(err);
	}else{
		recodeRefresh();
	}
}
</script>
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
<div id="mainbody"> 

<div class="pagetop"></div>
<div class="pagemain">
<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
            	<li class="fontback"><a href="/index.php/record/search"><font style="color:#890e0e;">游戏记录</font></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="youxi1">
    <form action="/index.php/record/searchGameRecord/<?=$this->userType?>" dataType="html" call="recordSearch" target="ajax">
  		<h2>
		<select name="type" class="text5">
        	<option value="0" <?=$this->iff($_REQUEST['type']=='', 'selected="selected"')?>>全部彩种</option>
            <?php
                if($this->types) foreach($this->types as $var){ 
                    if($var['enable']){
            ?>
            <option value="<?=$var['id']?>" <?=$this->iff($_REQUEST['type']==$var['id'], 'selected="selected"')?>><?=$this->iff($var['shortName'], $var['shortName'], $var['title'])?></option>

            <?php }} ?>
        </select>
       <select name="state" class="text5">
            <option value="0" selected>所有状态</option>
            <option value="1">已派奖</option>
            <option value="2">未中奖</option>
            <option value="3">未开奖</option>
            <option value="4">追号</option>
            <option value="5">撤单</option>
        </select>
     
       <select name="mode" class="text5">
            <option value="" selected>全部模式</option>
            <option value="1.000">1元</option>
            <option value="2.000">元</option>
            <option value="0.200">角</option>
            <option value="0.020">分</option>
            <option value="0.002">厘</option>
        </select>
      <input type="text" name="betId" value="输入单号" class="text6" />
      <input type="text"  name="fromTime" class="datainput"  value="<?=$this->iff($_REQUEST['fromTime'],$_REQUEST['fromTime'],date('Y-m-d H:i:s',$GLOBALS['fromTime']))?>"/>至<input type="text" name="toTime"  class="datainput" value="<?=$this->iff($_REQUEST['toTime'],$_REQUEST['toTime'],date('Y-m-d H:i:s',$GLOBALS['toTime']))?>"/>   
      <input type="button" value="查 询" class="btn chazhao">
  </form> 
    </div>
    <div class="display biao-cont">
    	<!--下注列表-->
        <?php $this->display('record/search-list.php'); ?>
        <!--下注列表 end -->
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>
  
   
 