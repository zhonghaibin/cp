<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 申请提现'); ?>
<script type="text/javascript">
function beforeToCash(){
	if(!this.amount.value) throw('请填写提现金额');
	if(!this.amount.value.match(/^[0-9]*[1-9][0-9]*$/)) throw('提现金额错误');
	showPaymentFee();
	var amount=parseInt(this.amount.value);
	if($('input[name=bankId]').val()==2||$('input[name=bankId]').val()==3){
		if(amount<parseFloat(<?=json_encode($this->settings['cashMin1'])?>)) throw('支付宝/财付通提现最小限额为<?=$this->settings['cashMin1']?>元');
		if(amount>parseFloat(<?=json_encode($this->settings['cashMax1'])?>)) throw('支付宝/财付通提现最大限额为<?=$this->settings['cashMax1']?>元');
		showPaymentFee();
	}else{
		if(amount<parseFloat(<?=json_encode($this->settings['cashMin'])?>)) throw('提现最小限额为<?=$this->settings['cashMin']?>元');
		if(amount>parseFloat(<?=json_encode($this->settings['cashMax'])?>)) throw('提现最大限额为<?=$this->settings['cashMax']?>元');
		showPaymentFee();
	}
	if(!this.coinpwd.value) throw('请输入资金密码');
	if(this.coinpwd.value<6) throw('资金密码至少6位');
	showPaymentFee();
}

function toCash(err, data){
	if(err){
		alert(err)
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		window.location.href="/index.php/cash/toCashResult";
	}
}
$(function(){
	$('input[name=amount]').keypress(function(event){
		event.keyCode=event.keyCode||event.charCode;
		
		return !!(
			// 数字键
			(event.keyCode>=48 && event.keyCode<=57)
			|| event.keyCode==13
			|| event.keyCode==8
			|| event.keyCode==46
			|| event.keyCode==9
		)
	});
});
</script>
<script type="text/javascript">
function showPaymentFee() {
   $("#ContentPlaceHolder1_txtMoney").val($("#ContentPlaceHolder1_txtMoney").val().replace(/\D+/g, ''));
   jQuery("#chineseMoney").html(changeMoneyToChinese($("#ContentPlaceHolder1_txtMoney").val()));
        }
</script>
<?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where b.isDelete=0 and m.bankId=b.id and m.uid=? limit 1", $this->user['uid']);
?>
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
		        <li class="aafbfg"><a href="/index.php/cash/recharge">充值</a></li>
                <li class="fontback"><a href="/index.php/cash/toCash" id="tocashss"><font style="color:#890e0e;">提现</font></a></li>
            	<li class="aafbfg"><a href="/index.php/cash/rechargeLog">充值记录</a></li>
                <li class="aafbfg"><a href="/index.php/cash/toCashLog">提现记录</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="biao-cont">
