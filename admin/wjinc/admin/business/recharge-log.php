<script type="text/javascript">
$(function(){
	$('.tabs_involved input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	$('.tabs_involved input[name=rechargeId]')
	.focus(function(){
		if(this.value=='充值编号') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='充值编号';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
});


function rechargeLogList(err, data){
	if(err){
		alert(err);
	}else{
		$('.tab_content').html(data);
	}
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3  class="tabs_involved">充值记录
            <form action="/admin778899.php/business/rechargeLogList" class="submit_link wz" target="ajax" dataType="html" call="rechargeLogList">
                用户：<input type="text" class="alt_btn" style="width:60px;" value="用户名" name="username"/>&nbsp;&nbsp;
                <input type="text" class="alt_btn" style="width:80px;" value="充值编号" name="rechargeId" />&nbsp;&nbsp;
                时间：从<input type="date" class="alt_btn" name="fromTime"/> 到 <input type="date" class="alt_btn" name="toTime"/>&nbsp;&nbsp;
                状态类型：<select style="width:100px" name="type">
					<option value="">所有类型</option>                    
                    <option value="0">正在申请</option>
                    <option value="1">手动到账</option>
                    <option value="2">自动到账</option>
                    <option value="9">管理员充值</option>
				</select>&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
                <input type="reset" value="重置条件">
            </form>
			<div  class="submit_link wz">
				<input type="submit" onclick="rechargModal()" class="alt_btn" value="充值"/>
			</div>
		</h3>
	</header>
	
	<div class="tab_content">
    	<?php $this->display("business/recharge-log-list.php");?>
    </div>

</article>