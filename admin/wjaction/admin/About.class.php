<?php
class About extends AdminBase{
	public $title='站内信 企鹅:605857566原创=>2015/03/20';
	public $pageSize=15;
	
	public final function daili(){
		$this->action='daililist';
		$this->display('About/daili.php');
	}

	public final function daililist(){
		$this->display('About/daililist.php');
	}

	public final function deletedaili($id){
		$id=wjStrFilter($id);
		$arr = explode("-",$id);
		$sql="delete from {$this->prename}inagent where id=?";
		foreach($arr as $key=>$var){
		     $this->update($sql,$arr[$key]);
		}
	}
}