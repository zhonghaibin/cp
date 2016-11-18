<?php 
	$sql="select * from {$this->prename}content where id=?";
	$info=$this->getRow($sql, $args[0]);
	
?>
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('#editor_2',{
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
<header><h3 class="tabs_involved">修改内容</h3></header>
<table>
<tr><td>
	<form action="/admin778899.php/system/doUpdateNotice/<?=$info['id']?>" method="post" target="ajax" onajax="beforeUpdateNotice" call="doUpdateNotice">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			
			<tr>
				<td><span class="aq-txt">标题：</span></td>
				<td align="left"><input type="text" name="title" style="width:550px;margin-left:-100px;" value="<?=$info['title']?>" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">内容：</span></td>
				<td align="left">
                <textarea rows="10" name="content" id="editor_2" boxid="content" style="width:550px;height:300px;"><?=$info['content']?></textarea>
                </td>
			</tr>
			<tr>
				<td><span class="aq-txt">发布日期：</span></td>
				<td align="left" style="text-align:left;"><input type="text" name="addTime" style="width:150px;" value="<?=date('Y-m-d', $info['addTime'])?>" /></td>
			</tr>
            <tr>
				<td><span class="aq-txt">是否显示：</span></td>
				<td align="left" style="text-align:left;"><input type="radio" name="enable" value="1" <?=$this->iff($info['enable'], 'checked')?>/>显示  <input type="radio" name="enable" value="0" <?=$this->iff($info['enable'], '', 'checked')?>/>隐藏</td>
			</tr>
            
			<tr>
				<td>&nbsp;</td>
				<td align="left"><input type="submit" class="alt_btn" value="确定修改"/></td>
			</tr>
		</table>
	</form>
	</td>
	
</tr>
</table>
</article>
