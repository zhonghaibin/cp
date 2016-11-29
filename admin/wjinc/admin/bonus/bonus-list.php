<?php

	$bonusDay = array('1','11','21');
	$dateDay = date('d',time());
	
	/*if(!in_array($dateDay,$bonusDay)) 
		die('<strong style="color:red;font-size:14px;">今天不是分红日，不能访问此页面！！！</strong>');*/

	if($dateDay == 1){
		$lastMonthTwentyOne = date('Y-m-21', strtotime('-1 month'));
		$fromTime = strtotime($lastMonthTwentyOne.' 00:00:00');
		$lastMonthEndDay = date('Y-m-t', strtotime('-1 month'));
		$toTime = strtotime($lastMonthEndDay.' 23:59:59');
	}else{
		$dayBeforeTen = date("Y-m-d",strtotime("-10 day"));
		$fromTime = strtotime($dayBeforeTen.' 00:00:00');
		$dayBeforeOne = date("Y-m-d",strtotime("-1 day"));
		$toTime = strtotime($dayBeforeOne.' 23：59：59');
	}
	
	$this->getSystemSettings();
	$sql="select uid,username,fanDian from xy_members WHERE (fanDian = 13.0 OR fanDian = 12.9)";
	$data=$this->getRows($sql);
?>
<article class="module width_full">
    <header>
		<h3 class="tabs_involved">分红发放列表</h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>用户名</th> 
			<th>返点值</th>
			<th>本期盈亏总额</th>
			<th>分红百分比（%）</th> 
			<th>本期分红金额</th>
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody>
		<?php if($data) foreach($data as $var){ 

			$bonusId = $this->getValue('select id from xy_bonus_log where uid='.$var['uid'].' and startTime='.$fromTime.' and endTime = '.$toTime);
			if($bonusId) continue;


			$var['lossAmount'] = $this->statLossAmount($var['uid'],$fromTime,$toTime);

			if($var['fanDian'] == 13.0){ 
				$var['bonusScale'] = $this->settings['bonusScale1']; 
			}else{ 
				$var['bonusScale'] = $this->settings['bonusScale2'];
			}
		?>
		<tr> 
			<td><?=$var['username']?></td> 
			<td><?=$var['fanDian']?></td> 
			<td><?=$var['lossAmount']?></td>
			<td><?=$var['bonusScale']?></td>
			<td><?php 
				if($var['lossAmount'] < 0){
					$bonusAmount = abs($var['lossAmount'])*($var['bonusScale']/100);
				}else if($var['lossAmount'] > 0){
					$bonusAmount = '-'.$var['lossAmount']*($var['bonusScale']/100);
				}else{
					$bonusAmount = 0;
				}
				echo sprintf("%.2f", $bonusAmount);  
			?></td>
			<td>
				<a href="/admin778899.php/Bonus/shareBonusModal/<?=$var['uid']?>" target="ajax" call="shareBonusModal">发放分红</a>
            </td>
		</tr> 
	<?php }else{ ?>
		<tr>
			<td colspan="9" align="center">本期没有可发放分红的用户。</td>
		</tr>
	<?php } ?>
	</tbody> 
    </table>
	<footer>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
