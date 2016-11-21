<?php
	$this->getTypes();
	$this->getPlayeds();

	
	// 帐号限制
	if($_REQUEST['username']){
		$_REQUEST['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and b.username like '%{$_REQUEST['username']}%'";
	}
	
	//期号
	if($_REQUEST['actionNo']){
		$_REQUEST['actionNo']=wjStrFilter($_REQUEST['actionNo']);
		$actionNoWhere=" and b.actionNo='{$_REQUEST['actionNo']}'";
	}

	// 彩种限制
	if($_REQUEST['type']=intval($_REQUEST['type'])){
		$typeWhere=" and b.type={$_REQUEST['type']}";
	}

	// 投注金额限制
	if($_REQUEST['betamount']!=0){
		$_REQUEST['betamount']=intval($_REQUEST['betamount']);
		    if($_REQUEST['betamount']==1){  //投注金额从小到大
		       $betamountWhere=" order by b.mode*b.beiShu*b.actionNum";
			}else if($_REQUEST['betamount']==2){   //投注金额从大到小
				$betamountWhere=" order by b.mode*b.beiShu*b.actionNum DESC";
			}
	}else{
		$betamountWhere=" order by b.id desc";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and b.actionTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and b.actionTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and b.actionTime<$fromTime";
	}else{
		$timeWhere=' and b.actionTime>'.strtotime('00:00');;
	}
	$sql="select * from {$this->prename}bets b where 1 $timeWhere $actionNoWhere $typeWhere $userWhere $betamountWhere";
	if($_REQUEST['id']){
	$_REQUEST['id']=wjStrFilter($_REQUEST['id']);
	if(!ctype_alnum($_REQUEST['id'])) throw new Exception('单号包含非法字符,请重新输入');
	$sql="select * from {$this->prename}bets b where b.wjorderId='{$_REQUEST['id']}'";}

	$data=$this->getPage($sql, $this->page, $this->pageSize);
	
	$mname=array(
	    '1.000'=>'1元',
		'2.000'=>'元',
		'0.200'=>'角',
		'0.020'=>'分',
		'0.002'=>'厘'
	);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3 class="tabs_involved">普通投注
			<div class="submit_link wz">
			<form action="/admin778899.php/business/betLog" target="ajax" call="defaultSearch" dataType="html">
				期号<input type="text" class="alt_btn" name="actionNo" style="width:90px;" value="<?=$_REQUEST['actionNo']?>"/>
				单号<input type="text" class="alt_btn" name="id" style="width:90px;"/>&nbsp;&nbsp;
				会员<input type="text" class="alt_btn" name="username" style="width:90px;"/>&nbsp;&nbsp;
				时间从 <input type="date" class="alt_btn" name="fromTime"/> 到 <input type="date" name="toTime" class="alt_btn"/>&nbsp;&nbsp;
				<select style="width:100px;" name="type">
					<option value="">全部彩种</option>
				<?php if($this->types) foreach($this->types as $var){
                                  
					if($var['enable'] && !$var['isDelete']){
				?>
					<option value="<?=$var['id']?>" title="<?=$var['title']?>"><?=$this->ifs($var['shortName'], $var['title'])?></option>
				<?php }} ?>
				</select>&nbsp;&nbsp;投注金额
				<select style="width:100px;" name="betamount">
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
	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<th>单号</th>
				<th>用户名</th>
				<th>投注时间</th>
				<th>彩种</th>
				<th>玩法</th>
				<th>期号</th>
				<th>倍数</th>
				<th>注数</th>
				<th>模式</th>
				<th>投注号码</th>
				<th>投注金额</th>
				<th>中奖金额</th>
				<th>返点</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody id="nav01">
		<?php if($data['data']) foreach($data['data'] as $var){ ?>
			<tr data-code='<?=json_encode($var)?>'>
				<td><a href="/admin778899.php/business/betInfo/<?=$var['id']?>" button="确定:defaultCloseModal" title="投注信息" width="510" target="modal"><?=$var['wjorderId']?></a></td>
				<td><?=$var['username']?></td>
				<td><?=date('m-d H:i', $var['actionTime'])?></td>
				<td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
				<td><?=$this->playeds[$var['playedId']]['name']?></td>
				<td><?=$var['actionNo']?></td>
				<td><?=$var['beiShu']?></td>
				<td><?=$var['actionNum']?></td>
				<td><?=$mname[$var['mode']]?></td>
				<td data-code="<?=$var['actionData']?>"><?=$this->CsubStr($var['actionData'],0,10)?></td>
				<td><?=number_format($var['mode'] * $var['beiShu'] * $var['actionNum'], 2)?></td>
				<td>
				<?php 
				if($var['isDelete']==1){
					echo '已撤单';
				}else{
					if($var['lotteryNo']){
						echo number_format($var['zjCount'] * $var['bonusProp'] * $var['beiShu'] * $var['mode']/2, 2);
					}else{
						echo '未开奖';
					}
				}
				?>
                </td>
				<td><?=$var['fanDianAmount']?></td>
				<td><?php if($var['lotteryNo'] || $var['isDelete']==1){ ?>--<?php }else{ ?><a href="/admin778899.php/business/betInfoUpdate/<?=$var['id']?>" button="修改:dataAddCode|取消:defaultCloseModal" title="修改投注信息" width="510" target="modal" modal="true">修改</a> | <a call="clearcode" href="/admin778899.php/business/deleteCode/<?=$var['wjorderId']?>" title="即将撤单，是否继续！" dataType="json" method="post" target="ajax">撤单</a></td><?php } ?>
			</tr>
		<?php }else{ ?>
    <tr>
        <td colspan="14" align="center">暂时没有投注记录。</td>
    </tr>
<?php } ?>
		</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/betLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>