<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('#editor_3',{
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
<header><h3 class="tabs_involved">添加公告</h3></header>
<table>
<tr><td>
<form action="/admin778899.php/system/doAddNotice" method="post" target="ajax" call="sysReloadNotice">
		<table class="tablesorter table2" cellspacing="0" width="100%">
			
			<tr>
				<td><span class="aq-txt">标题：</span></td>
				<td align="left"><input type="text" name="title" style="width:550px;margin-left:-100px;" value="" /></td>
			</tr>
			<tr>
				<td><span class="aq-txt">内容：</span></td>
				<td align="left">
                <textarea rows="10" name="content" id="editor_3" boxid="content" style="width:550px;height:300px;" ></textarea>
                </td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" class="alt_btn" value="添加公告"/></td>
			</tr>
		</table>
	</form>
	</td>
	
</tr>
</table>
</article>
