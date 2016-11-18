<?php 
	$sql="select * from {$this->prename}links where lid=?";
	$linkData=$this->getRow($sql, $args[0]);
	
	if($linkData['uid']){
		$parentData=$this->getRow("select fanDian, username from {$this->prename}members where uid=?", $linkData['uid']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
	}

?>
<div>
<form action="/index.php/team/linkDeleteed" target="ajax" method="post" call="linkDataBeforeSubmitDelete" onajax="linkDataBeforeSubmitDelete" dataType="html">
	<input type="hidden" name="lid" value="<?=$args[0]?>"/>

	<table cellpadding="2" cellspacing="2" class="popupModal">
		
		<tr>
			<td class="title">上级用户：</td>
			<td><?=$parentData['username']?></td>
		</tr>
		
		<tr>
			<td class="title">返点：</td>
			<td><?=$linkData['fanDian']?>%</td>
		</tr>
        <tr>
        	<td class="title">加入时间：</td>
			<td><?=date("Y-m-d H:i:s",$linkData['regTime'])?></td>
        </tr>
        
	</table>
</form>
</div>
