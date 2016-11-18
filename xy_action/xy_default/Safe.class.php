<?php
@session_start();
class Safe extends WebLoginBase{
	public $title='丽都娱乐';
	private $vcodeSessionName='xy_vcode_session_name';
	/**
	 * 用户信息页面
	 */
	public final function info(){
		$this->display('safe/info.php');
	}
	/**
	 * 密码管理
	 */
	public final function passwd(){
		$sql="select password, coinPassword from {$this->prename}members where uid=?";
		$pwd=$this->getRow($sql, $this->user['uid']);
		if(!$pwd['coinPassword']){
			$coinPassword=false;
		}else{
			$coinPassword=true;
		}
		$this->display('safe/passwd.php',0,$coinPassword);
	}
	
	/**
	 * 设置密码
	 */
	public final function setPasswd(){
		$opwd=$_POST['oldpassword'];
		if(!$opwd) throw new Exception('原密码不能为空');
		if(strlen($opwd)<6) throw new Exception('原密码至少6位');
		if(!$npwd=$_POST['newpassword']) throw new Exception('密码不能为空');
		if(strlen($npwd)<6) throw new Exception('密码至少6位');
		
		$sql="select password from {$this->prename}members where uid=?";
		$pwd=$this->getValue($sql, $this->user['uid']);
		
		$opwd=md5($opwd);
		if($opwd!=$pwd) throw new Exception('原密码不正确');
		
		$sql="update {$this->prename}members set password=? where uid={$this->user['uid']}";
		if($this->update($sql, md5($npwd))) return '修改密码成功';
		return '修改密码失败';
	}
	
	/**
	 * 设置资金密码
	 */
	public final function setCoinPwd(){
		$opwd=$_POST['oldpassword'];
		if(!$npwd=$_POST['newpassword']) throw new Exception('资金密码不能为空');
		if(strlen($npwd)<6) throw new Exception('资金密码至少6位');
		
		$sql="select password, coinPassword from {$this->prename}members where uid=?";
		$pwd=$this->getRow($sql, $this->user['uid']);
		if(!$pwd['coinPassword']){
			$npwd=md5($npwd);
			if($npwd==$pwd['password']) throw new Exception('资金密码与登录密码不能一样');
			$tishi='资金密码设置成功';
		}else{
			if($opwd && md5($opwd)!=$pwd['coinPassword']) throw new Exception('原资金密码不正确');
			$npwd=md5($npwd);
			if($npwd==$pwd['password']) throw new Exception('资金密码与登录密码不能一样');
			$tishi='修改资金密码成功';
		}
		$sql="update {$this->prename}members set coinPassword=? where uid={$this->user['uid']}";
		if($this->update($sql, $npwd)) return $tishi;
		return '修改资金密码失败';
	}
	
	public final function setCoinPwd2(){
		$opwd=$_POST['oldpassword'];
		if(!$opwd) throw new Exception('原资金密码不能为空');
		if(strlen($opwd)<6) throw new Exception('原资金密码至少6位');
		if(!$npwd=$_POST['newpassword']) throw new Exception('资金密码不能为空');
		if(strlen($npwd)<6) throw new Exception('资金密码至少6位');
		
		$sql="select password, coinPassword from {$this->prename}members where uid=?";
		$pwd=$this->getRow($sql, $this->user['uid']);
		if(!$pwd['coinPassword']){
			$npwd=md5($npwd);
			if($npwd==$pwd['password']) throw new Exception('资金密码与登录密码不能一样');
			$tishi='资金密码设置成功';
		}else{
			if($opwd && md5($opwd)!=$pwd['coinPassword']) throw new Exception('原资金密码不正确');
			$npwd=md5($npwd);
			if($npwd==$pwd['password']) throw new Exception('资金密码与登录密码不能一样');
			$tishi='修改资金密码成功';
		}
		$sql="update {$this->prename}members set coinPassword=? where uid={$this->user['uid']}";
		if($this->update($sql, $npwd)) return $tishi;
		return '修改资金密码失败';
	}
	
	/**
	 * 设置银行帐户
	 */
	public final function setCBAccount(){
		if(!$_POST) throw new Exception('参数出错');

		$update['account']=wjStrFilter($_POST['account']);
		$update['countname']=wjStrFilter($_POST['countname']);
		$update['username']=wjStrFilter($_POST['username']);
		$update['bankId']=intval($_POST['bankId']);
		$update['coinPassword']=$_POST['coinPassword'];

		if(!isset($update['account'])) throw new Exception('请填写银行账号!');
		if(!isset($update['countname'])) throw new Exception('请填写开户行!');
		if(!isset($update['username'])) throw new Exception('请填写账户名!');
		if(!isset($update['bankId'])) throw new Exception('请选择银行类型!');

		$x=strlen($update['countname']);$a=strlen($update['username']);
		$y=mb_strlen($update['countname'],'utf8');$b=mb_strlen($update['username'],'utf8');
		if(($x!=$y && $x%$y==0)==FALSE) throw new Exception('开户行必须为汉字');
		if(($a!=$b && $a%$b==0)==FALSE) throw new Exception('用户名必须为汉字');
		unset($x);unset($y);unset($a);unset($b);

		// 更新用户信息缓存
		$this->freshSession();
		if(md5($update['coinPassword'])!=$this->user['coinPassword']) throw new Exception('资金密码不正确');
		unset($update['coinPassword']);
		$update['uid']=$this->user['uid'];
		$update['editEnable']=0;//设置过银行
		
		//检查银行账号唯一
		if($account=$this->getValue("select account FROM {$this->prename}member_bank where account=? LIMIT 1",$update['account'])) throw new Exception('该'.$account.'银行账号已经使用');
		//检查账户名唯一
		if($account=$this->getValue("select username FROM {$this->prename}member_bank where account=? LIMIT 1",$update['username'])) throw new Exception('该'.$username.'账户名已经使用');
			
		if($bank=$this->getRow("select editEnable from {$this->prename}member_bank where uid=? LIMIT 1", $this->user['uid'])){
			$update['xgtime']=$this->time;
			if($bank['editEnable']!=1) throw new Exception('银行信息绑定后不能随便更改，如需更改，请联系在线客服');
			if($this->updateRows($this->prename .'member_bank', $update, 'uid='. $this->user['uid'])){
				return '更改银行信息成功';
			}else{
				throw new Exception( '更改银行信息出错');
			}
		}else{
			$update['bdtime']=$this->time;
			if($this->insertRow($this->prename .'member_bank', $update)){
				// 如果是工行，参与工行卡首次绑定活动
				if($update['bankId']==1){
					$this->getSystemSettings();
					if($coin=floatval($this->settings['huoDongRegister'])){
						$liqType=51;
						$info='首次绑定工行卡赠送';
						$ip=$this->ip(true);
						$bankAccount=$update['account'];
						
						// 查找是否已经赠送过
						$sql="select id from {$this->prename}coin_log where liqType='$liqType' and (`uid`={'$this->user['uid']'} or extfield0=$ip or extfield1='$bankAccount') limit 1";
						if(!$this->getValue($sql)){
							$this->addCoin(array(
								'coin'=>$coin,
								'liqType'=>$liqType,
								'info'=>$info,
								'extfield0'=>$ip,
								'extfield1'=>$bankAccount
							));
							return sprintf('更改银行信息成功，由于你第一次绑定工行卡，系统赠送%.2f元', $coin);
						}
					}
				}
				return '更改银行信息成功';
			}else{
				throw new Exception( '更改银行信息出错');
			}
		}
	}
}