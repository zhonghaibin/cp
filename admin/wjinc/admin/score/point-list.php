<?php
	// 帐号限制
	if($_REQUEST['username']&&$_REQUEST['username']!="用户名"){
		$_REQUEST['username']=wjStrFilter($_REQUEST['username']);
		if(!ctype_alnum($_REQUEST['username'])) throw new Exception('用户名包含非法字符,请重新输入');
		$userWhere="and u.username like '%{$_REQUEST['username']}%'";
	}

	// 状态限制
	if($_REQUEST['type']=intval($_REQUEST['type'])){
		if($_REQUEST['type']=='完成') $_REQUEST['type']='0';
		$typeWhere="and s.state={$_REQUEST['type']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.swapTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and s.swapTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.swapTime<$fromTime";
	}
	
	$sql="select s.*, g.title goodsTitle, g.price goodsPrice, u.username userName from {$this->prename}score_swap s, {$this->prename}score_goods g, {$this->prename}members u where s.uid=u.uid and s.goodId=g.id $userWhere $typeWhere $timeWhere order by s.id desc";
	//echo $sql;
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
</script>

<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">兑换订单
            <div class="submit_link wz">
            	<form action="/admin778899.php/Score/pointList" target="ajax" call="defaultSearch" dataType="html">
                会员：<input name="username" type="text" style="width:100px;" value="用户名"/>&nbsp;&nbsp;
                时间：从 <input type="date" style="width:75px;" name="fromTime"/> 到 <input type="date" style="width:75px;" name="toTime"/>&nbsp;&nbsp;
                <select name="type" style="width:90px;">
                    <option value="">所有状态</option>
                    <option value="1">等待发货</option>
                    <option value="2">正在配送</option>
                    <option value="3">已经取消</option>
                    <option value="完成">完成</option>
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
			<th>单号</th> 
			<th>商品</th> 
			<th>用户</th> 
			<th>数量</th> 
			<th>积分</th> 
            <th>价值(元)</th> 
			<th>兑换日期</th> 
			<th>状态</th> <!--（等待发货 > 正在配送 > 配送到达 > 完成/取消）-->
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data']) foreach($data['data'] as $var){
				$state="";
				$statenext="";
				switch($var['state']){
					case 1: 
						$state="等待发货";
						$statenext="【发货】";
						break;
					case 2:
						$state="正在配送";
						$statenext="【送达】";
						break;
					case 3:
						$state="配送到达";
						$statenext="【完成】";
						break;
					case 0:
						$state="完成";
						break;
					default: $state='未知出错';
				}
				if(!$var['enable']) $state="取消:".$state;
		?>
		<tr> 
			<td><?=$var['id']?></td> 
			<td><?=$var['goodsTitle']?></td> 
			<td><?=$var['userName']?></td>
			<td><?=$var['number']?></td> 
			<td><?=$var['score']?></td> 
            <td><?=$var['goodsPrice']*$var['number']?></td> 
			<td><?=date('Y-m-d H:i:s',$var['swapTime'])?></td> 
			<td><span class="state spn4 <?php if($state=="完成") echo 'spn5'?> <?php if(!$var['enable']) echo 'spn6'?>"><?=$state?></span></td> 
			<td>
            	<?php if($state!="完成"&&$var['enable']){?><a href="/admin778899.php/Score/pointState/<?=$var['id']?>/<?=$var['state']?>" target="ajax" call="pointHandle" dataType="json"><?=$statenext?></a> | <?php }?>
                
				<?php if($statenext!="【完成】"&&$state!="完成"){
					if($var['enable']){?>
                <a href="/admin778899.php/Score/pointEnable/<?=$var['id']?>/<?=$var['enable']?>" target="ajax" call="pointHandle" dataType="json">取消</a> |
				<?php }else{?>
                <a href="/admin778899.php/Score/pointEnable/<?=$var['id']?>/<?=$var['enable']?>" target="ajax" call="pointHandle" dataType="json">重启</a> |
                <?php }
				}?>
                
                <a href="/admin778899.php/Score/pointDel/<?=$var['id']?>" target="ajax" call="pointHandle" dataType="json">删除</a>
            </td> 
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="5">暂时没有兑换订单</td>
			</tr>
		<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/pointList-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
