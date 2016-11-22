<?php
	$para=$_GET;
	
	// 默认取今天的数据
	if(isset($para['date'])){
		$date=strtotime($para['date']);
	}else{
		$date=strtotime('00:00');
	}
	// 取彩种信息
	$sql="select * from {$this->prename}type where id=?";
	$typeInfo=$this->getRow($sql, $this->type);

	if($this->type==34){ //六合彩
		$timedb=$this->prename.'lhc_time';
		$sql="select * from {$timedb} where type={$this->type} order by actionNo";
	}else{
		$timedb=$this->prename.'data_time';
		$sql="select * from {$timedb} where type={$this->type} order by actionTime";
	}
	
	// 取当前彩种开奖时间表
	$times=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($times);
	
	if($this->type==34){ //六合彩
		$dateString='';
	}else{
		$dateString=date('Y-m-d ');
	}
	
	$sql="select * from {$this->prename}data where type={$this->type} and ";
	
	$sqlAmount="select sum(b.mode * b.beiShu * b.actionNum) betAmount, count(distinct(b.playedId)) facount, count(distinct(b.username)) useracount, sum(b.bonus) zjAmount, sum(b.fanDianAmount) fanDianAmount from xy_bets b where type={$this->type} and b.isDelete=0";
	$all=$this->getRow($sqlAmount);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3 class="tabs_involved"><?=$typeInfo['title']?>开奖数据
		<form class="submit_link wz" action="/admin778899.php/data/index/<?=$this->type?>" target="ajax" call="defaultSearch" dataType="html">
			期数：<input name="actionNo" type="text"  />
			<label style="margin-left:30px;"><a class="item" href="data/index/<?=$this->type?><?=$args[0]['id']?>?date=<?=date('Y-m-d', $date-24*3600)?>">前一天</a></label>
			<label><a class="item" href="data/index/<?=$this->type?><?=$args[0]['id']?>?date=<?=date('Y-m-d', $this->time)?>">今天</a></label>
			<label><a class="item" href="data/index/<?=$this->type?><?=$args[0]['id']?>?date=<?=date('Y-m-d', $date+24*3600)?>">后一天</a></label>
			<label>日期：<input name="date" type="date" /></label>
			<input type="submit" value="查找" class="alt_btn">
			<input type="reset" value="重置条件">
		</form>
		</h3>
	</header>

	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<th>彩种</th>
				<th>场次</th>
				<th>期数</th>
				<th>日期</th>
				<th>开奖数据</th>
				<th>状态</th>
				<th>开奖时间</th>
				<th>方案总数</th>
				<th>参与人数</th>
				<th>投注金额</th>
				<th>中奖金额</th>
				<th>返点金额</th>
				<th>手动开奖</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$count=array();
				if($para['actionNo']) $times=array('data'=>array('id' =>'--'));
				if($this->type==34){ //六合彩
					$dateString='';
				}else{
					$dateString=date('Y-m-d ', $date);
				}
				foreach($times['data'] as $var){
					if($para['actionNo']){
						$data=$this->getRow("select * from {$this->prename}data where type={$this->type} and number='{$para['actionNo']}'");
						$date=$data['time'];
						$var=array('actionNo'=>'--','actionTime'=>date('Y-m-d H:i:s', $date));
						$dateString='';
					}else{
						if($this->type==1){
							// 重庆彩特殊处理
							$number=1000+$var['actionNo'];
							if($var['actionNo']>120){ 
								$number=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
							}else{
								$number=date('Ymd-', $date).substr($number,1);
									
							}
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
						}else if($this->type==5){
							// 分分彩特殊处理
							$number=10000+$var['actionNo'];
							if($var['actionNo']>1440){ 
								$number=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
							}else{
								$number=date('Ymd-', $date).substr($number,1);
									
							}
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
							//echo $sql;
						}else if($this->type==12){
							// 新疆彩特殊处理
							$number=100+$var['actionNo'];
							if($var['actionNo']>96){ 
								$number=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
							}else{
								$number=date('Ymd-', $date).substr($number,1);
									
							}
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
							
						}else if($this->type==9 || $this->type==10){
							// 福彩3D
							$number=date('Yz', $date);
							$number=substr($number,0,4).substr(substr($number,4)+994,1);
							
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
							
						}else if($this->type==20){
							// PK10
							//$number=587914;
							$number = 179*(strtotime(date('Y-m-d', $date))-strtotime('2007-11-11'))/3600/24+$var['actionNo']-1267-1253;
							//echo '<pre>';
							//print_r($number);
							///print_r($var['actionNo']);
							//echo '</pre>';
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
							
						}else if($this->type==25){
							// k3
							$number=100+$var['actionNo'];
							if($var['actionNo']>82){ 
								$number=date('md', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
							}else{
								$number=date('md', $date).substr($number,1);
									
							}
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
						}else if($this->type==34){
							// 六合彩
							$number=1000+$var['actionNo'];
							$number=date('Y', $date).substr($number,-3);
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
						}else{
							$number=1000+$var['actionNo'];
							$number=date('Ymd-', $date).substr($number,1);
							$sql="select * from {$this->prename}data where type={$this->type} and number='$number'";
							$data=$this->getRow($sql);
						}
					}
					if($data['data']){
						$amountData=$this->getRow($sqlAmount." and actionNo=?",$data['number']);
					}else{
						$amountData=array();
					}
					$count['betAmount']+=$amountData['betAmount'];
					$count['zjAmount']+=$amountData['zjAmount'];
					$count['fanDianAmount']+=$amountData['fanDianAmount'];
			?>
			<tr>
				<td><?=$typeInfo['title']?></td>
				<td><?=$var['actionNo']?></td>
				<td><?=$this->iff($this->type==34,date('Y').substr((1000+$var['actionNo']),-3),$this->ifs($data['number'], '--'))?></td>
				<td><?=$this->iff($this->type==34,date('Y-m-d',strtotime($var['actionTime'])),date('Y-m-d', $date))?></td>
				<td><?=$this->ifs($data['data'], '--')?></td>
				<td><?=$this->iff($data['data'], '已开奖', '未开奖')?></td>
				<td><?=$dateString.$var['actionTime']?></td>
				<td><?=$this->ifs($amountData['facount'], '0')?></td>
				<td><?=$this->ifs($amountData['useracount'], '0')?></td>
				<td><?=$this->ifs($amountData['betAmount'], '--')?></td>
				<td><?=$this->ifs($amountData['zjAmount'], '--')?></td>
				<td><?=$this->ifs($amountData['fanDianAmount'], '--')?></td>
				<td>
				    <?php if($data['data']){ ?>
					<a href="/admin778899.php/data/updatedata/<?=$this->type?>/<?=$var['actionNo']?>/<?=$dateString.$var['actionTime']?>" target="modal" width="340" title="添加开奖号码" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">修改</a>
					<a href="/admin778899.php/data/kj" target="ajax" data-type="<?=$typeInfo['id']?>" data-number="<?=$data['number']?>" data-time="<?=$dateString.$var['actionTime']?>" data-data="<?=$data['data']?>" onajax="setKjData" call="setKj" title="重新对没有开奖的投注开奖">开奖</a>
					<?}else{?>
					<a href="/admin778899.php/data/add/<?=$this->type?>/<?=$var['actionNo']?>/<?=$dateString.$var['actionTime']?>" target="modal" width="340" title="添加开奖号码" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">添加</a>
					<?}?>
                    
				</td>
			</tr>
			<?php } ?>
            <tr>
                <td><span class="spn9">本页总结</span></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
				<td>--</td>
                <td>--</td>
                <td><?=$this->ifs($count['betAmount'], '--')?></td>
                <td><?=$this->ifs($count['zjAmount'], '--')?></td>
                <td><?=$this->ifs($count['fanDianAmount'], '--')?></td>
                <td>--</td>
            </tr>
            <tr>
                <td><span class="spn9">全部总结</span></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
				<td>--</td>
                <td>--</td>
                <td><?=$this->ifs($all['betAmount'], '--')?></td>
                <td><?=$this->ifs($all['zjAmount'], '--')?></td>
                <td><?=$this->ifs($all['fanDianAmount'], '--')?></td>
                <td>--</td>
            </tr>

		</tbody>
	</table>
	<footer>
	<?php
		if($para){
			$rel.='?'.http_build_query($para,'','&');
		}
		$rel=$this->controller.'/'.$this->action .'-{page}/'.$this->type.'?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $times['total'], $rel, 'dataPageAction');
	?>
	</footer>
</article>