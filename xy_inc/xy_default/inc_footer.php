<div style="display:none;">
<div id="footer">
<style>
.about_box{border-top: 1px #CFCFCF solid; margin-top: 10px;}
.about_box .about_left{float: left; padding: 8px 0;}
.about_box .about_left a{margin-right: 3px;}
.about_box .about_left .about_link{margin-bottom: 10px; line-height: 22px; color: #005AA0;}
.about_box .about_left .about_link a{margin:0 5px;}
.about_box .about_left .about_link a:hover{color: #FF0000; text-decoration: none;}
.about_box .about_right{float: left; padding: 15px 0 0 25px;}
.about_box .about_right_passport{float: right; padding: 15px 0 0 0; width: 274px; text-align: right;}
.about_box .about_right p, .foot_box .about_box .about_right_passport p{height: 24px; color: #888888;}
.about_box .about_right a, .foot_box .about_box .about_right_passport a{color: #888888;}
.about_box .about_right a:hover, .foot_box .about_box .about_right_passport a:hover{color: #FF0000; text-decoration: none;}
/* suspend */
.suspend{width:40px;height:198px;position:fixed;top:200px;right:0;overflow:hidden;z-index:9999;}
.suspend dl{width:120px;height:198px;border-radius:25px 0 0 25px;padding-left:40px;box-shadow:0 0 5px #e4e8ec;}
.suspend dl dt{width:40px;height:198px;background:url(http://demo.lanrenzhijia.com/2014/service0823/images/suspend.png);position:absolute;top:0;left:0;cursor:pointer;}
.suspend dl dd.suspendQQ{width:120px;height:85px;background:#ffffff;}
.suspend dl dd.suspendQQ a{width:120px;height:85px;display:block;background:url(http://demo.lanrenzhijia.com/2014/service0823/images/suspend.png) -40px 0;overflow:hidden;}
.suspend dl dd.suspendTel{width:120px;height:112px;background:#ffffff;border-top:1px solid #e4e8ec;}
.suspend dl dd.suspendTel a{width:120px;height:112px;display:block;background:url(http://<?=$_SERVER['HTTP_HOST']?>/images/common/kf.png) -40px -86px;overflow:hidden;}
* html .suspend{position:absolute;left:expression(eval(document.documentElement.scrollRight));top:expression(eval(document.documentElement.scrollTop+200))}
</style>
    <!--p>Copyright &copy;&nbsp;2010-2014 FUN时时彩平台</p>
    <p>强烈建议：本系统使用IE8以上内核浏览器效果最佳</p-->
	 <div class="about_box">
    <div style="about_left">
        <p>
            <a target="_blank" href="/"><img src="http://static.lecai.com/img/about/police.gif"/></a>
            <a target="_blank" href="/"><img src="http://static.lecai.com/img/about/beian.gif"/></a>
            <a target="_blank" href="/"><img src="http://static.lecai.com/img/about/kexin.gif"/></a>
        </p>
    </div>
</div>
<div class="about_right">
        <p>2009-2014 &copy; <a target="_blank" href="/">FUN</a> 京ICP备19562186号 京公网安备110106327435号</p>
        <p>提醒：购买彩票有风险，在线投注需谨慎，不向未满18周岁的青少年出售彩票！</p>
</div>
    <div class="clear"></div>
</div>
<div id="wanjinDialog"></div>

<div class="suspend">
	<dl>
		<dt class="IE6PNG"></dt>
		<dd class="suspendQQ"><a target="_blank" href="http://bizapp.qq.com/webc.htm?new=0&sid=113438373&eid=&o=im.qq.com&q=7"></a></dd>
		<dd class="suspendTel"><a href="javascript:void(0);"></a></dd>
	</dl>
</div>
</div>
<script type="text/javascript">           
$(function(){
	$(".suspend").mouseover(function() {
        $(this).stop();
        $(this).animate({width: 160}, 220);
    });
    $(".suspend").mouseout(function() {
        $(this).stop();
        $(this).animate({width: 40}, 220);
    });
});
</script>