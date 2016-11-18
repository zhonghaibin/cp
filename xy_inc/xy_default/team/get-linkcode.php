<div>
	<table cellpadding="2" cellspacing="2" class="popupModal">
	<?php 
		$sql="select * from {$this->prename}links where lid=?";
		if(!$linkData=$this->getRow($sql, $args[0])){
	?>
		<tr>
        	<td align="center" colspan="2" class="title">该注册链接不存在，或者已经失效！</td>
        </tr>	
	<?php  
		}else{
			$pd = "select * from {$this->prename}members where uid=?";
			$parentData = $this->getRow($pd, $linkData['uid']);
	?>
         <tr>
        	<td class="title">上级会员：</td>
			<td><?=$parentData['username']?></td>
        </tr>
		<tr>
			<td class="title">返点：</td>
			<td><?=$linkData['fanDian']?>%</td>
		</tr>
        <tr>
        	<td class="title">推广链接：</td>
			<td><input class="t-c t-c-w1" style="width:310px" id="adv-url" readonly="readonly" value="http://<?=$_SERVER['HTTP_HOST']?>/index.php/user/r/<?=$this->strToHex($this->myxor($linkData['lid']));?>" /></td>
        </tr>
        <tr>
        	<td class="title">&nbsp;</td>
			<td><div class="btn-a copy1">
                            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-advlink" align="top">
                                <param name="allowScriptAccess" value="always" />
                                <param name="movie" value="/skin/js/copy.swf?movieID=copy-advlink&inputID=adv-url" />
                                <param name="quality" value="high" />
                                <param name="bgcolor" value="#ffffff" />
                                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                                <embed src="/skin/js/copy.swf?movieID=copy-advlink&inputID=adv-url" width="62" height="23" name="copy-advlink" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                            </object>
                            </div></td>
        </tr>
     <?php }?>   
        
	</table>

</div>