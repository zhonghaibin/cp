<?php

$id=array('1','3','5','12','14','26','16','6','15','7','9','10','20');
$pgsid=array('30','50','80','100','120','');
include(dirname(__FILE__)."/inc/comfunc.php");
//此处设置彩种id
$typeid=intval($_GET['typeid']);
if(!in_array($typeid,$id)) die("typeid error");
if(!$typeid) $typeid=14;
//每页默认显示
$pgs=intval($_GET['pgs']);
if(!in_array($pgs,$pgsid)) die("pgs error");
if(!$pgs) $pgs=30;
//当前页面
$page=intval($_GET['page']);
if(!$page) $page=1;
//传参
$toUrl="?page=";
$params=http_build_query($_REQUEST, '', '&');
if(!$mydb) $mydb = new MYSQL($dbconf);

$gRs = $mydb->row($conf['db']['prename']."type","shortName","id=".$typeid);
if($gRs){
	$shortName=$gRs[0][0];
}

$fromTime=$_GET['fromTime'];
$toTime=$_GET['toTime'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<title><?=$shortName?>走势分析图</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/line.css"  rel="stylesheet" type="text/css">
<link href="js/jqueryui/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
</head>
<body style="background:none;">
<div id="header">
    <div id="header-inner">
        <div class="logo"><?=$shortName?>走势分析图</div>
    </div>
    
</div>
<div id="content">
<div class="search">
<b class="b5"></b>
<b class="b6"></b>
<b class="b7"></b>
<b class="b8"></b>
<table width="100%" id="titlemessage" border="0" cellpadding="0" cellspacing="0" style="background:#DDE0E5;">
	<tbody><tr>
		<td><b><span class="redtext"><?=$shortName?>基本走势</span></b></td>
		<td>
			<a href="?typeid=<?=$typeid?>&pgs=30" class="ml10<?php if($pgs==30) echo ' on'?>" target="_self">最近30期</a>
			<a href="?typeid=<?=$typeid?>&pgs=50" class="ml10<?php if($pgs==50) echo ' on'?>" target="_self">最近50期</a>
            <a href="?typeid=<?=$typeid?>&pgs=80" class="ml10<?php if($pgs==80) echo ' on'?>" target="_self">最近80期</a>
			<a href="?typeid=<?=$typeid?>&pgs=100" class="ml10<?php if($pgs==100) echo ' on'?>" target="_self">最近100期</a>
            <a href="?typeid=<?=$typeid?>&pgs=120" class="ml10<?php if($pgs==120) echo ' on'?>" target="_self">最近120期</a>
		</td>
		<td>
        <form action="" method="get">
        	<input type="hidden" name="typeid" value="<?=$typeid?>" />
            <input type="hidden" name="pgs" value="<?=$pgs?>" />
            <input type="text" value="<?=$fromTime?>" class="datetxt" name="fromTime" id="fromTime" style="width:80px;">
            <img src="images/date.png" style="vertical-align:middle;">
            至
            <input type="text" value="<?=$toTime?>" class="datetxt" name="toTime" id="toTime" style="width:80px;">
            <img src="images/date.png" style="vertical-align:middle;">
            <input type="submit" value="查询" id="showissue1">
        </form>
		</td>
	</tr>

</tbody></table>
<b class="b8"></b>
<b class="b7"></b>
<b class="b6"></b>
<b class="b5"></b>
</div>
<table height="5"><tbody><tr><td></td></tr></tbody></table>
<table align="center">
	 <tbody><tr>
        <td colspan="3" style="border:0px;">
			标注形式选择&nbsp;<input type="checkbox" name="checkbox2" value="checkbox" id="has_line">
            <span><b><label for="has_line">显示走势折线</label></b></span>&nbsp;
            <span>
            <label for="no_miss">
                <input type="checkbox" name="checkbox" value="checkbox" id="no_miss">不带遗漏
            </label>
            </span>
        </td>
      </tr>
</tbody></table>
<table height="5"><tbody><tr><td></td></tr></tbody></table>
<div style="position: relative; height: 756px;" id="container">
<table id="chartsTable" width="100%" cellpadding="0" cellspacing="0" border="0" style="position:absolute; top:0; left:0;">
      <tbody><tr id="title">
             <td rowspan="2"><strong>期号</strong></td>
             <td rowspan="2" colspan="5" class="redtext"><strong>开奖号码</strong></td>
                          <td colspan="10"><strong>万位</strong></td>
                          <td colspan="10"><strong>千位</strong></td>
                          <td colspan="10"><strong>百位</strong></td>
                          <td colspan="10"><strong>十位</strong></td>
                          <td colspan="10"><strong>个位</strong></td>
                 </tr>
                    <tr id="head">
                        <td class="wdh" align="center"><strong>0</strong></td>
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
                        <td class="wdh" align="center"><strong>0</strong></td>
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
                        <td class="wdh" align="center"><strong>0</strong></td>
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
                        <td class="wdh" align="center"><strong>0</strong></td>
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
                        <td class="wdh" align="center"><strong>0</strong></td>
                        <td class="wdh" align="center"><strong>1</strong></td>
                        <td class="wdh" align="center"><strong>2</strong></td>
                        <td class="wdh" align="center"><strong>3</strong></td>
                        <td class="wdh" align="center"><strong>4</strong></td>
                        <td class="wdh" align="center"><strong>5</strong></td>
                        <td class="wdh" align="center"><strong>6</strong></td>
                        <td class="wdh" align="center"><strong>7</strong></td>
                        <td class="wdh" align="center"><strong>8</strong></td>
                        <td class="wdh" align="center"><strong>9</strong></td>
                    </tr>
          		<?php
				if($fromTime) $fromTime=strtotime($fromTime);
				if($toTime) $toTime=strtotime($toTime)+24*3600;
				
				$pg=trim($_REQUEST["page"]);
				if(!$pg){$pg=1;}
				if(!$pgs){$pgs=30;}
				$tableStr=$conf['db']['prename']."data";
				$tableStr2=$conf['db']['prename']."data a";
				$fieldsStr="time, number, data";
				
				$fieldsStr2="a.time, a.number, a.data";
				$whereStr=" type=$typeid ";
				$whereStr2=" a.type=$typeid ";
				if($fromTime && $toTime){
					$whereStr.=" and time between $fromTime and $toTime";
					$whereStr2.=" and a.time between $fromTime and $toTime";
				}elseif($fromTime){
					$whereStr.=' and time>='.$fromTime;
					$whereStr2.=' and a.time>='.$fromTime;
				}elseif($toTime){
					$whereStr.=' and time<'.$toTime;
					$whereStr2.=' and a.time<'.$toTime;
				}else{}
				$orderStr=" order by a.number desc,a.time desc";
	
				$totalNumber = $mydb->row_count($tableStr,$whereStr);

				if ($totalNumber>0){
			 
                $countcount=0;
				$perNumber=$pgs; //每页显示的记录数
				$page=$pg; //获得当前的页面值
				if (!isset($page)) $page=1;
				
				$totalPage=ceil($totalNumber/$perNumber); //计算出总页数
				$startCount=($page-1)*$perNumber; //分页开始,根据此方法计算出开始的记录
				$data = $mydb->row($tableStr2,$fieldsStr2,$whereStr2.' '.$orderStr." limit $startCount,$perNumber");
				
				if($data) foreach($data as $var){
					
				$dArry=explode(",",$var[2]);
				$var['d1']=$dArry[0];
				$var['d2']=$dArry[1];
				$var['d3']=$dArry[2];
				$var['d4']=$dArry[3];
				$var['d5']=$dArry[4];
				
				echo '<tr>';
				echo '<td id="title">'.$var[1].'</td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d1'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d3'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
				echo '<td class="wdh" align="center"><div class="ball02">'.$var['d5'].'</div></td>';
	
				for($i=0;$i<10;$i++) //万位
				{
					if($i==intval($var['d1'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d1'].'</div></td>';
						$five['LW'.$i]=0;  //遗漏
						if($five['SW'.$i]){$five['SW'.$i]++;}else{$five['SW'.$i]=1;} //出现总次数
						if($five['LCW'.$i]){$five['LCW'.$i]++;}else{$five['LCW'.$i]=1;} //最大连出值
					}else{
						if($five['LW'.$i]){$five['LW'.$i]++;}else{$five['LW'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LW'.$i].'</div></td>';
						$five['LCW'.$i]=0;
					}
					//遗漏总计
					if($five['ZW'.$i]){$five['ZW'.$i]+=$five['LW'.$i];}else{$five['ZW'.$i]=$five['LW'.$i];}
					//最大遗漏值
					if($five['MW'.$i]<$five['LW'.$i]){$five['MW'.$i]=$five['LW'.$i];}
					//最大连出值
					if($five['MLCW'.$i]<$five['LCW'.$i]){$five['MLCW'.$i]=$five['LCW'.$i];}
					
				}
				
				for($i=0;$i<10;$i++) //千位
				{
					if($i==intval($var['d2'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d2'].'</div></td>';
						$five['LQ'.$i]=0;
						if($five['SQ'.$i]){$five['SQ'.$i]++;}else{$five['SQ'.$i]=1;}
						if($five['LCQ'.$i]){$five['LCQ'.$i]++;}else{$five['LCQ'.$i]=1;}
					}else{
						if($five['LQ'.$i]){$five['LQ'.$i]++;}else{$five['LQ'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LQ'.$i].'</div></td>';
						$five['LCQ'.$i]=0;
					}
					if($five['ZQ'.$i]){$five['ZQ'.$i]+=$five['LQ'.$i];}else{$five['ZQ'.$i]=$five['LQ'.$i];}
					if($five['MQ'.$i]<$five['LQ'.$i]){$five['MQ'.$i]=$five['LQ'.$i];}
					if($five['MLCQ'.$i]<$five['LCQ'.$i]){$five['MLCQ'.$i]=$five['LCQ'.$i];}
		
				}
				for($i=0;$i<10;$i++) //百位
				{
					if($i==intval($var['d3'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d3'].'</div></td>';
						$five['LB'.$i]=0;
						if($five['SB'.$i]){$five['SB'.$i]++;}else{$five['SB'.$i]=1;}
						if($five['LCB'.$i]){$five['LCB'.$i]++;}else{$five['LCB'.$i]=1;}
					}else{
						if($five['LB'.$i]){$five['LB'.$i]++;}else{$five['LB'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LB'.$i].'</div></td>';
						$five['LCB'.$i]=0;
					}
					if($five['ZB'.$i]){$five['ZB'.$i]+=$five['LB'.$i];}else{$five['ZB'.$i]=$five['LB'.$i];}
					if($five['MB'.$i]<$five['LB'.$i]){$five['MB'.$i]=$five['LB'.$i];}
					if($five['MLCB'.$i]<$five['LCB'.$i]){$five['MLCB'.$i]=$five['LCB'.$i];}
				
				}

				for($i=0;$i<10;$i++) //十位
				{
					if($i==intval($var['d4'])){
						echo '<td class="charball" align="center"><div class="ball02">'.$var['d4'].'</div></td>';
						$five['LS'.$i]=0;
						if($five['SS'.$i]){$five['SS'.$i]++;}else{$five['SS'.$i]=1;}
						if($five['LCS'.$i]){$five['LCS'.$i]++;}else{$five['LCS'.$i]=1;}
					}else{
						if($five['LS'.$i]){$five['LS'.$i]++;}else{$five['LS'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball04">'.$five['LS'.$i].'</div></td>';
						$five['LCS'.$i]=0;
					}
					if($five['ZS'.$i]){$five['ZS'.$i]+=$five['LS'.$i];}else{$five['ZS'.$i]=$five['LS'.$i];}
					if($five['MS'.$i]<$five['LS'.$i]){$five['MS'.$i]=$five['LS'.$i];}
					if($five['MLCS'.$i]<$five['LCS'.$i]){$five['MLCS'.$i]=$five['LCS'.$i];}
			
				}
				
				for($i=0;$i<10;$i++)  //个位
				{
					if($i==intval($var['d5'])){
						echo '<td class="charball" align="center"><div class="ball01">'.$var['d5'].'</div></td>';
						$five['LG'.$i]=0;
						if($five['SG'.$i]){$five['SG'.$i]++;}else{$five['SG'.$i]=1;}
						if($five['LCG'.$i]){$five['LCG'.$i]++;}else{$five['LCG'.$i]=1;}
					}else{
						if($five['LG'.$i]){$five['LG'.$i]++;}else{$five['LG'.$i]=1;}
						echo '<td class="wdh" align="center"><div class="ball03">'.$five['LG'.$i].'</div></td>';
						$five['LCG'.$i]=0;
					}
					if($five['ZG'.$i]){$five['ZG'.$i]+=$five['LG'.$i];}else{$five['ZG'.$i]=$five['LG'.$i];}
					if($five['MG'.$i]<$five['LG'.$i]){$five['MG'.$i]=$five['LG'.$i];}
					if($five['MLCG'.$i]<$five['LCG'.$i]){$five['MLCG'.$i]=$five['LCG'.$i];}
				}
			
			echo '</tr>';	
			
            } 
			
			
		?>                          
    <tr>
    <td nowrap="">出现总次数</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=0;$i<10;$i++)
		{
			if($five['S'.$var.$i]){
				$five['D'.$var.$i]=$five['S'.$var.$i];
			}else{
				$five['D'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['D'.$var.$i].'</td>';
		}
	}
	?>  
    </tr>
    <tr>
    <td nowrap="">平均遗漏值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=0;$i<10;$i++)
		{
			$five['P'.$var.$i]=intval($pgs/($five['D'.$var.$i]+1));
			echo '<td align="center">'.$five['P'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大遗漏值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=0;$i<10;$i++)
		{
			if($five['M'.$var.$i]){
				$five['Max'.$var.$i]=$five['M'.$var.$i];
			}else{
				$five['Max'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['Max'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr>
    <td nowrap>最大连出值</td>
    <td align="center" colspan="5">&nbsp;</td>
    <?php 
	foreach(array('W','Q','B','S','G') as $var){
		for($i=0;$i<10;$i++)
		{
			if($five['MLC'.$var.$i]){
				$five['MaxLC'.$var.$i]=$five['MLC'.$var.$i];
			}else{
				$five['MaxLC'.$var.$i]=0;
			}
			echo '<td align="center">'.$five['MaxLC'.$var.$i].'</td>';
		}
	}
	?>
    </tr>
    <tr id="head">
        <td rowspan="2" align="center"><strong>期号</strong></td>
        <td rowspan="2" align="center" colspan="5"><strong>开奖号码</strong></td>
        <td align="center"><strong>0</strong></td>
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
        <td align="center"><strong>0</strong></td>
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
        <td align="center"><strong>0</strong></td>
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
        <td align="center"><strong>0</strong></td>
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
        <td align="center"><strong>0</strong></td>
        <td align="center"><strong>1</strong></td>
        <td align="center"><strong>2</strong></td>
        <td align="center"><strong>3</strong></td>
        <td align="center"><strong>4</strong></td>
        <td align="center"><strong>5</strong></td>
        <td align="center"><strong>6</strong></td>
        <td align="center"><strong>7</strong></td>
        <td align="center"><strong>8</strong></td>
        <td align="center"><strong>9</strong></td>
    </tr>
    <tr id="title">
      <td colspan="10"><strong>万位</strong></td>
      <td colspan="10"><strong>千位</strong></td>
      <td colspan="10"><strong>百位</strong></td>
      <td colspan="10"><strong>十位</strong></td>
      <td colspan="10"><strong>个位</strong></td>
    </tr>
    <?php	  
			  
		}
	?>
</tbody></table>
</div>

<dl class="tips">
    <dt>图表参数说明</dt>
　　<dd>出现总次数：统计期数内实际出现的次数。</dd>
　　<dd>平均遗漏值：统计期数内遗漏的平均值。（计算公式：平均遗漏＝统计期数/(出现次数+1)。）</dd>
　　<dd>最大遗漏值：统计期数内遗漏的最大值。</dd>
　　<dd>最大连出值：统计期数内连续开出的最大值。</dd>
</dl>
</div>
<!--<div id="footer">Copyright © 娱乐</div>-->
<script language="javascript" type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script language="javascript" type="text/javascript" src="js/line.js"></script>
<script language="javascript" type="text/javascript" src="js/jqueryui/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script language="javascript">
fw.onReady(function(){
	Chart.init();	
	DrawLine.bind("chartsTable","has_line");
	DrawLine.color('#499495');
	DrawLine.add((parseInt(0)*10+5+1),2,10,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(1)*10+5+1),2,10,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(2)*10+5+1),2,10,0);
	DrawLine.color('#E4A8A8');
	DrawLine.add((parseInt(3)*10+5+1),2,10,0);
	DrawLine.color('#499495');
	DrawLine.add((parseInt(4)*10+5+1),2,10,0);
	DrawLine.draw(Chart.ini.default_has_line);
	if($("#chartsTable").width()>$('body').width())
	{
	   $('body').width($("#chartsTable").width() + "px");
	}
	$("#container").height($("#chartsTable").height() + "px");
    resize();

	var nols = $(".ball04,.ball03");
	$("#no_miss").click(function(){
		
		var checked = $(this).attr("checked");
		$.each(nols,function(i,n){
			if(checked==true || checked=='checked'){
				n.style.display='none';
			}else{
				n.style.display='block';
			}
		});
	});
});
function resize(){
    window.onresize = func;
    function func(){
        window.location.href=window.location.href;
    }
}
$(function(){
	$(".datetxt").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText);} });	
})
</script>
</body>
</html>