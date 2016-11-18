<?php
@session_start();
class Score extends WebLoginBase{
	private $vcodeSessionName='xy_vcode_session_name';
	public $scoretype='current';
	public $limittype='all';
	public $pageSize=3;
	public $payout=0.85;		// 取消兑换积分返还率
	/**
	 * 列表页
	 */
	public final function goods($scoretype=null,$limittype=null){
		if($scoretype) $this->scoretype=$scoretype;
		if($limittype) $this->limittype=$limittype;
		
		$sql="select * from {$this->prename}score_goods where enable=1 and startTime<={$this->time} and ";
		switch($this->scoretype){
			case 'current':
				// 正在进行的活动
				switch($this->limittype){
					case 'all':
						$sql.="(stopTime>{$this->time} or stopTime=0)";
					break;
					case 'time':
						$sql.="stopTime>{$this->time} and sum=0";
					break;
					case 'number':
						$sql.='sum>0 and surplus>0 and stopTime=0';
					break;
					case 'both':
						$sql.="stopTime>{$this->time} and sum>0";
					break;
					case 'none':
						$sql.='stopTime=0 and sum=0';
					break;
					default:
						throw new Exception('参数出错');
				}
			break;
			case 'old':
				switch($this->limittype){
					case 'all':
						$sql.="((stopTime<{$this->time} and stopTime<>0) or (sum>0 and surplus=0))";
					break;
					case 'time':
						$sql.="stopTime<{$this->time} and sum=0";
					break;
					case 'number':
						$sql.='sum>0 and surplus=0';
					break;
					case 'both':
						$sql.="stopTime>0 and (stopTime<{$this->time} or (sum>0 and surplus=0))";
					break;
					default:
						throw new Exception('参数出错');
				}
			break;
			case 'me':
				$sql="select s.id swapId, s.state, g.* from {$this->prename}score_swap s, {$this->prename}score_goods g where s.goodId=g.id and s.uid={$this->user['uid']} and ";
				switch($this->limittype){
					case 'current':
						$sql.='state between 1 and 2';
					break;
					case 'history':
						$sql.='state=0';
					break;
					default:
						throw new Exception('参数出错');
				}
			break;
			default:
				throw new Exception('参数出错');
			break;
		}
		//echo $sql;exit;
		$sql.=' order by price desc';
		$goods=$this->getPage($sql, $this->page, $this->pageSize);
		
		$this->display('score/list.php',0,$goods);
	}

	/**
	 * 兑换页
	 */
	public final function swap($goodId){
		$goodId=intval($goodId);
		$good=$this->getRow("select * from {$this->prename}score_goods where id=?", $goodId);
		$this->display('score/swap.php',0,$good);
	}

	public final function scoreinfo(){
		$this->display('score/reloadscore.php');
	}

