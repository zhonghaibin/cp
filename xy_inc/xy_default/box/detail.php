<table width="100%">
    <tbody><tr>
        <td width="50%">主题：<input name="box-title" id="box-title" value="<?=$args[0]['title']?>" class="txt"></td>
        <td width="50%">发件人：<input name="box-from" id="box-from" value="<?=$args[0]['from_username']?>" class="txt"></td>
    </tr>
    <tr>
        <td>时间：<input name="box-time" id="box-time" value="<?=date('Y-m-d H:i',$args[0]['time'])?>" class="txt"></td>
        <td>收件人：<input name="box-to" id="box-to" value="<?=$args[0]['to_username']?>" class="txt"></td>
    </tr>
    <tr>
        <td colspan="2">
            <textarea name="box-content" class="txt2"><?=$args[0]['content']?></textarea>
        </td>
    </tr>
    </tbody>
</table>
<div class="answer" style="text-align:center;margin:auto;">
    <a href="/index.php/box/answer/<?=$args[0]['mid']?>" class="myanswer" target="modal" width="600" title="回复" modal="true" button=""><input value="回 复" style="width:70px;height:27px;margin-top:10px" class="bnt" type="button"></a>
</div>