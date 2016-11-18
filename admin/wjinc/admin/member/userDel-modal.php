<?php 
		//检查是否有下级，并且有帐变
		$uid=$args[0];
		$son=$this->getRow("select count(*) teamNum, sum(coin) teamCoin, sum(fcoin) teamFcoin from {$this->prename}members where concat(',', parents, ',') like '%,$uid,%'");
		
?>
<div>
<?php 
echo $son['teamNum'];
if($son['teamNum']-1>0){?>
<input type="hidden" value="<?=$this->user['username']?>" />
<form target="ajax" method="post" call="nothin" dataType="html">
	<input type="hidden" name="uid" value="<?=$uid?>" />
	<input type="hidden" name="teamCoin" value="<?=$son['teamCoin']?>" />
	<input type="hidden" name="teamFcoin" value="<?=$son['teamFcoin']?>" />
	 团队还有成员<?=$son['teamNum']?>人，团队资金<?=$this->ifs($son['teamCoin'],'0.00')?>元,团队冻结<?=$this->ifs($son['teamFcoin'],'0.00')?>元，请先删除团队成员。
</form>
<?php }else{?>
<form action="/admin778899.php/Member/deleteed/<?=$uid?>" target="ajax" method="post" call="userDataSubmitCode" dataType="html">
	<input type="hidden" name="uid" value="<?=$uid?>" />
	<input type="hidden" name="teamCoin" value="<?=$son['teamCoin']?>" />
	<input type="hidden" name="teamFcoin" value="<?=$son['teamFcoin']?>" />
	无团队成员，个人资金<?=$this->ifs($son['teamCoin'],'0.00')?>元,团队冻结<?=$this->ifs($son['teamFcoin'],'0.00')?>元。<br />
	<span style="color:#F00; text-align:center; line-height:50px;">确定删除将不能恢复，是否确定？</span><br />
</form>
<?php }?>
</div>