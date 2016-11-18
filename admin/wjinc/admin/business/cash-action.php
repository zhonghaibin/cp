<div class="cash-modal" data="<?=$args[0]['id']?>">
<form action="/admin778899.php/business/cashDealWith/<?=$args[0]['id']?>"  target="ajax" method="post" call="rechargeSubmitCode" dataType="html">
	<ul>
		<li> 银行类型：<?=$args[0]['bankName']?>&nbsp;&nbsp;<a href="<?=$args[0]['bankHome']?>" target="_blank" style="color:#f00;">进入银行>></a></li>
		<li>开户姓名：<?=$args[0]['username']?> <input name="username" id="username" type="hidden" value="<?=$args[0]['username']?>" />
        		<div style="float:right;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-username" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-username&inputID=username" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-username&inputID=username" width="62" height="23" name="copy-username" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                </object>
               </div>
           </li>
           <li>银行帐号：<?=$args[0]['account']?> <input name="account" id="account" type="hidden" value="<?=$args[0]['account']?>" />
        		<div style="float:right;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-account" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-username&inputID=account" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-account&inputID=account" width="62" height="23" name="copy-account" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                </object>
               </div>
           </li>
           <li>提取金额：<?=$args[0]['amount']?> <input name="amount" id="amount" type="hidden" value="<?=$args[0]['amount']?>" />
        		<div style="float:right;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="62" height="23" id="copy-amount" align="top">
                <param name="allowScriptAccess" value="always" />
                <param name="movie" value="/skin/js/copy.swf?movieID=copy-amount&inputID=amount" />
                <param name="quality" value="high" />
                <param name="bgcolor" value="#ffffff" />
                <param name="scale" value="noscale" /><!-- FLASH原始像素显示-->
                <embed src="/skin/js/copy.swf?movieID=copy-amount&inputID=amount" width="62" height="23" name="copy-amount" align="top" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                </object>
               </div>
           </li>
	</ul>
	<p>
		<label><input type="radio" name="type" value="0" checked onclick="cashTrue()"/>提现成功（扣除冻结款）</label>
		<label><input type="radio" name="type" value="1" onclick="cashFalse()"/>提现失败（返还冻结款）</label>
        <input type="text" class="cashFalseSM" name="info" style="display:none; overflow-y:auto; width:100%;"  value=""/>
	</p>
</form>
</div>