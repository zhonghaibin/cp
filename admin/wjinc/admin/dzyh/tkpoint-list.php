<?php
	// 帐号限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$_REQUEST['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and u.username like '%{$_REQUEST['username']}%'";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.tktime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and s.tktime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.tktime<$fromTime";
	}

	//提款金额限制
	if($_REQUEST['tk_money']!=0){
		$_REQUEST['tk_money']=intval($_REQUEST['tk_money']);
		    if($_REQUEST['tk_money']==1){  //存款金额从小到大
		       $tk_moneyWhere=" order by s.tk_money";
			}else if($_REQUEST['tk_money']==2){   //存款金额从大到小
				$tk_moneyWhere=" order by s.tk_money DESC";
			}
	}else{
		$tk_moneyWhere=" order by s.id desc ";
	}

	//已存时间限制
	if($_REQUEST['time']!=0){
		$_REQUEST['time']=intval($_REQUEST['enable']);
		    if($_REQUEST['time']==1){  //存款时间从小到大
		       $yctime=" and s.time";
			}else if($_REQUEST['time']==2){   //存款时间从小到大
				$yctimeWhere=" and s.time DESC";
			}
	}
	$sql="select s.*,u.username userName from {$this->prename}dzyh_tk_swap s, {$this->prename}members u where s.uid=u.uid and s.isdelete=0 $userWhere $timeWhere $yctimeWhere $tk_moneyWhere";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>

<script type="text/javascript">
$(function(){
	$('.tabs_involved input[name=username]')
	.focus(function(){
		if(this.value=='用户名') this.value='';
	})
	.blur(function(){
		if(this.value=='') this.value='用户名';
	})
	.keypress(function(e){
		if(e.keyCode==13) $(this).closest('form').submit();
	});
	
});
function pointHandle(err, data){
	if(err){
		alert(err);
		$(this).dialog('destroy');
	}else{
		success(data);
		$(this).dialog('destroy');
		reload();
	}
} 
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">提款记录
            <div class="submit_link wz">
            	<form action="/admin778899.php/dzyh/tkpointList" target="ajax" call="defaultSearch" dataType="html">
                会员：<input name="username" type="text" style="width:80px;" value="用户名"/>&nbsp;&nbsp;
                时间：从 <input type="date" style="width:75px;" name="fromTime"/> 到 <input type="date" style="width:75px;" name="toTime"/>&nbsp;&nbsp;提款金额:
				<select style="width:80px;" name="tk_money">
					<option value="0"></option>
					<option value="1">从小到大</option>
					<option value="2">从大到小</option>
				</select>&nbsp;&nbsp;已存时间:
				<select style="width:80px;" name="time">
					<option value="0"></option>
					<option value="1">从小到大</option>
					<option value="2">从大到小</option>
				</select>&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
                <input type="reset" value="重置条件">
                </form>
            </div>
        </h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>编号</th>
			<th>uid</th>
			<th>提款人</th> 
			<th>本金+利息</th>
			<th>已存时间</th>
			<th>提款日利率</th>
			<th>存入时间</th>
			<th>提款时间</th>
			<th>提款人ip</th>
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data']) foreach($data['data'] as $var){?>
		<tr> 
			<td><?=$var['id']?></td>
			<th><?=$var['uid']?></th>
			<td><?=$var['username']?></td> 
			<td><?=$var['tk_money']?>&nbsp+&nbsp<?=$var['lx']?>&nbsp=<?=$var['tk_money']+$var['lx']?>&nbsp元</td>
			<td><?=intval(($var['tktime']-$var['time'])/3600)?>小时</td>
			<td><?=$var['lv']?>%</td>
			<td><?=date('Y-m-d H:i:s',$var['time'])?></td>
			<td><?=date('Y-m-d H:i:s',$var['tktime'])?></td>
			<td><?=long2ip($var['ip'])?></td>
			<td><a href="/admin778899.php/dzyh/dzyhpointDel/<?=$var['id']?>" method="post" width="400" class="myanswer" target="ajax" title="是否删除该笔提款记录?" modal="true" call="pointHandle" dataType="json">删除</a>
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="12">暂无提款记录</td>
			</tr>
		<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/tkpointList-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div>
</article>
