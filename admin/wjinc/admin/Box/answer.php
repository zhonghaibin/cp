<form action="/admin778899.php/box/dowrite" method="post" target="ajax" onajax="boxBeforSend" call="boxSend">
    <input name="touser" value="dowrite" type="hidden">
    <input name="boxid" value="<?=$args[0]['mid']?>" type="hidden">
        <div class="writeinfo_l">
            <dl>
                <dt>收件人：</dt>
                <dd><?=$args[0]['from_username']?></dd>
            </dl>
            <dl>
                <dt>主题：</dt>
                <dd><input name="title" value="回复：”<?=htmlspecialchars($args[0]['title'])?>“" class="txt" type="text"></dd>
            </dl>
            <dl>
                <dt>内容：</dt>
                <dd><textarea name="content" class="txt2"></textarea></dd>
            </dl>
            <dl class="pagemain">
                <dt>&nbsp;</dt>
                <dd><input class="bnt" value="发 送" type="submit"></dd>
            </dl>
			<dl>
			</dl>
            <input name="users" id="users" value="" type="hidden">
        </div>
        <div class="writeinfo_r" id="memberList" style="display:none;"></div>
        <div class="clear"></div>
</form>