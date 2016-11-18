<?php
class pays extends AdminBase{
	/**
	 * 支付接口列表
	 */
	public final function index(){
		$this->display('pay/list.php');
	}

	public final function addpayModal(){
		$this->display('pay/pay-add-modal.php');
	}

	public final function addpay(){
		$para=$_POST;
		if(!$para) throw new Exception('提交数据出错，请重新操作');

		$update['name']=wjStrFilter($para['name']);
		$update['number']=wjStrFilter($para['number']);
		$update['mkey']=wjStrFilter($para['mkey']);
		$update['sortname']=wjStrFilter($para['sortname']);

		$sql="select name from xy_pay where name=?";
		if($this->getvalue($sql,$update['name'])) throw new Exception('不能重复添加同一商家名');

		if($this->insertRow($this->prename .'pay', $update)){
			$id=$this->lastInsertId();
			$this->addLog(20,$this->adminLogType[20].'['.$this->user['username'].']',$this->lastInsertId(),$this->user['username']);
			return '添加接口成功';
		}else{
			throw new Exception('未知错误');
		}
	}

	public final function deletepay($sid){
		$sid=intval($sid);
		$sql="delete from xy_pay where sid=?";
		if($this->delete($sql, $sid)){
			return '接口已经删除';
		}else{
			throw new Exception('未知错误');
		}
	}
}