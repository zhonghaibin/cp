<?php
	$para=$_GET;
	
	// 用户限制
	if($para['username'] && $para['username']!="用户名"){
		$userWhere="and username like '%{$para['username']}%'";
	}

	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$fromTime=strtotime($para['fromTime']);
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and c.actionTime between $fromTime and $toTime";
	}elseif($para['fromTime']){
		$fromTime=strtotime($para['fromTime']);
		$timeWhere="and c.actionTime>=$fromTime";
	}elseif($para['toTime']){
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and c.actionTime<$fromTime";
	}

	$sql="select * from {$this->prename}bonus_log where 1 $timeWhere $userWhere and isDelete=0 order by id desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
<article class="module width_full">
    <header>
		<h3 class="tabs_involved">分红记录列表
		<form action="/admin778899.php/bonus/bonusLog" target="ajax" datatype="html" call="defaultSearch" class="submit_link wz">
                用户名：<input type="text" class="alt_btn" style="width:60px;" name="username">&nbsp;&nbsp;
                时间：从 <input type="date" class="alt_btn" name="fromTime"> 到 <input type="date" class="alt_btn hasDatepicker" name="toTime">&nbsp;&nbsp;
                <input type="submit" value="查找" class="alt_btn">
        </form>
		</h3>
    </header>
<table class="tablesorter" cellspacing="0">
<thead>
    <tr>
        <th>UserID</th>
        <th>用户名</th>
        <th>盈亏总额</th>
        <th>分红金额</th>
        <th>分红起始时间</th>
        <th>分红发放时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
<?php if($data['data']) foreach($data['data'] as $var){ ?>
    <tr>
        <td><?=$var['uid']?></td>
        <td><?=$var['username']?></td>
        <td><?=$var['lossAmount']?></td>
        <td><?=$var['bonusAmount']?></td>
		<td><?=date('Y-m-d H:i:s',$var['startTime'])?><br><?=date('Y-m-d H:i:s',$var['endTime'])?></td>
        <td><?=date('Y-m-d H:i:s', $var['bonusTime'])?></td>
        <td>
        <?php
            if($var['bonusStatus']==1){
                echo '<font color="green">已领取</font>';
            }else{
                echo '<font color="red">未领取</font>';
            }
        ?>
        </td>
        <td align="center">
        <?php if($var['bonusStatus']==1){ ?>
            	<a href="/admin778899.php/bonus/bonusLogDelete/<?=$var['id']?>" target="ajax" call="bonusLogDelete" dataType="html">删除</a>
        <?php }else{ ?>
				<a href="/admin778899.php/bonus/bonusLogActionModal/<?=$var['id']?>" target="ajax" call="bonusLogModal">处理</a>
        <?php } ?>
        </td>
    </tr>
<?php }else{ ?>
    <tr>
        <td colspan="8" align="center">暂时没有分红记录。</td>
    </tr>
<?php } ?>
</tbody>
</table>
<footer>
<?php
		$rel=get_class($this).'/bonusLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
?>
</footer>
</article>
