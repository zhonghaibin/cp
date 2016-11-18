<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 申请提现'); ?>
<?php
	$txcount=$this->getValue("select count(id) from {$this->prename}member_cash  where state=1")
?>
</head> 
<body id="bg">
<?php $this->display('inc_header.php'); ?>
<div class="pagetop"></div>
<div class="pagemain">
<div class="content3 wjcont">
 <div class="body">
 <div class="youxi1">

        	<p>提现正在处理中，排队<strong class="red"><?=intval($txcount)+intval($this->settings['cashPersons'])?></strong></p>
        </div>
    </div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>