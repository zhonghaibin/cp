<?php
class activity extends WebLoginBase{
	public $title='新春活动';   

	public final function newyear(){
		$this->display('activity/info.php');
	}
}
