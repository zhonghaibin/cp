<?php
/**
 * 后台管理基类
 */
class AdminBase extends Object{
	private $w234FWEF32F='ASN';
	private $user;
	public $headers;
	public $page=1;
	public $types;			// 彩票种类信息数组
	public $playeds;		// 玩法信息数组
	private $expire=3600;	// 读取玩法、彩票缓存
	public $settings;
	public $adminLogType=array(
		1=>'提现处理',
		2=>'充值确认',
		3=>'管理员充值',
		4=>'增加用户',
		5=>'修改用户',
		6=>'删除用户',
		7=>'添加管理员',
		8=>'修改管理员密码',
		9=>'删除管理员',
		10=>'修改系统设置',
		11=>'银行设置',
		12=>'彩种设置',
		13=>'玩法设置',
		14=>'等级设置修改',
		15=>'兑换订单处理',
		16=>'兑换商品操作',
		17=>'手动开奖',
		18=>'修改订单',
		19=>'清除管理员',
		20=>'添加支付接口',
		21=>'踢会员下线',
		22=>'大转盘中奖记录处理',
		23=>'修改大转盘设置',
		24=>'修改夺宝奇兵配置',
		25=>'夺宝记录处理',
		26=>'电子银行提款记录删除',
		27=>'电子银行存款冻结',
		28=>'电子银行存款解冻'
	);
	function __construct($dsn, $user='', $password=''){
		session_start();
		if($_SESSION[$this->w234FWEF32F]){
			$this->user=unserialize($_SESSION[$this->w234FWEF32F]);
		}else{
			unset($_SESSION[$this->w234FWEF32F]);
			header('location: /');
			exit();
		}
		if($this->user['admin']!=1 || $this->user['sb']!=9){
			unset($_SESSION[$this->w234FWEF32F]);
			header('location: /');
			exit();
		}
		try{
			parent::__construct($dsn, $user, $password);
			$sql="update xy_sysadmin_session set accessTime={$this->time} where id=?";
			$this->update($sql, $this->user['sessionId']);
			// 限制同一个用户只能在一个地方登录
			$x=$this->getRow("select isOnLine,state from xy_sysadmin_session where uid={$this->user['uid']} and session_key=? order by id desc limit 1", session_id());
			if(!$x['isOnLine'] && $x['state']==1){
				echo "<script>alert('对不起,您的账号在别处登陆,您被强迫下线!');window.location.href='/admin778899.php/user/logout'</script>";
				exit();
			}else if(!$x['isOnLine']){
				echo "<script>alert('对不起,登陆超时或网络不稳定,请重新登陆!');window.location.href='/admin778899.php/user/logout'</script>";
				exit();
			}
		}catch(Exception $e){
		}
	}

	/**
	 * 管理员日志
	 */
	public function addLog($type,$logString, $extfield0=0, $extfield1=''){
		$log=array(
			'uid'=>$this->user['uid'],
			'username'=>$this->user['username'],
			'type'=>$type,
			'actionTime'=>$this->time,
			'actionIP'=>$this->ip(true),
			'action'=>$logString,
			'extfield0'=>$extfield0,
			'extfield1'=>$extfield1
		);
		return $this->insertRow($this->prename .'admin_log', $log);
	}
	
	public function getTypes(){
		if($this->types) return $this->types;
		$sql="select * from {$this->prename}type where isDelete=0";
		return $this->types=$this->getObject($sql, 'id', null, $this->expire);
	}
	