	/**
	 * 兑换
	 */
	public final function swapGood(){
		if(!$_POST) throw new Exception('请求出错');

		//过滤未知字段
		$para['goodId']=intval($_POST['goodId']);
		$para['number']=$_POST['number'];
		$para['coinpwd']=$_POST['coinpwd'];

		if(!$para['goodId']) throw new Exception('请求出错');
		if(!ctype_digit($para['number'])) throw new Exception('兑换数量必须为整数');
		if($para['number']<=0) throw new Exception('兑换数量需大于等于1');
		
		$this->beginTransaction();
		try{
			$sql="select * from {$this->prename}score_goods where id=?";
			if(!$good=$this->getRow($sql, $para['goodId'])) throw new Exception('兑换商品不存在');
			if($good['stopTime']>0 && $good['stopTime']<$this->time) throw new Exception('这活动已经过期了');
			if($good['sum']>0 && $good['surplus']==$good['sum']) throw new Exception('这礼品已经兑换完了');
            $good['score']=$good['score']*$para['number'];
			
			$this->freshSession();
			if($good['score']>$this->user['score']) throw new Exception('你拥有积分不足，不能兑换这礼品');
			if(!$this->user['coinPassword']) throw new Exception('你尚未设置资金密码!');
			if(md5($para['coinpwd'])!=$this->user['coinPassword']) throw new Exception('资金密码不正确');
			unset($para['coinpwd']);
			
			$para['swapTime']=$this->time;
			$para['swapIp']=$this->ip(true);
			$para['uid']=$this->user['uid'];
			$para['score']=$good['score'];
			
			if($good['price']>0){//积分直接兑奖
				$para['state']=0;
				}
			if(!$this->insertRow($this->prename .'score_swap', $para)) throw new Exception('兑换礼品出错');
			
			$sql="update {$this->prename}members set score=score-{$good['score']} where uid=?";
			if(!$this->update($sql, $this->user['uid'])) throw new Exception('兑换礼品出错');
			
			if($good['sum']>0){
				// 限量兑换的礼品
				$sql="update {$this->prename}score_goods set surplus=surplus+1,persons=persons+1 where id=?";
				if(!$this->update($sql, $good['id'])) throw new Exception('兑换礼品出错');
			}
			if($good['price']>0){//积分直接兑奖
				$rechargeAmount=$good['price']*$para['number']; //元
					
					$this->addCoin(array(
						'uid'=>$this->user['uid'],
						'coin'=>$rechargeAmount,
						'liqType'=>1,
						//'extfield0'=>$id,
						'extfield0'=>0,
						'extfield1'=>0,
						'info'=>'积分兑换'
					));	
			}//兑换积分结束
			$this->commit();
			return '兑换礼品成功';
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	
	/**
	 * 兑换礼品状态改变
	 */
	public final function setSwapState($swapId){
		if(!$swapId=intval($swapId)) throw new Exception('请求出错');
		if(!$swap=$this->getRow("select * from {$this->prename}score_swap where id=$swapId")) throw new Exception('请求出错');
		
		if($swap['uid']!=$this->user['uid']) throw new Exception('你不能代别人取消兑换或确认收货');
		if($swap['state']==0) throw new Exception('这兑换已经确认收货了');
		if($swap['state']==3) throw new Exception('这兑换已经取消。');
		
		if($swap['state']==1){
			$score=round($swap['score']*$this->payout);
			$sql="update {$this->prename}members u, {$this->prename}score_swap s set u.score=u.score+$score, s.state=3 where u.uid=s.uid and s.id=$swapId";
		}elseif($swap['state']==2){
			$sql="update {$this->prename}score_swap set state=0 where id=$swapId";
		}else{
			throw new Exception('请求出错');
		}
		
		if($this->update($sql)){
			return '操作成功';
		}else{
			throw new Exception('请求出错');
		}
	}
	
	public function formatGoodTime($startTime, $endTime){
		if($this->time < $startTime) return '等待中';
		if($endTime && $endTime < $this->time) return '已结束';
		if(!$endTime) return '';
		
		$time=$endTime-$this->time;
		if($time>24*3600){
			$return=floor($time/(24*3600)).'天';
			$time%=24*3600;
		}
		
		if($time>3600){
			$return.=floor($time/3600).'时';
			$time%=3600;
		}
		
		$return.=floor($time/60).'分';
		return $this->CsubStr($return,0,6,'');
	}

	/**
	 * 幸运大转盘  379独创
	 */
	public final function rotate(){
		$this->display('score/rotate.php');
	}

	public final function rotateEvent(){
		$this->getdzpSettings;
		$score=$this->dzpsettings['score'];        //单次转动所需要的积分
		$money=array();     //定义现金数组
		$multiple=array();  //定义实物数组  默认永远不可能中奖，有需要请调节 getRand
		if($this->user['score']<$score){$result['angle']=0;$result['prize']='你拥有积分不足，不能能参加转盘抽奖活动！';return $result;}
		if(!$this->dzpsettings['switchWeb']){$result['angle']=0;$result['prize']='幸运大转盘活动未开启，敬请关注！';return $result;}
        $prize_arr = array(
           '0' => array('id'=>1,'min'=>289,'max'=>323,'prize'=>$this->dzpsettings['goods289323'],'v'=>$this->dzpsettings['chance289323'],'j'=>$this->dzpsettings['coin289323'],'w'=>$this->dzpsettings['shiwu289323']),
           '1' => array('id'=>2,'min'=>181,'max'=>215,'prize'=>$this->dzpsettings['goods181215'],'v'=>$this->dzpsettings['chance181215'],'j'=>$this->dzpsettings['coin181215'],'w'=>$this->dzpsettings['shiwu181215']),
           '2' => array('id'=>3,'min'=>37,'max'=>71,'prize'=>$this->dzpsettings['goods3771'],'v'=>$this->dzpsettings['chance3771'],'j'=>$this->dzpsettings['coin3771'],'w'=>$this->dzpsettings['shiwu3771']),
           '3' => array('id'=>4,'min'=>73,'max'=>107,'prize'=>$this->dzpsettings['goods73107'],'v'=>$this->dzpsettings['chance73107'],'j'=>$this->dzpsettings['coin73107'],'w'=>$this->dzpsettings['shiwu73107']),
           '4' => array('id'=>5,'min'=>253,'max'=>287,'prize'=>$this->dzpsettings['goods253287'],'v'=>$this->dzpsettings['chance253287'],'j'=>$this->dzpsettings['coin253287'],'w'=>$this->dzpsettings['shiwu253287']),
           '5' => array('id'=>6,'min'=>0,'max'=>35,'prize'=>$this->dzpsettings['goods035'],'v'=>$this->dzpsettings['chance035'],'j'=>$this->dzpsettings['coin035'],'w'=>$this->dzpsettings['shiwu035']),
		   '6' => array('id'=>7,'min'=>145,'max'=>179,'prize'=>$this->dzpsettings['goods145179'],'v'=>$this->dzpsettings['chance145179'],'j'=>$this->dzpsettings['coin145179'],'w'=>$this->dzpsettings['shiwu145179']),
           '7' => array('id'=>8,'min'=>109,'max'=>143,'prize'=>$this->dzpsettings['goods109143'],'v'=>$this->dzpsettings['chance109143'],'j'=>$this->dzpsettings['coin109143'],'w'=>$this->dzpsettings['shiwu109143']),
           '8' => array('id'=>9,'min'=>217,'max'=>251,'prize'=>$this->dzpsettings['goods217251'],'v'=>$this->dzpsettings['chance217251'],'j'=>$this->dzpsettings['coin217251'],'w'=>$this->dzpsettings['shiwu217251']),
		   '9' => array('id'=>10,'min'=>325,'max'=>359,'prize'=>$this->dzpsettings['goods325359'],'v'=>$this->dzpsettings['chance325359'],'j'=>$this->dzpsettings['coin325359'],'w'=>$this->dzpsettings['shiwu325359'])
        );
        foreach ($prize_arr as $key => $val) {    //二维数组遍历
            $arr[$val['id']] = $val['v'];
			if($val['j']>0){                      //筛选现金id
				array_push($money,$val['id']);    //压入数据
			}
			if($val['w']>0){                      //筛选实物id
				array_push($multiple,$val['id']);    //压入数据
			}
        }
        $rid = $this->getRand($arr); //根据概率获取奖项id
        $res = $prize_arr[$rid-1]; //中奖项
        $min = $res['min'];
        $max = $res['max'];
        $result['angle'] = mt_rand($min,$max); //随机生成一个角度
        $result['prize'] = $res['prize'];
		$this->beginTransaction();          //开始事务处理
		try{
		$sql="update {$this->prename}members set score=score-{$score} where uid=?";
		if(!$this->update($sql, $this->user['uid'])){$result['angle']=0;$result['prize']='内部出错，请重新操作!';return $result;}   //扣出本次积分
		if(in_array($rid,$money)){
			$this->addCoin(array(
						'uid'=>$this->user['uid'],
						'coin'=>$res['j'],
						'liqType'=>120,
						'extfield0'=>0,
						'extfield1'=>0,
						'info'=>'大转盘奖金'
			));
			$para=array(                              //定义记录值
			     'uid'=>$this->user['uid'],
			     'info'=>$res['prize'],
			     'state'=>0,
			     'swapTime'=>$this->time,
			     'swapIp'=>$this->ip(true),
			     'coin'=>$res['j'],
			     'score'=>$this->user['score']-$score,
				 'xscore'=>$score,
			     'enable'=>1
			);
		    if(!$this->insertRow($this->prename .'dzp_swap', $para)){$result['angle']=0;$result['prize']='内部出错，请重新操作!';return $result;}   //产生后台记录
		}else if($rid==8){        //如果中了 "再来一次"
			$sql="update {$this->prename}members set score=score+{$score} where uid=?";
		    if(!$this->update($sql, $this->user['uid'])){$result['angle']=0;$result['prize']='内部出错，请重新操作!';return $result;}   //中了再来一次后排给积分
		}else if(in_array($rid,$multiple)){    //getRand默认不中奖实物，如果中了实物就他妈的提交到后台去
			$para=array(                              //定义记录值
			     'uid'=>$this->user['uid'],
			     'info'=>$res['prize'],
			     'state'=>1,
			     'swapTime'=>$this->time,
			     'swapIp'=>$this->ip(true),
			     'coin'=>$res['j'],
			     'score'=>$this->user['score']-$score,
				 'xscore'=>$score,
			     'enable'=>1
			);
		    if(!$this->insertRow($this->prename .'dzp_swap', $para)){$result['angle']=0;$result['prize']='内部出错，请重新操作!';return $result;}   //产生后台记录
		}
		    $this->commit();
			return $result; 
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}  
	}

	/**
	 * 夺宝奇兵   379独创   配合mysql事件功能使用(event_resetdbqb)
	 */
	public final function dodbqb(){
		$this->display('score/dodbqb.php');
	}

	public final function dbqbed(){
		$jrdate=strtotime(date('Y-m-d 00:00:00',$this->time));
		$dateq=strtotime(date('Y-m-d ',$this->time).$this->dbqbsettings['FromTime'].':00');
		$datez=strtotime(date('Y-m-d ',$this->time).$this->dbqbsettings['ToTime'].':00');

		if(!$this->dbqbsettings['switchWeb']) throw new Exception('夺宝奇兵活动已下线，敬请期待!');
		if($this->time<$dateq || $this->time>$datez) throw new Exception('不在活动时间段内，无法参加!');

		if($this->user['coin']<$this->dbqbsettings['scoin']) throw new Exception('账户余额小于'.$this->dbqbsettings['scoin'].'元，无法参加!');

		$con=number_format($this->getValue("select sum(beiShu * mode * actionNum) from {$this->prename}bets where actionTime > ? and uid={$this->user['uid']} and isDelete=0",$jrdate),2);
		if($con<floatval($this->dbqbsettings['xcoin'])) throw new Exception('今日消费不满'.$this->dbqbsettings['xcoin'].'元，无法参加!');

		if($this->dbqbsettings['num']<=0) throw new Exception('很遗憾！宝箱已被抢光，请等待下一场！');
		$sql="update {$this->prename}dbqbparams SET value=value-1 where name='num'";
		$sql2="select state from {$this->prename}dbqb_swap where uid={$this->user['uid']} and  swapTime>{$jrdate}";
		$sql3="select swapIp from {$this->prename}dbqb_swap where uid={$this->user['uid']} and  swapTime>{$jrdate}";

	    if($this->getValue($sql2)) throw new Exception('很遗憾！您今日已参加过活动，请等待下一场！');
		if($this->ip(true)==$this->getValue($sql3)) throw new Exception('很遗憾！每个IP，每天只允许一个帐户参加活动！');
		$bxarr=explode('*',$this->dbqbsettings['value']);
		$bxnum=count($bxarr);
		$bxvalue=$bxarr[mt_rand(0,$bxnum)];           //随机抽取一个宝箱
        
		$this->beginTransaction();          //开始事务处理
		try{
			$this->addCoin(array(
						'uid'=>$this->user['uid'],
						'coin'=>$bxvalue,
						'liqType'=>130,
						'extfield0'=>0,
						'extfield1'=>0,
						'info'=>'夺宝奇兵奖金'
			));
			$para=array(                              //定义记录值
			     'uid'=>$this->user['uid'],
			     'info'=>$bxvalue.'元宝箱',
			     'swapTime'=>$this->time,
				 'state'=>1,
			     'swapIp'=>$this->ip(true),
			     'coin'=>$bxvalue,
			     'enable'=>1
			);
			$this->query($sql);                                     //被抢一次，宝箱总数减少一个
			$this->insertRow($this->prename .'dbqb_swap', $para);   //产生后台记录
		    $this->commit();
			return '恭喜你，抽到一个'.$bxvalue.'元的宝箱'; 
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}

	/**
	 * 电子银行   379独创 
	 */
	public final function dodzyh(){
		$this->display('score/dodzyh.php');
	}

	public final function dzyhck(){
		$this->display('score/dzyhck.php');
	}

	public final function dzyhtk(){
		         $ckdate1=$this->dzyhsettings['ckdate1']*24;$cklv1=$this->dzyhsettings['cklv1'];
				 $ckdate2=$this->dzyhsettings['ckdate2']*24;$cklv2=$this->dzyhsettings['cklv2'];
				 $ckdate3=$this->dzyhsettings['ckdate3']*24;$cklv3=$this->dzyhsettings['cklv3'];
				 $ckdate4=$this->dzyhsettings['ckdate4']*24*30;$cklv4=$this->dzyhsettings['cklv4'];
				 $ckdate5=$this->dzyhsettings['ckdate5']*24*30*12;$cklv5=$this->dzyhsettings['cklv5'];

			     $cktime=array($ckdate1,$ckdate2,$ckdate3,$ckdate4,$ckdate5);sort($cktime);
				 $cklv=array($cklv1,$cklv2,$cklv3,$cklv4,$cklv5);sort($cklv);
                  
			     $sql="select ck_money,time,username from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
				 if($data=$this->getRow($sql)){$time=($this->time-$data['time'])/3600;}else{$time=0;$data['ck_money']=0;}
				 if($time<$this->dzyhsettings['ckzdsj']){
					 $lv=0;$lx=0;
				 }else if($time>$this->dzyhsettings['ckzdsj'] && $time>=$cktime[0] && $time<$cktime[1]){
					 $lv=$cklv[0];$lx=$data['ck_money']*$cklv[0]/100*$cktime[0]/24;
				 }else if($time>=$cktime[1] && $time<$cktime[2]){
					 $lv=$cklv[1];$lx=$data['ck_money']*$cklv[1]/100*$cktime[1]/24;
				 }else if($time>=$cktime[2] && $time<$cktime[3]){
					 $lv=$cklv[2];$lx=$data['ck_money']*$cklv[2]/100*$cktime[2]/24;
				 }else if($time>=$cktime[3] && $time<$cktime[4]){
					 $lv=$cklv[3];$lx=$data['ck_money']*$cklv[3]/100*$cktime[3]/24;
				 }else if($time>=$cktime[4]){
					 $lv=$cklv[4];$lx=$data['ck_money']*$cklv[4]/100*$cktime[4]/24;
				 }
				 $data['lx']=$lx;
		$this->display('score/dzyhtk.php',0,$data);
	}

	public final function dzyhcked(){

		$ck_money=floatval($_POST['ckmoney']);
		if(strtolower($_POST['vcode'])!=$_SESSION[$this->vcodeSessionName]) throw new Exception('验证码不正确。');
	    unset($_SESSION[$this->vcodeSessionName]);   //清空验证码session
		if(md5($_POST['coinpassword'])!=$this->user['coinPassword']) throw new Exception('资金密码错误,请核对后再操作!');
		if(!$this->dzyhsettings['switchck']) throw new Exception('电子银行存款功能已关闭,详情请联系平台客服！');   //存款开关判断

		if($this->getValue("select count(id) from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;")>=1) throw new Exception('对不起！每个用户只能存一笔，您已经有一笔存款,请先取出！');
		if($this->user['coin']==0) throw new Exception('用户余额为零，请先充值！');
		if($ck_money<=0) throw new Exception('存款不能为负数，请勿抓包！');
		if($ck_money>$this->user['coin']) throw new Exception('很遗憾！存款金额大于当前账户余额，无法存款，请先充值！');  

		$para=array(                                      //定义存款记录
			'uid'=>$this->user['uid'],
			'username'=>$this->user['username'],
			'ck_money'=>$ck_money,
			'time'=>$this->time,
			'ip'=>$this->ip(true),
			'enable'=>0,
			'state'=>0,
			'isdelete'=>0
		);
		if(!$this->insertRow($this->prename .'dzyh_ck_swap', $para)) throw new Exception('存款失败！请重试');   //产生存款记录
		$this->addCoin(array(                         //产生存款扣款账变
			'uid'=>$this->user['uid'],
			'coin'=>-$ck_money,
			'liqType'=>140,
			'extfield0'=>0,
			'extfield1'=>0,
			'info'=>'存入电子银行'
		));

		return '存款成功!';
	}

	public final function dzyhtked(){
		if(strtolower($_POST['vcode'])!=$_SESSION[$this->vcodeSessionName]) throw new Exception('验证码不正确。');
	    unset($_SESSION[$this->vcodeSessionName]);   //清空验证码session
		if(md5($_POST['coinpassword'])!=$this->user['coinPassword']) throw new Exception('资金密码错误,请核对后再操作!');
		if(!$this->dzyhsettings['switchtk']) throw new Exception('电子银行提款功能已关闭,详情请联系平台客服！');   //提款开关判断
		if(!$this->getValue("select count(id) from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;")) throw new Exception('对不起！您没有存款！');
		if($this->getValue("select enable from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0;")) throw new Exception('对不起！您的存款已被冻结,详情请联系平台客服！');
		         $ckdate1=$this->dzyhsettings['ckdate1']*24;$cklv1=$this->dzyhsettings['cklv1'];
				 $ckdate2=$this->dzyhsettings['ckdate2']*24;$cklv2=$this->dzyhsettings['cklv2'];
				 $ckdate3=$this->dzyhsettings['ckdate3']*24;$cklv3=$this->dzyhsettings['cklv3'];
				 $ckdate4=$this->dzyhsettings['ckdate4']*24*30;$cklv4=$this->dzyhsettings['cklv4'];
				 $ckdate5=$this->dzyhsettings['ckdate5']*24*30*12;$cklv5=$this->dzyhsettings['cklv5'];

			     $cktime=array($ckdate1,$ckdate2,$ckdate3,$ckdate4,$ckdate5);sort($cktime);
				 $cklv=array($cklv1,$cklv2,$cklv3,$cklv4,$cklv5);sort($cklv);
                  
			     $sql="select ck_money,time,username from {$this->prename}dzyh_ck_swap where uid={$this->user['uid']} and isdelete=0 and state=0";
				 if($data=$this->getRow($sql)){$time=($this->time-$data['time'])/3600;}else{$time=0;$data['ck_money']=0;}
				 if($time<$this->dzyhsettings['ckzdsj']){
					 $lv=0;$lx=0;
				 }else if($time>$this->dzyhsettings['ckzdsj'] && $time>=$cktime[0] && $time<$cktime[1]){
					 $lv=$cklv[0];$lx=$data['ck_money']*$cklv[0]/100*$cktime[0]/24;
				 }else if($time>=$cktime[1] && $time<$cktime[2]){
					 $lv=$cklv[1];$lx=$data['ck_money']*$cklv[1]/100*$cktime[1]/24;
				 }else if($time>=$cktime[2] && $time<$cktime[3]){
					 $lv=$cklv[2];$lx=$data['ck_money']*$cklv[2]/100*$cktime[2]/24;
				 }else if($time>=$cktime[3] && $time<$cktime[4]){
					 $lv=$cklv[3];$lx=$data['ck_money']*$cklv[3]/100*$cktime[3]/24;
				 }else if($time>=$cktime[4]){
					 $lv=$cklv[4];$lx=$data['ck_money']*$cklv[4]/100*$cktime[4]/24;
				 }

		$para=array(                                      //定义提款记录
			'uid'=>$this->user['uid'],
			'username'=>$data['username'],
			'tk_money'=>$data['ck_money'],
			'time'=>$data['time'],
			'tktime'=>$this->time,
            'lv'=>$lv,
			'lx'=>$lx,
			'ip'=>$this->ip(true),
			'isdelete'=>0
		);
		if(!$this->update("update {$this->prename}dzyh_ck_swap set state=1 where uid={$this->user['uid']}")) throw new Exception('提款失败！请重试');   //重置提款状态
		if(!$this->insertRow($this->prename .'dzyh_tk_swap', $para)) throw new Exception('提款失败！请重试');   //产生提款记录
		$this->addCoin(array(                         //产生提款账变
			'uid'=>$this->user['uid'],
			'coin'=>$data['ck_money']+$lx,
			'liqType'=>150,
			'extfield0'=>0,
			'extfield1'=>0,
			'info'=>'电子银行提款'
		));

		return '提款成功!';
	}
}