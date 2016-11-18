<script type="text/javascript">
$(function(){
	$('input[name=touser]').live("click",function(){
		var val=$(this).val();
		if(val=='member'){
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
function boxBeforadd(){
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
	if(!touser)  error('请选择收件人');
	if(touser=='member' && byid.length<1)  error('请在右侧选择会员');
	if(!this.title.value) error('请输入主题');
	if(!this.content.value) error('请输入内容');
	this.users.value=byid;
}
function boxadd(err, data){
	if(err){
		error(err);
	}else{
		success('发送成功');
	}
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">发消息</h3></header>
<div class="writeinfo2">
        <form action="/admin778899.php/box/dowrite" method="post" target="ajax" onajax="boxBeforadd" call="boxadd">
            <div class="writeinfo2_l">
            	<dl>
                	<dt>收件人：</dt>
                    <dd><label><input name="touser" value="all" checked="checked" type="radio">群发所有</label><label><input class="ml20" name="touser" value="member" type="radio">部分会员</label></dd>
                </dl>
                <dl>
                	<dt>主题：</dt>
                    <dd><input name="title" value="" class="txt" type="text"></dd>
                </dl>
                <dl>
                	<dt>内容：</dt>
                    <dd><textarea name="content" class="txt2"></textarea></dd>
                </dl>
                <dl class="pagemain">
                	<dt>&nbsp;</dt>
                    <dd><input class="bnt" value="发 送" type="submit"></dd>
                </dl>
                <input name="users" id="users" value="" type="hidden">
            </div>
            <div class="writeinfo2_r" id="memberList" style="display:none;">
            	<h4><input id="chk_All" value="" name="chk_All" type="checkbox">会员列表</h4>
            	<ul style="list-style:none;">
				<?php
                    $sql="select uid, username from {$this->prename}members order by username";
	                $data=$this->getRows($sql,$this->user['uid']);
					foreach($data as $var){?>
					    <li><label style="color:blue"><input value="<?=$var['uid']?>" name="chk_only" type="checkbox"><?=$var['username']?></label></li>
					<?}?>
                </ul>
            </div>
            <div class="clear"></div>
       </form>
</div>
<div class="clear"></div>
</article>
