<?php
class Dzyh extends AdminBase{
	public $pageSize=15;
	
	public final function ckpointList(){
		$this->display('Dzyh/ckpoint-list.php');
	}

	public final function tkpointList(){
		$this->display('Dzyh/tkpoint-list.php');
	}
	
	public final function dzyhsettings(){
		$this->display('Dzyh/settings.php');
	}

	public final function updateSettings(){
		$sql="insert into {$this->prename}Dzyhparams(name, `value`) values";
		$i=0;
		if(!$para=$_POST) throw new Exception('参数出错');

		if(!ctype_digit($para['ckdate1'])) throw new Exception('请正确设置存款时间!');
		if(!ctype_digit($para['ckdate2'])) throw new Exception('请正确设置存款时间!');
		if(!ctype_digit($para['ckdate3'])) throw new Exception('请正确设置存款时间!');
		if(!ctype_digit($para['ckdate4'])) throw new Exception('请正确设置存款时间!');
		if(!ctype_digit($para['ckdate5'])) throw new Exception('请正确设置存款时间!');

		if($para['ckdate1']==$para['ckdate2'] || $para['ckdate1']==$para['ckdate3'] || $para['ckdate2']==$para['ckdate3']) throw new Exception('存款日期不要重复!');
		if($para['ckdate4']>=$para['ckdate5']*12 || $para['ckdate4']>=12) throw new Exception('月存款天数不要大于等于年存款天数或者大与等于12个月!');
		if($para['ckdate3']/30>=$para['ckdate4'] || $para['ckdate3']>=30) throw new Exception('日存款天数不要大于等于月存款天数或者大与等于30天!');
		if($para['ckdate2']/30>=$para['ckdate4'] || $para['ckdate2']>=30) throw new Exception('日存款天数不要大于等于月存款天数或者大与等于30天!');
		if($para['ckdate1']/30>=$para['ckdate1'] || $para['ckdate1']>=30) throw new Exception('日存款天数不要大于等于月存款天数或者大于等于30天!');
		if($para['ckdate2']>$para['ckdate1'] && $para['cklv2']<$para['cklv1']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');
		if($para['ckdate1']>$para['ckdate2'] && $para['cklv1']<$para['cklv2']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');
		if($para['ckdate3']>$para['ckdate2'] && $para['cklv3']<$para['cklv2']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');
		if($para['ckdate2']>$para['ckdate3'] && $para['cklv2']<$para['cklv3']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');
		if($para['ckdate1']>$para['ckdate3'] && $para['cklv1']<$para['cklv3']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');
		if($para['ckdate3']>$para['ckdate1'] && $para['cklv3']<$para['cklv1']) throw new Exception('存款利率与日期的对应设置不规范,请仔细检查!');

		if($para['switchck']!=0 && $para['switchck']!=1) throw new Exception('请正确设置存款开关!');
		if($para['switchtk']!=0 && $para['switchtk']!=1) throw new Exception('请正确设置存款开关!');
		
		foreach($para as $key=>$var){
			if($var==$this->dzyhsettings[$key]) continue;
			$i++;
			$sql.="('$key', '$var'),";
		}
		
		if(!$i) throw new Exception('数据没有改变');
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update `value`=values(`value`)';
		
		if($this->insert($sql)){
			$this->addLog(24,$this->adminLogType[24]);
			return $this->getdzyhSettings(0);
		}else{
			throw new Exception('未知错误');
		}
	}
	
	public final function DzyhpointDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');

		$sql="delete from {$this->prename}Dzyh_tk_swap where id=?";
		if($this->delete($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}Dzyh_tk_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(26,$this->adminLogType[26].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '删除成功';
		}else{
			throw new Exception('未知出错');
		}
	}

	public final function Dzyhpointdj($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		if($this->getValue("select enable from {$this->prename}Dzyh_ck_swap where id={$id}")) throw new Exception('该笔存款已处于冻结状态！');

		$sql="update {$this->prename}Dzyh_ck_swap SET enable=1 where id=?";
		if($this->update($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}Dzyh_ck_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(27,$this->adminLogType[27].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '存款冻结成功';
		}else{
			throw new Exception('未知出错');
		}
	}

	public final function Dzyhpointjd($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		if(!$this->getValue("select enable from {$this->prename}Dzyh_ck_swap where id={$id}")) throw new Exception('该笔存款未冻结，无需解冻！');

		$sql="update {$this->prename}Dzyh_ck_swap SET enable=0 where id=?";
		if($this->update($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}Dzyh_ck_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(28,$this->adminLogType[28].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '存款解冻成功';
		}else{
			throw new Exception('未知出错');
		}
	}

	public final function Dzyhpointedit($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="select * from {$this->prename}dzyh_ck_swap where id=?";
        $data=$this->getRow($sql,$id);
		$this->display('Dzyh/edit.php',0,$data);
	}

	public final function Dzyhpointedited(){
	    $para['id']=intval($_POST['id']);
		$para['ck_money']=floatval($_POST['ck_money']);
	    $para['time']=strtotime($_POST['time']);
		if(!$this->update("update {$this->prename}dzyh_ck_swap SET ck_money={$para['ck_money']},time={$para['time']} where id={$para['id']}")) throw new Exception('修改失败，请重试!');
		return "修改成功";
	}
}