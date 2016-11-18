<?php

/**
 * 与开奖数据有关
 */
class Data extends AdminBase{
	public $pageSize=15;
	private $encrypt_key='QQ:421991377-CMK;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)GL;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)t#20BO(,u=PHsGr@NI*N/On?u8v(^Pa~Gl;pt`4Wg;*$+G<EWhZ~I+@l,k$y5r75Q/)#n=0w:%o5G$8QCOsdFf2(yz1Fz:ZB#uAR';	// 256位随便密码
	private $dataPort=65531;
	
	public final function index($type){
		$this->type=$type;
		$this->display('data/index.php');
	}
	
	public final function add($type, $actionNo, $actionTime){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'actionTime'=>$actionTime
		);
		$this->display('data/add-modal.php', 0, $para);
	}

    public final function updatedata($type, $actionNo, $actionTime){
		$para=array(
			'type'=>$type,
			'actionNo'=>$actionNo,
			'actionTime'=>$actionTime
		);
		$this->display('data/update-modal.php', 0, $para);
	}
	
	public final function kj(){
		$para=$_GET;
		$para['key']=$this->encrypt_key;
		$url=$GLOBALS['conf']['node']['access'] . '/data/kj';
		echo $this->http_post($url, $para);
	}

	public final function added(){
		$para=$_POST;
		$para['type']=intval($para['type']);
		$para['key']=$this->encrypt_key;
		
		$url=$GLOBALS['conf']['node']['access'] . '/data/add';
		if(!$this->getValue("select data from {$this->prename}data where type={$para['type']} and number='{$para['number']}'")) $this->addLog(17,$this->adminLogType[17].'['.$para['data'].']', 0, $this->getValue("select shortName from {$this->prename}type where id=?",$para['type']).'[期号:'.$para['number'].']');
		echo $this->http_post($url, $para);
	}

	public final function updatedataed(){
		$id=intval($_POST['id']);
		$para['data']=$_POST['data'];
		$sql="update {$this->prename}data set data='{$para['data']}' where id={$id}";
		if($this->update($sql)){
			echo '修改成功';
		}
	}
	
	public function http_post($url, $data) {
		$data_url = http_build_query ($data);
		$data_len = strlen ($data_url);
	
		return file_get_contents ($url, false, stream_context_create (array ('http'=>array ('method'=>'POST'
				, 'header'=>"Connection: close\r\nContent-Length: $data_len\r\n"
				, 'content'=>$data_url
				))));
	}
}
