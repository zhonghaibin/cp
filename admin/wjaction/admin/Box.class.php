<?php
class Box extends AdminBase{
	public $title='站内信 企鹅:605857566原创=>2015/03/20';
	public $pageSize=15;
	
	public final function sendbox(){
		$this->action='sendlist';
		$this->display('Box/sendbox.php');
	}

	public final function sendlist(){
		$this->display('Box/sendlist.php');
	}

	public final function addbox(){
		$this->display('Box/box-add.php');
	}

	public final function receivebox(){
		$this->display('Box/receivebox.php');
	}

	public final function receivelist(){
		$this->display('Box/receivelist.php');
	}
	
	public final function all(){
		$this->action='alllist';
		$this->display('Box/all.php');
	}

	public final function alllist(){
		$this->display('Box/alllist.php');
	}

	public final function senddeleteAll($id){
		$id=wjStrFilter($id);
		$arr = explode("-",$id);
		$sql="update {$this->prename}message_sender set from_deleted=1 where mid=?";
		$sql2="select from_uid from {$this->prename}message_sender where mid=?";
		foreach($arr as $key=>$var){
			 if($this->getValue($sql2,$arr[$key])!=$this->user['uid']) throw new Exception('这不是您的消息,无法删除！');
		     $this->update($sql,$arr[$key]);
		}
	}

	public final function midinfo($mid){
		$mid=intval($mid);

        $sql="select s.title, s.from_username, s.content, s.time, r.to_username, r.mid from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.to_uid={$this->user['uid']} and r.mid=? and r.mid=s.mid";
		$data=$this->getRow($sql,$mid);

		$sql2="update {$this->prename}message_receiver set is_readed=1 where mid=? and to_uid={$this->user['uid']}";
		$this->update($sql2,$mid);

		$this->display('box/midinfo.php',0,$data);
		
	}

	public final function allmidinfo($mid){
		$mid=intval($mid);

        $sql="select s.title, s.from_username, s.content, s.time, r.to_username, r.mid from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.mid=? and r.mid=s.mid";
		$data=$this->getRow($sql,$mid);

		$this->display('box/midinfo.php',0,$data);
		
	}

	public final function receivedeleteAll($id){
		$id=wjStrFilter($id);
		$arr = explode("-",$id);
		$sql="update {$this->prename}message_receiver set is_deleted=1 where mid=?";
		$sql2="select to_uid from {$this->prename}message_receiver where mid=? and to_username='平台管理员'";
		foreach($arr as $key=>$var){
			 if($this->getValue($sql2,$arr[$key])!=$this->user['uid']) throw new Exception('这不是您的消息,无法删除！');
		     $this->update($sql,$arr[$key]);
		}
	}

	public final function alldeleteAll($id){
		$id=wjStrFilter($id);
		$arr = explode("-",$id);
		$sql="delete from {$this->prename}message_sender where mid=?";
		$sql2="delete from {$this->prename}message_receiver where mid=?";
		foreach($arr as $key=>$var){
		     $this->update($sql,$arr[$key]);
			 $this->update($sql2,$arr[$key]);
		}
	}

	public final function answer($mid){
		$mid=intval($mid);

		$sql="select s.title, s.from_username, r.mid from {$this->prename}message_sender s, {$this->prename}message_receiver r where r.mid=? and r.to_uid={$this->user['uid']} and r.mid=s.mid";
		$sql2="select to_uid from {$this->prename}message_receiver where mid=? and to_username='平台管理员'";
		if($this->getValue($sql2,$mid)!=$this->user['uid']) throw new Exception('这不是您的消息,无法回复！');

		$sql3="update {$this->prename}message_receiver set is_readed=1 where mid=? and to_uid={$this->user['uid']}";
		$this->update($sql3,$mid);

		$data=$this->getRow($sql,$mid);
		$this->display('box/answer.php',0,$data);
	}

	public final function dowrite(){
		if(!$_POST) throw new Exception('提交数据出错！');

		$touser=wjStrFilter($_POST['touser']);
		$users=wjStrFilter($_POST['users']);
		$para['title']=wjStrFilter($_POST['title']);
		$para['content']=wjStrFilter($_POST['content']);
		$para['from_username']='平台管理员';
		$para['time']=$this->time;
		$para['from_uid']=$this->user['uid'];
		$para['from_deleted']=0;

		$sql="select uid,username from {$this->prename}members where enable=1 and isDelete=0";
		$sql2="select username from {$this->prename}members where uid=?";
		$sql3="select from_uid from {$this->prename}message_sender where mid=?";
		$sql4="select from_username from {$this->prename}message_sender where mid=?";
		if($touser=='member'){

			$this->insertRow($this->prename .'message_sender', $para);
		    $update['mid']=$this->lastInsertId();

		    $arr = explode(",",$users);
		    foreach($arr as $key=>$var){
			     $update['to_username']=$this->getValue($sql2,$arr[$key]);
			     $update['to_uid']=$arr[$key];
			     $update['is_readed']=0;
			     $update['is_deleted']=0;
			     $this->insertRow($this->prename .'message_receiver', $update);
		     }
			return '发送成功';

		}else if($touser=='all'){

		    $this->insertRow($this->prename .'message_sender', $para);
		    $update['mid']=$this->lastInsertId();

            $arr = $this->getRows($sql);
		    foreach($arr as $key=>$var){
			     $update['to_username']=$arr[$key]['username'];
			     $update['to_uid']=$arr[$key]['uid'];
			     $update['is_readed']=0;
			     $update['is_deleted']=0;
			     $this->insertRow($this->prename .'message_receiver', $update);
		     }
			return '发送成功';
		}else if($touser=='dowrite'){
			$dowrite['boxid']=intval($_POST['boxid']);

			$this->insertRow($this->prename .'message_sender', $para);
			$update['mid']=$this->lastInsertId();

			$update['to_username']=$this->getValue($sql4,$dowrite['boxid']);
			$update['to_uid']=$this->getValue($sql3,$dowrite['boxid']);
			$update['is_readed']=0;
			$update['is_deleted']=0;
			$this->insertRow($this->prename .'message_receiver', $update);
			return '发送成功';
		}   
	}
}