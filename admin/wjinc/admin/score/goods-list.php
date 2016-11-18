<?php
	$sql="select * from {$this->prename}score_goods where isdelete=0 order by id desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	//print_r($this);
	//echo get_class($this);
?>
<article class="module width_full">
<input type="hidden" value="<?=$this->user['username']?>" />
    <header>
    	<h3 class="tabs_involved">兑换商品列表
			<div class="submit_link wz"><input type="submit" value="添加商品" onclick="scoreEditGoods()" class="alt_btn"></div>
        </h3>
    </header>
    <div class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>ID</th> 
			<th>名称</th> 
			<th>描述</th> 
			<th>总量</th> 
			<th>兑换量</th> 
			<th>剩余量</th> 
			<th>积分</th> 
			<th>价值（元）</th> 
			<th>时间</th> 
			<th>状态</th><!--开启 关闭 超时 缺货-->
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody>
    <!--picmin 小图片	picmax 大图片	intoTime 加入时间	restriction 限制单人兑换件数	sum 商品总数	surplus 兑换件数	startTime 开始时间	stopTime 结束时间	score 积分	price 价值	enable-->
	<?php if($data['data']) foreach($data['data'] as $var){ 
		$cssspan1="spn1";
		$cssspan2="spn1";
		$cssspan3="spn1";
		if($var['enable']==0){
			$state="关闭";
			$statebtn="开启";
			$cssspan3="spn6";
		}else{
			$state="开启";
			$statebtn="关闭";
			$cssspan3="spn5";
			if($var["sum"]-$var["surplus"]<=0){
				$state="关闭";
				$statebtn="开启";
				$cssspan1="spn4";
				$cssspan3="spn6";
			}
			if((time()-$var["stopTime"]>0 && $var["stopTime"]) || time()-$var["startTime"]<0){
				$state="关闭";
				$statebtn="开启";
				$cssspan2="spn4";
				$cssspan3="spn6";
			}
		}
	?>
		<tr> 
			<td><?=$var['id']?></td> 
			<td><?=$var['title']?></td> 
			<td><input type="text" value="<?=$var['content']?>"/></td> 
			<td><?=$var['sum']?></td> 
			<td><?=$var['surplus']?></td> 
			<td><span class="<?=$cssspan1?>"><?=$var['sum']-$var['surplus']?></span></td> 
			<td><?=$var['score']?></td> 
			<td><?=$var['price']?></td> 
			<td><span class="<?=$cssspan2?>"> <?=date("Y-m-d H:i",$var['startTime'])?> — <?=date("Y-m-d H:i",$var['stopTime'])?></span></td> 
			<td><span class="<?=$cssspan3?>"><?=$state?></span></td> 
			<td><a href="/admin778899.php/Score/goodsOnoff/<?=$var['id'].'/'.$var['enable']?>" target="ajax" call="goodsHandle" dataType="json"><?=$statebtn?></a> | <a href="#" onclick="scoreEditGoods(<?=$var['id']?>)">修改</a> | 
            <a href="/admin778899.php/Score/goodsDel/<?=$var['id']?>" target="ajax" call="goodsHandle" dataType="json">删</a>
            </td>
		</tr> 
	<?php }else{ ?>
		<tr>
			<td colspan="9" align="center">暂时还没有商品。</td>
		</tr>
	<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/goodsList-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div><!-- end of .tab_container -->
</article><!-- end of content manager article -->
