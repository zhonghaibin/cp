<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '活动中心'); ?>
<link href="/skin/css/dzp.css" rel="stylesheet" type="text/css">
<style>
	.dh_68_1 ul{ margin:0px; padding:0px; list-style-type:none; font-size:12px; color:#5c5c5c; font-weight:bold; }
	.dh_68_1 ul li a{width:88px; height:30px; display:block; text-decoration:none; color:#5c5c5c;}
	.dh_68_1 ul li a:hover{width:88px; height:30px; display:block; text-decoration:none;}
	.aafbfg{ float:left; width:88px; height:30px; background-image:url(/oacss/images/bg681.png); margin-left:5px; background-repeat:no-repeat; text-align:center; line-height:30px;}
	.fontback{float:left;color:#890e0e;width:88px;height:30px;background-image:url(/oacss/images/bg_61.png);margin-left:5px;text-align:center; line-height:30px;background-repeat:no-repeat;}
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
			    <li class="fontback"><a href="/index.php/score/rotate">幸运大转盘</a></li>
            	<li class="aafbfg"><a href="/index.php/score/goods/current">积分兑换</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
    <!--main content start-->
    <div style="width:880px; margin:0 auto; overflow:hidden;">
    <div class="con_chouj">
        <div class="con_width chouj_content clearfix" id="lottery_content_box">
            <div class="chou_box" id="start"><div class="cj_zhuan" id="startbtn" tit="使用 <?=$this->dzpsettings['score']?> 积分兑换一次抽奖，是否确定继续抽奖？"></div></div>
            <div class="win_open">
                     <!-- 中奖列表begin -->
                    <div class="win_box">
                        <h2 class="win_tit">最新中奖名单</h2>
                        <div class="win_cont">
                            <div class="win_scroll" id="lottery_list_container_0">
                                <div class="win_height">
                                 <div style="overflow: hidden; position: relative; height: 330px;" id="lottery_list_container_1">
                                   <ul style="position: absolute; margin: 0px; padding: 0px; top: -20.2878px;" class="win_list" id="lottery_list_container">
								   <?php 
								         $data=$this->getRows("select s.*,u.username from {$this->prename}dzp_swap s, {$this->prename}members u where s.uid=u.uid order by s.swapTime desc");
										 foreach($data as $var){
                                            echo '<li style="margin: 0px; padding: 0px;"><span>恭喜用户【'.preg_replace('/^(\w{2}).*(\w{2})$/','\1***\2',htmlspecialchars($var['username'])).'】</span>，喜中<em>'.$var['coin'].'元现金</em></li>';
								         }
								   ?>
								   </ul>
                                  </div>
                                    <div id="lottery_list_container_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 中奖列表end -->
					<div class="win_caption">
 	               <h3 style="font-size:15px">&nbsp&nbsp抽奖活动说明：</h3>
                     <ul>
                        <span class="scoreinfo"><?php $this->display('score/reloadscore.php');?></span>
                        <li>3、积分不足不能参与抽奖活动，抽奖次数不限；</li>
                        <li>4、抽到非现金奖项的请直接联系客服进行处理；</li>
                        <li>5、抽到实物，请与客服联系提供收货地址，我们将以邮寄的方</li>
						<li>&nbsp&nbsp&nbsp&nbsp&nbsp式将实物邮寄到您手上。</li>
                   </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--main content end-->
<div id="wanjinDialog"></div>

<script type="text/javascript" src="/skin/js/jQueryRotate.2.2.js"></script>
<script type="text/javascript" src="/skin/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="/skin/js/jquery.vticker.js"></script>
<script type="text/javascript">
$(function(){ 
     $("#startbtn").live("click",function(){ 
	    var title=$(this).attr("tit");
		if(confirm(title)){ 
			lottery(); 
		}
    }); 
	$('#lottery_list_container_1').vTicker({
		speed:1000, 
		pause:0,
		showItems:8,
		animation:'fade',
		mousePause:true,
		height:330,
		direction:'up' 
    });
}); 
function lottery(){ 
    $.ajax({ 
        type: 'POST', 
        url: '/index.php/score/rotateEvent', 
        dataType: 'json', 
        cache: false, 
        error: function(){ 
            alert('出错了！'); 
        }, 
        success:function(json){
			$('.scoreinfo').load('/index.php/score/scoreInfo');
            $("#startbtn").unbind('click').css("cursor","default");
            var a = json.angle; //角度
            var p = json.prize; //奖项 
			if(parseInt(a)==0){
				alert(p);
			}else{
            $("#startbtn").rotate({ 
                duration:3000, //转动时间 
                angle: 0, 
                animateTo:1800+a, //转动角度 
                easing: $.easing.easeOutSine, 
                callback: function(){ 
					if(p=='谢谢参与' || p=='再接再厉'){
						alert(p+'！'); 
					}else if(p=='再来一次'){
						if(confirm('再来一次！')){ 
							lottery(); 
						}else{ 
							//return false; 
						} 
					}else{
						alert('恭喜你，中得'+p+'！'); 
						parent.reloadMemberInfo();
					}
                } 
            });
		   }
        } 
    });
} 
</script>
</body></html>