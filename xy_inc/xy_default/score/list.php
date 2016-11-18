<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '活动中心'); 
if($this->limittype=='current'){?>
<script type="text/javascript">
$(function(){
	$('.state-on').hover(function(){
		$(this).removeClass('state-on').addClass('state-complete').text('[确认收货]');
	},function(){
		$(this).removeClass('state-complete').addClass('state-on').text('正在发货');
	});
	$('.state-wait').hover(function(){
		$(this).removeClass('state-wait').addClass('state-off').text('[取消兑换]');
	},function(){
		$(this).removeClass('state-off').addClass('state-wait').text('等待发货');
	});
});

function scoreSetState(err, data){
	if(err){
		alert(err);
	}else{
		location.reload();
	}
}

function scoreBeforeSetState(){
	var state=$(this).attr('state');
	if(state==1){
		return confirm('取消兑换礼品只能返还<?=$this->payout * 100?>%积分，你确认要取消兑换嘛？');
	}else if(state==2){
		return confirm('你要确认收货嘛？');
	}
}
</script>
<?php } ?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{
		color:#890e0e;  background-image:url(/oacss/images/bg_61.png); width:88px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:5px;
		}
</style>
</head> 
 
<body>
<div id="mainbody"> 

<div class="pagetop"></div>
<div class="pagemain">
<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
			    <li class="aafbfg"><a href="/index.php/score/dodzyh">电子银行</a></li>
			    <li class="aafbfg"><a href="/index.php/score/dodbqb">夺宝奇兵</a></li>
			    <li class="aafbfg"><a href="/index.php/score/rotate">幸运大转盘</a></li>
            	<li class="fontback"><a href="/index.php/score/goods/current">积分兑换</a></li>
            </ul>
        </div>
    </div>
</div>
    <div class="display biao-cont">
    	<div class="scorelist">
			<?php
                $colors=array('#f00','#224D3C','#384161','#125222','#3A352F','#AE3C15','#1b1b1b');
                if($args[0]) foreach($args[0]['data'] as $var){
            ?>
				<div class="swap">
					<div class="sp-left">
						<div class="goodsimg">
							<div class="zhezhao"></div>
							<div class="sp-xian"></div>
							<img src="/<?=$var['picmax']?>" border="0" width="390" height="145"/>
						</div>
						<div class="goods-right">
							<div class="gs-intro"><span class="spn13"><?=Object::CsubStr($var['content'],0,40)?></span></div>
							<div class="gs-title spn2" style="background:<?=$colors[mt_rand(0, count($colors))]?>;"><?=$var['title']?></div>
							<div class="gs-price spn9">
								<table width="100%">
									<tr>
										<td width="35%">价值</td><td width="40%">积分</td><td width="25%">剩余</td>
									</tr>
									<tr>
										<td>￥<?=$var['price']?></td><td><?=$var['score']?></td><td><?=$this->iff($var['sum']=='0', '不限', $var['sum']-$var['surplus'])?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="sp-right">
						<div class="sp-time"><?=$this->formatGoodTime($var['startTime'], $var['stopTime'])?></div>
						<a class="sp-join sp-join-btn" <?=$this->iff($this->formatGoodTime($var['startTime'], $var['stopTime'])!='已结束','title="点击参与" href="/index.php/score/swap/'.$var['id'].'"','')?> style="display:block;">
							<div class="number spn15"><?=$this->getValue("select count(distinct uid) from {$this->prename}score_swap where goodId=?", $var['id'])?></div>
							<div class="spn14">人参与</div>
						</a>
						<?php
							if($var['state']){
								$state=array('1'=>'state-wait','2'=>'state-on');
						?>
						<a href="/index.php/score/setSwapState/<?=$var['swapId']?>" state="<?=$var['state']?>" target="ajax" onajax="scoreBeforeSetState" call="scoreSetState" class="sp-state <?=$state[$var['state']]?>" style="display:block;"><?=$this->iff($var['state']==1,'等待发货','正在发货')?></a>
						<?php } ?>
					</div>
				</div>
			<?php } $this->display('inc_page.php', 0, $args[0]['total'], $this->pageSize, "/index.php/score/goods-{page}/{$this->scoretype}/{$this->limittype}", 1); ?>

 			</div>
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>