<form action="/index.php/box/dowrite" method="post" target="ajax" onajax="boxBeforSend" call="boxSend">
    <input name="touser" value="dowrite" type="hidden">
    <input name="boxid" value="<?=$args[0]['mid']?>" type="hidden">
        <div class="writeinfo_l">
            <dl>
                <dt>收件人：</dt>
                <dd><?=$args[0]['from_username']?></dd>
            </dl>
            <dl>
                <dt>主题：</dt>
                <dd><input name="title" value="回复：”<?=$args[0]['title']?>“" class="txt" type="text"></dd>
            </dl>
            <dl>
                <dt>内容：</dt>
                <dd><textarea name="content" class="txt2"></textarea></dd>
            </dl>
			<dl>
                <dt>验证码：</dt>
                <dd><input name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4" type="text" class="text4" style="ime-mode: disabled; width: 75px;" /><b class="yzmNum"><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></b></dd>
            </dl>
            <dl class="pagemain">
                <dt>&nbsp;</dt>
                <dd><input class="bnt" style="width:70px;margin-left:-20px" value="发 送" type="submit"></dd>
            </dl>
            <input name="users" id="users" value="" type="hidden">
        </div>
        <div class="writeinfo_r" id="memberList" style="display:none;">
        </div>
        <div class="clear"></div>
</form>