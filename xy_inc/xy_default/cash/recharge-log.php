<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 充值记录'); ?>
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:10px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{
		color:#890e0e;  background-image:url(/oacss/images/bg_61.png); width:88px; height:30px;text-align:center; line-height:30px; float:left; background-repeat:no-repeat; margin-left:10px;
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
		<li class="aafbfg"><a href="/index.php/cash/recharge">充值</a></li>
                <li class="aafbfg"><a href="/index.php/cash/toCash">提现</a></li>
            	<li class="fontback"><a href="/index.php/cash/rechargeLog"><font style="color:#890e0e;">充值记录</font></a></li>
                <li class="aafbfg"><a href="/index.php/cash/toCashLog">提现记录</a></li>
            	
            </ul>
        </div>
    </div>
</div>
	<div class="search">
  		<form action="/index.php/cash/rechargeLog" method="get">
  		
           时间：<input type="text" name="fromTime" class="datainput"  value="<?=$this->iff($_REQUEST['fromTime'],$_REQUEST['fromTime'],date('Y-m-d H:i:s',$GLOBALS['fromTime']))?>"/>至<input type="text" name="toTime"  class="datainput" value="<?=$this->iff($_REQUEST['toTime'],$_REQUEST['toTime'],date('Y-m-d H:i:s',$GLOBALS['toTime']))?>"/>
         
      <input type="button" value="查 询" class="btn chazhao">
  </form> 
    </div>
    <div class="display biao-cont">
        <!--下注列表-->
        <table width="100%" class='table_b'>
        <thead>
            <thead>
            <tr class="table_b_th">
                <td>编号</td>
                <td>充值金额</td>
                <td>实际到账</td>
                <td>充值银行</td>
                <td>状态</td>
                <td>成功时间</td>
                <td>备注</td>
            </tr>
            </thead>
            <tbody class="table_b_tr">
            <?php
                $sql="select a.rechargeId,a.amount,a.rechargeAmount,a.info,a.state,a.actionTime,b.name as bankName from {$this->prename}member_recharge a left join {$this->prename}bank_list b on b.id=a.bankId where a.isDelete=0 and a.uid={$this->user['uid']}";
                if($_GET['fromTime'] && $_GET['endTime']){
                    $fromTime=strtotime($_GET['fromTime']);
                    $endTime=strtotime($_GET['endTime']);
                    $sql.=" and a.actionTime between $fromTime and $endTime";
                }elseif($_GET['fromTime']){
                    $sql.=' and a.actionTime>='.strtotime($_GET['fromTime']);
                }elseif($_GET['endTime']){
                    $sql.=' and a.actionTime<'.(strtotime($_GET['endTime']));
                }else{
					
					if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $sql.=' and a.actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
				}
                $sql.=' order by a.id desc';
                
                $pageSize=10;
                
                $list=$this->getPage($sql, $this->page, $pageSize);
                if($list['data']) foreach($list['data'] as $var){
            ?>
            <tr>
                <td><?=$this->ifs($var['rechargeId'], '管理员充值')?></td>
                <td><?=$var['amount']?></td>
                <td><?=$this->iff($var['rechargeAmount']>0, $var['rechargeAmount'], '--')?></td>
                <td><?=$this->iff($var['bankName'], $var['bankName'], '--')?></td>
                <td><?=$this->iff($var['state'], '充值成功', '<span style="color:#653809">正在处理</span>')?></td>
                <td><?=$this->iff($var['state'], date('m-d H:i:s', $var['actionTime']), '--')?></td>
                <td><?=$var['info']?></td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td colspan="7" align="center">没有充值记录</td>
            </tr>
            <?php } ?>
            </tbody>
            
        </table>
        <?php
            $this->display('inc_page.php', 0, $list['total'], $this->pageSize, "/index.php/cash/rechargeLog-{page}?fromTime={$_GET['fromTime']}&endTime={$_GET['endTime']}");
        ?>
        <!--下注列表 end -->
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>
  
   
 