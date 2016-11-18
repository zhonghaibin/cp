<?php
@session_start();
class User extends WebBase{
	public $title='新天恒';
	private $vcodeSessionName='xy_vcode_session_name';
	
	/**
	 * 用户登录页面
	 */
	public final function login(){
		$this->display('user/login.php');
	}
	
	/**
	 * 用户登出操作
	 */
	public final function logout(){
		$_SESSION=array();
		if($this->user['uid']){
			$this->update("update {$this->prename}member_session set isOnLine=0 where uid={$this->user['uid']}");
			echo "<script>alert('您已安全退出，欢迎再次光临!');window.location.href='/index.php/user/login'</script>";
	        exit();
		}
	}
	
	public final function bulletin(){
		$this->display('user/bulletin.php');
	}
	
	private function getBrowser(){
		$flag=$_SERVER['HTTP_USER_AGENT'];
		$para=array();
		
		// 检查操作系统
		if(preg_match('/Windows[\d\. \w]*/',$flag, $match)) $para['os']=$match[0];
		
		if(preg_match('/Chrome\/[\d\.\w]*/',$flag, $match)){
			// 检查Chrome
			$para['browser']=$match[0];
		}elseif(preg_match('/Safari\/[\d\.\w]*/',$flag, $match)){
			// 检查Safari
			$para['browser']=$match[0];
		}elseif(preg_match('/MSIE [\d\.\w]*/',$flag, $match)){
			// IE
			$para['browser']=$match[0];
		}elseif(preg_match('/Opera\/[\d\.\w]*/',$flag, $match)){
			// opera
			$para['browser']=$match[0];
		}elseif(preg_match('/Firefox\/[\d\.\w]*/',$flag, $match)){
			// Firefox
			$para['browser']=$match[0];
		}elseif(preg_match('/OmniWeb\/(v*)([^\s|;]+)/i',$flag, $match)){
			//OmniWeb
			$para['browser']=$match[2];
		}elseif(preg_match('/Netscape([\d]*)\/([^\s]+)/i',$flag, $match)){
			//Netscape
			$para['browser']=$match[2];
		}elseif(preg_match('/Lynx\/([^\s]+)/i',$flag, $match)){
			//Lynx
			$para['browser']=$match[1];
		}elseif(preg_match('/360SE/i',$flag, $match)){
			//360SE
			$para['browser']='360安全浏览器';
		}elseif(preg_match('/SE 2.x/i',$flag, $match)) {
			//搜狗
			$para['browser']='搜狗浏览器';
		}else{
			$para['browser']='unkown';
		}
		//print_r($para);exit;
		return $para;
	}

	/*活动*/
	public final function huodong(){
		$this->display('notice/huodong.php');
	}
	/*登录前活动*/
	public final function loginhuodong(){
		$this->display('notice/loginhuodong.php');
	}
	
	/**
	 * 用户登录检查
	 */
	public final function logined(){
		$username=wjStrFilter($_POST['username']);
		$password=wjStrFilter($_POST['password']);
        if(!ctype_alnum($username)) throw new Exception('用户名包含非法字符,请重新输入');

		if(!isset($username)){
			throw new Exception('请输入用户名');
		}
		if(!$password){
			throw new Exception('不允许空密码登录');
		}

		$sql="select * from {$this->prename}members where isDelete=0 and admin=0 and username=?";
		if(!$user=$this->getRow($sql, $username)){
			throw new Exception('用户名或密码不正确');
		}
		if(md5($password)!=$user['password']){
			throw new Exception('密码不正确');
		}
		if(!$user['enable']){
			throw new Exception('您的帐号被冻结，请联系管理员。');
		}
		$session=array(
			'uid'=>$user['uid'],
			'username'=>$user['username'],
			'session_key'=>session_id(),
			'loginTime'=>$this->time,
			'accessTime'=>$this->time,
			'loginIP'=>self::ip(true)
		);
		
		$session=array_merge($session, $this->getBrowser());
		
		if($this->insertRow($this->prename.'member_session', $session)){
			$user['sessionId']=$this->lastInsertId();
		}
		$_SESSION[$this->memberSessionName]=serialize($user);

		// 把别人踢下线
		$this->update("update {$this->prename}member_session set isOnLine=0,state=1 where uid={$user['uid']} and id<{$user['sessionId']}");

		return $user;
	}

	/**
	 * 验证码产生器
	 */
	public final function vcode($rmt=null){
		$lib_path=$_SERVER['DOCUMENT_ROOT'].'/xy_lib/';
		include_once $lib_path .'classes/CImage.class';
		$width=72;
		$height=24;
		$img=new CImage($width, $height);
		$img->sessionName=$this->vcodeSessionName;
		$img->printimg('png');
	}

