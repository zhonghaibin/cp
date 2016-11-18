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
            <textarea name="box-content" style="border:1px solid #CCC;padding:2px 3px; height:140px;width:470px; overflow:scroll;"><?=$args[0]['content']?></textarea>
        </td>
    </tr>
    </tbody>
</table>