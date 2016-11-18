<?php
class Dzp extends AdminBase{
	public $pageSize=15;
	
	public final function pointList(){
		$this->display('dzp/point-list.php');
	}
	
	public final function dzpsettings(){
		$this->display('dzp/settings.php');
	}

	public final function updateSettings(){
		$sql="insert into {$this->prename}dzpparams(name, `value`) values";
		$i=0;
		if(!$para=$_POST) throw new Exception('参数出错');
		if(!ctype_digit($para['score']) || $para['score']<0) throw new Exception('请正确输入积分!');
		if(!ctype_digit($para['chance035']) || $para['chance035']<0 || $para['chance035']>100) throw new Exception('请正确输入0°-35°概率!'.$para['chance035']);
		if(!ctype_digit($para['chance3771']) || $para['chance3771']<0 || $para['chance3771']>100) throw new Exception('请正确输入37°-71°概率!');
		if(!ctype_digit($para['chance73107']) || $para['chance73107']<0 || $para['chance73107']>100) throw new Exception('请正确输入73°-107°概率!');
		if(!ctype_digit($para['chance109143']) || $para['chance109143']<0 || $para['chance109143']>100) throw new Exception('请正确输入109°-143°概率!');
		if(!ctype_digit($para['chance145179']) || $para['chance145179']<0 || $para['chance145179']>100) throw new Exception('请正确输入145°-179°概率!');
		if(!ctype_digit($para['chance181215']) || $para['chance181215']<0 || $para['chance181215']>100) throw new Exception('请正确输入181°-215°概率!');
		if(!ctype_digit($para['chance217251']) || $para['chance217251']<0 || $para['chance217251']>100) throw new Exception('请正确输入217°-251°概率!');
		if(!ctype_digit($para['chance253287']) || $para['chance253287']<0 || $para['chance253287']>100) throw new Exception('请正确输入253°-287°概率!');
		if(!ctype_digit($para['chance289323']) || $para['chance289323']<0 || $para['chance289323']>100) throw new Exception('请正确输入289°-323°概率!');
		if(!ctype_digit($para['chance325359']) || $para['chance325359']<0 || $para['chance325359']>100) throw new Exception('请正确输入325°-359°概率!');

		if($para['chance035']+$para['chance3771']+$para['chance73107']+$para['chance109143']+$para['chance145179']+$para['chance181215']+$para['chance217251']+$para['chance253287']+$para['chance289323']+$para['chance325359']!=100) throw new Exception('各项概率之和必须为100%!');

		if(!ctype_digit($para['coin035'])) throw new Exception('请正确输入0°-35°现金!');
		if(!ctype_digit($para['coin3771'])) throw new Exception('请正确输入37°-71°现金!');
		if(!ctype_digit($para['coin73107'])) throw new Exception('请正确输入73°-107°现金!');
		if(!ctype_digit($para['coin109143'])) throw new Exception('请正确输入109°-143°现金!');
		if(!ctype_digit($para['coin145179'])) throw new Exception('请正确输入145°-179°现金!');
		if(!ctype_digit($para['coin181215'])) throw new Exception('请正确输入181°-215°现金!');
		if(!ctype_digit($para['coin217251'])) throw new Exception('请正确输入217°-251°现金!');
		if(!ctype_digit($para['coin253287'])) throw new Exception('请正确输入253°-287°现金!');
		if(!ctype_digit($para['coin289323'])) throw new Exception('请正确输入289°-323°现金!');
		if(!ctype_digit($para['coin325359'])) throw new Exception('请正确输入325°-359°现金!');

		if($para['switchWeb']!=0 && $para['switchWeb']!=1) throw new Exception('请正确设置大转盘开关!');
		
		foreach($para as $key=>$var){
			if($var==$this->dzpsettings[$key]) continue;
			$i++;
			$sql.="('$key', '$var'),";
		}
		
		if(!$i) throw new Exception('数据没有改变');
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update `value`=values(`value`)';
		
		if($this->insert($sql)){
			$this->addLog(23,$this->adminLogType[23]);
			return $this->getdzpSettings(0);
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
				
		$sql="update {$this->prename}dzp_swap set state=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username,s.goodId goodId from {$this->prename}members u,{$this->prename}dzp_swap s where s.uid=u.uid and s.id=?", $id);
				
            }
			$this->addLog(22,$this->adminLogType[22].'[处理ID:'.$id.']',$userData['uid'],$userData['username']);
			$this->commit();
			return '操作成功';
			
			}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
		
		
		/*$sql="update {$this->prename}dzp_swap set state=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}dzp_swap s where s.uid=u.uid and s.id=?", $id);
			$this->addLog(15,$this->adminLogType[15].'[处理ID:'.$id.']',$userData['uid'],$userData['username']);
			return '操作成功';
		}else{
			throw new Exception('未知错误');
		}*/
	}
	
	public final function pointDel($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}dzp_swap where id=?";
		if($this->delete($sql, $id)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}dzp_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(22,$this->adminLogType[22].'[删除ID:'.$id.']',$userData['uid'],$userData['username']);
			return '中奖记录已经删除';
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
		$sql="update {$this->prename}dzp_swap set enable=$stateNext where id=$id";
		if($this->update($sql)){
			$userData=$this->getRow("select u.uid uid,u.username username from {$this->prename}members u,{$this->prename}dzp_swap s where s.uid=u.uid and s.id=?",$id);
			$this->addLog(15,$this->adminLogType[15].'[取消ID:'.$id.']',$userData['uid'],$userData['username']);
			return '操作成功！';
		}else{
			throw new Exception('未知错误');
		}
	}

}