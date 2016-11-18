<script language="javascript">
function cashFalse(){
	$('.cashFalseSM').css('display','block');
}
function cashTrue(){
	$('.cashFalseSM').css('display','none');
	$('.cashFalseSM').val()=false;
}
</script>
<?php
	$sql="select b.name bankName, c.*, u.username userAccount,u.parents, d.countname from {$this->prename}bank_list b, {$this->prename}member_cash c, {$this->prename}members u, {$this->prename}member_bank d where c.state=1 and c.bankId=b.id and c.uid=u.uid and d.uid=u.uid";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($this);
	//echo get_class($this);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header><h3 class="tabs_involved">提现请求</h3></header>
	
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<th>UserID</th>
			<th>用户名</th>
			<th>上级关系</th>
			<th>提现金额</th>
			<th>银行类型</th>
			<th>开户姓名</th>
			<th>银行账号</th>
			<th>开户行</th>
			<th>时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
	<?php if($data['data']) foreach($data['data'] as $var){ ?>
		<tr>
			<td><?=$var['uid']?></td>
			<td><?=htmlspecialchars($var['userAccount'])?></td>
			<td><?=implode('> ',$this->getCol("select username from {$this->prename}members where uid in ({$var['parents']})"))?></td>
			<td><?=$var['amount']?></td>
			<td><?=htmlspecialchars($var['bankName'])?></td>
			<td><?=htmlspecialchars($var['username'])?></td>
			<td><?=htmlspecialchars($var['account'])?></td>
            <td><?=htmlspecialchars($var['countname'])?></td>
			<td><?=date('Y-m-d H:i:s', $var['actionTime'])?></td>
			<td align="center">
			<?php if($var['state']==0 || $var['state']==2 || $var['state']==4){ ?>
				<a href="/admin778899.php/business/cashLogDelete/<?=$var['id']?>">删除</a>
			<?php }elseif($var['state']==1){ ?>
                <a href="/admin778899.php/business/cashActionModal/<?=$var['id']?>" target="modal"  width="420" title="提款处理" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">处理</a>
			<?php }elseif($var['state']>=3){ ?>
				--
			<?php } ?>
			</td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="8" align="center">暂时没有人申请提现。</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/cash';
		$this->display('inc/page.php', 0, $data['total'], $rel); 
	?>
	</footer>
</article>