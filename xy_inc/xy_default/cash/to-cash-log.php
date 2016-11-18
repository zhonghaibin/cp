<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 提现记录'); ?>
<script type="text/javascript">
$(function(){
	$('.sure[id]').click(function(){
		var $this=$(this),
		cashId=$this.attr('id'),
		
		call=function(err, data){
			if(err){
				alert(err);
			}else{
				this.parent().text('已到帐');
			}
		}
		
		$.ajax('/index.php/cash/toCashSure/'+cashId,{
			dataType:'json',
			
			error:function(xhr, textStatus, errThrow){
				call.call($this, errThrow||textStatus);
			},
			
			success:function(data, textStatus, xhr){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call($this, decodeURIComponent(errorMessage), data);
				}else{
					call.call($this, null, data);
				}
			}
		});
	});
});
</script>
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
            	<li class="aafbfg"><a href="/index.php/cash/rechargeLog">充值记录</a></li>
                <li class="fontback"><a href="/index.php/cash/toCashLog"><font style="color:#890e0e;">提现记录</font></a></li>
            </ul>
        </div>
    </div>
</div>

	<div class="search">
 	 <form action="/index.php/cash/toCashLog" method="get">
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
                <td>提现金额</td>
                <td>申请时间</td>
                <td>提现银行</td>
                <td>银行尾号</td>
                <td>状态</td>
            </tr>
            </thead>
            <tbody class="table_b_tr">
            <?php
                $sql="select c.*, b.name bankName from {$this->prename}member_cash c, {$this->prename}bank_list b where c.bankId=b.id and uid={$this->user['uid']} and b.isDelete=0 and c.isDelete=0";
                if($_GET['fromTime'] && $_GET['endTime']){
                    $fromTime=strtotime($_GET['fromTime']);
                    $endTime=strtotime($_GET['endTime']);
                    $sql.=" and actionTime between $fromTime and $endTime";
                }elseif($_GET['fromTime']){
                    $sql.=' and actionTime>='.strtotime($_GET['fromTime']);
                }elseif($_GET['endTime']){
                    $sql.=' and actionTime<'.(strtotime($_GET['endTime']));
                }else{
					
					if($GLOBALS['fromTime'] && $GLOBALS['toTime']) $sql.=' and actionTime between '.$GLOBALS['fromTime'].' and '.$GLOBALS['toTime'].' ';
				}
                
                $stateName=array('已到帐', '正在办理', '已取消', '已支付', '失败');
                
                $list=$this->getPage($sql, $this->page, $this->pageSize);
                if($list['data']) foreach($list['data'] as $var){
            ?>
            <tr>
                <td><?=$var['amount']?></td>
                <td><?=date('m-d H:i:s', $var['actionTime'])?></td>
                <td><?=$var['bankName']?></td>
                <td><?=preg_replace('/^.*(.{4})$/', "$1", $var['account'])?></td>
                <td>
                <?php
                    if($var['state']==3){
                        echo '<div class="sure" id="', $var['id'], '"></div>';
                    }else if($var['state']==4){
                        echo '<span title="'.$var['info'].'" style="cursor:pointer; color:#f00;">'.$stateName[$var['state']].'</span>';
                    }else{
                        echo $stateName[$var['state']];
                    }
                ?>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
            $this->display('inc_page.php', 0, $list['total'], $this->pageSize, "/index.php/cash/toCashLog-{page}?fromTime={$_GET['fromTime']}&endTime={$_GET['endTime']}");
        ?>
        <!--下注列表 end -->
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>
  
   
 