	public final function inAgent(){
		if(!$_POST)  throw new Exception('提交数据出错，请重新操作');
		$para['name']=wjStrFilter($_POST['content1']);
		$para['amount']=wjStrFilter($_POST['content2']);
		$para['qq']=wjStrFilter($_POST['content3']);

		if(!ctype_digit($para['amount'])) throw new Exception('销量包含非法字符，请填入纯数字');
		if(!ctype_digit($para['qq'])) throw new Exception('QQ号码包含非法字符');
		if(strlen($para['name'])>40) throw new Exception('平台名请不要超过40个字符');

		$para['time']=$this->time;
		$para['ip']=$this->ip(true);
		if(!$this->insertRow($this->prename .'inagent', $para)) throw new Exception('提交出错，请重试!');

		return '申请信息已成功提交';
	}
	
	/**
	 * 推广注册
	 */
	public final function r($userxxx){
		if(!$userxxx){
			$this->display('team/register.php');
		}else{
			$lid = $this->myxor($this->hexToStr($userxxx));
			if(!is_numeric($lid)){
				$this->display('team/register.php');
			}else{
				if(!$link=$this->getRow("select * from {$this->prename}links where lid=?",$lid)){
					$this->display('team/register.php');
				}else{
					if(!$link['enable']){
						$this->display('team/register.php');
					}else{
						$this->display('team/register.php',0,$userxxx);
					}
				}
			}
		}
	}
    public final function reg(){
		if(!$_POST)  throw new Exception('提交数据出错，请重新操作');

		$user=wjStrFilter($_POST['username']);
		$password=$_POST['password'];
		$qq=wjStrFilter($_POST['qq']);
		$vcode=wjStrFilter($_POST['vcode']);
		$codec=wjStrFilter($_POST['codec']);
   
		if(strtolower($vcode)!=$_SESSION[$this->vcodeSessionName]){
			throw new Exception('验证码不正确。');
		}
		
		//验证码使用完之后要清空
		unset($_SESSION[$this->vcodeSessionName]);

		if(!ctype_alnum($user)) throw new Exception('用户名包含非法字符');
		if(!ctype_digit($qq)) throw new Exception('QQ包含非法字符');
		
		if(strlen($user)<6 || strlen($user)>16) throw new Exception('用户名为6-16位,请重新输入');
		if(strlen($qq)<4 || strlen($qq)>13) throw new Exception('QQ号为4-12位,请重新输入');
		if(strlen($password)<6) throw new Exception('密码至少6位');
		if(!$codec) throw new Exception('链接错误');
		$lid = $this->myxor($this->hexToStr($codec));
		$zczs=$this->getValue("select Value from {$this->prename}params where name='zczs'");
		if(!$link=$this->getRow("select * from {$this->prename}links where lid=?",$lid)){
			throw new Exception('该链接已失效，请联系您的上级重新索取注册链接！！');
		}else{
			$para=array(
					'username'=>$user,
					'type'=>$link['type'],
					'password'=>md5($password),
				    'source'=>3,
					'parentId'=>$link['uid'],
					'parents'=>$this->getValue("select parents from {$this->prename}members where uid=?",$link['uid']),
					'fanDian'=>$link['fanDian'],
					'regIP'=>$this->ip(true),
					'regTime'=>$this->time,
					'qq'=>$qq,
					'coin'=>0,
					'fcoin'=>0,
					'score'=>0,
					'scoreTotal'=>0,
					'admin'=>0				
			);
			
			if(!$para['nickname']) $para['nickname']=$para['username'];
			if(!$para['name']) $para['name']=$para['username'];
			
			try{
				$this->beginTransaction();
				$sql="select username from {$this->prename}members where username=?";
			    if($this->getValue($sql, $para['username'])) throw new Exception('用户"'.$para['username'].'"已经存在');
			    if($this->insertRow($this->prename .'members', $para)){
				$id=$this->lastInsertId();
				$sql="update {$this->prename}members set parents=concat(parents, ',', $id) where `uid`=$id";
				$this->update($sql);
                
				//注册活动
				if($para['parentId'] && $this->settings['regReceiveMoney'] && $this->settings['maxRegCount']){
					$regCount=$this->getValue("select count(*) from {$this->prename}members where parentId={$para['parentId']} and regIP={$this->ip(true)}");
					$maxRegCount=intval($this->settings['maxRegCount']);
					$amount=floatval($this->settings['regReceiveMoney']);
						if($regCount<=$maxRegCount){
							$this->addCoin(array(
								'uid'=>$para['parentId'],
								'liqType'=>55,
								'info'=>'注册佣金',
								'coin'=>$amount,
								'extfield0'=>$id,
								'extfield1'=>''
							));	
							
						}
				}///注册活动 end

				$this->commit();
				return '注册成功';
			}else{
				throw new Exception('注册失败');
			}	
			}catch(Exception $e){
				$this->rollBack();
				throw $e;
			}
		}
	}
}
