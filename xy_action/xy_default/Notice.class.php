<?php

class Notice extends WebLoginBase{
	public $pageSize=15;
	
	/**
	 * 列表页
	 */
	public final function info(){
		$sql="select * from {$this->prename}content where enable=1 and nodeId=1";
		$sql.=' order by id desc';
		$info=$this->getPage($sql, $this->page, $this->pageSize);
		$this->action='notice';
		$this->display('notice/list.php',0,$info);
		
	}

	/**
	 * 详情页
	 */
	public final function view($infoid){
		$infoid=intval($infoid);
		$info=$this->getRow("select * from {$this->prename}content where id=?", $infoid);
		$this->action='notice';
		$this->display('notice/view.php',0,$info);
	}

	/**
	 * 活动页
	 */
	public final function huodong2(){
		$this->display('notice/loginhuodong.php');
	}
}