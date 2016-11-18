<script type="text/javascript">
$(function(){
	$('.tabs_involved input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
});
function defaultSearch(err, data){
	if(err){
		alert(err);
	}else{
		$('.tab_content').html(data);
	}
}
</script>
<script type="text/javascript">
$(function(){
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
/**
 * 批量撤销前调用
 */
function receiverecordBeforeDelete(){
	//获取ID
	var byid="";
	var tourl="/admin778899.php/box/receivedeleteAll/";
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
		}else{return false;}
	}else{
		alert("请选择需要删除的消息！");	
		return false;
	}
}
function receivedeleteBet(err, data){
	if(err){
		alert(err);
	}else{
		alert('删除成功');
		load('Box/receivebox');
	}
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">收件箱
            <form action="/admin778899.php/Box/receivelist" target="ajax" dataType="html" call="defaultSearch" class="submit_link wz">
			   会员名：<input type="text" class="alt_btn" style="width:100px;" value="用户名" name="username"/>&nbsp;&nbsp;
			   <select name="state">
                <option value="3" selected>所有</option>
                <option value="2">已读</option>
                <option value="1">未读</option>
               </select>
                时间：从 <input type="date" class="alt_btn" name="fromTime"/> 到 <input type="date" class="alt_btn" name="toTime"/>&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
            </form>
        </h3>
    </header>
    <div class="tab_content">
		<?php $this->display("Box/receivelist.php") ?>
    </div>
</article>