	public function getPlayeds(){
		if($this->playeds) return $this->playeds;
		$sql="select * from {$this->prename}played";
		return $this->playeds=$this->getObject($sql, 'id', null, $this->expire);
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
	
	public function getUser($uid=null){
		if($uid===null) return $this->user;
		if(is_int($uid)) return $this->getRow("select * from {$this->prename}sysmember where uid='$uid'");
		if(is_string($uid)) return $this->getRow("select * from {$this->prename}sysmember where username=?", $uid);
	}
	
	public function setUser(){
		throw new Exception('这是一个只读属性');
	}
	
	public function checkLogin(){
		if($user=unserialize($_SESSION[$this->w234FWEF32F])) return $user;
		echo "<script>alert('对不起,您尚未登录!');window.location.href='/index.php/user/login'</script>";
		exit();
	}
	
	private function setClientMessage($message, $type='Info', $showTime=3000){
		$message=trim(rawurlencode($message), '"');
		header("X-$type-Message: $message");
		header("X-$type-Message-Times: $showTime");
	}
	
	protected function info($message, $showTime=3000){
		$this->setClientMessage($message, 'Info', $showTime);
	}
	protected function success($message, $showTime=3000){
		$this->setClientMessage($message, 'Success', $showTime);
	}
	protected function warning($message, $showTime=3000){
		$this->setClientMessage($message, 'Warning', $showTime);
	}
	public function error($message, $showTime=5000){
		$this->setClientMessage($message, 'Error', $showTime);
		exit;
	}
	public function unescape($source){ 
    $decodedStr = ""; 
    $pos = 0; 
    $len = strlen ($source); 
    while ($pos < $len){ 
       $charAt = substr ($source, $pos, 1); 
         if ($charAt == '%'){ 
       $pos++; 
       $charAt = substr ($source, $pos, 1); 
             if ($charAt == 'u'){ 
       $pos++; 
       $unicodeHexVal = substr ($source, $pos, 4); 
       $unicode = hexdec ($unicodeHexVal); 
       $decodedStr .=$this->u2utf82gb($unicode); 
       $pos += 4; 
             }else{ 
       $hexVal = substr ($source, $pos, 2); 
       $decodedStr .= chr (hexdec ($hexVal)); 
       $pos += 2; 
       } 
    }else{ 
       $decodedStr .= $charAt; 
      $pos++; 
   } 
   } 
   return $decodedStr; 
   }
   public function u2utf82gb($c){
      $strphp = "";
      if($c < 0x80){
         $strphp .= $c;
       }elseif($c < 0x800){
         $strphp .= chr(0xC0 | $c>>6);
         $strphp .= chr(0x80 | $c & 0x3F);
      }elseif($c < 0x10000){
         $strphp .= chr(0xE0 | $c>>12);
         $strphp .= chr(0x80 | $c>>6 & 0x3F);
         $strphp .= chr(0x80 | $c & 0x3F);
      }elseif($c < 0x200000){
         $strphp .= chr(0xF0 | $c>>18);
         $strphp .= chr(0x80 | $c>>12 & 0x3F);
         $strphp .= chr(0x80 | $c>>6 & 0x3F);
         $strphp .= chr(0x80 | $c & 0x3F);
      }
         return $strphp;
   }
	
	/**
	 * 用户资金变动
	 *
	 * 请在一个事务里使用
	 */
	public function addCoin($log){

		if(!isset($log['uid'])) $log['info']=$this->user['uid'];
		if(!isset($log['info'])) $log['info']='';
		if(!isset($log['coin'])) $log['coin']=0;
		if(!isset($log['type'])) $log['type']=0;
		if(!isset($log['fcoin'])) $log['fcoin']=0;
		if(!isset($log['extfield0'])) $log['extfield0']=0;
		if(!isset($log['extfield1'])) $log['extfield1']='';
		if(!isset($log['extfield2'])) $log['extfield2']='';

		$sql="call setCoin({$log['coin']}, {$log['fcoin']}, {$log['uid']}, {$log['liqType']}, {$log['type']}, '{$log['info']}', {$log['extfield0']}, '{$log['extfield1']}', '{$log['extfield2']}')";
		$this->insert($sql);

	}
	
	/**
	 * 获得某天的统计信息
	 */
	public function getDateCount($date=null){
		if(!$date) $date=strtotime(date("Y-m-d",$this->time));
		$sql="select count(*) betCount, sum(beiShu*mode*actionNum*(fpEnable+1)) betAmount, sum(bonus) zjAmount from {$this->prename}bets where kjTime between $date and $date+24*3600 and lotteryNo<>'' and isDelete=0";
		$all=$this->getRow($sql);
		$all['fanDianAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where liqType between 2 and 3 and actionTime between $date and $date+24*3600");
		$all['brokerageAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where liqType in(50,51,52,53,56) and actionTime between $date and $date+24*3600");

		return $all;
	}
	
}