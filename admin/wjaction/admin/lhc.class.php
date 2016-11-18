<?php
class lhc extends AdminBase{
	public $pageSize=15;
	
	
	// 玩法设置
	public final function rte($playid){
	    $playid=intval($playid);
		$this->display('lhc/rte-list.php',0,$playid);
	}

	
	public final function switchLHCRteStatus($id){
		$id=intval($id);
		$sql="update {$this->prename}lhc_ratio set enable=not enable where id=?";
		if($this->update($sql, $id)){
			$playName=$this->getValue("select name from {$this->prename}lhc_ratio where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法开关:'.$playName.']',$id,$playName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function switchLHCRteMStatus($id){
		$id=intval($id);
		$sql="update {$this->prename}lhc_ratio set android=not android where id=?";
		if($this->update($sql, $id)){
			$playName=$this->getValue("select name from {$this->prename}lhc_ratio where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法手机开关:'.$playName.']',$id,$playName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function updateLHCRte($id){
		$id=intval($id);
		if($this->updateRows($this->prename .'lhc_ratio', $_POST, 'id='.$id)){
			$playName=$this->getValue("select name from {$this->prename}lhc_ratio where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[修改:'.$playName.']',$id,$playName);
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
	}

	
}