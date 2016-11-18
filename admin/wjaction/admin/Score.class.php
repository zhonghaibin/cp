<?php
class Score extends AdminBase{
	public $pageSize=15;
	
	public final function pointList(){
		$this->display('score/point-list.php');
	}
	
	public final function goodsList(){
		$this->display('score/goods-list.php');
	}
	
	public final function goodsModal($id){
		$this->display('score/goods-modal.php',0,$id);
	}

	public final function updateGoods(){
		$para=$_POST;

		if($para['startTime']){
			$para['startTime']=strtotime($para['startTime']);
		}else{
			$para['startTime']=$this->time;
		}
		if($para['stopTime']){
			$para['stopTime']=strtotime($para['stopTime']);
		}else{
			$para['stopTime']=0;
		}
		$para['intoTime']=$this->time;
		
		$sql="insert into {$this->prename}score_goods set";
		foreach($para as $field=>$var){
			$sql.=" `$field`='$var',";
		}
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update `title`=values(title), content=values(content), sum=values(sum), persons=values(persons), surplus=values(surplus), score=values(score), price=values(price), startTime=values(startTime), stopTime=values(stopTime), enable=values(enable)';
		if($para['picmin']) $sql.=', picmin=values(picmin)';
		if($para['picmax']) $sql.=', picmax=values(picmax)';
		if($this->insert($sql, $para)){
			$this->addLog(16,$this->adminLogType[16].'[修改ID:'.$para['id'].']',$para['id'],$para['title']);
			$fun='success';
			$msg='操作成功';
			//echo $fun;
		}else{
			$fun='error';
			$msg='未知错误';
			//echo $msg;
		}
		echo '<script type="text/javascript">top.goodsUpdateCompile("',$fun,'",',json_encode($msg),')</script>';
	}
	
	public final function goodsOnoff($id,$state){
		if(!$id=intval($id)) throw new Exception('参数出错');
		if($state){
			$state=0;
		}else{
			$state=1;
		}
		$sql="update {$this->prename}score_goods set enable=$state where id=$id";
		if($this->update($sql)){
			$this->addLog(16,$this->adminLogType[16].'[开关ID:'.$id.']',$id,$this->getValue("select title from {$this->prename}score_goods where id=?",$id));
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}
	public final function goodsDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="update {$this->prename}score_goods set isdelete=1 where id=$id";
		if($this->update($sql)){
			$this->addLog(16,$this->adminLogType[16].'[删除ID:'.$id.']',$id,$this->getValue("select title from {$this->prename}score_goods where id=?",$id));
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}
	
	/*兑换订单*/
	public final function pointState($id,$state){
		switch($state){
			case 1:
				$stateNext=2;
				break;
			case 2:
				$stateNext=3;
				break;
			case 3:  //完成
				$stateNext=0;
				
				
				break;	
		}
		
		
		try{
		
		$this->beginTransaction();
				
		$sql="update {$this->prename}score_swap set state=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username,s.goodId goodId from {$this->prename}members u,{$this->prename}score_swap s where s.uid=u.uid and s.id=?", $id);
				
            }
			$this->addLog(15,$this->adminLogType[15].'[处理ID:'.$id.']',$userData['uid'],$userData['username']);
			$this->commit();
			return '操作成功';
			
			}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
		
		
		/*$sql="update {$this->prename}score_swap set state=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}score_swap s where s.uid=u.uid and s.id=?", $id);
			$this->addLog(15,$this->adminLogType[15].'[处理ID:'.$id.']',$userData['uid'],$userData['username']);
			return '操作成功';
		}else{
			throw new Exception('未知错误');
		}*/
	}
	
	public final function pointDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}score_swap where id=?";
		if($this->delete($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}score_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(15,$this->adminLogType[15].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '订单已经删除';
		}else{
			throw new Exception('未知出错');
		}
	}	
	
	public final function pointEnable($id,$enable){
		if(!$id=intval($id)) throw new Exception('参数出错');
		switch(intval($enable)){
			case 0:
				$stateNext=1;
				break;
			case 1:
				$stateNext=0;
				break;
		}
		$sql="update {$this->prename}score_swap set enable=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}score_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(15,$this->adminLogType[15].'[取消ID:'.$id.']',$userData['uid'],$userData['username']);
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}

}