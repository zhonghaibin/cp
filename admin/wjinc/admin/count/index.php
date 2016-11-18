<article class="module width_full">
    <?php
		$date=strtotime('00:00:00');
		$sql="select left(`date`,7) monthName, sum(betAmount) betAmount, sum(betAmount-zjAmount) winAmount from {$this->prename}count group by monthName order by monthName desc limit 5";
		$dataMonth=$this->getRows($sql);
		$dataMonth=array_reverse($dataMonth);
		foreach($dataMonth as $arrId=>$varAmount){
			$monthArr[$arrId]=$varAmount['monthName'];
			$betAmountArr[$arrId]=intval($varAmount['betAmount']);
			$winAmountArr[$arrId]=intval($varAmount['winAmount']);
			if($arrId==0){
				$onff=false;
				$max=$betAmountArr[$arrId];
				$min=$winAmountArr[$arrId];
			}else{
				if($max<$betAmountArr[$arrId]) $max=$betAmountArr[$arrId];
				if($min>$winAmountArr[$arrId]) $min=$winAmountArr[$arrId];
			}
		}
		$cha=$max-$min;
		$imgY='|'.$min.'元|'.$max.'元';
		$imgX="";
		$imgBet="";
		$imgWin="";
		$z0="";
		for($i=0;$i<($arrId+1);$i++){
			$imgX.='|'.$monthArr[$i];
			if($i==0){
				$imgBet.='|'.intval(($betAmountArr[$i]-$min)/$cha*100);
				$imgWin.='|'.intval(($winAmountArr[$i]-$min)/$cha*100);
				$z0=intval((0-$min)/$cha*100);
			}else{
				$imgBet.=','.intval(($betAmountArr[$i]-$min)/$cha*100);
				$imgWin.=','.intval(($winAmountArr[$i]-$min)/$cha*100);
				if($min<0){
					$z0.=','.intval((0-$min)/$cha*100);
				}
			}
		}
	?>
    <header><h3 class="tabs_involved">盈亏统计</h3></header>
	<article class="stats_graph" style="margin:10px;">
		<img src="<?=$imgSrc?>" width="400" height="140" alt="" />
	</article>
	<article style="margin:10px; width:20%; float:left;">
        <table align="center" style="text-align:center">
        	<thead>
            <tr>
            	<td height="24">月份</td><td>投注金额</td><td>盈亏</td>
            </tr>
            </thead>
            <tbody>
			<?php for($i=0;$i<($arrId+1);$i++){?>
            <tr>
            	<td height="24"><?=$monthArr[$i]?></td><td style="color:#81c65b"><?=intval($betAmountArr[$i])?></td><td style="color:#76a4fa"><?=intval($winAmountArr[$i])?></td>
            </tr>
			<?php }?>
            </tbody>
        </table>
	</article>
	<article class="stats_overview" style="margin:10px;">
		<?php
		  $date=strtotime("00:00");
		  $data=$this->getDateCount($date);
		  $jtTCount=number_format($data['betAmount']-$data['zjAmount']-$data['fanDianAmount']-$data['brokerageAmount'],2,'.','');
		  $jtYKCount=number_format($data['betAmount'],2,'.','');
		  if($jtTCount>0){
			  $jtTCount="<span style='color:#76a4fa'>".$jtTCount."</span>";
			 }else if($jtTCount<0){
			   $jtTCount="<span style='color:#76a4fa'>-".abs($jtTCount)."</span>";
			 }else{
			  $jtTCount=$jtTCount;
		   }
		 ?>
		<div class="overview_today">
			<p class="overview_day">今日统计</p>
			<p class="overview_count" style="color:#76a4fa"><?=$jtTCount?></p>
			<p class="overview_type">盈亏</p>
			<p class="overview_count" style="color:#81c65b"><?=$jtYKCount?></p>
			<p class="overview_type">投注额</p>
		</div>
		<?php 
            $date=strtotime("00:00")-24*3600;
			$data=$this->getDateCount($date);
		  $ztTCount=number_format($data['betAmount']-$data['zjAmount']-$data['fanDianAmount']-$data['brokerageAmount'],2,'.','');
		  $ztYKCount=number_format($data['betAmount'],2,'.','');
		  if($ztTCount>0){
			  $ztTCount="<span style='color:#76a4fa'>".$ztTCount."</span>";
			 }else if($ztTCount<0){
			  $ztTCount="<span style='color:#76a4fa'>-".abs($ztTCount)."</span>";
			 }else{
			  $ztTCount=$ztTCount;
		   }
        ?>
		<div class="overview_previous">
			<p class="overview_day">昨日统计</p>
			<p class="overview_count" style="color:#76a4fa"><?=$ztTCount?></p>
			<p class="overview_type">盈亏</p>
			<p class="overview_count" style="color:#81c65b"><?=$ztYKCount?></p>
			<p class="overview_type">投注额</p>
		</div>
	</article>
	<div class="clear"></div>
