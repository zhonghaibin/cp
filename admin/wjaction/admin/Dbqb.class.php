<?php
class Dbqb extends AdminBase{
	public $pageSize=15;
	
	public final function pointList(){
		$this->display('Dbqb/point-list.php');
	}
	
	public final function dbqbsettings(){
		$this->display('Dbqb/settings.php');
	}

	public final function updateSettings(){
		$sql="insert into {$this->prename}dbqbparams(name, `value`) values";
		$i=0;
		if(!$para=$_POST) throw new Exception('参数出错');

		if(!ctype_digit($para['scoin'])) throw new Exception('请正确设置账户余额!');
		if(!ctype_digit($para['xcoin'])) throw new Exception('请正确设置今日消费!');
		if(!ctype_digit($para['num'])) throw new Exception('请正确设置宝箱数量!');
		if($para['switchWeb']!=0 && $para['switchWeb']!=1) throw new Exception('请正确设置夺宝奇兵开关!');

		$para['allnum']=$para['num'];
		if(substr($para['value'],-1)=='*' || substr($para['value'],0)=='*') throw new Exception('金额格式错误，请重新配置!');
		$arr=explode('*',$para['value']);
		foreach($arr as $var){
			if(!ctype_digit($var)) throw new Exception('金额格式错误，请重新配置!');
		}
		
		foreach($para as $key=>$var){
			if($var==$this->dbqbsettings[$key]) continue;
			$i++;
			$sql.="('$key', '$var'),";
		}
		
		if(!$i) throw new Exception('数据没有改变');
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update `value`=values(`value`)';
		
		if($this->insert($sql)){
			$this->addLog(24,$this->adminLogType[24]);
			return $this->getdbqbSettings(0);
		}else{
			throw new Exception('未知错误');
		}
	}
	
	public final function dbqbpointDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}dbqb_swap where id=?";
		if($this->delete($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}dbqb_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(25,$this->adminLogType[25].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '夺宝记录已经删除';
		}else{
			throw new Exception('未知出错');
		}
	}
}