<?php
class Member extends AdminBase{
	public $pageSize=15;
	public final function add(){
		$this->display('member/add.php');
	}
	
	public final function index(){
		$this->display('member/list.php');
	}
	
	public final function bank(){
		$this->display('member/bank.php');
	}
	
	public final function loginLog(){
		include 'ip.function.php';
		$this->display('member/login-list.php');
	}
	
	public final function level(){
		$this->display('member/level-list.php');
	}
	
	public final function userCountSetting(){
		$this->display('member/count-setting.php');
	}
	
	public final function edit($uid){
		$this->display('member/edit.php');
	}

public final function fabuxiaoxi(){
     $this->display('member/fabuxiaoxi.php');
}

public final function fabuxiaoxi_action(){
	$para=$_POST;
	if(!$para['title']){
		 throw new Exception("请输入消息标题。");
	}
	if(!$para['message']){
		 throw new Exception("请输入消息内容。");
	}
	if($para['user'] == 2){
	   if($para['uid'] == ""){
		   throw new Exception("请输入用户名。");
	   }else{
		   
		   $uid = $this->getValue("select uid from {$this->prename}members where username=?",$para['uid']);
		   $value['to_uid'] = $uid;
		   $value['message'] = $para['message'];
		   $value['title'] = $para['title'];
		   $value['dateline'] = time();
		    $value['leixing'] = 1;
		   if($this->insertRows($this->prename .'message',$value)){
			   $aaa['message']='消息发布成功';
			   return $aaa;
		   }
		 
	   }
	}else{
		$sql="select uid from {$this->prename}members where isDelete = 0 and enable = 1";
		$list=$this->getrows($sql);
		if($list) foreach($list as $var){
			$value['to_uid'] = $var['uid'];
		    $value['message'] = $para['message'];
		    $value['title'] = $para['title'];
		    $value['leixing'] = 0;
		    $value['dateline'] = time();
		    $this->insertRows($this->prename .'message',$value);
		}
			   $aaa['message']='消息发布成功';
			   return $aaa;
	}
}
	public final function added($passwordEncrypt=false){
		if(!$_POST) throw new Exception('提交数据出错');

		//过滤
		$update['type']=intval($_POST['type']);
		$update['fanDian']=floatval($_POST['fanDian']);
		$update['username']=wjStrFilter($_POST['username']);
		$update['qq']=$_POST['qq'];
		$update['password']=$_POST['password'];

		if(!isset($update['username'])) throw new Exception('用户名不能为空');
		if(!isset($update['fanDian'])) throw new Exception('返点不能为空');
		if(!ctype_digit($update['qq'])) throw new Exception('QQ包含非法字符');
		if(strlen($update['qq'])<4 || strlen($update['qq'])>13) throw new Exception('QQ号为4-12位,请重新输入');
		
		if($this->getValue("select uid from {$this->prename}members where username=?", $update['username']))
		throw new Exception("用户名已经存在。");
		
		if(isset($update['password']) && !$passwordEncrypt) $update['password']=md5($update['password']);
		if(!isset($update['nickname']) || !$update['nickname']) $update['nickname']=$update['username'];
		if(!isset($update['name']) || !$update['name']) $update['name']=$update['username'];
		
		$update['regIP']=$this->ip(true);
		$update['regTime']=$this->time;
		$update['source']=2;
		
		if($this->insertRow($this->prename .'members', $update)){
			$uid=$this->lastInsertId();
			$this->addLog(4,$this->adminLogType[4].'['.$update['username'].']',$uid, $update['username']);
			$this->updateRows($this->prename .'members', array('parents'=>$uid), 'uid='.$uid);
			$para['message']='添加用户成功';
			return $update;
		}else{
			throw new Exception('未知错误');
		}
	}
	
	public final function delete($uid){
		$uid=intval($uid);
		$this->display('member/userDel-modal.php', 0, $uid);
	}
	public final function deleteed(){
		$para=$_POST;
		$uid=$para['uid'];
		$teamCoin=$para['teamCoin'];
		$teamFcoin=$para['teamFcoin'];
		//检查是否有下级，并且有帐变
		$son=$this->getRow("select count(*) teamNum, sum(coin) teamCoin, sum(fcoin) teamFcoin from {$this->prename}members where concat(',', parents, ',') like '%,$uid,%'");
		if($son['teamNum']-1>0) throw new Exception('团队还有成员'.$son['teamNum'].'人，团队资金'.$son['teamCoin'].'元,团队冻结'.$son['teamFcoin'].'元');
		if(floatval($teamCoin) != floatval($son['teamCoin'])) throw new Exception('团队资金刚有变动'.(floatval($son['teamFcoin'])-floatval($teamFcoin)).'元，请确认后再删除');
		if(floatval($teamFcoin) != floatval($son['teamFcoin'])) throw new Exception('团队冻结资金刚有变动'.(floatval($son['teamFcoin'])-floatval($teamFcoin)).'元，请确认后再删除');
		//检查用户是否有已经充值还未到账的情况
		//if() throw new Exception('有用户充值'.(floatval($son['teamFcoin'])-floatval($teamFcoin)).'元，正在到账中……');
		
		$userName=$this->getValue("select username from {$this->prename}members where uid=?", $uid);
		$sql="call delUser2($uid)";
		if($this->update($sql)){
			//$this->updateRows($this->prename .'members', array('isDelete'=>1), 'uid='.$uid)
			$this->addLog(6,$this->adminLogType[6].'['.$userName.']',$uid,$userName);
			return '删除成功';
		}else{
			throw new Exception('删除失败');
		}
	}
	
	public final function setLevel(){
		$para=$_POST;
		$table=$this->prename .'member_level';

		foreach($para['data'] as $id=>$level){
			//print_r($para);exit;
			$this->updateRows($table, $level, "id=$id");
		}
		$this->addLog(14,$this->adminLogType[14]);
		return true;
	}

//用户等级限额
	public final function updateUserCount($id){
		if($this->updateRows($this->prename .'params_fandianset', $_POST, 'id='.$id)){
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	/*用户*///myq
	public final function listUser($sortType="userId"){
		//throw new Exception($sortType);
		$this->sortType=$sortType;
		$this->display('member/list-user.php');
	}
	/*编辑用户*/
	public final function userUpdate($id){
		$this->display('member/update-modal.php', 0, $id);
	}
	public final function userUpdateed(){
		$para=$_POST;
		$uid=intval($para['uid']);
		if(!$para['password']){
			unset($para['password']);
		}else{
			$para['password']=md5($para['password']);
		}
		if(!$para['coinPassword']){
			unset($para['coinPassword']);
		}else{
			$para['coinPassword']=md5($para['coinPassword']);
		}
		if(!isset($para['fanDian'])) unset($para['fanDian']);
		
		// 重置银行信息
		if($para['resetBank']==1){
			$sql="update {$this->prename}member_bank set editEnable=1,account='' where `uid`={$para['uid']}";
			$this->update($sql);
		}
		unset($para['resetBank']);
		
		//print_r($para);
		if($this->updateRows($this->prename .'members', $para, "uid=$uid")){
			$this->addLog(5,$this->adminLogType[5].'['.$para['username'].']',$para['uid'],$para['username']);
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
		
	}
	
	public final function userAmount($id){
		$this->display('member/user-amount.php', 0, $id);
	}


    
}