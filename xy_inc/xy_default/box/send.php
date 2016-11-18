<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php', 0 , '已发消息 - 我的消息 - '); ?>
<link rel="stylesheet" type="text/css" href="/skin/js/jquery.datetimepicker.css">
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
<body lim:visitorcapacity="1">
<script type="text/javascript">
$(function(){
	$('.chazhao').click(function(){
		$(this).closest('form').submit();
	});
	
	$('.bottompage a[href]').live('click', function(){
		$('.biao-cont').load($(this).attr('href'));
		return false;
	});
	//查看
	$('.viewbox').live('click', function(){
		var tourl=$(this).attr("tourl");
		if(tourl){
			$('.boxdetail').load(tourl);
		}
	});
	//全选
$("input[name=chk_All]").live("click",function(){
	var item=$("input[name=chk_only]");
	 if( typeof(item.length) == "undefined" )
		{
			item.checked = !item.checked;
		}
		else
		{
			for(i=0;i<item.length;i++)
			{
				item[i].checked=$(this).attr("checked");
			}
		}
	 })	;
});
function boxSearch(err, data){
	if(err){
		alert(err);
	}else{
		$('.biao-cont').html(data);
		recodeRefresh();
	}
}
function recodeRefresh(){
	$('.biao-cont').load(
		$('.bottompage .on').attr('href')
	);
}
function deleteBet(err, data){
	if(err){
		alert(err);
	}else{
		alert('删除成功');
		recodeRefresh();
	}
}
/**
 * 批量撤销前调用
 */
function recordBeforeDelete(){
	//获取ID
	var byid="";
	var tourl="/index.php/box/senddeleteAll/";
	var a=document.getElementsByName("chk_only");
	for(var i=0,len=a.length;i<len;i++){
		if(a.item(i).checked){
		if(byid.length >0){
			byid=byid + "-" + a.item(i).value;
			}
		else{
			byid=byid + a.item(i).value;
		   }
	   }
	}
	if(byid.length>0){
		if(confirm('是否确定要删除？')){
			tourl+=byid;
			$(".removeAllRecord").attr("href",tourl);
		}
		
	}else{
		alert("请选择需要删除的消息！");	
		return false;
	}
}
</script>
<div class="pagetop"></div>
<div class="pagemain">
	<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
			    <li class="fontback"><a href="/index.php/box/receive"><font style="color:#890e0e;">站内信</font></a></li>
            	<li class="aafbfg"><a href="/index.php/safe/info">个人资料</a></li>
                <li class="aafbfg"><a href="/index.php/safe/passwd">密码管理</a></li>
                <li class="aafbfg"><a href="/index.php/report/coin">账变记录</a></li>
				<li class="aafbfg"><a href="/index.php/wanfa/eg">玩法介绍</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="youxi1">
<form action="/index.php/box/sendsearchReceive" datatype="html" call="boxSearch" target="ajax">
 	<h2>
     <select name="state" class="text5">
                <option value="3" selected="">所有</option>
                <option value="2">已读</option>
                <option value="1">未读</option>
            </select>
           <input type="text"  name="fromTime" class="datainput"  value="<?=$this->iff($_REQUEST['fromTime'],$_REQUEST['fromTime'],date('Y-m-d H:i:s',$GLOBALS['fromTime']))?>"/>至<input type="text" name="toTime"  class="datainput" value="<?=$this->iff($_REQUEST['toTime'],$_REQUEST['toTime'],date('Y-m-d H:i:s',$GLOBALS['toTime']))?>"/> 
             
            <input class="an chazhao" value="查询" type="submit">
            <input class="an ml10" value="已收消息" onclick="window.location.href='/index.php/box/receive'" type="button">
            <input class="an ml10" value="编写消息" onclick="window.location.href='/index.php/box/write'" type="button">
    </h2>
    </form>
<div class="biao-cont">
<?php $this->display('box/sendsearchReceive.php');?>
</div>
<div class="boxdetail">	
<table width="100%">
    <tbody><tr>
        <td width="50%">主题：<input name="box-title" id="box-title" value="" class="txt"></td>
        <td width="50%">发件人：<input name="box-from" id="box-from" value="" class="txt"></td>
    </tr>
    <tr>
        <td>时间：<input name="box-time" id="box-time" value="" class="txt"></td>
        <td>收件人：<input name="box-to" id="box-to" value="" class="txt"></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea name="box-content" class="txt2"></textarea>
        </td>
    </tr>
   </tbody>
</table>
</div>
    
 </div>
 </div>
 <div class="foot"></div>
</div>
<div id="wanjinDialog"></div>
</body></html>