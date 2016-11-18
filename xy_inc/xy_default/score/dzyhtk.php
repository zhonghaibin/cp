<form action="/index.php/score/dzyhtked" method="post" target="ajax" onajax="Beforindexdzyh" call="indexdzyhtked">
        <div class="writeinfo_l">
            <dl>
                <dt>提款人：</dt>
                <dd><?=$args[0]['username']?></dd>
            </dl>
			<dl>
                <dt>存款时间：</dt>
                <dd><?=date('Y-m-d H:i',$args[0]['time'])?></dd>
            </dl>
            <dl>
                <dt>提款时间：</dt>
                <dd><?=date('Y-m-d H:i',$this->time)?></dd>
            </dl>
			<dl>
                <dt>本息总额：</dt>
                <dd><span style="color:red"><?=$args[0]['ck_money']?>&nbsp+<?=$args[0]['lx']?>&nbsp=&nbsp<?=$args[0]['ck_money']+$args[0]['lx']?>元&nbsp</span></dd>
            </dl>
            <dl>
                <dt>资金密码：</dt>
                <dd><input name="coinpassword" id="coinpassword" value="" style="padding: 2px 3px;height:20px;width:150px;line-height:20px;" type="password"></dd>
            </dl>
			<dl>
                <dt>验证码：</dt>
                <dd><input name="vcode" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9]/,'');}).call(this)" onblur="this.v();" maxlength="4" type="text" class="text4" style="padding: 2px 3px;height:20px;width:92px;line-height:20px;" /><b class="yzmNum"><img width="58" height="24" border="0" style="cursor:pointer;margin-bottom:0px;" id="vcode" alt="看不清？点击更换" align="absmiddle" src="/index.php/user/vcode/<?=$this->time?>" title="看不清楚，换一张图片" onclick="this.src='/index.php/user/vcode/'+(new Date()).getTime()"/></b></dd>
            </dl>
            <dl class="pagemain">
                <dt>&nbsp;</dt>
                <dd style="margin-left:-15px"><input class="bnt" style="width:70px;height:27px" value="确认提款" type="submit"></dd>
            </dl>
			<dl>
                <dt></dt>
                <dd></dd>
            </dl>
        </div>
        <div class="clear"></div>
</form>