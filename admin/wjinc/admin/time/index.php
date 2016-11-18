<?php
	$para=$_GET;
	// 取当前彩种开奖时间表
	if($this->type==34){ //六合彩
		$sql="select t.*,b.title typeName from {$this->prename}lhc_time t left join {$this->prename}type b on b.id=t.type where t.type={$this->type} order by t.actionNo";
	}else{
		$sql="select t.*,b.title typeName from {$this->prename}data_time t left join {$this->prename}type b on b.id=t.type where t.type={$this->type} order by t.actionNo";
	}
	$times=$this->getPage($sql, $this->page, $this->pageSize);
	
?>
<article class="module width_full">
	<header>
		<h3 class="tabs_involved">彩种时间设置
         <?php if($this->type==34){ //六合彩?>
        <a button="确定增加:dataAddCode|取消:defaultCloseModal" modal="true" title="增加期数" style="padding-left:50px" width="500" target="modal" href="/admin778899.php/time/add/<?=$this->type?>" class="alt_btn" >增加期数</a>
        <?php }?>
        </h3>
	</header>

	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<th>彩种</th>
				<th>期数</th>
                <!--<th>封单时间</th>-->
				<th>开奖时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php
	
				foreach($times['data'] as $var){
					
			?>
			<tr>
				<td><?=$var['typeName']?></td>
				<?php if($this->type==34){ //六合彩?>
                <td><input type="text" name="actionNo"   value="<?=$var['actionNo']?>"/></td>
                <?php }else{?>
                <td><?=$var['actionNo']?></td>
                <?php }?>
<!--				<td><input type="text" name="stopTime"   value="<?=$var['stopTime']?>"/></td>
-->                <td><input type="text" name="actionTime"   value="<?=$var['actionTime']?>"/></td>
				<td>
                 <?php if($this->type==34){ //六合彩?>
                 <a href="/admin778899.php/time/updated/<?=$var['type']?>/<?=$var['id']?>" target="ajax" method="POST" onajax="sysBeforeUpdateTime" call="sysUpdateTime">保存修改</a>
				 <a href="/admin778899.php/time/deleted/<?=$var['id']?>" target="ajax" onajax="beforeDelData" call="afterData" >清除</a>	
                 
                <?php }else{?>
                <a href="/admin778899.php/time/updateTime/<?=$var['type']?>/<?=$var['id']?>" target="ajax" method="POST" onajax="sysBeforeUpdateTime" call="sysUpdateTime">保存修改</a>
                <?php }?>
                </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<footer>
	<?php
		//$rel=$args[0]['id'];
		if($para){
			$rel.='?'.http_build_query($para,'','&');
		}
		$rel=$this->controller.'/'.$this->action .'-{page}/'.$this->type.'?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $times['total'], $rel, 'dataPageAction');
	?>
	</footer>
</article>