<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 站内公告'); ?>
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
            	<li class="fontback"><a href="/index.php/notice/info"><font style="color:#890e0e;">系统公告</font></a></li>
            </ul>
        </div>
    </div>
</div>
    <div class="display biao-cont">
    
    	 <table width="100%" class='table_b'>
        <thead>
            <thead>
            <tr class="table_b_th">
                <td>编号</td>
                <td>公告标题</td>
                <td>发布时间</td>
            </tr>
            </thead>
            <tbody class="table_b_tr">
           <?php
			$cout=0;
            $styles=array('tr_line_2_a','tr_line_2_b');
            if($args[0]) foreach($args[0]['data'] as $var){
			$cout+=1;
			$mod=$cout%2;
        ?>
            <tr>
            	<td><?=$var['id']?></td>
            	<td class="tl"><a href="/index.php/notice/view/<?=$var['id']?>"  title="<?=$var['title']?>" ><?=$var['title']?></a></td>
            	<td class="tl"><?=date('Y-m-d H:i:s', $var['addTime'])?></td>
            </tr>
            <?php }else{ ?>
            <tr>
                <td colspan="3" align="center">没有记录</td>
            </tr>
            <?php } ?>
            </tbody>
            
        </table>
        <?php $this->display('inc_page.php', 0, $args[0]['total'], $this->pageSize, "/index.php/notice/info-{page}", 0); ?>
    </div>

</div>
<div class="pagebottom"></div>
</div>
<div id="wanjinDialog"></div>
</body>
</html>
  
   
 