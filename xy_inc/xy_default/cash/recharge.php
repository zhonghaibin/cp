<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 在线充值'); ?>
<script type="text/javascript">
$(function(){
	$('form').trigger('reset');
	$(':radio').click(function(){
		var data=$(this).data('bank'),
		box=$('#display-dom');
		
		$('#bank-type-icon', box).attr('src', '/'+data.logo);
		if($.cookie('rechargeBank')!=data.id) $.cookie('rechargeBank', data.id, 360*24);
		var bname=$(this).attr("cname");
	    $("#bank-type-name").text(bname);
	});
	
	var bankId=$.cookie('rechargeBank')||$(':radio').attr('value');
	$(':radio[value='+bankId+']').click();
	
	$('.copy').click(function(){
		var text=document.getElementById($(this).attr('for')).value;
		if(!CopyToClipboard(text, function(){
			alert('复制成功');
		}));
	});
	
	$('.example2').click(function(){
		var src='/'+$(this).attr('rel');
		if(src) $('<div>').append($('<img>',{src:src,width:'640px',height:'480px'})).dialog({width:630,height:500,title:'充值演示'});
	});
});

function checkRecharge(){
	if(!this.amount.value) throw('请填写充值金额');
	showPaymentFee();
	var amount=parseInt(this.amount.value),
	$this=$('input[name=amount]',this),
	$bname=$('input[name=mBankId]:checked',this),
	min=parseInt($this.attr('min')),
	max=parseInt($this.attr('max'));
	min1=parseInt($this.attr('min1')),
	max1=parseInt($this.attr('max1'));

	if(!$bname) throw('请选择充值银行');

	if(!this.vcode.value) throw('请输入验证码');
	if(this.vcode.value<4) throw('验证码至少4位');
	showPaymentFee();
}
function toCash(err, data){
	if(err){
		alert(err);
		$("#vcode").trigger("click");
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		$('.biao-cont').html(data);
	}
}
$(function(){
	$('input[name=amount]').keypress(function(event){
		event.keyCode=event.keyCode || event.charCode;
		return !!(
			// 数字键
			(event.keyCode>=48 && event.keyCode<=57)
			|| event.keyCode==13
			|| event.keyCode==8
			|| event.keyCode==9
			|| event.keyCode==46
		)
	});
});
$(function(){
	$('input[name=vcode]').keypress(function(event){
		event.keyCode=event.keyCode || event.charCode;
		return !!(
			// 数字键
			(event.keyCode>=48 && event.keyCode<=57)
			|| event.keyCode==13
			|| event.keyCode==8
			|| event.keyCode==9
			|| event.keyCode==46
		)
	});
});
</script>
<script type="text/javascript">
$(function(){
	$('.example2').click(function(){
		var src='/'+$(this).attr('rel');
		if(src) $('<img>',{src:src}).css({width:'640px',height:'480px'}).dialog({width:660,height:500,title:'充值演示'});
	});
	$('input[name=mBankId]').click(function(){
		var bname=$(this).attr("cname");
		$("#bank-type-name").text(bname);	
	});
});
</script>

<!--//复制程序 flash+js-->

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
<script type="text/javascript" src="/skin/js/swfobject.js"></script>
<script type="text/javascript">
function showPaymentFee(){
   $("#ContentPlaceHolder1_txtMoney").val($("#ContentPlaceHolder1_txtMoney").val().replace(/\D+/g, ''));
   jQuery("#chineseMoney").html(changeMoneyToChinese($("#ContentPlaceHolder1_txtMoney").val()));
}
</script>
<style type="text/css">
		 .table_b td input
        {
	        height:24px;
	        line-height:24px;
	        padding:2px;
	        border:1px #ddd solid
        }
        .table_b td input:focus
        {
	        border:1px #e29898 solid;
	        background-color:#ffecec
        }
</style>
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
<div class="pagetop"></div>
<div class="pagemain">
	<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
		        <li class="fontback"><a href="/index.php/cash/recharge"><font style="color:#890e0e;">充值</font></a></li>
                <li class="aafbfg"><a href="/index.php/cash/toCash">提现</a></li>
            	<li class="aafbfg"><a href="/index.php/cash/rechargeLog">充值记录</a></li>
                <li class="aafbfg"><a href="/index.php/cash/toCashLog">提现记录</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="biao-cont">
<div class="content3 wjcont">
 <div class="body">
        <?php
				$sql="select * from {$this->prename}bank_list b, {$this->prename}sysadmin_bank m where m.admin=1 and m.enable=1 and b.isDelete=0 and b.id=m.bankId";
				$banks=$this->getRows($sql);	
				if($banks){
				if($this->user['coinPassword']){
				?>
<form action="/index.php/cash/inRecharge" method="post" target="ajax" onajax="checkRecharge" call="toCash" dataType="html">
<div class="chongzhi3">
 	<h2>在线充值：</h2>
    <ul>
    <li>
<table width="100%">
	<tr>
      <td width="200"><span>选择充值银行：</span></td>
      <td align="left"><?php					
								$set=$this->getSystemSettings();
								$idx = 0;
								
								if($banks) foreach($banks as $bank){
									if($idx == 0){
										$bnm = $bank['name'];
									}
							?>
						<label><input type="radio" class="xuan" name="mBankId" cname="<?=$bank['name'] ?>" value="<?=$bank['id']?>" <?=$this->iff($idx==0, 'checked', '') ?> data-bank='<?=json_encode($bank)?>'/><img src="/<?=$bank['logo']?>" alt="" /></label>
							<?php 
								$idx++;}
							?>
        </td> 
		</tr>
	</table>
	</li>						
	 <li><span>银行类型：</span><b id="bank-type-name"><?=$bnm?></b></li>
     <li><span>充值金额：</span><input type="text" name="amount" min="<?=$set['rechargeMin']?>" max="<?=$set['rechargeMax']?>" min1="<?=$set['rechargeMin1']?>" max1="<?=$set['rechargeMax1']?>" class="text4" style="width: 150px;" id="ContentPlaceHolder1_txtMoney" onkeyup="showPaymentFee();"/>*一次充值最低为<?=$set['rechargeMin']?>元以上金额！</li>
	 <li><span>金额大写：</span><span style="color:red;text-align:left;" id="chineseMoney"></span></li>
     <li><span>验证码：</span><input name="vcode" type="text" class="text4" style="ime-mode: disabled; width: 75px;" /><b class="yzmNum"><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></b></li>
    </ul>
    <h3><input id="setcz" class="an" type="submit" value="进入充值" ><input type="reset" id="resetcz" class="an" value="重置" /></h3>
</div>
</form>
		<?php }else{?>
        <div class="chongzhi1">
		<h2>在线充值：</h2>
        <div class="tips">
        	<dl>
            	<dt>温馨提示：</dt>
                <dd>尚未设置您的资金管理密码！&nbsp;&nbsp;<a href="/index.php/safe/passwd">马上设置&gt;&gt;</a></dd>
            </dl>
        </div>
        </div>
         <?php } ?>
         <?php }else{ ?>
        <div class="chongzhi1">
    	<h2>充值信息：</h2>
        <div class="tips">
        	<dl>
            	<dt>温馨提示：<a>由于银行网络原因，充值暂停！给您带来不便敬请谅解！</a></dt>
            </dl>
        </div>
        </div>
            <?php }?>	
<div class="clear"></div>
 </div>
<div class="foot"></div>
 </div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>