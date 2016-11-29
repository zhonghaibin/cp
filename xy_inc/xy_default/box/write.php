<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php', 0 , '编写消息 - 我的消息 - '); ?>
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
	$('input[name=touser]').live("click",function(){
		var val=$(this).val();
		if(val=='children'){
			$("#memberList").show();
		}else{
			$("#memberList").hide();
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
function boxBeforSend(){
	var touser=$('[name=touser]:checked',this).val(),byid="",
	    a=document.getElementsByName("chk_only");
	for(var i=0,len=a.length;i<len;i++){
		if(a.item(i).checked){
		if(byid.length >0){
			byid=byid + "," + a.item(i).value;
			}
		else{
			byid=byid + a.item(i).value;
		   }
	   }
	}
	if(!touser)  throw('请选择收件人');
	if(touser=='children' && byid.length<1)  throw('请选择直属下级会员');
	if(!this.title.value) throw('请输入主题');
	if(!this.content.value) throw('请输入内容');
	if(!this.vcode.value) throw('请输入验证码');
	if(this.vcode.value<4) throw('验证码至少4位');
	this.users.value=byid;
}
function boxSend(err, data){
	if(err){
		winjinAlert(err,"err");
		$("#vcode").trigger("click");
	}else{
		winjinAlert(data,"ok");
		this.reset();
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
				<li class="aafbfg"><a href="/index.php/wanfa/wf">玩法介绍</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="youxi1">
	<h2>
        <input class="an ml10" value="已收消息" onclick="window.location.href='/index.php/box/receive'" type="button">
        <input class="an ml10" value="已发消息" onclick="window.location.href='/index.php/box/send'" type="button">
    </h2>
    <div class="biao-cont">
    	<div class="writeinfo2">
        <form action="/index.php/box/dowrite" method="post" target="ajax" onajax="boxBeforSend" call="boxSend">
            <div class="writeinfo2_l">
            	<dl>
                	<dt>收件人：</dt>
                    <dd><label><input name="touser" value="parent" checked="checked" type="radio">上级代理</label><label><input class="ml20" name="touser" value="children" type="radio">直属下级会员</label></dd>
                </dl>
                <dl>
                	<dt>主题：</dt>
                    <dd><input name="title" value="" class="txt" type="text"></dd>
                </dl>
                <dl>
                	<dt>内容：</dt>
                    <dd><textarea name="content" class="txt2"></textarea></dd>
                </dl>
				<dl>
                <dt>验证码：</dt>
                <dd><input name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4" type="text" class="text4" style="ime-mode: disabled; width: 75px;" /><b class="yzmNum"><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></b></dd>
            </dl>
                <dl class="pagemain">
                	<dt>&nbsp;</dt>
                    <dd><input class="bnt" value="发 送" type="submit" style="width:80px;margin-left:-17px;height:28px"></dd>
                </dl>
                <input name="users" id="users" value="" type="hidden">
            </div>
            <div class="writeinfo2_r" id="memberList" style="display:none;">
            	<h4><input id="chk_All" value="All" name="chk_All" type="checkbox"> 直属下级会员</h4>
            	<ul>
				<?php
                    $sql="select uid, username from {$this->prename}members where parentId=?";
	                $data=$this->getRows($sql,$this->user['uid']);
					$sql2="select * from xy_member_session where uid=? order by id desc limit 1";
					foreach($data as $var){ 
						$login=$this->getRow($sql2, $var['uid']);
					?>
					    <li><label><input value="<?=$var['uid']?>" name="chk_only" type="checkbox"><?=$var['username']?>[<?=$this->iff($login['isOnLine'] && ceil(strtotime(date('Y-m-d H:i:s', time()))-strtotime(date('Y-m-d H:i:s',$login['accessTime'])))<$GLOBALS['conf']['member']['sessionTime'], '<font color="#FF0000">在线</font>', '离线')?>]</label></li>
					<?}?>
                </ul>
            </div>
            <div class="clear"></div>
            </form>
        </div>
    </div>
    <div class="clear"></div>
    <div class="bank"></div>
 </div>
 </div>
 <div class="foot"></div>
</div>
<div id="wanjinDialog"></div>
</body></html>