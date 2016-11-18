<?php
    $this->gettypes();
	$this->getPlayeds();
	$bet=$this->getRow("select * from {$this->prename}bets where id=?", $args[0]);
	
	if(!$bet) throw new Exception('单号不存在');
	
	$modeName=array('2.000'=>'元', '0.200'=>'角', '0.020'=>'分', '0.002'=>'厘','1.000'=>'1元');
	$weiShu=$bet['weiShu'];
	if($weiShu){
		$w=array(16=>'万', 8=>'千', 4=>'百', 2=>'十',1=>'个');
		foreach($w as $p=>$v){
			if($weiShu & $p) $wei.=$v;
		}
		$wei.=':';
	}
	$betCont=$bet['mode'] * $bet['beiShu'] * $bet['actionNum'];
?>
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/admin778899.php/business/betinfoUpdateed" target="ajax" method="post" call="betinfoDataSubmitCode" onajax="betinfoDataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="betid" value="<?=$args[0]?>"/>
    <input type="hidden" name="uid" value="<?=$bet['uid']?>"/>
    <input type="hidden" name="username" value="<?=$bet['username']?>"/>
   
<div class="bet-info popupModal">
	<table cellpadding="0" cellspacing="0" width="480">
		<tr>
			<td align="right">号码：</td>
			<td colspan="3"><textarea cols="45" name="actionData" rows="5"><?=$wei.$bet['actionData']?></textarea></td>
		</tr>
		<tr>
			<td width="80" align="right">单号：</td>
			<td width="160"><?=$bet['wjorderId']?></td>
			<td width="80" align="right">投注数量：</td>
			<td width="160"><input type="text" name="actionNum" style="width:110px;" value="<?=$bet['actionNum']?>" /></td>
		</tr>
		<tr>
			<td align="right">发起人：</td>
			<td><?=$bet['username']?></td>
			<?php if($bet['type']!=34){?>
			<td align="right">模式：</td>
			<td><select name="mode" style="width:60px;">
			         <option value="2.000" <?=$this->iff($bet['mode']==2.000, 'selected="selected"')?>>元</option>
					 <option value="0.200" <?=$this->iff($bet['mode']==0.200, 'selected="selected"')?>>角</option>
					 <option value="0.020" <?=$this->iff($bet['mode']==0.020, 'selected="selected"')?>>分</option>
			    </select>
			</td>
			<?}else{?>
			<td align="right">模式：</td>
			<td><select name="mode" style="width:60px;">
			        <option value="1.000" <?=$this->iff($bet['mode']==1.000, 'selected="selected"')?>>1元</option>
			    </select>
			</td>
			<?}?>
		</tr>
		<tr>
			<td align="right">倍数：</td>
			<td><input type="text" name="beiShu" style="width:110px;" value="<?=$bet['beiShu']?>" /></td>
			<td align="right">中奖注数：</td>
			<td><?=$this->iff($bet['lotteryNo'], $bet['zjCount'], '－')?></td>
		</tr>
		<tr>
			<td align="right">彩种：</td>
			<td><?=$this->types[$bet['type']]['title']?></td>
			<td align="right">奖金－返点：</td>
			<td><?=number_format($bet['bonusProp'], 2)?>－<?=number_format($bet['fanDian'],1)?>%</td>
		</tr>
		<tr>
			<td align="right">期号：</td>
			<td><?=$bet['actionNo']?></td>
			<td align="right">玩法：</td>
			<td>
<?php
		$sql="select * from {$this->prename}played where enable=1 and type=?";
		$plays=$this->getRows($sql,$bet['type']);
		if($plays){
?>
<select name="playedId">
<?php
		foreach($plays as $play){
		?>
		<option value="<?=$play['id']?>" <?=$this->iff($play['id']==$bet['playedId'], 'selected="selected"')?>><?=$play['name']?></option>
<?php } ?>
</select>		
		<?php } ?>
</td>
		</tr>
		<tr>
			<td align="right">开奖号：</td>
			<td><?=$this->ifs($bet['lotteryNo'], '－')?></td>
			<td align="right">投注时间：</td>
			<td><?=date('m-d H:i:s',$bet['actionTime'])?></td>
		</tr>
		<tr>
			<td align="right">订单状态：</td>
			<td>
			<?php
				if($bet['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif(!$bet['lotteryNo']){
					echo '<font color="#009900">未开奖</font>';
				}elseif($bet['zjCount']){
					echo '<font color="red">已派奖</font>';
				}else{
					echo '未中奖';
				}
			?>
			</td>
            <td align="right">开奖时间：</td>
            <td colspan="3"><?=date('m-d H:i:s',$bet['kjTime'])?></td>
        </tr>
		<!-- 投注开始 -->
		<tr>
			<td align="right">投注：</td>
			<td><?=number_format($betCont, 2)?>元</td>
			<td align="right">中奖：</td>
			<td><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'], 2) .'元', '－')?></td>
		</tr>
		<tr>
			<td align="right">返点：</td>
			<td><?=$this->iff($bet['lotteryNo'], number_format($bet['fanDianAmount'], 2). '元', '－')?></td>
			<td align="right">个人盈亏：</td>
			<td><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'] - $betCont + $bet['fanDianAmount'], 2) . '元', '－')?></td>
		</tr>
		<!-- 投注结束 -->
	</table>
</div>
   </form>
</div>