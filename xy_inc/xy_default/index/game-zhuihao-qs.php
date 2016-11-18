<?php
	if($list=$this->getGameNos($this->type, $args[1]))
	foreach($list as $var){
?>
<tr>
	<td><input type="checkbox" />
	<td><?=$var['actionNo']?></td>
	<td><input type="text" class="beishu" value="1"/></td>
	<td><span class="amount"><?=$args[0]?></span>元</td>
	<td><?=date('Y-m-d H:i:s', $var['actionTime'])?></td>
</tr>
<?php } ?>