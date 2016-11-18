<?php
	$this->getPlayeds();
	$played=$this->getRow("select simpleInfo, info, example from {$this->prename}played where id=?", $args[0]);
	
	if(!$played) throw new Exception('单号不存在');
?>
<div>
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/admin778899.php/system/playedInfoUpdateed" target="ajax" method="post" call="playedInfoDataSubmitCode" onajax="playedInfoDataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="playedid" value="<?=$args[0]?>"/>
   
<div class="bet-info popupModal">
	<table cellpadding="0" cellspacing="0" width="480">
		<tr>
			<td align="right">玩法介绍：</td>
			<td><textarea cols="45" name="simpleInfo" rows="3"><?=$played['simpleInfo']?></textarea></td>
		</tr>
		<tr>
			<td align="right">详细介绍：</td>
			<td><textarea cols="45" name="info" rows="3"><?=$played['info']?></textarea></td>
		</tr>
        <tr>
			<td align="right">中奖范例：</td>
			<td><textarea cols="45" name="example" rows="3"><?=$played['example']?></textarea></td>
		</tr>
		
	</table>
</div>
   </form>
</div>