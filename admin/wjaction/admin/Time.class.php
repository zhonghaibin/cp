<?php
class Time extends AdminBase{
	public $pageSize=20;
	
	public final function index($type){
		$this->type=$type;
		$this->display('time/index.php');
	}
	

	// 彩种时间相关方法
	
	public final function updateTime($type,$id){
		$id=intval($id);
		if($this->updateRows($this->prename .'data_time', $_POST, 'id='.$id)){
			$shortName=$this->getValue("select shortName from {$this->prename}type where id=?", $type);
			$actionNo=$this->getValue("select actionNo from {$this->prename}type where id=?", $id);
			$this->addLog(19,$this->adminLogType[19].'['.$shortName.'第'.$actionNo.'期]',$id,$shortName.'第'.$actionNo.'期');
			echo '修改时间成功';
		}else{
			throw new Exception('未知出错');
		}
	}

	//六合彩
	public final function add($type){
		$type=intval($type);
		$this->display('time/add-modal.php',0,$type);
	}
	
	public final function added(){
		$para=$_POST;
		if(!$para['actionNo']) throw new Exception('期数不能为空');
		if(!$para['actionTime']) throw new Exception('开奖时间不能为空');
		
		if($this->getValue("select id from {$this->prename}lhc_time where type={$para['type']} and actionNo={$para['actionNo']}"))
		throw new Exception("期数已经存在。");
		
		if($this->insertRow($this->prename .'lhc_time', $para)){
			$uid=$this->lastInsertId();
			$para['message']='添加期数成功';
			return $para;
		}else{
			throw new Exception('未知错误');
		}
	}
	//更新
	public final function updated($type,$id){
		$id=intval($id);
		if($this->updateRows($this->prename .'lhc_time', $_POST, 'id='.$id)){
			$shortName=$this->getValue("select shortName from {$this->prename}type where id=?", $type);
			$actionNo=$this->getValue("select actionNo from {$this->prename}type where id=?", $id);
			$this->addLog(19,$this->adminLogType[19].'['.$shortName.'第'.$actionNo.'期]',$id,$shortName.'第'.$actionNo.'期');
			echo '修改时间成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	//清除
	public final  function deleted($id) {
	if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}lhc_time where id=$id";
		if($this->delete($sql)){
			echo '清除成功';
		}else{
			throw new Exception('未知错误');
		}
	}
	///六合彩结束
}