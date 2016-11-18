<?php
/*注数计算函数*/

class Bet{
	// 直选复式
	// 大小单双
	public static function fs($bet){
		$bets=explode(',', $bet);
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$ret*=count($codes);
		}
		return $ret;
	}

	// 直选单式
	// 二星直选组选单式
	public static function ds($bet){
		return count(explode('|', $bet));
	}
    
	// 五星复式
	public static function ssc5xfs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bets=explode(',', $bet);
		if(count($bets)!=5) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$x=array_unique($codes);
			if(count($codes)!=count($x) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $y){
				   if(!in_array($y,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 五星单式
	public static function ssc5xds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$e=substr_count($bet,'|');
		$a=explode('|', $bet);
		if($e!=count($a)-1) return 0;
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=5) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// 前/后四复式
	public static function sscqh4xfs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bets=explode(',', $bet);
		if(count($bets)!=4) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$x=array_unique($codes);
			if(count($codes)!=count($x) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $y){
				   if(!in_array($y,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 前/后四单式
	public static function qh4ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$e=substr_count($bet,'|');
		$a=explode('|', $bet);
		if($e!=count($a)-1) return 0;
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=4) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// 前/中/后三复式
	public static function sscqzh3xfs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bets=explode(',', $bet);
		if(count($bets)!=3) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$x=array_unique($codes);
			if(count($codes)!=count($x) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $y){
				   if(!in_array($y,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 前/中/后三单式
	public static function qzh3ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$e=substr_count($bet,'|');
		$a=explode('|', $bet);
		if($e!=count($a)-1) return 0;
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=3) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// 前/后二复式
	public static function sscqh2xfs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bets=explode(',', $bet);
		if(count($bets)!=2) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$x=array_unique($codes);
			if(count($codes)!=count($x) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $y){
				   if(!in_array($y,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 前/后二单式
	public static function qh2ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$e=substr_count($bet,'|');
		$a=explode('|', $bet);
		if($e!=count($a)-1) return 0;
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=2) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// 前/后二直选和值
	public static function sscqh2zhixhz($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18');
		$e=substr_count($bet,',');
		$bet=explode(',',$bet);
		$x=array_unique($bet);
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;$alist=array();$blist=array();$alist=$bet;$a=count($alist);
		if(count($bet)<1 || count($bet)>18 || count($bet)!=count($x) || $e!=count($bet)-1) return 0;
		foreach($bet as $b){
		   if(!in_array($b,$check)) return 0;
		}
		for($i=0;$i<$a;$i++){for ($j=0;$j<10;$j++){for($c=0;$c<10;$c++){if($j+$c-$alist[$i]==0){$bnum=$bnum+1;}}}}
		return $bnum;
	}

	// 前/后二组选和值
	public static function sscqh2zhuxhz($bet){
		$check=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17');
		$e=substr_count($bet,',');
		$bet=explode(',',$bet);
		$x=array_unique($bet);
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;$alist=array();$blist=array();$alist=$bet;$a=count($alist);
		if(count($bet)<1 || count($bet)>18 || count($bet)!=count($x) || $e!=count($bet)-1) return 0;
		foreach($bet as $b){
		   if(!in_array($b,$check)) return 0;
		}
		for ($i=0;$i<$a;$i++){$b=$alist[$i];for ($j=0;$j<10;$j++){for ($c=$j;$c<10;$c++){if($j-$c!=0){if($b-$j-$c==0){$bnum=$bnum+1;}}}}}
		return $bnum;
	}

	// 任选二复式
	public static function rx2fs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$bets=explode(',', $bet);
		$e=array_count_values($bets);
		if($e['-']!=3 || count($bets)!=5) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$count=array_unique($codes);
			if(count($codes)!=count($count) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $codess){
				   if(!in_array($codess,$check)) return 0;
               }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 任选二单式
	public static function rx2ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$a=explode('|', $bet);
        foreach($a as $b){
          $c=explode(',', $b);
          $e=array_count_values($c);
		  if($e['-']!=3 || count($c)!=5) return 0;
		  foreach($c as $h){
			 if(!in_array($h,$check)) return 0;
		  }
        }
        return count($a);
	}

    // 任选三复式
	public static function rx3fs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$bets=explode(',', $bet);
		$e=array_count_values($bets);
		if($e['-']!=2 || count($bets)!=5) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$count=array_unique($codes);
			if(count($codes)!=count($count) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $codess){
				   if(!in_array($codess,$check)) return 0;
               }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 任选三单式
	public static function rx3ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$a=explode('|', $bet);
        foreach($a as $b){
          $c=explode(',', $b);
          $e=array_count_values($c);
		  if($e['-']!=2 || count($c)!=5) return 0;
          foreach($c as $h){
			 if(!in_array($h,$check)) return 0;
		  }
        }
        return count($a);
	}

	// 任选四复式
	public static function rx4fs($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$bets=explode(',', $bet);
		$e=array_count_values($bets);
		if($e['-']!=1 || count($bets)!=5) return 0;
		$ret=1;
		foreach($bets as $b){
			$codes=str_split($b);
			$count=array_unique($codes);
			if(count($codes)!=count($count) || count($codes)>10 || count($codes)<1) return 0;
			   foreach($codes as $codess){
				   if(!in_array($codess,$check)) return 0;
               }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 任选四单式
	public static function rx4ds($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','-');
		$a=explode('|', $bet);
        foreach($a as $b){
          $c=explode(',', $b);
          $e=array_count_values($c);
		  if($e['-']!=1 || count($c)!=5) return 0;
          foreach($c as $h){
			 if(!in_array($h,$check)) return 0;
		  }
        }
        return count($a);
	}

    // 前后三二码
	public static function r2ssc($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$k=$bet;$bet=explode(' ', $bet);$bet1=array_unique($bet);
		if(count($bet)!=count($bet1) || count($bet)<2 || count($bet)>10) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
	    return self::rx($k, 2);
	}

	// 任选三组三
	public static function rx3z3($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
			$x=str_split($bet);
			foreach($x as $y){
				if(!in_array($y,$check)) return 0;
			}
			if(count($x)<2 || count($x)>10) return 0;
			return self::A(count($x), 2);
		}else{
			// 来自混合组选
			return count(explode(',', $bet));
		}
	}
	
	// 任选三组六
	public static function rx3z6($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
			$x=str_split($bet);
			foreach($x as $y){
				if(!in_array($y,$check)) return 0;
			}
			if(count($x)<3 || count($x)>10) return 0;
			return self::C(count($x), 3);
		}else{
			return count(explode(',', $bet));
		}
	}

	// 组三
	public static function z3($bet){
		if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
			return self::A(count(str_split($bet)), 2);
		}else{
			// 来自混合组选
			return count(explode(',', $bet));
		}
	}
	
	// 组六
	public static function z6($bet){
		if(strpos($bet, ',')===false && !preg_match('/(\d).*\1/', $bet)){
			return self::C(count(str_split($bet)), 3);
		}else{
			return count(explode(',', $bet));
		}
	}
	
	// 组二
	public static function z2($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$a=str_split($bet);$c=count($a);
		$x=count(array_unique($a));
		if($x!=$c) return 0;
		foreach($a as $b){
			 if(!in_array($b,$check)) return 0;
		}
		return self::C(count(str_split($bet)), 2);
	}
	
	// 五星定位胆
	// 三星定位胆
	// 五星定胆
	public static function dwd($bet){
		return strlen(str_replace(array(',','-'), '', $bet));
	}

	public static function ssc5xdwd($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$m=substr_count($bet,',');
		$j=explode(',',$bet);
		$p=array_count_values($j);
		if($p['']) return 0;

		$bet1=str_replace('-','',$bet);
        $a=explode(',',$bet1);
		$n=array_count_values($a);
		if(count($a)!=5 || (count($a)-1)!=$m || $n[' ']) return 0;
        foreach($a as $b){
           $g=str_split($b);
           $c=array_unique($g);
           if(count($g)!=count($c) || count($g)>10 || count($g)<1){
               return 0;break;
           }
        }
        $x=str_replace(array(',','-'), '', $bet);
        $z=str_split($x);
        foreach($z as $y){
            if(!in_array($y,$check)) return 0;
        }
        return strlen($x);
	}
	
	// 十星定胆
	public static function dwd10($bet){
		return strlen(str_replace(array(',','-',' '), '', $bet))/2;
	}
	
	//前后二大小单双
	public static function qh2dxds($bet){
		$bet=str_replace(array('大','小','单', '双'), array(1,2,3,4), $bet);
		$k=$bet;$bet=explode(',',$bet);
		$a=str_split($bet[0]);$b=str_split($bet[1]);
		$a1=array_unique($a);$b1=array_unique($b);
		if(count($a)<1 || count($b)<1 || count($a)>4 || count($b)>4) return 0;
		if(count($a)!=count($a1) || count($b)!=count($b1)) return 0;
		return self::fs($k);
	}

	//前后三大小单双
	public static function qh3dxds($bet){
		$bet=str_replace(array('大','小','单', '双'), array(1,2,3,4), $bet);
		$k=$bet;$bet=explode(',',$bet);
		$a=str_split($bet[0]);$b=str_split($bet[1]);$c=str_split($bet[2]);
		$a1=array_unique($a);$b1=array_unique($b);$c1=array_unique($c);
		if(count($a)<1 || count($b)<1 || count($c)<1 || count($a)>4 || count($b)>4 || count($c)>4) return 0;
		if(count($a)!=count($a1) || count($b)!=count($b1) || count($c)!=count($c1)) return 0;
		return self::fs($k);
	}

	//任选大小单双
	public static function rxdxds($bet){
		$bet=str_replace(array('大','小','单', '双'), array(1,2,3,4), $bet);
		$bets=explode(',', $bet);$ret=1;
		$e=array_count_values($bets);
		if($e['-']!=3 || count($bets)!=5) return 0;
		foreach($bets as $s){
			$a=str_split($s);
			$a1=array_unique($a);
			if(count($a)<1 || count($a)>4 || count($a)!=count($a1)) return 0;
			$ret*=count($a);
		}
		return $ret;
	}

	// 大小单双
	public static function dxds($bet){
		$bet=str_replace(array('大','小','单', '双'), array(1,2,3,4), $bet);
		return self::fs($bet);
	}

	// 定单双
	public static function dds($bet){
		$bet=str_replace(array('5单0双','4单1双','3单2双','2单3双','1单4双','0单5双'), array(1,2,3,4,5,6), $bet);
		return self::fs($bet);
	}
	
	// 龙虎
	public static function lh($bet){
		$check=array('1','2');
		$bet=str_replace(array('龙','虎'), array(1,2), $bet);
		$bets=str_split($bet);$a1=array_unique($bets);
		if(count($a1)!=count($bets) || count($bets)>2 || count($bets)==0) return 0;
		return self::fs($bet);
	}

	// 组选120
	public static function zx120($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=explode(',', $bet);
		$bet0=array_unique($bet);
		if(count($bet)!=count($bet0) || count($bet)>10 || count($bet)<5) return 0;
        foreach($bet as $bets){
           if(!in_array($bets,$check)) return 0;
        }
        return self::C(count($bet),5);
	}

	// 组选60
	public static function zx60($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=explode(',',$bet);
		$endnum=0;$num=0;$anum=0;$bnum=0;
        $sele_count=array('0','0','0','1','4','10','20','35','56','84');
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<3 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		$num=self::Sames($dCode,$tCode);if($tLen-1>=0){$c=$tLen-1;}else{$c=0;}if($num-1>=0){if($dLen-$num==0){$anum=$sele_count[$c]*$dLen;}if($dLen-$num>0){$anum=$sele_count[$tLen]*($dLen-$num)+$sele_count[$c]*$num;}}else{$anum=$sele_count[$tLen]*$dLen;}
		return $anum;
	}

	// 组选30
	public static function zx30($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<2 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<1 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		for ($i=0;$i<$dLen-1;$i++){$d=$i+1;for ($j=$d;$j<$dLen;$j++){for ($c=0;$c<$tLen;$c++){if($dCode[$i]-$tCode[$c]!=0 && $dCode[$j]-$tCode[$c]!=0){$bnum=$bnum+1;}}}}
		return $bnum;
	}

	// 组选20
	public static function zx20($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<2 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		for ($i=0;$i<$tLen-1;$i++){$d=$i+1;for ($j=$d;$j<$tLen;$j++){for ($c=0;$c<$dLen;$c++){if($tCode[$i]-$dCode[$c]!=0 && $tCode[$j]-$dCode[$c]!=0){$bnum=$bnum+1;}}}}
		return $bnum;
	}

	// 组选10
	public static function zx10($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<1 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		for ($i=0;$i<$dLen;$i++){for ($j=0;$j<$tLen;$j++){if($dCode[$i]-$tCode[$j]!=0){$bnum=$bnum+1;}}}
		return $bnum;
	}

	// 组选5
	public static function zx5($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$endnum=0;$num=0;$anum=0;$bnum=0;$cnum=0;$bnum=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<1 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		for ($i=0;$i<$dLen;$i++){for ($j=0;$j<$tLen;$j++){if($dCode[$i]-$tCode[$j]!=0){$bnum=$bnum+1;}}}
		return $bnum;
	}

	// 组选24
	public static function zx24($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$sele_count=array('0','0','0','1','5','15','35','70','126','210');
		$bet=explode(',',$bet);$dLen=count($bet);$repet=array_unique($bet);$endnum=0;
		if($dLen<4 || $dLen>10 || count($repet)!=$dLen) return 0;
		foreach($bet as $x){
			if(!in_array($x,$check)) return 0;
		}
		$num=$dLen-1;
		return $sele_count[$num];
	}

	// 组选12
	public static function zx12($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$sele_count=array('0','1','3','6','10','15','21','28','36');
		$endnum=0;$num=0;$anum=0;$bnum=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<2 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		$num=self::Sames($dCode,$tCode);  
            if($tLen-1>=0){$c=$tLen-1;}else{$c=0;}
	        if($tLen-2>=0){$d=$tLen-2;}else{$d=0;} 
	        if($num-1>=0){
		    if($dLen-$num==0){$c=$tLen-2;$anum=$sele_count[$c]*$dLen;}
		    if($dLen-$num>0){$c=$tLen-2;$anum=$sele_count[$c]*$num;$anum=$anum+$sele_count[$tLen-1]*($dLen-$num);}
	        }else{if($tLen-1>=0){$c=$tLen-1;}else{$c=0;}$anum=$sele_count[$c]*$dLen;}
	    return $anum;
	}

	// 组选6
	public static function zx6($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$sele_count=array('0','0','1','3','6','10','15','21','28','36','45');
		$bet=explode(',',$bet);$repet=array_unique($bet);$dLen=count($bet);
		if($dLen>10 || $dLen<2 || count($repet)!=$dLen) return 0;
		foreach($bet as $x){
			if(!in_array($x,$check)) return 0;
		}
		return $sele_count[$dLen];
	}

	// 组选4
	public static function zx4($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$d_arr=array();$num=0;
		$bet=explode(',',$bet);
		$dCode=str_split($bet[0]);$tCode=str_split($bet[1]);
		$a1=array_unique($dCode);$b1=array_unique($tCode);
		$dLen=count($dCode);$tLen=count($tCode);
		if($dLen<1 || $dLen>10 || $dLen!=count($a1)) return 0;
		if($tLen<1 || $tLen>10 || $tLen!=count($b1)) return 0;
		foreach($dCode as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($tCode as $y){
			if(!in_array($y,$check)) return 0;
		}
		for($e=0;$e<$dLen;$e++){
		    $num=$dCode[$e];
			for($i=0;$i<$tLen;$i++){
		       if(intval($tCode[$i],10)-intval($num,10)==0){
		       }else{
				  array_push($d_arr,$tCode[$i]);
		       }
	        }
		$endnum=count($d_arr);
	    }
		return $endnum;
	}

	// 后三直选跨度
	public static function ssch3zhixkd($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$sele_count=array('10','54','96','126','144','150','144','126','96','54');
		$bet=explode(',', $bet);$repet=array_unique($bet);$dLen=count($bet);$endnum=0;
		if($dLen<1 || $dLen>10 || count($repet)!=$dLen) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		for($i=0;$i<$dLen;$i++){$num=$bet[$i];if($num-1>=-1){$endnum=$endnum+$sele_count[$num];}}
		return $endnum;
	}

	// 后三组选和值
	public static function ssch3zxhz($bet){
        $check=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26');
		$arr=array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
		$bet=explode(',',$bet);$endnum=0;
		$count=count($bet);
		if($count>26 || $count<1) return 0;
		for($i=0;$i<$count;$i++){
			if(!in_array($bet[$i],$check)) return 0;
			$num=$bet[$i]-1;
			$endnum=$endnum+$arr[$num];
		}
		return $endnum;
	}

	// 后三特殊号码
	public static function ssch3tshm($bet){
		$bet=str_replace(array('豹子','顺子','对子'), array(1,2,3), $bet);
		$bet=explode(',',$bet);$bet1=array_unique($bet);
		if(count($bet)<1 || count($bet)>3 || count($bet)!=count($bet1)) return 0;
		return count($bet);
	}

	// 前中后三一码
	public static function sscqzhr31m($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=str_split($bet);$bet1=array_unique($bet);
		if(count($bet)<1 || count($bet)>10 || count($bet)!=count($bet1)) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
        return count($bet);
	}

	// 四星一码
	public static function ssc4x1m($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=explode(' ',$bet);$bet1=array_unique($bet);
		if(count($bet)<1 || count($bet)>10 || count($bet)!=count($bet1)) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
        return count($bet);
	}

	// 五星三码
	public static function ssc5x3m($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=explode(' ',$bet);$k=$bet;$bet1=array_unique($bet);
		if(count($bet)<3 || count($bet)>10 || count($bet)!=count($bet1)) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
        return self::C(count($k),3);
	}

	// 趣味玩法1-4
	public static function r1sscqw($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=explode(' ', $bet);$bet0=array_unique($bet);
		if(count($bet)!=count($bet0) || count($bet)>10 || count($bet)<1) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet);
	}

	// 前后三趣味二星
	public static function qh3qw2x($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=str_replace(array('小','大'),array(1,2),$bet);
		$bet=explode(',', $bet);
		$a=str_split($bet[0]);$b=str_split($bet[1]);$c=str_split($bet[2]);
		$a1=count($a);$b1=count($b);$c1=count($c);
		$repet=count(array_unique($a));$repet1=count(array_unique($b));$repet2=count(array_unique($c));
		if($a1!=$repet || $b1!=$repet1 || $c1!=$repet2) return 0;
		if($a1<1 || $b1<1 || $c1<1 || $a1>2 || $b1>10 ||$c1>10) return 0;
		foreach($bet as $s){
			$k=str_split($s);
			foreach($k as $h){
			   if(!in_array($h,$check)) return 0;
			}
		}
		return $a1*$b1*$c1;
	}

	// 四码趣味三星
	public static function ssc4mqw3x($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=str_replace(array('小','大'),array(1,2),$bet);
		$bet=explode(',', $bet);
		$a=str_split($bet[0]);$b=str_split($bet[1]);$c=str_split($bet[2]);$d=str_split($bet[3]);
		$a1=count($a);$b1=count($b);$c1=count($c);$d1=count($d);
		$repet=count(array_unique($a));$repet1=count(array_unique($b));$repet2=count(array_unique($c));$repet3=count(array_unique($d));
		if($a1!=$repet || $b1!=$repet1 || $c1!=$repet2 || $d1!=$repet3) return 0;
		if($a1<1 || $b1<1 || $c1<1 || $d1<1 || $a1>2 || $b1>10 || $c1>10 || $d1>10) return 0;
		foreach($bet as $s){
			$k=str_split($s);
			foreach($k as $h){
			   if(!in_array($h,$check)) return 0;
			}
		}
		return $a1*$b1*$c1*$d1;
	}

	// 前后三趣味二星
	public static function ssc5mqw3x($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet=str_replace(array('小','大'),array(1,2),$bet);
		$bet=explode(',', $bet);
		$a=str_split($bet[0]);$b=str_split($bet[1]);$c=str_split($bet[2]);$d=str_split($bet[3]);$e=str_split($bet[4]);
		$a1=count($a);$b1=count($b);$c1=count($c);$d1=count($d);$e1=count($e);
		$repet=count(array_unique($a));$repet1=count(array_unique($b));$repet2=count(array_unique($c));$repet3=count(array_unique($d));$repet4=count(array_unique($e));
		if($a1!=$repet || $b1!=$repet1 || $c1!=$repet2 || $d1!=$repet3 || $e1!=$repet4) return 0;
		if($a1<1 || $b1<1 || $c1<1 || $d1<1 || $e1<1 || $a1>2 || $b1>2 || $c1>10 || $d1>10 || $e1>10) return 0;
		foreach($bet as $s){
			$k=str_split($s);
			foreach($k as $h){
			   if(!in_array($h,$check)) return 0;
			}
		}
		return $a1*$b1*$c1*$d1*$e1;
	}

	//{{{ 十一选五
	
	// 任选一
	public static function r111x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}

	// 任选一单式
	public static function r1ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%2!=0 || $x!=2) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
		return self::C(count($a), 1);
	}
	
	// 任选二
	// 前二组选
	public static function r211x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<2) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 2);
	}

	// 任选二单式
	public static function r2ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%4!=0 || $x!=4) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 2);
	}
	
	// 任选三
	// 前三组选
	public static function r311x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<3) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 3);
	}

	// 任选三单式
	public static function r3ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%6!=0 || $x!=6) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 3);
	}

	public static function r411x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<4) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 4);
	}

	// 任选四单式
	public static function r4ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%8!=0 || $x!=8) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 4);
	}

	public static function r511x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<5) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 5);
	}

	// 任选五单式
	public static function r5ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%10!=0 || $x!=10) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 5);
	}

	public static function r611x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<6) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 6);
	}

	// 任选六单式
	public static function r6ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%12!=0 || $x!=12) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 6);
	}

	public static function r711x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<7) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 7);
	}

	// 任选七单式
	public static function r7ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%14!=0 || $x!=14) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 7);
	}

	public static function r811x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<8) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::rx($bet, 8);
	}

	// 任选八单式
	public static function r8ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $x=strlen($bet);
        if($x%16!=0 || $x!=16) return 0;
        $bet=rtrim(chunk_split($bet,2,','),',');
        $a=explode(',',$bet);$c=array_unique($a);
        if(count($a)!=count($c)) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return self::C(count($a), 8);
	}

	// 11选5前一直选
	public static function q1zx11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
        $a=explode(' ',$bet);$c=array_unique($a);
        if(count($a)!=count($c) || count($a)>11 || count($a)<1) return 0;
        foreach($a as $b){
            if(!in_array($b,$check)) return 0;
        }
        return count($a);
	}

	// 11选5定位胆
	public static function dwd11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet1=str_replace('-','',$bet);
        $a=explode(',',$bet1);
        foreach($a as $b){
           $g=explode(' ',$b);
           $c=array_unique($g);
           if(count($g)!=count($c) || count($g)>11 || count($g)<1) return 0;
        }
        $x=str_replace(array(',','-',' '), '', $bet);
        $z=str_split($x,2);
        foreach($z as $y){
            if(!in_array($y,$check)) return 0;
        }
        return count($z);
	}

	// 11选5不定位
	public static function bdw11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bet=explode(' ',$bet);
		$count=array_unique($bet);
		if(count($bet)!=count($count) || count($bet)>11 || count($bet)<1) return 0;
		foreach($bet as $s){
			if(!in_array($s,$check)) return 0;
		}
		return count($bet);
	}
	
	// 任选二
	// 前二组选
	public static function r2($bet){
		return self::rx($bet, 2);
	}
	
	// 任选三
	// 前三组选
	public static function r3($bet){
		return self::rx($bet, 3);
	}
	public static function r4($bet){
		return self::rx($bet, 4);
	}
	public static function r5($bet){
		return self::rx($bet, 5);
	}
	public static function r6($bet){
		return self::rx($bet, 6);
	}
	public static function r7($bet){
		return self::rx($bet, 7);
	}
	public static function r8($bet){
		return self::rx($bet, 8);
	}
	public static function r9($bet){
		return self::rx($bet, 9);
	}
	public static function r10($bet){
		return self::rx($bet, 10);
	}
	
	// 十一选五直选
	public static function zx11($bet){
		$bets=explode(',', $bet);
		$ret=1;
		
		foreach($bets as $b){
			$codes=explode(' ', $b);
			$ret*=count($codes);
		}
		
		return $ret;
	}
	// 十一选五前/后二单式
	// 前/后二单式
	public static function qh2ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$a=explode('|', $bet);
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=2) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// 前/后三单式
	public static function qh3ds11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$a=explode('|', $bet);
		foreach($a as $b){
			$c=explode(',', $b);
			foreach($c as $d){
				if(!in_array($d,$check) || count($c)!=3) return 0;
			}
		}
		return count(explode('|', $bet));
	}

	// K3和值
	public static function k3hz($bet){
		$check=array('3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>16 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}

	// K3三通号单选
	public static function k33tdx($bet){
		$check=array('111','222','333','444','555','666');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>6 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}

	// K3三通号通选
	public static function k33ttx($bet){
		$check=array('111','222','333','444','555','666');
		$bet1=explode(',', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)!=6) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return 1;
	}

	// K3三连号通选
	public static function k33ltx($bet){
		$check=array('123','234','345','456');
		$bet1=explode(',', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a)) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return 1;
	}

	// K3三不同号
	public static function k33bt($bet){
		$check=array('1','2','3','4','5','6');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)<3 || count($bet1)>6) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1), 3);
	}

	// K3二不同号
	public static function k32bt($bet){
		$check=array('1','2','3','4','5','6');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)<2 || count($bet1)>6) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1), 2);
	}

	// K3二同号复选
	public static function k32tfx($bet){
		$check=array('11*','22*','33*','44*','55*','66*');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>6 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}

	// K3二同号复选
	public static function k32tdx($bet){
		$check=array('11','22','33','44','55','66');
		$check2=array('1','2','3','4','5','6');
		$bet=explode(',', $bet);$bet[0]=explode(' ',$bet[0]);$bet[1]=explode(' ',$bet[1]);$a=array_unique($bet[0]);$b=array_unique($bet[1]);
		if(count($bet[0])!=count($a) || count($bet[1])!=count($b) || count($bet[0])>6 || count($bet[0])<1 || count($bet[1])>6 || count($bet[1])<1) return 0;
		foreach($bet[0] as $x){
			if(!in_array($x,$check)) return 0;
		}
		foreach($bet[1] as $y){
			if(!in_array($y,$check2)) return 0;
		}
		return count($bet[0])*count($bet[1]);
	}

	// PK10猜冠军
	public static function pk10cgj($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>11 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}
	// PK10猜冠亚军
	public static function pk10cgyj($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10');
		$bets=explode(',', $bet);$ret=1;
		foreach($bets as $b){
			$codes=explode(' ',$b);
			$m=array_unique($codes);
			if(count($codes)!=count($m) || count($codes)>11 || count($codes)<1) return 0;
			   foreach($codes as $k){
				   if(!in_array($k,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 任选一
	public static function r1($bet){
		return count(explode(' ', $bet));
	}

	// 冠亚季选一
	public static function gyjx1($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10');
		$bet=explode(' ', $bet);$bet0=array_unique($bet);
		if(count($bet)!=count($bet0) || count($bet)>10 || count($bet)<1) return 0;
		foreach($bet as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet);
	}

	// 六合彩特码
	public static function lhctm($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>49 || count($bet1)<1) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}

	// 六合彩2中2
	public static function lhc2z2($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>49 || count($bet1)<2) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1),2);
	}

	// 六合彩3中3
	public static function lhc3z3($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)>49 || count($bet1)<3) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1),3);
	}

	// 六合彩5不中
	public static function lhc5bz($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)!=5) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1),5);
	}

	// 六合彩7不中
	public static function lhc7bz($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49');
		$bet1=explode(' ', $bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)!=7) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1),7);
	}
    // 六合彩特码大小
	public static function lhctmdx($bet){
        $bet=str_replace(array('大','小'), array(1,2), $bet);
		if(count($bet)>1) return 0;
		return count($bet);
	}

	// 六合彩总大小
	public static function lhczdx($bet){
        $bet=str_replace(array('大','小'), array(1,2), $bet);
		if(count($bet)>1) return 0;
		return count($bet);
	}

	// 六合彩总单双
	public static function lhczds($bet){
        $bet=str_replace(array('单','双'), array(1,2), $bet);
		if(count($bet)>1) return 0;
		return count($bet);
	}

	// 福彩3D直选和值
	public static function fc3dhz($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27');
        $sele_count=array('1','3','6','10','15','21','28','36','45','55','63','69','73','75','75','73','69','63','55','45','36','28','21','15','10','6','3','1');
		$bet1=explode(',', $bet);$a=array_unique($bet1);$endnum=0;
		if(count($bet1)!=count($a) || count($bet1)<1 || count($bet1)>28) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		for($i=0;$i<count($bet1);$i++){$num=$bet1[$i];$endnum=$endnum+intval($sele_count[$num]);}
		return $endnum;
	}

	// 福彩3D组选和值
	public static function fc3dzxhz($bet){
		$check=array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26');
        $sele_count=array('1','2','2','4','5','6','8','10','11','13','14','14','15','15','14','14','13','11','10','8','6','5','4','2','2','1');
		$bet1=explode(',', $bet);$a=array_unique($bet1);$endnum=0;
		if(count($bet1)!=count($a) || count($bet1)<1 || count($bet1)>27) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		for($i=0;$i<count($bet1);$i++){$num=$bet1[$i]-1;$endnum=$endnum+intval($sele_count[$num]);}
		return $endnum;
	}

	// 福彩3D一码不定位
	public static function fc3d1mbdw($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet1=str_split($bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)<1 || count($bet1)>10) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return count($bet1);
	}
	
	// 福彩3D二码不定位
	public static function fc3d2mbdw($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet1=explode(' ',$bet);$a=array_unique($bet1);
		if(count($bet1)!=count($a) || count($bet1)<1 || count($bet1)>10) return 0;
		foreach($bet1 as $bets){
			if(!in_array($bets,$check)) return 0;
		}
		return self::C(count($bet1),2);
	}

	// 福彩3D三星定位
	public static function fc3d3xdw($bet){
		$check=array('0','1','2','3','4','5','6','7','8','9');
		$bet1=str_replace('-','',$bet);
        $a=explode(',',$bet1);
        foreach($a as $b){
           $g=str_split($b);
           $c=array_unique($g);
           if(count($g)!=count($c) || count($g)>10 || count($g)<1){
               return 0;break;
           }
        }
        $x=str_replace(array(',','-'), '', $bet);
        $z=str_split($x);
        foreach($z as $y){
            if(!in_array($y,$check)) return 0;
        }
        return strlen($x);
	}
	
	//百家乐
	public static function bjldx($bet){
		$bet=str_replace(array('庄','闲','和','庄对子','闲对子','庄豹子','闲豹子','庄天王','闲天王'),array(1,2,3,4,5,6,7,8,9), $bet);
		if(count($bet)!=1) return 0;
		return count($bet);
	}
	
	// 排除对子 豹子
	public static function descar($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bets=explode(',', $bet);$ret=1;
		foreach($bets as $b){
			$codes=explode(' ',$b);
			$m=array_unique($codes);
			if(count($codes)!=count($m) || count($codes)>11 || count($codes)<1) return 0;
			   foreach($codes as $k){
				   if(!in_array($k,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	// 11选5前二直选
	public static function q2zx11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bets=explode(',', $bet);$ret=1;$un=0;
		$w=explode(' ',$bets[0]);
		$v=explode(' ',$bets[1]);
		foreach($bets as $b){
			$codes=explode(' ',$b);
			$m=array_unique($codes);
			if(count($codes)!=count($m) || count($codes)>11 || count($codes)<1) return 0;
			   foreach($codes as $k){
				   if(!in_array($k,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		if(count($w)>=count($v)){
			$un=self::Sames($w,$v);
		}else{
			$un=self::Sames($v,$w);
		}
		return $ret-$un;
	}

	// 11选5前三直选
	public static function q3zx11x5($bet){
		$check=array('01','02','03','04','05','06','07','08','09','10','11');
		$bets=explode(',', $bet);$ret=1;$un=0;
		$w=explode(' ',$bets[0]);
		$v=explode(' ',$bets[1]);
		$q=explode(' ',$bets[2]);
		foreach($bets as $b){
			$codes=explode(' ',$b);
			$m=array_unique($codes);
			if(count($codes)!=count($m) || count($codes)>11 || count($codes)<1) return 0;
			   foreach($codes as $k){
				   if(!in_array($k,$check)) return 0;
			   }
			$ret*=count($codes);
		}
		return $ret;
	}

	//{{{ 常用算法
	//排列
	public static function A($n, $m){
		if($n<$m) return false;
		$num=1;
		for($i=0; $i<$m; $i++) $num*=$n-$i;
		return $num;
	}

	//组合
	public static function C($n, $m){
		if($n<$m) return false;
		return self::A($n, $m)/self::A($m, $m);
	}

	// 十一选五任选
	public static function rx($bet, $num){
		if($pos=strpos($bet, ')')){
			$dm=substr($bet, 1, $pos-1);
			$tm=substr($bet, $pos+1);
			
			//printf("胆码：%s，拖码：%s", $dm, $tm);
			$len = count(explode(' ', $tm));
			$num-=count(explode(' ', $dm));
		}else{
			$len = count(explode(' ', $bet));
		}
		
		return self::C($len, $num);
	}
	//}}}

	public static function Sames($a,$b){
	$num=0;
	for ($i=0;$i<count($a);$i++)
	{   $zt=0;
		for ($j=0;$j<count($b);$j++)
		{
			if($a[$i]-$b[$j]==0){
				$zt=1;
			}
		}
		if($zt==1){
			$num+=1; 
		}
	}
	return $num;
    }
}