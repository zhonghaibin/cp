<?php

		$bonusDay = array('1','11','21');
		$dateDay = date('d',time());
		if(!in_array($dateDay,$bonusDay)) 
			die('<strong style="color:red;font-size:14px;">今天不是分红日，不可发放分红！！！</strong>');

	if($dateDay == 1){
		$lastMonthTwentyOne = date('Y-m-21', strtotime('-1 month'));
		$fromTime = strtotime($lastMonthTwentyOne.' 00:00:00');
		$lastMonthEndDay = date('Y-m-t', strtotime('-1 month'));
		$toTime = strtotime($lastMonthEndDay.' 23：59：59');
	}else{
		$dayBeforeTen = date("Y-m-d",strtotime("-10 day"));
		$fromTime = strtotime($dayBeforeTen.' 00:00:00');
		$dayBeforeOne = date("Y-m-d",strtotime("-1 day"));
		$toTime = strtotime($dayBeforeOne.' 23：59：59');
	}
	
	$this->getSystemSettings();
	$sql="select uid,username,fanDian from xy_members WHERE uid=?";
	$data=$this->getRows($sql,$args[0]);
	$bonusUser = $data[0];

	if($bonusUser['fanDian'] == 13.0){ 
		$bonusUser['bonusScale'] = $this->settings['bonusScale1']; 
	}else{ 
		$bonusUser['bonusScale'] = $this->settings['bonusScale2'];
	}

	$bonusUser['lossAmount'] = $this->statLossAmount($bonusUser['uid'],$fromTime,$toTime);
	
	if($bonusUser['lossAmount'] < 0){
		$bonusAmount = abs($bonusUser['lossAmount'])*($bonusUser['bonusScale']/100);
	}else if($bonusUser['lossAmount'] > 0){
		$bonusAmount = '-'.$bonusUser['lossAmount']*($bonusUser['bonusScale']/100);
	}else{
		$bonusAmount = 0.0;
	}
	$bonusUser['bonusAmount'] = sprintf("%.2f", $bonusAmount);
?>

<div class="manager-edit">
<form action="/admin778899.php/Bonus/shareBonusSingle/<?=$args[0]?>" target="ajax" method="post" call="shareBonusHandle" onajax="bonusBeforeShare" dataType="html">
<table class="tablesorter left" cellspacing="0"> 
	<tbody> 
		<tr> 
			<td>用户名</td> 
			<td><?=$bonusUser['username']?></td> 
		</tr> 
		<tr> 
			<td>返点值</td> 
			<td><?=$bonusUser['fanDian']?></td> 
		</tr> 
		<tr> 
			<td>本期盈亏总额</td> 
			<td><input type="text" value="<?=$bonusUser['lossAmount']?>" name="lossAmount"/></td> 
		</tr> 
		<tr> 
			<td>分红百分比（%）</td> 
			<td><?=$bonusUser['bonusScale']?></td> 
		</tr> 
		<tr>
			<td>本期分红金额</td> 
			<td><input type="text" value="<?=$bonusUser['bonusAmount']?>" name="bonusAmount"/></td> 
		</tr>
		<tr>
			<td>本期分红起始时间</td> 
			<td><?=date('Y-m-d H:i:s',$fromTime)?><br/><?=date('Y-m-d H:i:s',$toTime)?></td> 
		</tr>
		<input type="hidden" name="startTime" value="<?=$fromTime?>" />
		<input type="hidden" name="endTime" value="<?=$toTime?>" />
	</tbody> 
</table>
</form>
</div>
