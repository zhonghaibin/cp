<div class="bonus-log-modal" data="<?=$args[0]['id']?>">
<form action="/admin778899.php/bonus/bonusLogDealWith/<?=$args[0]['id']?>"  target="ajax" method="post" call="bonusLogDealWith" dataType="html">
	<ul>
		<li>用户名：<?=$args[0]['username']?></li>
		<li>盈亏总额：<?=$args[0]['lossAmount']?></li> 
		<li>分红金额：<?=$args[0]['bonusAmount']?></li> 
		<li>分红起始时间：</li>
		<li><?=date('Y-m-d H:i:s',$args[0]['startTime'])?><br/><?=date('Y-m-d H:i:s',$args[0]['endTime'])?></li> 
		<li>分红发放时间：<?=date('Y-m-d H:i:s',$args[0]['bonusTime'])?></li> 
	</ul>
	<p>
		<label><input type="radio" name="bonusStatus" value="0" checked/>未领取</label>
		<label><input type="radio" name="bonusStatus" value="1" />已领取</label>
	</p>
</form>
</div>




