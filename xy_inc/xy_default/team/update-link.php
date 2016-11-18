<?php 
	$sql="select * from {$this->prename}links where lid=?";
	$linkData=$this->getRow($sql, $args[0]);
	if($linkData['uid']){
		$parentData=$this->getRow("select fanDian from {$this->prename}members where uid=?", $linkData['uid']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
	}
?>
<div>
<form action="/index.php/team/linkUpdateed" target="ajax" method="post" call="linkDataSubmitCode" onajax="linkDataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="lid" value="<?=$args[0]?>"/>
	<table cellpadding="2" cellspacing="2" class="popupModal">
	<tr>
			<td class="title">账号类型：</td>
			<td><label><input type="radio" name="type" value="1" title="代理" <?=$this->iff($linkData['type'],'checked="checked"','')?> />代理</label>&nbsp;&nbsp;<label><input name="type" type="radio" value="0" title="会员" <?=$this->iff(!$linkData['type'],'checked="checked"','');?>/>会员</label></td>
	</tr>
	<tr>
			<td class="title">返点：</td>
			<td><input type="text" name="fanDian" value="<?=$linkData['fanDian']?>" max="<?=$parentData['fanDian']?>" min="0" fanDianDiff=<?=$this->settings['fanDianDiff']?> >%&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#999">0—<?=$parentData['fanDian']?>%</span></td>
	</tr>
    <tr>
        	<td class="title">加入时间：</td>
			<td><?=date("Y-m-d H:i:s",$linkData['regTime'])?></td>
    </tr>
        
	</table>
</form>
</div>