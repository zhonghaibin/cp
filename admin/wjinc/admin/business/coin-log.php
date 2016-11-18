<?php
	$this->getTypes();
	$this->getPlayeds();

	$para=$_GET;

	// 用户限制
	if($para['username']){
		if(!ctype_alnum($para['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and u.username like '%{$para['username']}%'";
	}

	// 帐变类型限制
	$para['liqType']=intval($para['liqType']);
	if($para['liqType']){
		$liqTypeWhere="and l.liqType={$para['liqType']}";
		if($_REQUEST['liqType']==2) $liqTypeWhere=' and liqType=2 or liqType=3';
	}

	// 彩种限制
	$_REQUEST['type']=intval($_REQUEST['type']);
	if($_REQUEST['type']){
		$typeWhere="and l.type={$_REQUEST['type']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and l.actionTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime<$fromTime";
	}else{
		$timeWhere=' and l.actionTime>'.strtotime('00:00');
	}

	$sql="select l.*, u.username from {$this->prename}coin_log l,{$this->prename}members u where l.liqType not in(4,11,104) $timeWhere $liqTypeWhere $typeWhere $userWhere and l.uid=u.uid order by l.id desc";

	$data=$this->getPage($sql, $this->page, $this->pageSize);
	$mname=array(
	    '1.000'=>'1元',
		'2.000'=>'元',
		'0.200'=>'角',
		'0.020'=>'分',
		'0.002'=>'厘'
	);
	
	$sql="select mode, playedId, actionNo from {$this->prename}bets where id=?";
	
	$liqTypeName=array(
		1=>'充值',
		2=>'返点',
		//3=>'返点',//分红
		//4=>'抽水金额',
		5=>'停止追号',
		6=>'中奖金额',
		7=>'撤单',
		8=>'提现失败返回冻结金额',
		9=>'管理员充值',
		10=>'解除抢庄冻结金额',
		//11=>'收单金额',
		
		50=>'签到赠送',
		51=>'首次绑定工行卡赠送',
		52=>'充值佣金',
		53=>'消费佣金',
		
		100=>'抢庄冻结金额',
		101=>'投注冻结金额',
		102=>'追号投注',
		103=>'抢庄返点金额',
		//104=>'抢庄抽水金额',
		105=>'抢庄赔付金额',
		106=>'提现冻结',
		107=>'提现成功扣除冻结金额',
		108=>'开奖扣除冻结金额',
		109=>'上级充值金额',
		110=>'给下级充值扣款金额',
		120=>'幸运大转盘赠送',
		130=>'夺宝奇兵赠送'
	);
?>

<script type="text/javascript">
 function defaultSearch(err, html){
	if(err){
		error(err);
	}else{
		$('#main').html(html).find('input[type=date]').datepicker();
	}
}
</script>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
	<header>
		<h3 class="tabs_involved">帐变明细
		<form action="/admin778899.php/business/coinLog" class="submit_link wz" target="ajax" call="defaultSearch" dataType="html">
			会员：<input type="text" class="alt_btn" name="username" style="width:60px;"/>&nbsp;&nbsp;
			类型：<select style="width:100px" name="liqType">
					<option value="">所有帐变类型</option>
                    <option value="1">充值</option>
                    <option value="2">返点</option><!--3,分红-->
                    <!--<option value="4">抽水金额</option>-->
                    <option value="5">停止追号</option>
                    <option value="6">中奖金额</option>
                    <option value="7">撤单</option>
                    <option value="8">提现失败返回冻结金额</option>
                    <option value="9">管理员充值</option>
                    <option value="10">解除抢庄冻结金额</option>
                    <!--<option value="11">收单金额</option>-->
                    <option value="50">签到赠送</option>
                    <option value="51">首次绑定工行卡赠送</option>
                    <option value="52">充值佣金</option>
                    <option value="53">消费佣金</option>
                    <option value="100">抢庄冻结金额</option>
                    <option value="101">投注</option>
                    <option value="102">追号投注</option>
                    <option value="103">抢庄返点金额</option>
                    <!--<option value="104">抢庄抽水金额</option>-->
                    <option value="105">抢庄赔付金额</option>
                    <option value="106">提现冻结</option>
                    <option value="107">提现成功扣除冻结金额</option>
                    <option value="108">开奖扣除冻结金额</option>
					<option value="109">上级充值金额</option>
					<option value="110">给下级充值扣款金额</option>
					<option value="120">幸运大转盘赠送</option>
					<option value="130">夺宝奇兵赠送</option>
				</select>&nbsp;&nbsp;
			时间：从<input type="date" class="alt_btn" name="fromTime"/> 到 <input type="date" class="alt_btn" name="toTime"/>&nbsp;&nbsp;
			<select style="width:90px;" name="type">
				<option value="">全部彩种</option>
			<?php if($this->types) foreach($this->types as $var){
				if($var['enable'] && !$var['isDelete']){
			?>
				<option value="<?=$var['id']?>" title="<?=$var['title']?>"><?=$this->ifs($var['shortName'], $var['title'])?></option>
			<?php }} ?>
			</select>&nbsp;&nbsp;
			<input type="submit" value="查找" class="alt_btn">
			<input type="reset" value="重置条件">
		</form>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<th>用户名</th>
			<th>帐变类型</th>
			<th>单号</th>
			<th>游戏</th>
			<th>玩法</th>
			<th>期号</th>
			<th>模式</th>
			<th>资金</th>
			<th>余额</th>
			<th>时间</th>
			
		</tr>
	</thead>
	<tbody id="nav01">
	<?php if($data['data']) foreach($data['data'] as $var){
		if($var['extfield0']>0){
			$bet=$this->getRow($sql, $var['extfield0']);
		}else{
			$bet=array();
		}
	?>
		<tr>
			<td><?=$var['username']?></td>
			<td><?=$var['info']?></td>
            <?php if($var['extfield0'] && in_array($var['liqType'], array(2,3,4,5,6,7,10,11,100,101,102,103,104,105,108))){ ?>
                <td><a target="modal" button="关闭:defaultCloseModal" width="510" title="投注信息" href="/admin778899.php/business/betInfo/<?=$var['extfield0']?>"><?=$this->ifs($var['extfield0'], '--')?></a>
                </td>
                <td><?=$this->iff($var['type'], $this->types[$var['type']]['title'], '--')?></td>
                <td><?=$this->iff($bet['playedId'], $this->playeds[$bet['playedId']]['name'], '--')?></td>
                <td><?=$this->ifs($bet['actionNo'], '--')?></td>
                <td><?=$this->iff($bet['mode'], $mname[$bet['mode']], '--')?></td>
			<?php }elseif(in_array($var['liqType'], array(1,9,52))){?>
                <td><a href="/admin778899.php/business/rechargeInfo/<?=$var['extfield0']?>" width="500" title="充值信息" button="关闭:defaultCloseModal" target="modal"><?=$var['extfield1']?></a></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
			<?php }elseif(in_array($var['liqType'], array(8,106,107))){?>
                <td><a href="/admin778899.php/business/cashInfo/<?=$var['extfield0']?>" width="500" title="提现信息" button="关闭:defaultCloseModal" target="modal"><?=$var['extfield0']?></a></td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                
            <?php }else{ ?>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
                <td>--</td>
            <?php } ?>
            
			<td><?=$var['coin']?></td>
			<td><?=$var['userCoin']?></td>
			<td><?=date('m-d H:i', $var['actionTime'])?></td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="10">暂时没有帐变记录</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/coinLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction');
	?>
	</footer>
</article>
<script type="text/javascript">  
ghhs("nav01","tr");  
</script>