<div class="content3 wjcont">
 <div class="body">
 	<?php if($bank['bankId']){?>
<form action="/index.php/cash/ajaxToCash" method="post" target="ajax" datatype="json" onajax="beforeToCash" call="toCash">
  <div class="chongzhi3">
 	<h2>提款申请：</h2>
    <ul>
     <li><span>银行类型：</span><img src="/<?=$bank['logo']?>" title="<?=htmlspecialchars($bank['bankName'])?>" alt="" /><a href="/index.php/safe/info#bank-info" > 修改我的银行信息>></a></li>
     <li><span>银行账号：</span><input type="text" name="account" readonly value="<?=preg_replace('/^.*(\w{4})$/', '***\1', htmlspecialchars($bank['account']))?>" class="text4" /></li>
     <li><span>账户名：</span><input type="text" name="username" readonly value="<?=preg_replace('/^(\w).*$/', '\1**', htmlspecialchars($bank['username']))?>" class="text4" /></li>
     <li><span>提款金额：</span><input type="text" name="amount" class="text4" id="ContentPlaceHolder1_txtMoney" onkeyup="showPaymentFee();" />*提现请输入<?=$this->settings['cashMin']?>至<?=$this->settings['cashMax']?>的整数金额！</li>
	 <li><span>金额大写：</span><span style="color:red;text-align:left;" id="chineseMoney"></span></li>
     <li><span>资金密码：</span><input type="password" name="coinpwd" class="text4" /></li>
    </ul>
    <h3><input id="" class="an" type="submit" value="提交申请"  ><input type="reset" id="button" class="an" value="重置" /></h3>
 </div>
 </form>
  <?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where b.isDelete=0 and m.bankId=b.id and m.uid=? limit 1", $this->user['uid']);
	$this->freshSession(); 
    $date=strtotime('00:00:00');
	$date2=strtotime('00:00:00');
	$time=strtotime(date('Y-m-d', $this->time));
	$cashAmout=0;
		$rechargeAmount=0;
		$rechargeTime=strtotime('00:00');
		if($this->settings['cashMinAmount']){
			$cashMinAmount=$this->settings['cashMinAmount']/100;
			$gRs=$this->getRow("select sum(case when rechargeAmount>0 then rechargeAmount else amount end) as rechargeAmount from {$this->prename}member_recharge where  uid={$this->user['uid']} and state in (1,2,9) and isDelete=0 and rechargeTime>=".$rechargeTime);
			if($gRs){
				$rechargeAmount=$gRs["rechargeAmount"];
			}
		}
	$cashAmout=$this->getValue("select sum(mode*beiShu*actionNum) from {$this->prename}bets where isDelete=0 and actionTime>={$rechargeTime} and uid={$this->user['uid']}");
	$times=$this->getValue("select count(*) from {$this->prename}member_cash where actionTime>=$time and uid=?", $this->user['uid']);
?>
 <div class="chongzhi2">
 	<h3>提现说明：</h3>
    <ul>
     <li>1、您是尊贵的&nbsp<strong style="font-size:15px;color:red;">VIP<?=$this->user['grade']?></strong>&nbsp客户，每天限提&nbsp<strong style="font-size:15px;color:red;"><?=$this->getValue("select maxToCashCount from {$this->prename}member_level where level=?", $this->user['grade'])?></strong>&nbsp次,今天您已经成功发起了&nbsp<strong style="font-size:15px;color:green"><?=$times?></strong>&nbsp次提现申请;</li>
     <li>2、每天的提现处理时间为：<strong style="font-size:15px;color:red;" > 早上 <?=$this->settings['cashFromTime']?> 至 晚上 <?=$this->settings['cashToTime']?></strong></li>
	 <li>3、提现10分钟内到账。(如遇高峰期，可能需要延迟到三十分钟内到帐);</li>
     <li>4、银行卡用户每日最小提现&nbsp<strong style="color:green;font-size:15px;"><?=$this->settings['cashMin']?></strong>&nbsp元，最大提提现&nbsp<strong style="color:green;font-size:15px;"><?=$this->settings['cashMax']?></strong>&nbsp元。财付通/支付宝用户,最小提现&nbsp<strong style="color:green;font-size:15px;"><?=$this->settings['cashMin1']?></strong>&nbsp元，最大提现&nbsp<strong style="color:green;font-size:15px;"><?=$this->settings['cashMax1']?></strong>&nbsp元。</li>
	 <li>5、消费比例公式：今日消费比例=今日投注量/今日充值额，(消费比例未达到系统设置的&nbsp<strong style="color:red" id="sysbili"><?=$this->settings['cashMinAmount']?></strong>&nbsp%，则不能提款.);
	 <li>6、如果今日未充值，则消费比例自动为100%，即使未投注也可随时提款。系统是从当天凌晨0点至第二天凌晨0点算一天;</li>
	 <li>7、今日投注：<strong style="color:red"><?=$this->iff($cashAmout,$cashAmout,0)?></strong> 元&nbsp今天充值：&nbsp<strong style="color:red"><?=$this->iff($rechargeAmount,$rechargeAmount,0)?></strong>&nbsp元&nbsp，您今日消费比例已达到：&nbsp<strong style="color:red" id="bili"><?=$this->iff($rechargeAmount,round($cashAmout/$rechargeAmount*100,1),100)?>&nbsp%</strong>;</li>
    </ul>
 </div>
   		<?php }else{?>
		<div class="chongzhi1">
    	<h2>提款申请：</h2>
         <div class="tips">
        	<dl>
            	<dt>温馨提示：</dt>
                <dd>尚未设置您的银行账户！&nbsp;&nbsp;<a href="/index.php/safe/info">马上设置&gt;&gt;</a></dd>
            </dl>
        </div>
		</div>
		<div class="clear"></div>
    <?php }?>
	<div class="bank"></div>
 </div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>