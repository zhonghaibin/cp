<div class="manage-edit">
<input type="hidden" value="<?=$this->user['username']?>" />
<form action="/admin778899.php/pays/addpay" target="ajax" method="post" call="Addpay" onajax="BeforeAddpay">
	<table class="tablesorter left" cellspacing="0"> 
	<tbody> 
		<tr> 
		   <td>商家名</td> 
			<td><select name="name">
                <option value="易宝支付" selected>易宝支付</option>
                <!--option value="环迅支付">环迅支付</option>
				<option value="花旗支付">花旗支付</option>
                <option value="智付">智付</option>
				<option value="宝付">宝付</option--> 
            </select></td>
		</tr>
		<td><input type="hidden" value="yeepay" name="sortname"/></td>
		<tr> 
			<td>商户编号</td> 
			<td><input  value="" name="number"/></td> 
		</tr> 
		<tr> 
			<td>商户密钥</td> 
			<td><input  value="" name="mkey"/></td>
		</tr>
	</tbody> 
	</table>
</form>
</div>