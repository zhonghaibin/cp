<form action="/admin778899.php/dzyh/Dzyhpointedited" method="post" target="ajax" call="indexdzyhedited">
<input name="id" value="<?=$args[0]['id']?>" type="hidden">
        <div class="writeinfo_l">
            <dl>
                <dt style="margin-top:10px;">存款人：</dt>
                <dd><?=$args[0]['username']?></dd>
            </dl>
			<dl>
                <dt style="margin-top:10px;">存款金额：</dt>
                <dd><input name="ck_money" id="ck_money" value="<?=$args[0]['ck_money']?>" style="padding: 2px 3px;height:20px;width:100px;line-height:20px;" type="text" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9./]/,'');}).call(this)" onblur="this.v();"></dd>
            </dl>
            <dl>
                <dt style="margin-top:10px;">存款时间：</dt>
                <dd><input name="time" id="time" value="<?=date('Y-m-d H:i:s',$args[0]['time'])?>" style="padding: 2px 3px;height:20px;width:150px;line-height:20px;" type="text"></dd>
            </dl>
            <dl class="pagemain">
                <dt>&nbsp;</dt>
                <dd style="margin-left:-15px"><input class="bnt" style="width:70px;height:27px" value="确认修改" type="submit"></dd>
            </dl>
			<dl>
                <dt></dt>
                <dd></dd>
            </dl>
        </div>
        <div class="clear"></div>
</form>