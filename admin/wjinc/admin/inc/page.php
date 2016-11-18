<?php
	if(isset($args[0])){
		if($args[0]>1){
			$recordCount=$args[0];
		}else{
			$recordCount=1;
		}
	}else{
		$recordCount=1;
	}
	
	$pageCount=ceil($recordCount/$this->pageSize);
	$listPageSize=10;
	$startPage=$this->page-floor($listPageSize/2);
	if($startPage<1) $startPage=1;
	$prePage=$this->page-1;
	if($prePage<1) $prePage=1;
	$nextPage=$this->page+1;
	if($nextPage>$pageCount) $nextPage=$pageCount;
?>
<ul class="pageinfo" rel="<?=$args[1]?>" action="<?=$args[2]?>">
	<li>页数：<?=$this->page?>/<?=$pageCount?></li>
	
	<?php if($this->page==1){ ?>
	<li value="1" class="disabled">&lt;&lt;</li>
	<li value="1" class="disabled">&lt;</li>
	<?php }else{ ?>
	<li value="1">&lt;&lt;</li>
	<li value="<?=$prePage?>">&lt;</li>
	<?php }
		
		for($page=$startPage; $page<=$startPage+$listPageSize; $page++){
			if($page>$pageCount) break;
	?>
	
	<li value="<?=$page?>"<?=($page==$this->page?' class="current"':'')?>><?=$page?></li>

	
	<?php
		}
		if($page>$pageCount) $page=$pageCount;
	
		if($this->page==$pageCount){
	?>
	<li class="disabled" value="<?=$nextPage?>">&gt;</li>
	<li class="disabled" value="<?=$pageCount?>">&gt;&gt;</li>
	<?php }else{ ?>
	<li value="<?=$nextPage?>">&gt;</li>
	<li value="<?=$pageCount?>">&gt;&gt;</li>
	<?php } ?>
</ul>