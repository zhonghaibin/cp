<?php
/**
 * 前台页面基类
 */
class WebLoginBase extends WebBase{
	public $type;		// 彩票种类ID
	public $groupId;	// 玩法组ID
	public $played;		// 玩法ID
	public $NO;			// 期号
	public $gameFanDian;
                function __construct($dsn, $user='', $password=''){
		session_start();
		if(!$_SESSION[$this->memberSessionName]){
			header('location: /index.php/user/login');
		    exit('您没有登录');
		}
		try{
			parent::__construct($dsn, $user, $password);
			$this->gameFanDian=$this->getValue("select fanDian from {$this->prename}members where uid=?", $GLOBALS['SUPER-ADMIN-UID']);
			// 限制同一个用户只能在一个地方登录
			$x=$this->getRow("select isOnLine,state from xy_member_session where uid={$this->user['uid']} and session_key=? order by id desc limit 1", session_id());
			if(!$x['isOnLine'] && $x['state']==1){
				echo "<script>alert('对不起,您的账号在别处登陆,您被强迫下线!');window.location.href='/index.php/user/login'</script>";
				exit();
			}else if(!$x['isOnLine']){
				echo "<script>alert('对不起,登陆超时或网络不稳定,请重新登陆!');window.location.href='/index.php/user/login'</script>";
				exit();
			}
		}catch(Exception $e){
		}
	}
	
	public function freshSession(){
		if(!$this->user) return false;
		$sessionId=$this->user['sessionId'];
		
		$sql="select * from {$this->prename}members where uid=?";
		$user=$this->getRow($sql, $this->user['uid']);
		$user['sessionId']=$sessionId;
		$user['_gameFanDian']=$this->getGameFanDian();
		$_SESSION[$this->memberSessionName]=serialize($user);
		$this->user=$user;
		return true;
	}
	
	public function getGameFanDian(){
		if($this->gameFanDian) return $this->gameFanDian;
		$this->getSystemSettings();
		return $this->gameFanDian=$this->settings['fanDianMax'];
	}
	
	
	public function getSystemSettings($expire=null){
		if($expire===null) $expire=$this->expire;
		$file=$this->cacheDir . 'systemSettings';
		if($expire && is_file($file) && filemtime($file)+$expire>$this->time){
			return $this->settings=unserialize(file_get_contents($file));
		}
		
		$sql="select * from {$this->prename}params";
		$this->settings=array();
		if($data=$this->getRows($sql)){
			foreach($data as $var){
				$this->settings[$var['name']]=$var['value'];
			}
		}
		file_put_contents($file, serialize($this->settings));
		return $this->settings;
	}

	public function getdzpSettings(){
		$sql="select * from {$this->prename}dzpparams";
		$this->dzpsettings=array();
		if($data=$this->getRows($sql)){
			foreach($data as $var){
				$this->dzpsettings[$var['name']]=$var['value'];
			}
		}
		return $this->dzpsettings;
	}

	public function getdbqbSettings(){
		$sql="select * from {$this->prename}dbqbparams";
		$this->dbqbsettings=array();
		if($data=$this->getRows($sql)){
			foreach($data as $var){
				$this->dbqbsettings[$var['name']]=$var['value'];
			}
		}
		return $this->dbqbsettings;
	}

	public function getdzyhSettings(){
		$sql="select * from {$this->prename}dzyhparams";
		$this->dzyhsettings=array();
		if($data=$this->getRows($sql)){
			foreach($data as $var){
				$this->dzyhsettings[$var['name']]=$var['value'];
			}
		}
		return $this->dzyhsettings;
	}
	
	/**
	 * 用户资金变动
	 *
	 * 请在一个事务里使用
	 */
	public function addCoin($log){
		if(!isset($log['uid'])) $log['uid']=$this->user['uid'];
		if(!isset($log['info'])) $log['info']='';
		if(!isset($log['coin'])) $log['coin']=0;
		if(!isset($log['type'])) $log['type']=0;
		if(!isset($log['fcoin'])) $log['fcoin']=0;
		if(!isset($log['extfield0'])) $log['extfield0']=0;
		if(!isset($log['extfield1'])) $log['extfield1']='';
		if(!isset($log['extfield2'])) $log['extfield2']='';
		
		$sql="call setCoin({$log['coin']}, {$log['fcoin']}, {$log['uid']}, {$log['liqType']}, {$log['type']}, '{$log['info']}', {$log['extfield0']}, '{$log['extfield1']}', '{$log['extfield2']}')";
		
		//echo $sql;exit;
		$this->insert($sql);
	}
	/**
	 * 读取可用返点
	 */
	public function getFanDian($uid=null){
		if($uid===null){
			if(!$uid=$this->user['parentId']){
				return $this->params['basePl'];
			}
		}
		return $this->getValue("select fanDian from {$this->prename}members where parentId=?", intval($uid));
	}

}
