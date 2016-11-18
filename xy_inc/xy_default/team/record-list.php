<?php
	//echo $this->userType;
	$para=$_GET;
	
	if($para['state']==5){
		$whereStr = ' and b.isDelete=1 ';
	}else{
		$whereStr = ' and  b.isDelete=0 ';	
	}
	// 彩种限制
	if($para['type']=intval($para['type'])){
		$whereStr .= " and b.type={$para['type']}";
	}
	
	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$whereStr .= ' and b.actionTime between '.strtotime($para['fromTime']).' and '.strtotime($para['toTime']);
	}elseif($para['fromTime']){
		$whereStr .= ' and b.actionTime>='.strtotime($para['fromTime']);
	}elseif($para['toTime']){
		$whereStr .= ' and b.actionTime<'.strtotime($para['toTime']);
	}else{
		
		if($GLOBALS['fromTime'] && $GLOBALS['toTime']){
			$whereStr .= ' and b.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
		}
	}
	
	// 投注状态限制
	if($para['state']){
	switch($para['state']){
		case 1:
			// 已派奖
			$whereStr .= ' and b.zjCount>0';
		break;
		case 2:
			// 未中奖
			$whereStr .= " and b.zjCount=0 and b.lotteryNo!='' and b.isDelete=0";
		break;
		case 3:
			// 未开奖
			$whereStr .= " and b.lotteryNo=''";
		break;
		case 4:
			// 追号
			$whereStr .= ' and b.zhuiHao=1';
		break;
		case 5:
			// 撤单
			$whereStr .= ' and b.isDelete=1';
		break;
		}
	}
	
	// 模式限制
	if($para['mode']=floatval($para['mode'])) $whereStr .= " and b.mode={$para['mode']}";
	
	//单号
   if($para['betId'] && $para['betId']!='输入单号'){
   $para['betId']=wjStrFilter($para['betId']);
   if(!ctype_alnum($para['betId'])) throw new Exception('单号包含非法字符,请重新输入');
   $whereStr .= " and b.wjorderId='{$para['betId']}'";}


	// 用户名限制
		if($para['username'] && $para['username']!='用户名'){
			$para['username']=wjStrFilter($para['username']);
			if(!ctype_alnum($para['username'])) throw new Exception('用户名包含非法字符,请重新输入');
			$whereStr .= " and u.username like '%{$para['username']}%' and concat(',',u.parents,',') like '%,{$this->user['uid']},%'";
		}
		switch($para['utype']){
			case 1:
				//我自己
				$whereStr .= " and b.uid={$this->user['uid']}";
				break;
			case 2:
				//直属下线
				$whereStr .= " and u.parentId={$this->user['uid']}";
				break;
			case 3:
				// 所有下级
				$whereStr .= " and concat(',',u.parents,',') like '%,{$this->user['uid']},%' and u.uid!={$this->user['uid']}";
				break;
			default:
				// 所有人
				$whereStr .= " and concat(',',u.parents,',') like '%,{$this->user['uid']},%'";
			break;
		}
	$sql="select b.*, u.username from {$this->prename}bets b, {$this->prename}members u where b.uid=u.uid";
	$sql.=$whereStr;
	$sql.=' order by id desc, actionTime desc';
	
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($data);
	$params=http_build_query($para, '', '&');
	
	$modeName=array('2.000'=>'元', '0.200'=>'角', '0.020'=>'分', '0.002'=>'厘','1.000'=>'1元');
?>
<div>
<table width="100%" class='table_b'>
	<thead>
		<tr class="table_b_th">
			<td>编号</td>
            <td>用户</td>
			<td>投注时间</td>
			<td>彩种</td>
			<td>期号</td>
			<td>玩法</td>
			<td>倍数模式</td>
			<td>总额(元)</td>
			<td>奖金(元)</td>
			<td>开奖号码</td>
			<td>状态</td>
            <td>操作</td>
		</tr>
	</thead>
	<tbody class="table_b_tr">
	<?php if($data['data']){ 
	foreach($data['data'] as $var){ ?>
		<tr>
			<td>
				<a href="/index.php/record/betInfo/<?=$var['id']?>" width="800" title="投注信息" button="关闭:defaultModalCloase" target="modal"><?=$var['wjorderId']?></a>
			</td>
            <td>
			<?
            if($var['username']){echo  $var['username'];}else{echo '--';};
            ?>
            </td>
			<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
			<td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
			<td><?=$var['actionNo']?></td>
			<td><?=$this->playeds[$var['playedId']]['name']?></td>
			
			<td><?=$var['beiShu']?> [<?=$modeName[$var['mode']]?>]</td>
			<td><?=$var['mode']*$var['beiShu']*$var['actionNum']?></td>
			<td><?=$this->iff($var['lotteryNo'], number_format($var['bonus'], 2), '0.00')?></td>
			<td><?=$this->ifs($this->CsubStr($var['lotteryNo'],0,6), '--')?></td>
			<td>
			<?php
				if($var['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif(!$var['lotteryNo']){
					echo '<font color="#009900">未开奖</font>';
				}elseif($var['zjCount']){
					echo '<font color="red">已派奖</font>';
				}else{
					echo '未中奖';
				}
			?>
			</td>
            <td>--</td>
		</tr>
	<?php } }else{ ?>
    <tr><td colspan="12">暂无投注信息</td></tr>
    <?php } ?>
	</tbody>
</table>
<?php 
	$this->display('inc_page.php',0,$data['total'],$this->pageSize, "/index.php/{$this->controller}/{$this->action}-{page}/?$params");
?>
</div>