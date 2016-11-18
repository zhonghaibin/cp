<div>
<form action="/admin778899.php/time/added" method="post" target="ajax" onajax="beforeAddTime" call="addTime" dataType="html">
	<input type="hidden" name="type" value="<?=$args[0]?>"/>
     
	<table cellpadding="2" cellspacing="2" class="popupModal">
		
		<tr>
			<td class="title" width="180">彩种：</td>
			<td>六合彩</td>
		</tr>
        <tr>
			<td class="title" width="180">期数：</td>
			<td><input type="text" name="actionNo"  value=""/> 如：11</td>
		</tr>
         <tr>
			<td class="title" width="180">开奖时间：</td>
			<td><input type="text" name="actionTime"  value=""/> 如：2014-05-11 21:30:00</td>
		</tr>
	</table>
</form>
</div>
