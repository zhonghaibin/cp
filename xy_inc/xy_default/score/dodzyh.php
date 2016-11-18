<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '活动中心'); ?>
<script type="text/javascript" src="/skin/js/jquery.vticker.js"></script>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{float:left;color:#890e0e;width:88px;height:30px;background-image:url(/oacss/images/bg_61.png);margin-left:5px;text-align:center; line-height:30px;background-repeat:no-repeat;}
</style>
<script>
function indexdzyh(err, data){
	if(err){
		winjinAlert(err,"alert");
	}else{
		reloadMemberInfo();
		winjinAlert(data,"alert");
	}
}
function indexdzyhed(err, data){
	if(err){
		winjinAlert(err,"alert");
		$("#vcode").trigger("click");
	}else{
		window.parent.reloadMemberInfo();
		winjinAlert(data,"alert");
		reload();
	}
} 
function indexdzyhtked(err, data){
	if(err){
		winjinAlert(err,"alert");
		$("#vcode").trigger("click");
	}else{
		window.parent.reloadMemberInfo();
		winjinAlert(data,"alert");
		reload();
	}
}
</script>
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
			    <li class="fontback"><a href="/index.php/score/dodzyh">电子银行</a></li>
			    <li class="aafbfg"><a href="/index.php/score/dodbqb">夺宝奇兵</a></li>
			    <li class="aafbfg"><a href="/index.php/score/rotate">幸运大转盘</a></li>
            	<li class="aafbfg"><a href="/index.php/score/goods/current">积分兑换</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
<!--main content start-->
<style type="text/css">.ct2{width:96%;border:0px;border-collapse: 0px;font-size:14px;margin:auto;padding-bottom:8px}
.ct2 td{line-height:28px;color:black;border-bottom:1px dotted #626262;height:42px;}
.ct2 td strong{color:#000}
.ct2 .nl{width:22.6%;color:black;text-align:right;padding-right:11px;font-weight:bold;}
.helpinfo{font-size:12px;padding-left:20px;color:black;}
.ct2 .w160{width:160px;}
.ld .lt .th td{border:0px;line-height:36px;height:36px;background:url("/images/v1/left.png") repeat-x 0px -228px;color:#222;text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
</style>
</head>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ct2">
  <tbody>
    <tr>
      <td align="right"><strong style="font-size:15px">活动主题：</strong></td>
      <td style="line-height:20px;padding:5px 10px">
         <font style="font-size:16px;color:#F30;font-weight:bold;">电子银行</font></td></tr><tr></tr>
             <tr>
			    <td align="right"><strong>活动内容说明:</strong></td>
                <td style="color:green;padding-left:10px;">
                   1：存期按最少<?=$this->dzyhsettings['ckzdsj']?>小时计算，如果存款没有达到<?=$this->dzyhsettings['ckzdsj']?>小时就提款，那么只能取得本金，无利息。<br>
                   2：存期<?=$this->dzyhsettings['ckdate1']?>日，日利息为为<?=$this->dzyhsettings['cklv1']?>%，例如，存款<?=$this->dzyhsettings['ckeg1']?>元，那么<?=$this->dzyhsettings['ckdate1']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100?>*<?=$this->dzyhsettings['ckdate1']?>=<?=$this->dzyhsettings['ckeg1']*$this->dzyhsettings['cklv1']/100*$this->dzyhsettings['ckdate1']?>元。<br>
                   3：存款<?=$this->dzyhsettings['ckdate2']?>日，日利息为<?=$this->dzyhsettings['cklv2']?>%，例如，存款<?=$this->dzyhsettings['ckeg2']?>元，那么<?=$this->dzyhsettings['ckdate2']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100?>*<?=$this->dzyhsettings['ckdate2']?>=<?=$this->dzyhsettings['ckeg2']*$this->dzyhsettings['cklv2']/100*$this->dzyhsettings['ckdate2']?>元。<br>
                   4：存款<?=$this->dzyhsettings['ckdate3']?>日，日利息为<?=$this->dzyhsettings['cklv3']?>%，例如，存款<?=$this->dzyhsettings['ckeg3']?>元，那么<?=$this->dzyhsettings['ckdate3']?>天后提出，可得到利息<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100?>*<?=$this->dzyhsettings['ckdate3']?>=<?=$this->dzyhsettings['ckeg3']*$this->dzyhsettings['cklv3']/100*$this->dzyhsettings['ckdate3']?>元。<br>
                  <!-- 5：存款<?=$this->dzyhsettings['ckdate4']?>个月（<?=$this->dzyhsettings['ckdate4']*30?>天），日利息为<?=$this->dzyhsettings['cklv4']?>%，例如，存款<?=$this->dzyhsettings['ckeg4']?>元，那么<?=$this->dzyhsettings['ckdate4']?>个月后提出，可得到利息<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100?>*<?=$this->dzyhsettings['ckdate4']*30?>=<?=$this->dzyhsettings['ckeg4']*$this->dzyhsettings['cklv4']/100*$this->dzyhsettings['ckdate4']*30?>元。<br>
                   6：存款<?=$this->dzyhsettings['ckdate5']?>年（<?=$this->dzyhsettings['ckdate5']*12*30?>天），日利息为<?=$this->dzyhsettings['cklv5']?>%，例如，存款<?=$this->dzyhsettings['ckeg5']?>元，那么<?=$this->dzyhsettings['ckdate5']?>年后提出，可得到利息<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100?>*<?=$this->dzyhsettings['ckdate5']*360?>=<?=$this->dzyhsettings['ckeg5']*$this->dzyhsettings['cklv5']/100*$this->dzyhsettings['ckdate5']*360?>元。<br>-->
                </td>
			 </tr>
			 <tr>
			 </tr>
			 <tr>
			    <td align="right"><strong></strong></td>
                <td class="info" style="font-size:12px;line-height:25px;"><img alt="" src="/images/bank2.jpg"></td>
			 </tr>
             <tr>
			    <td align="right"><strong style="font-size:15px">当前可用余额为:</strong></td>
                <td style="padding-left:10px;"><font color="green"><?=$this->user['coin']?>元</font></td>
			 </tr>
			 <?php
			     $ckdate1=$this->dzyhsettings['ckdate1']*24;$cklv1=$this->dzyhsettings['cklv1'];
				 $ckdate2=$this->dzyhsettings['ckdate2']*24;$cklv2=$this->dzyhsettings['cklv2'];
				 $ckdate3=$this->dzyhsettings['ckdate3']*24;$cklv3=$this->dzyhsettings['cklv3'];
				 $ckdate4=$this->dzyhsettings['ckdate4']*24*30;$cklv4=$this->dzyhsettings['cklv4'];
				 $ckdate5=$this->dzyhsettings['ckdate5']*24*30*12;$cklv5=$this->dzyhsettings['cklv5'];

			     $cktime=array($ckdate1,$ckdate2,$ckdate3,$ckdate4,$ckdate5);sort($cktime);
				 $cklv=array($cklv1,$cklv2,$cklv3,$cklv4,$cklv5);sort($cklv);
                  
			     $sql="select ck_money,time from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
				 if($data=$this->getRow($sql)){$time=($this->time-$data['time'])/3600;}else{$time=0;$data['ck_money']=0;}
				 if($time<$this->dzyhsettings['ckzdsj']){
					 $lv=0;$lx=0;
				 }else if($time>$this->dzyhsettings['ckzdsj'] && $time>=$cktime[0] && $time<$cktime[1]){
					 $lv=$cklv[0];$lx=$data['ck_money']*$cklv[0]/100*$cktime[0]/24;
				 }else if($time>=$cktime[1] && $time<$cktime[2]){
					 $lv=$cklv[1];$lx=$data['ck_money']*$cklv[1]/100*$cktime[1]/24;
				 }else if($time>=$cktime[2] && $time<$cktime[3]){
					 $lv=$cklv[2];$lx=$data['ck_money']*$cklv[2]/100*$cktime[2]/24;
				 }else if($time>=$cktime[3] && $time<$cktime[4]){
					 $lv=$cklv[3];$lx=$data['ck_money']*$cklv[3]/100*$cktime[3]/24;
				 }else if($time>=$cktime[4]){
					 $lv=$cklv[4];$lx=$data['ck_money']*$cklv[4]/100*$cktime[4]/24;
				 }
			 ?>
             <tr>
			    <td align="right"><strong style="font-size:15px">当前银行存款为:</strong></td>
				<td style="padding-left:10px;"><font color="red;font-size:14px">&nbsp;<?=$this->iff($data['ck_money'],$data['ck_money'],0)?>&nbsp;元 &nbsp;&nbsp;&nbsp;&nbsp;共存了
				&nbsp;<?php if($time<24){echo intval($time) ."&nbsp小时";}else if($time>=24 && $time<30*24){echo intval($time/24) ."&nbsp天";}else if($time>=30*24 && $time<30*24*12){echo intval($time/24/30) ."&nbsp月";}else if($time>=30*24*12){echo intval($time/30/24/12) ."&nbsp年";}?>，利率为：<?=$this->iff($lv,$lv,0)?>&nbsp;%，所得利息&nbsp;<?=$this->iff($lx,$lx,0)?>&nbsp;元</font></td>
			 </tr>
             <tr>
			    <td align="right"><strong style="font-size:15px">存入电子银行:</strong></td>
				<td style="color:red;padding-left:10px;">
				    <a href="/index.php/score/dzyhck" class="myanswer" target="modal" width="500px" height="300px" title="电子银行存款" modal="true" button=""><input type="submit" class="bnt"  value="存款" style="width:77px;height:27px"></a>
				</td>
			</tr>
             <tr>
			    <form action="/index.php/score/dzyhtked" method="post" target="ajax" call="indexdzyh">
                    <td align="right" width="150px"><strong style="font-size:15px">提出所有存款与利息:</strong></td>
                    <td style="padding-left:10px;">
					    <a href="/index.php/score/dzyhtk" target="modal" style="width:77px;height:27px" title="提款" modal="true" button=""><input name="button" type="submit" class="bnt" id="button" value="提款" style="width:77px;height:27px"></a>
					</td>
				</form>
			 </tr>
  </tbody>
</table>
<div id="wanjinDialog"></div>
</body>
</html>