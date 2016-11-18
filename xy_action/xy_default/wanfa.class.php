<?php
class wanfa extends WebLoginBase{
	
	public final function wf(){
		$this->display('wanfa/wanfa_iframe.php');
	}
	public final function ssc($id){
        $id=intval($id);
		if($id==1){
		   $this->display('wanfa/wanfa_ssc.php');
		}else if($id==6){
		   $this->display('wanfa/wanfa_11x5.php');
		}else if($id==9){
		   $this->display('wanfa/wanfa_p33d.php');
		}else if($id==20){
		   $this->display('wanfa/wanfa_pk10.php');
		}
	}
}