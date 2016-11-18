<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心－个人资料'); ?>
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
<div class="pagetop"></div>
<div class="pagemain">
	<div style="width:880px; height:42px; border-bottom:11px solid #ff9f08;">
	<div style="width:100%; height:30px; margin-top:10px;">
    	<div style="width:100px; float:left; height:30px;"><img src="/oacss/images/dh01-17.png"></div>
        <div class="dh_68_1" style="width:700px; float:left; height:30px;">
        	<ul>
			    <li class="aafbfg"><a href="/index.php/box/receive">站内信</a></li>
            	<li class="fontback"><a href="/index.php/safe/info"><font style="color:#890e0e;">个人资料</font></a></li>
                <li class="aafbfg"><a href="/index.php/safe/passwd">密码管理</a></li>
                <li class="aafbfg"><a href="/index.php/report/coin">账变记录</a></li>
				<li class="aafbfg"><a href="/index.php/wanfa/wf">玩法介绍</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="content3 wjcont">
 <div class="body">
 <div class="jiben1">
 <?php $login=$this->getRow("select * from {$this->prename}member_session where uid=? order by id desc limit 1", $this->user['uid']);?>
 	<h2>个人基本信息：</h2>
    <ul>
     <li><span>账号：</span><b><?=htmlspecialchars($this->user['username'])?></b></li><li><span>会员类型：</span><b><?=$this->iff($this->user['type'], '代理', '会员')?></b></li>
     <li><span>等级：</span><b>VIP<?=htmlspecialchars($this->user['grade'])?></b></li><li><span>可用资金：</span><b><?=htmlspecialchars($this->user['coin'])?> 元</b></li>
	 <li><span>积分：</span><b><?=htmlspecialchars($this->user['score'])?></b></li><li><span>在线时长：</span><b><?=htmlspecialchars($this->tranSecToMHDY($this->time-$login['loginTime']))?></b></li><li><span>返点：</span><b><?=htmlspecialchars($this->user['fanDian'])?>%</b></li><li><span>最后登录：</span><b><?=htmlspecialchars($this->user['updateTime'])?></b></li>
    </ul>
 </div>
 <div class="clear"></div>
  <div class="jiben1">
 	<form action="/index.php/safe/setCBAccount" method="post" target="ajax" onajax="safeBeforSetCBA" call="safeSetCBA">
	<?php if($this->user['coinPassword']){ ?>
    <h2>个人银行信息：</h2>
    <ul>
     <li><span>银行类型：</span>
         <?php
            $myBank=$this->getRow("select * from {$this->prename}member_bank where uid=?", $this->user['uid']);
            $banks=$this->getRows("select * from {$this->prename}bank_list where isDelete=0 and id!=12 and id!=17 and id!=19 and id!=18 and id!=20 and id!=21 and id!=22 order by sort");
            
            $flag=($myBank['editEnable']!=1)&&($myBank);
          ?>
		 <select name="bankId" class="text5" <?=$this->iff($flag, 'disabled')?>>
         <?php foreach($banks as $bank){ ?>
         <option value="<?=$bank['id']?>" <?=$this->iff($myBank['bankId']==$bank['id'], 'selected')?>><?=$bank['name']?></option>
         <?php } ?>
		 </select></li>
     <li><span>银行账号：</span><input type="text" name="account" class="text4" value="<?=preg_replace('/^.*(\w{4})$/', '***\1',htmlspecialchars($myBank['account']))?>" <?=$this->iff($flag, 'readonly')?> /></li>
     <li><span>银行户名：</span><input type="text" name="username" class="text4"  value="<?=$this->iff($myBank['username'],mb_substr(htmlspecialchars($myBank['username']),0,1,'utf-8').'**')?>" <?=$this->iff($flag, 'readonly')?> /></li>
	 <li><span>开户行：</span><input type="text"  name="countname" class="text4" value="<?=preg_replace('/^(\w{4}).*(\w{4})$/','\1***\2',htmlspecialchars($myBank['countname']))?>" <?=$this->iff($flag, 'readonly')?>/></li>
     <li><span>资金密码：</span><input type="password" name="coinPassword" class="text4" <?=$this->iff($flag, 'readonly')?> /></li>
	</ul>
    <h3><input id="setbank" class="an" type="submit" <?=$this->iff($flag, 'disabled')?> value="设置银行"   ><input type="reset" id="reset" class="an" value="重置" onClick="this.form.reset()"  /></h3>
    </form>
<?php }else{?>
    <h2>个人银行信息：</h2>
    <div class="tips">
    	<dl>
        	<dt>温馨提示：</dt>
            <dd>设置银行信息要用资金密码，您尚未设置资金密码！&nbsp;&nbsp;<a href="/index.php/safe/passwd">设置资金密码&gt;&gt;</a></dd>
        </dl>
    </div>
	<div class="clear"></div>
<?php }?>
</div>
</div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>