<?php
    @session_start();
	if($this->type==34){
	$mode=1.00;
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time;
	}else{
	$lastNo=$this->getGameLastNo($this->type);
	$kjHao=$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
	if($kjHao) $kjHao=explode(',', $kjHao);
	$actionNo=$this->getGameNo($this->type);
	$types=$this->getTypes();
	$kjdTime=$types[$this->type]['data_ftime'];
	$diffTime=strtotime($actionNo['actionTime'])-$this->time-$kjdTime;
	$kjDiffTime=strtotime($lastNo['actionTime'])-$this->time;
	}
?>  
    <!--div-->
    <div class="bd" id="kaijiang" type="<?=$this->type?>" ctype="<?=$types[$this->type]['type']?>" style="margin-top:-20px;">
      <table width="920px" cellpadding="0" cellspacing="0" border="0" class="game_top_area">
        <tr valign="top">
          <td class="game_top_aleft">
          <ul>
              <li class="ni kj-title" style="text-align:center;"><p class="i2">&nbsp第 <span class="i1" style="color:;"><?=$actionNo['actionNo']?></span> 期</p></li>
			  <li class="tb"><span class="i2" action="/index.php/display/freshKanJiang/<?=$this->type?>" id="pre-kanjiang">00:00:00</span></li>
			  <li class="tb"><span style="color:red;"><a  target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/zst/index.php?typeid=<?=$this->type?>" style="color:#CD6600;text-decoration:none;cursor:hand;font-size:13px;text-align:center;font-family:'微软雅黑',Arial;">号码分布</a> -- <a  target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/zst/index.php?typeid=<?=$this->type?>" style="color:#8B1A1A;text-decoration:none;cursor:hand;font-size:13px;text-align:center;font-family:'微软雅黑',Arial;">遗漏分析</a></span></li>
	    </ul>
	  </td>
     <?php if($types[$this->type]['type']==3) { //3D?>
      <td width="440" class="game_top_aright"> 
	    <div class="kj-bottom"><span class="tit" style="padding: 0px 70px;"><span class='gamename' style="color:#e4ff00;font-size:12px"><?=$types[$this->type]['title']?></span>&nbsp;&nbsp;第 <span class="last_issues"  style="color:#e4ff00;font-size:12px"><b><?=$lastNo['actionNo']?></b></span> 期 <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><span id="lockgame"></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()"><span id="lockgame"></span><div class="clear"></div></div>   
            <div class="grid_code_tl wjkjData" >
              	<p class="hide"><img src="/images/common/kjts.png" /></p>
              	<ul class="kj-hao" ctype="g0"  cnum="10" style="margin-left:90px;">
                    <li id="span_lot_0" class="gr_s gr_s<?=$kjHao[0]?>"> </li>
                    <li id="span_lot_1" class="gr_s gr_s<?=$kjHao[1]?>"> </li>
                    <li id="span_lot_2" class="gr_s gr_s<?=$kjHao[2]?>"> </li>
                  </ul>
              <div class="clear"></div>
           </div>
       </td> 
       <td class="game_top_period" width='200' >
	    <div style='padding:3px 5px' id='historylot'>
           <?php $this->display('index/inc_data_iframe.php');?>
        </div>
	  </td>
	  <?php }else if($types[$this->type]['type']==11) { //六合彩?>
	  <td width="390" class="game_top_aright">
	  <div class="kj-bottom"><span class="tit" style="padding: 0px 0px 0px 10px;"><span class='gamename' style="color:#e4ff00;font-size:12px"><?=$types[$this->type]['title']?></span>&nbsp;&nbsp;第 <span class="last_issues"  style="color:#e4ff00;font-size:12px"><b><?=$lastNo['actionNo']?></b></span> 期 <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><span id="lockgame"></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()"><span id="lockgame"></span><div class="clear"></div></div>   
            <div class="grid_code_tl wjkjData" >
              	<p class="hide"><img src="/images/common/kjts.png" /></p>
              	<ul class="kj-hao hao-qx" ctype="lhc"  cnum="10" style="margin-left:50px;margin-top:10px">
	               <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[0],$kjHao[0],'no')?>.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[1],$kjHao[1],'no')?>.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[2],$kjHao[2],'no')?>.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[3],$kjHao[3],'no')?>.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[4],$kjHao[4],'no')?>.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[5],$kjHao[5],'no')?>.gif" /></li>
				   <li><img src="/skin/main/images/lhc/number/te.gif" /></li>
                   <li><img src="/skin/main/images/lhc/number/<?=$this->iff($kjHao[6],$kjHao[6],'no')?>.gif" /></li>
                </ul>
     <div class="clear"></div>
           </div>
       </td> 
       <td class="game_top_period" width='200' >
	    <div style='padding:3px 3px' id='historylot'>
           <?php $this->display('index/inc_data_iframe_lhc.php');?>
        </div>
	  </td>
	  <?php }else if($types[$this->type]['type']==6) { //PK10?>
       <td width="400" class="game_top_aright"> 
	    <div class="kj-bottom"><span class="tit"><span class='gamename' style="color:#e4ff00;font-size:12px"><?=$types[$this->type]['title']?></span>&nbsp;&nbsp;第 <span class="last_issues" style="color:#e4ff00;font-size:12px"><b><?=$lastNo['actionNo']?></b></span> 期 <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><span id="lockgame"></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()"><span id="lockgame"></span><div class="clear"></div></div>
          <div class="wjkjData" style="height:30px;padding-top:30px;padding-left: 15px;">
          	<p class="hide" style="margin-top:-30px"><img src="/images/common/kjts.png" /></p>
				<ul class="kj-hao" ctype="pk10">
                <li class="ball2 ball_01"><?=$kjHao[0]?> </li>
                <li class="ball2 ball_02"><?=$kjHao[1]?> </li>
                <li class="ball2 ball_03"><?=$kjHao[2]?> </li>
                <li class="ball2 ball_04"><?=$kjHao[3]?> </li>
                <li class="ball2 ball_02"><?=$kjHao[4]?> </li>
                <li class="ball2 ball_01"><?=$kjHao[5]?> </li>
                <li class="ball2 ball_04"><?=$kjHao[6]?> </li>
                <li class="ball2 ball_03"><?=$kjHao[7]?> </li>
                <li class="ball2 ball_02"><?=$kjHao[8]?> </li>
                <li class="ball2 ball_01"><?=$kjHao[9]?> </li>
              </ul>
              <div class="clear"></div>
          </div>    
	  </div>
      <td class="game_top_period" width='300' >
	    <div style='padding:3px 5px' id='historylot'>
           <?php $this->display('index/inc_data_iframe_pk10.php');?>
        </div>
	  </td>
      <?php }else if($types[$this->type]['type']==2) { //11选5?>
         <td width="440" class="game_top_aright"> 
	    <div class="kj-bottom"><span class="tit"><span class='gamename' style="color:#e4ff00;font-size:12px"><?=$types[$this->type]['title']?></span>&nbsp;&nbsp;第 <span class="last_issues" style="color:#e4ff00;font-size:12px"><b><?=$lastNo['actionNo']?></b></span> 期 <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><span id="lockgame"></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()"><span id="lockgame"></span><div class="clear"></div></div>  
              <div class="grid_code_ssc wjkjData" >
              	  <p class="hide"><img src="/images/common/kjts.png" /></p>
                  <ul class="kj-hao" ctype="g3" cnum="11" >
                    <li id="span_lot_0" class="gr_s gr_s<?=$kjHao[0]?>"> </li>
                    <li id="span_lot_1" class="gr_s gr_s<?=$kjHao[1]?>"> </li>
                    <li id="span_lot_2" class="gr_s gr_s<?=$kjHao[2]?>"> </li>
                    <li id="span_lot_3" class="gr_s gr_s<?=$kjHao[3]?>"> </li>
                    <li id="span_lot_4" class="gr_s gr_s<?=$kjHao[4]?>"> </li>
                  </ul>
                  <div class="clear"></div>
            </div>    
	  </td>
	  <td class="game_top_period" width='200' >
	    <div style='padding:3px 5px' id='historylot'>
           <?php $this->display('index/inc_data_iframe.php');?>
        </div>
	  </td>
 	<?php }else{  ?>
         <td width="440" class="game_top_aright"> 
	    <div class="kj-bottom"><span class="tit"><span class='gamename' style="color:#e4ff00;font-size:12px"><?=$types[$this->type]['title']?></span>&nbsp;&nbsp;第 <span class="last_issues"  style="color:#e4ff00;font-size:12px"><b><?=$lastNo['actionNo']?></b></span> 期 <span id="kjsay">开奖倒计时：<em class="kjtips">00:00</em></span></span><span id="lockgame"></span></span><img id="voice" class="voice-on"  title="声音开启，点击关闭" onclick="voiceKJ()"><span id="lockgame"></span><div class="clear"></div></div>  
              <div class="grid_code_ssc wjkjData" >
              	  <p class="hide"><img src="/images/common/kjts.png" /></p>
                  <ul class="kj-hao" ctype="g0"  cnum="10">
                    <li id="span_lot_0" class="gr_s gr_s<?=$kjHao[0]?>"> </li>
                    <li id="span_lot_1" class="gr_s gr_s<?=$kjHao[1]?>"> </li>
                    <li id="span_lot_2" class="gr_s gr_s<?=$kjHao[2]?>"> </li>
                    <li id="span_lot_3" class="gr_s gr_s<?=$kjHao[3]?>"> </li>
                    <li id="span_lot_4" class="gr_s gr_s<?=$kjHao[4]?>"> </li>
                  </ul>
                  <div class="clear"></div>
            </div>   
	  </td>
	  <td class="game_top_period" width='200' >
	    <div style='padding:3px 5px' id='historylot'>
           <?php $this->display('index/inc_data_iframe.php');?>
        </div>
	  </td>
       <?php }?>
        </tr>
      </table>
    </div> 
<script type="text/javascript">
$(function(){
	window.S=<?=json_encode($diffTime>0)?>;
	window.KS=<?=json_encode($kjDiffTime>0)?>;
	window.kjTime=parseInt(<?=json_encode($kjdTime)?>);
	
	if($.browser.msie){
		//window.diffTime=<?=$diffTime?>;
		setTimeout(function(){
			gameKanJiangDataC(<?=$diffTime?>);
		}, 1000);
	}else{
		setTimeout(gameKanJiangDataC, 1000, <?=$diffTime?>);
	}
	<?php if($kjDiffTime>0){ ?> 
		if($.browser.msie){
		setTimeout(function(){
			setKJWaiting(<?=$kjDiffTime?>);
		}, 1000);
		}else{
			setTimeout(setKJWaiting, 1000, <?=$kjDiffTime?>);
		}
	<?php } ?> 
	
	<?php if(!$kjHao){ ?> 
		loadKjData();
	<?php } ?> 
});
</script>