<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<input type="hidden" value="<?=$this->user['username']?>" />
<link rel="stylesheet" type="text/css" href="/skin/admin/layout.css" media="all" />
<link type="text/css" rel="stylesheet" href="/skin/js/jqueryui/skin/smoothness/jquery-ui-1.8.23.custom.css" />
<script src="/skin/js/jquery-1.7.2.min.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.core.js"></script>
<script src="/skin/js/jqueryui/jquery.ui.datepicker.js"></script>
<script src="/skin/js/jqueryui/i18n/jquery.ui.datepicker-zh-CN.js"></script>
<script>
$(function(){
	$(':input[type=date]').datepicker();
});
</script>
</head>
<body>
<form name="score_addGoods" action="/admin778899.php/Score/updateGoods" enctype="multipart/form-data" method="POST">
<?php
	if($args[0]){
		$goodsId=intval($args[0]);
		$goods=$this->getRow("select * from {$this->prename}score_goods where id=$goodsId");
		echo '<input type="hidden" name="id" value="', $goods['id'], '"/>';
	}
?>
    <table class="tablesorter left" cellspacing="0" width="100%">
    <thead> 
        <tr> 
            <td>项目</td> 
            <td>值</td> 
        </tr> 
    </thead>
    <tbody>
        <tr> 
            <td>商品名称</td> 
            <td><input type="text" name="title" value="<?=$goods['title']?>"/></td>
        </tr>
        <tr> 
            <td>简单介绍</td> 
            <td><textarea rows="3" name="content"><?=$goods['content']?></textarea></td>
        </tr>
        <tr> 
            <td>积分</td> 
            <td><input type="text" name="score"  value="<?=$goods['score']?>"/></td>
        </tr>
        <tr> 
            <td>价值（元）</td> 
            <td><input type="text" name="price"  value="<?=$goods['price']?>"/></td>
        </tr>
        <tr> 
            <td>总件数</td> 
            <td><input type="text" name="sum"  value="<?=$goods['sum']?>"/></td>
        </tr>
         <tr> 
            <td>兑换件数</td> 
            <td><input type="text" name="surplus"  value="<?=$goods['surplus']?>"/></td>
        </tr>
        <tr> 
            <td>参与人数</td> 
            <td><input type="text" name="persons"  value="<?=$goods['persons']?>"/></td>
        </tr>
        
        <tr> 
            <td>时间</td> 
            <td>从 <input type="date"  name="startTime" style="width:75px;" value="<?=date('Y-m-d H:i:s',$goods['startTime'])?>"/> 到  <input type="date" name="stopTime" style="width:75px;" value="<?php if($goods['stopTime']){echo date('Y-m-d H:i:s',$goods['stopTime']);}else{echo '0';}?>"/><span class="spn6">0为不过期</span></td>
        </tr>
        <tr> 
            <td>缩略图</td> 
            <td><input type="text" name="picmin" value="<?=$goods['picmin']?>"/></td>
        </tr>
        <tr> 
            <td>大图</td> 
            <td><input type="text" name="picmax" value="<?=$goods['picmax']?>"/></td>
        </tr>
        <tr> 
            <td>状态</td> 
            <td>
                <label><input type="radio" value="1" name="enable" <?php if($goods["enable"]==1){?> checked='checked'<?php }?>/>开启</label>
                <label><input type="radio" value="0" name="enable" <?php if($goods["enable"]==0){?> checked='checked'<?php }?>/>关闭</label>
            </td> 
        <tr> 
    </tbody> 
    </table>
</form>
</body>
</html>