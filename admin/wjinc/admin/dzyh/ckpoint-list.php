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
		$timeWhere="and s.time between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and s.time>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and s.time<$fromTime";
	}

	//存款金额限制
	if($_REQUEST['ck_money']!=0){
		$_REQUEST['ck_money']=intval($_REQUEST['ck_money']);
		    if($_REQUEST['ck_money']==1){  //存款金额从小到大
		       $ck_moneyWhere=" order by s.ck_money";
			}else if($_REQUEST['ck_money']==2){   //存款金额从大到小
				$ck_moneyWhere=" order by s.ck_money DESC";
			}
	}else{
		$ck_moneyWhere=" order by s.id desc ";
	}

	//存款状态限制
	if($_REQUEST['enable']!=0){
		$_REQUEST['enable']=intval($_REQUEST['enable']);
		    if($_REQUEST['enable']==1){  //存款状态正常
		       $enableWhere=" and s.enable=0";
			}else if($_REQUEST['enable']==2){   //存款已冻结
				$enableWhere=" and s.enable=1";
			}
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
	$sql="select s.*,u.username userName from {$this->prename}dzyh_ck_swap s, {$this->prename}members u where s.uid=u.uid and s.isdelete=0 and s.state=0 $userWhere $timeWhere $enableWhere $ck_moneyWhere";
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
function indexdzyhedited(err, data){
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
    	<h3 class="tabs_involved">存款记录
            <div class="submit_link wz">
            	<form action="/admin778899.php/dzyh/ckpointList" target="ajax" call="defaultSearch" dataType="html">
                会员：<input name="username" type="text" style="width:80px;" value="用户名"/>&nbsp;&nbsp;
                时间：从 <input type="date" style="width:75px;" name="fromTime"/> 到 <input type="date" style="width:75px;" name="toTime"/>&nbsp;&nbsp;存款金额:
				<select style="width:80px;" name="ck_money">
					<option value="0"></option>
					<option value="1">从小到大</option>
					<option value="2">从大到小</option>
				</select>&nbsp;&nbsp;已存时间:
				<select style="width:80px;" name="time">
					<option value="0"></option>
					<option value="1">从小到大</option>
					<option value="2">从大到小</option>
				</select>&nbsp;&nbsp;状态
				<select style="width:60px;" name="enable">
					<option value="0"></option>
					<option value="1">正常</option>
					<option value="2">已冻结</option>
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
			<th>存款人</th> 
			<th>存款金额</th>
			<th></th>
			<th>已存时间</th>
			<th></th>
			<th>当前日利率</th>
			<th></th>
			<th>利息金额</th>
			<th>本息总额</th>
			<th>存入时间</th>
			<th>存款人ip</th>
			<th>存款状态</th>
			<th>操作</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php if($data['data']) foreach($data['data'] as $var){
		         $ckdate1=$this->dzyhsettings['ckdate1']*24;$cklv1=$this->dzyhsettings['cklv1'];
				 $ckdate2=$this->dzyhsettings['ckdate2']*24;$cklv2=$this->dzyhsettings['cklv2'];
				 $ckdate3=$this->dzyhsettings['ckdate3']*24;$cklv3=$this->dzyhsettings['cklv3'];
				 $ckdate4=$this->dzyhsettings['ckdate4']*24*30;$cklv4=$this->dzyhsettings['cklv4'];
				 $ckdate5=$this->dzyhsettings['ckdate5']*24*30*12;$cklv5=$this->dzyhsettings['cklv5'];

			     $cktime=array($ckdate1,$ckdate2,$ckdate3,$ckdate4,$ckdate5);sort($cktime);
				 $cklv=array($cklv1,$cklv2,$cklv3,$cklv4,$cklv5);sort($cklv);
                  
				 $time=($this->time-$var['time'])/3600;
				 if($time<$this->dzyhsettings['ckzdsj']){
					 $lv=0;$lx=0;
				 }else if($time>$this->dzyhsettings['ckzdsj'] && $time>=$cktime[0] && $time<$cktime[1]){
					 $lv=$cklv[0];$lx=$var['ck_money']*$cklv[0]/100*$cktime[0]/24;
				 }else if($time>=$cktime[1] && $time<$cktime[2]){
					 $lv=$cklv[1];$lx=$var['ck_money']*$cklv[1]/100*$cktime[1]/24;
				 }else if($time>=$cktime[2] && $time<$cktime[3]){
					 $lv=$cklv[2];$lx=$var['ck_money']*$cklv[2]/100*$cktime[2]/24;
				 }else if($time>=$cktime[3] && $time<$cktime[4]){
					 $lv=$cklv[3];$lx=$var['ck_money']*$cklv[3]/100*$cktime[3]/24;
				 }else if($time>=$cktime[4]){
					 $lv=$cklv[4];$lx=$var['ck_money']*$cklv[4]/100*$cktime[4]/24;
				 }
		?>
		<tr> 
			<td><?=$var['id']?></td>
			<th><?=$var['uid']?></th>
			<td><?=$var['username']?></td> 
			<td><span style="color:blue"><?=$var['ck_money']?>&nbsp元</span></td>
			<td><span style="color:blue">x</span></td>
			<td><span style="color:blue"><?php if($time<24){echo intval($time) ."&nbsp小时";}else if($time>=24 && $time<30*24){echo intval($time/24) ."&nbsp天";}else if($time>=30*24 && $time<30*24*12){echo intval($time/24/30) ."&nbsp月";}else if($time>=30*24*12){echo intval($time/30/24/12) ."&nbsp年";}?></span></td>
			<td><span style="color:blue">x</span></td>
			<td><span style="color:blue"><?=$lv?>%</span></td>
			<td><span style="color:blue">=</span></td>
			<td><span style="color:blue"><?=$lx?>元</span></td>
			<td><span style="color:red"><?=$lx+$var['ck_money']?>元</span></td>
			<td><?=date('Y-m-d H:i:s',$var['time'])?></td>
			<td><?=long2ip($var['ip'])?></td>
			<td><?=$this->iff($var['enable'],"<span style='color:red'>已冻结</span>","<span style='color:#090'>正常</span>")?></td>
			<td><a href="/admin778899.php/dzyh/dzyhpointedit/<?=$var['id']?>" method="post" width="400" class="myanswer" target="modal" title="存款编辑" modal="true" call="pointHandle" dataType="json">编辑</a>|
			    <?if(!$this->getValue("select enable from {$this->prename}Dzyh_ck_swap where id={$var['id']}")){?>
			    <a href="/admin778899.php/dzyh/dzyhpointdj/<?=$var['id']?>" method="post" target="ajax" call="pointHandle" title="冻结存款后用户无法取出，是否继续？" dataType="json">冻结</a></td>
				<?}else{?>
				<a href="/admin778899.php/dzyh/dzyhpointjd/<?=$var['id']?>" method="post" target="ajax" call="pointHandle" title="即将解冻该笔春款，是否继续？" dataType="json">解冻</a></td>
				<?}?>
		</tr>
		<?php }else{ ?>
			<tr>
				<td colspan="12">暂无存款记录</td>
			</tr>
		<?php } ?>
	</tbody> 
    </table>
	<footer>
	<?php
		$rel=get_class($this).'/ckpointList-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
    </div>
</article>