</article>

<?php
	$date=strtotime(date("Y-m-d",$this->time)." 00:00:00");
	$date2=strtotime(date("Y-m-d",$this->time-24*3600)." 00:00:00");
	$sql="select count(uid) allUser, sum(regTime>=$date) todayReg, sum(regTime>=$date2 and regTime<=$date) yesterdayReg, sum(type) dlCount, sum(type=0) memberCount, sum(coin+fcoin) amountCount from {$this->prename}members where isDelete=0";
	$sql2="select sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount from {$this->prename}members u left join {$this->prename}bets b on b.isDelete=0 and b.kjTime between $date and $date+24*3600 and b.lotteryNo<>'' and b.isDelete=0 and u.uid=b.uid"; //投注.中奖总额
	$sql3="select sum(r.amount) from {$this->prename}member_recharge r, {$this->prename}members u where  r.actionTime between $date and $date+24*3600 and r.state in (1,2,9) and r.isDelete=0 and r.uid=u.uid";  //充值总额
	$sql4="select sum(c.amount) from {$this->prename}member_cash c, {$this->prename}members u  where c.state=0 and c.actionTime between $date and $date+24*3600 and c.isDelete=0 and c.uid=u.uid";  //取款总额
	$data2=$this->getRow($sql2);
	$data3=$this->getValue($sql3);
	$data4=$this->getValue($sql4);
	$data=$this->getRow($sql);
    ?>
<article class="module width_full">
	<header><h3 class="tabs_involved">用户统计</h3></header>
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>用户总数</th>
            <th>代理人数</th> 
			<th>会员人数</th>			
			<th>昨日注册人数</th> 
			<th>今日注册人数</th> 
			<th>今日投注总额</th>
            <th>今日中奖总额</th>
            <th>今日充值总额</th>
            <th>今日取款总额</th>			
			<th>当前在线人数</th>
			<th>余额总数</th>
		</tr> 
	</thead> 
	<tbody> 
		<tr> 
			<td><?=$data['allUser']?></td>
			<td><?=$data['dlCount']?></td> 
			<td><?=$data['memberCount']?></td>
            <td><?=$data['yesterdayReg']?></td> 			
			<td><?=$data['todayReg']?></td> 
            <td><?=$this->ifs($data2['betAmount'],'0')?></td>			
			<td><?=$this->ifs($data2['zjAmount'],'0')?></td>
			<td><?=$this->ifs($data3,'0')?></td>			
			<td><?=$this->ifs($data4,'0')?></td>
			<td><?=$this->getValue("select count(distinct uid) from {$this->prename}member_session where isOnLine=1 and {$this->time}-accessTime<900 and uid in (select uid from {$this->prename}members where admin=0)")?></td> 
			<td><?=number_format($data['amountCount'])?></td> 
		</tr> 
	</tbody> 
	</table>
</article>

<article class="module width_full">
    <header><h3 class="tabs_involved">彩种投注金额统计<span class="spn1">（彩种名称：投注金额）</span></h3></header>
    <div class="module_content">
	<?php
		$sql="select type, sum(beiShu*mode*actionNum) amount from {$this->prename}bets where lotteryNo!='' group by type";
		$data=$this->getObject($sql, 'type');
		$this->getTypes();
		if($this->types) foreach($this->types as $var){
			if($var['isDelete']==0 && $var['enable']==1){
	?>
        <div class="cztz"><span class="title"><?=$var['title']?></span><span class="spn2">￥<?=number_format($this->ifs($data[$var['id']]['amount'], 0),2)?></span></div>
	<?php }} ?>
    </div>
</article>

<article class="module width_full">
	<header><h3 class="tabs_involved">玩法统计<span class="spn1">（玩法统计：投注金额 / 注数）</span></h3></header>
	<div class="module_content">
	<?php
		$sql="select playedId, sum(beiShu*mode*actionNum) amount,sum(actionNum) actionNumA from {$this->prename}bets where lotteryNo!='' group by playedId";
		$data=$this->getObject($sql, 'playedId');
		$this->getPlayeds();
		if($this->playeds) foreach($this->playeds as $var){
	?>
		<div class="cztz"><span class="title"><?=$var['name']?></span><span class="spn2">￥<?=number_format($this->ifs($data[$var['id']]['amount'], 0),2)?> / <?=$this->ifs($data[$var['id']]['actionNumA'], 0)?>注</span></div>
	<?php } ?>
	</div>
</article>

<!-- <div class="tip">提示：本页数据被缓存5分钟，你看到的可能是几分钟之前的数据！</div> -->
