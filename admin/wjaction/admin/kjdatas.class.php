<?php
class kjdatas extends AdminBase{
	public $pageSize=15;
	/**
	 * ¿ª½±¼ì²â
	 */
	public final function tests(){
		$this->display('kjdatas/list.php');
	}
}