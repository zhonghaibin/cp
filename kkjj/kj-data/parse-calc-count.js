function codeIn(code, arr){
	return arr.indexOf(code)!=-1;
}
/**
 * 算法模型
 *　func(betData, kjData, betWeiShu)
 */
//{{{ 时时彩
//{{{ 多星玩法

// 五星单式
exports.dxwf5d=function(betData, kjData){
	return ds(betData, kjData);
}

// 五星复式
exports.dxwf5f=function(betData, kjData){
	return fs(betData, kjData);
}

// 组选120
exports.dxwf5z120=function(bet, kj){
	kj=kj.split(',').sort();bet=bet.split(',');
	var kkjj=kj.concat().join(',');
    if(kkjj.match(/(\d),\1/)) return 0;
	if(Sames(bet,kj)==5){return 1;}else{return 0;}
}

// 组选60
exports.dxwf5z60=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1]){
         kjs+=kj[i];kj.splice(i,2);break;
      }
 }
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kj)==3){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 组选30
exports.dxwf5z30=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1]){
         kjs+=kj[i];kj.splice(i,2);break;
      }
 }
for(var x=0;x<kj.length;x++){
      if(kj[x]==kj[x+1]){
         kjs+=kj[x];kj.splice(x,2);break;
      }
 }
if(Sames(bet1,kj)==1){
   if(Sames(bet0,kjs.split(''))==2){
      return 1;
   }else{return 0;}
}else{return 0;}
}

// 组选20
exports.dxwf5z20=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2]){
         kjs+=kj[i];kj.splice(i,3);break;
      }
}
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kj)==2){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 组选10
exports.dxwf5z10=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(',');var kjs="";var kjs2="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');

for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2]){
         kjs+=kj[i];kj.splice(i,3);break;
      }
 }
for(var j=0;j<kj.length;j++){
      if(kj[j]==kj[j+1]){
         kjs2+=kj[j];kj.splice(j,2);
      }
 }
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kjs2)==1){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 组选5
exports.dxwf5z5=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1,\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2] && kj[i+2]==kj[i+3]){
         kjs+=kj[i];kj.splice(i,4);break;
      }
 }
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kj)==1){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 前4复式
exports.dxwfQ4f=function(betData, kjData){
	return fs(betData, kjData.removeFromList(',', 5));
}

// 前4单式
exports.dxwfQ4d=function(betData, kjData){
	return ds(betData, kjData.removeFromList(',', 5));
}

// 后4复式
exports.dxwfH4f=function(bet, kj){
	return fs(bet, kj.removeFromList(',',1));
}

// 后4单式
exports.dxwfH4d=function(bet, kj){
	return ds(bet, kj.removeFromList(',',1));
}

// 任选4复式
exports.dxwfR4f=function(bet, kj){
	var w=bet.split(',').indexOf('-')+1;
	kj=kj.replaceList('-', w);
	return fs(bet, kj);
}

// 任选4单式
exports.dxwfR4d=function(bet, kj){
	var w=bet.substr(0,9).split(',').indexOf('-')+1;
	kj=kj.replaceList('-', w);
	return ds(bet, kj);
}

// 组选24
exports.dxwf4z24=function(bet, kj){
kj=kj.substr(2,7).split(',').sort();bet=bet.split(',');
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1/)) return 0;
  if(Sames(bet,kj)==4){
       return 1;
  }else{return 0;}
}

// 组选12
exports.dxwf4z12=function(bet, kj){
kj=kj.substr(2,7).split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1]){
         kjs+=kj[i];kj.splice(i,2);break;
      }
 }
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kj)==2){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 组选6
exports.dxwf4z6=function(bet, kj){
kj=kj.substr(2,7).split(',').sort();bet=bet.split(',');var kjs="";var kjs2="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1/)) return 0;
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1]){
         kjs+=kj[i];kj.splice(i,2);break;
      }
 }
for(var j=0;j<kj.length;j++){
      if(kj[j]==kj[j+1]){
         kjs2+=kj[j];kj.splice(j,2);break;
      }
 }
if(Sames(bet,kjs.split(''))==1){
  if(Sames(bet,kjs2)==1){
     return 1;
  }else{return 0;}
}else{return 0;}
}

// 组选4
exports.dxwf4z4=function(bet, kj){
kj=kj.substr(2,7).split(',').sort();bet=bet.split(',');var kjs="";
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1,\1/)) return 0;
var bet0=bet[0].split('');
var bet1=bet[1].split('');
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2]){
         kjs+=kj[i];kj.splice(i,3);break;
      }
 }
if(Sames(bet0,kjs.split(''))==1){
  if(Sames(bet1,kj)==1){
     return 1;
  }else{return 0;}
}else{return 0;}
}

//}}}

//{{{ 三星玩法

// 前三复式
exports.sxwfQ3f=function(bet, kj){
	return fs(bet, kj.removeFromList(',', 4,5));
}

// 前三单式
exports.sxwfQ3d=function(bet, kj){
	return ds(bet, kj.removeFromList(',', 4,5));
}

// 中三复式
exports.sxwfz3fs=function(bet, kj){
	return fs(bet, kj.substr(2,5));
}

// 中三单式
exports.sxwfz3ds=function(bet, kj){
	return ds(bet, kj.substr(2,5));
}

// 后三复式
exports.sxwfH3f=function(bet, kj){
	return fs(bet, kj.removeFromList(',', 1, 2));
}

// 后三单式
exports.sxwfH3d=function(bet, kj){
	return ds(bet, kj.removeFromList(',', 1,2));
}

// 任选三复式
exports.sxwfR3f=function(bet, kj){
	bet.split(',').map(function(v, i){
		if(v=='-') kj=kj.replaceList('-',i+1);
	});
	
	return fs(bet, kj);
}

// 任选三单式
exports.sxwfR3d=function(bet, kj){
	bet.substr(0,9).split(',').map(function(v, i){
		if(v=='-') kj=kj.replaceList('-',i+1);
	});
	
	return ds(bet, kj);
}

// 后三和值尾数
exports.sxh3hzws=function(bet, kj){
kj=kj.substr(4,5).split(',');bet=bet.split(' ');var bet2="";
var m=parseInt(kj[0])+parseInt(kj[1])+parseInt(kj[2]);
if(m<10){var g=m;}else{g=m%10;}
 for(var i=0;i<bet.length;i++){
    if(g==parseInt(bet[i])) {bet2+=bet[i];break;}
 }
 return bet2.length;
}

//}}}

//{{{ 三星组选

// 前三组三
exports.sxzxQ3z3=function(bet, kj){
	
	return z3(bet, kj.substr(0,5));
}

// 前三组六
exports.sxzxQ3z6=function(bet, kj){
	return z6(bet, kj.substr(0,5));
}

// 中三组三
exports.sxzxz3z3=function(bet, kj){
	
	return z3(bet, kj.substr(2,5));
}

// 中三组六
exports.sxzxz3z6=function(bet, kj){
	return z6(bet, kj.substr(2,5));
}

// 中三混合组选
exports.sxzxZ3h=function(bet, kj){

}

// 前三混合组选
exports.sxzxQ3h=function(bet, kj){

}

// 后三组三
exports.sxzxH3z3=function(bet, kj){
	return z3(bet, kj.substr(4,5));
}

// 后三组六
exports.sxzxH3z6=function(bet, kj){
	return z6(bet, kj.substr(4,5));
}

// 后三混合组选
exports.sxzxH3h=function(bet, kj){

}

// 任三组三
exports.sxzxR3z3=function(bet, kj, w){
	kj=kj.split(',');
	[16, 8, 4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	return z3(bet, kj);
}

// 任三组六
exports.sxzxR3z6=function(bet, kj, w){
	kj=kj.split(',');
	[16, 8, 4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	return z6(bet, kj);
}

// 任三混合组
exports.sxzxR3h=function(bet, kj, w){
}

// 后三组选和值
exports.sxzxH3hz=function(bet, kj){
kj=kj.substr(4,5).split(',');
bet=bet.split(',');
var bz=kj.join();
if(bz.match(/(\d),\1,\1/)) alert(0);
var m=parseInt(kj[0])+parseInt(kj[1])+parseInt(kj[2]);
 for(var i=0;i<bet.length;i++){
  if(m==bet[i]){
    if(isRepeat(kj)){ return 2;break;}else{return 1;break;}
  }
 }
}

// 后三特殊号码
exports.sxzxH3ts=function(bet, kj){
kj=kj.substr(4,5).split(',').sort();
bet=bet.split(',');
 for(var i=0;i<kj.length;i++){
  if(kj[i]==kj[i+1]){
      if(bet.indexOf('对子')!=-1){return 1;break;}else{return 0;break;}
  }
  if(kj[i]==kj[i+1]-1 && kj[i+1]==kj[i+2]-1){
      if(bet.indexOf('顺子')!=-1){return 4;break;}else{return 0;break;}
  }
  if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2]){
      if(bet.indexOf('豹子')!=-1){return 27;break;}else{return 0;break;}
  }
 }
}

// 后三直选跨度
exports.sxzxH3kd=function(bet, kj){
kj=kj.substr(4,5).split(',').sort();
bet=bet.split(',').join('');;
var m=(parseInt(kj[2])-parseInt(kj[0])).toString().split('');
if(bet.indexOf(m)!=-1){return 1;}else{return 0;}
}
//}}}

//{{{ 二星直选

// 前二复式
exports.rxwfQ2f=function(bet, kj){
	return fs(bet, kj.substr(0,3));
}

// 前二单式
exports.rxwfQ2d=function(bet, kj){
	return ds(bet, kj.substr(0,3));
}

// 后二复式
exports.rxwfH2f=function(bet, kj){
	return fs(bet, kj.substr(6,3));
}

// 后二单式
exports.rxwfH2d=function(bet, kj){
	return ds(bet, kj.substr(6,3));
}

// 前二和值
exports.sscq2zhixhz=function(bet, kj){
var k=0;kj=kj.split(',');bet=bet.split(',');
var m=(parseInt(kj[0])+parseInt(kj[1]));
  for(i=0;i<bet.length;i++){
     if(bet[i]==m) k+=1;
  }
return k;
}

// 后二和值
exports.ssch2zhixhz=function(bet, kj){
var k=0;kj=kj.split(',');bet=bet.split(',');
var m=(parseInt(kj[3])+parseInt(kj[4]));
  for(i=0;i<bet.length;i++){
     if(bet[i]==m) k+=1;
  }
return k;
}

// 前二组选和值
exports.sscq2zhixhz=function(bet, kj){
var k=0;kj=kj.split(',');bet=bet.split(',');
if(kj[0]==kj[1]) return 0;
var m=(parseInt(kj[0])+parseInt(kj[1]));
  for(i=0;i<bet.length;i++){
     if(bet[i]==m) k+=1;
  }
return k;
}

// 后二组选和值
exports.ssch2zhuxhz=function(bet, kj){
var k=0;kj=kj.split(',');bet=bet.split(',');
if(kj[3]==kj[4]) return 0;
var m=(parseInt(kj[3])+parseInt(kj[4]));
  for(i=0;i<bet.length;i++){
     if(bet[i]==m) k+=1;
  }
return k;
}

// 任选二复式
exports.rxwfR2f=exports.sxwfR3f;

// 任选二单式
exports.rxwfR2d=exports.sxwfR3d;

//}}}

//{{{ 二星组选

// 前二组复式
exports.rxzxQ2f=function(bet, kj){
	return z2f(bet, kj.substr(0,3));
}

// 前二组单式
exports.rxzxQ2d=function(bet, kj){
	return z2d(bet, kj.substr(0,3));
}

// 后二组复式
exports.rxzxH2f=function(bet, kj){
	return z2f(bet, kj.substr(6,3));
}

// 后二组单式
exports.rxzxH2d=function(bet, kj){
	return z2d(bet, kj.substr(6,3));
}

// 任选二组选复式
exports.rxzxR2f=function(bet, kj, w){
	kj=kj.split(',');
	[16, 8, 4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	return z2f(bet, kj);
}

// 任选二组选单式
exports.rxzxR2d=function(bet, kj, w){
	kj=kj.split(',');
	[16, 8, 4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	//console.log(kj);
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	bet=bet.split('|').map(function(b){
		b=b.split(',');
		[16, 8, 4, 2, 1].forEach(function(v, i){
			if((w&v)==0) delete b[i];
		});
		return b.filter(function(v){
			return v!=undefined;
		}).join(',');
	}).join('|');
	
	return z2d(bet, kj);
}

// 前二组包胆
exports.rxzxQ2bd=function(bet, kj){
kj=kj.substr(0,3).split(',');
if(kj[0]!=kj[1]){
   if(kj.indexOf(bet)!=-1){
       return 9;
   }else{return 0;}
}else{return 0;}
}

// 后二组包胆
exports.rxzxH2bd=function(bet, kj){
kj=kj.substr(6,3).split(',');
if(kj[0]!=kj[1]){
   if(kj.indexOf(bet)!=-1){
       return 9;
   }else{return 0;}
}else{return 0;}
}
//{{{ 五星定位胆

exports.dwd5x=function(bet, kj){
	kj=kj.split(',');
	var count=0;
	bet.split(',').map(function(v, i){
		if(v.length>1){
			v.split('').map(function(s){
				if(s==kj[i]) count++;
			});
		}else{
			if(v==kj[i]) count++;
		}
	});
	return count;
}

//{{{ 十星定位胆

exports.dwd10x=function(bet, kj){
	kj=kj.split(',');
	var count=0;
	
	bet.split(',').map(function(v, i){
		if(v.length>2){
			v.split(' ').map(function(s){
				if(s==kj[i]) count++;
			});
		}else{
			if(v==kj[i]) count++;
		}
	});
	
	return count;
}

//}}}

//{{{ 不定胆

// 后三不定胆
exports.bddH3=function(bet, kj){
	kj=kj.substr(4,5);
	bet=bet.split('').filter(function(v){
		return kj.indexOf(v)!=-1;
	});
	
	return bet.length;
}

// 前三不定胆
exports.bddQ3=function(bet, kj){
	kj=kj.substr(0,5);
	bet=bet.split('').filter(function(v){
		return kj.indexOf(v)!=-1;
	});
	return bet.length;
}

// 中三不定胆
exports.bddZ3=function(bet, kj){
	kj=kj.substr(2,5);
	bet=bet.split('').filter(function(v){
		return kj.indexOf(v)!=-1;
	});
	
	return bet.length;
}

// 任选三不定胆
exports.bddR3=function(bet, kj, w){
	kj=kj.split(',');
	[16, 8, 4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');	
	bet=bet.split('').filter(function(v){
		return kj.indexOf(v)!=-1;
	});
	return bet.length;
}
// 前三二码  二码不定位
exports.bdwQ32=function(bet, kj){
kj=filterArray(kj.substr(0,5).split(','));bet=bet.split(' ');
if(bet.length<kj.length){
	  if(Sames(kj,bet)>=2) return Combination(Sames(kj,bet),2);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=2) return Combination(Sames(bet,kj),2);
  }
}

// 后三二码
exports.bdwH32=function(bet, kj){
kj=filterArray(kj.substr(4,5).split(','));bet=bet.split(' ');
if(bet.length<kj.length){
	  if(Sames(kj,bet)>=2) return Combination(Sames(kj,bet),2);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=2) return Combination(Sames(bet,kj),2);
  }
}
// 五星三码
exports.bdw5x3m=function(bet, kj){
kj=filterArray(kj.split(','));bet=bet.split(' ');
if(bet.length<kj.length){
	  if(Sames(kj,bet)>=3) return Combination(Sames(kj,bet),3);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=3) return Combination(Sames(bet,kj),3);
  }
}
// 五星二码
exports.bdw5x2m=function(bet, kj){
kj=filterArray(kj.split(','));bet=bet.split(' ');
if(bet.length<kj.length){
	  if(Sames(kj,bet)>=2) return Combination(Sames(kj,bet),2);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=2) return Combination(Sames(bet,kj),2);
  }
}
// 四星二码
exports.bdw4x2m=function(bet, kj){
kj=filterArray(kj.substr(2,7).split(','));bet=bet.split(' ');
if(bet.length<kj.length){
	  if(Sames(kj,bet)>=2) return Combination(Sames(kj,bet),2);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=2) return Combination(Sames(bet,kj),2);
  }
}
// 四星一码
exports.bdw4x1m=function(bet, kj){
kj=filterArray(kj.substr(2,7).split(','));bet=bet.split(' ');
  if(bet.length<kj.length){
	  if(Sames(kj,bet)>=1) return Sames(kj,bet);
  }else if(bet.length>=kj.length){
	  if(Sames(bet,kj)>=1) return Sames(bet,kj);
  }
}
//}}}

//{{{ 大小单双

// 前二大小单双
exports.dsQ2=function(bet, kj){
	return dxds(bet, kj.substr(0,3));
}

// 前三大小单双
exports.dsQ3=function(bet, kj){
	return dxds(bet, kj.substr(0,5));
}

// 后二大小单双
exports.dsH2=function(bet, kj){
	return dxds(bet, kj.substr(6,3));
}
// 后三大小单双
exports.dsH3=function(bet, kj){
	return dxds(bet, kj.substr(4,5));
}

// 任选二大小单双
exports.dsR2=function(bet, kj, w){
	kj=kj.split(',');
	bet=bet.split(',').filter(function(v, i){
		if(v=='-'){
			delete kj[i];
		}else{
			return v;
		}
	}).join(',');
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	return dxds(bet, kj);
}

// 时时彩结束

//{{{ 福彩3D

// 三星直选－复式
exports.fc3dFs=fs;

// 三星直选－单式
exports.fc3dDs=ds;

// 三星直选和值
exports.fc3dhz=function(bet, kj){
bet=bet.split(',');kj=kj.split(',');var count=0;
var a=parseInt(kj[0])+parseInt(kj[1])+parseInt(kj[2]);
if(bet.indexOf(a)!=-1) count+=1;
return count;
}

// 三星组选－组三
exports.fc3dZ3=z3;

// 三星组选－组六
exports.fc3dZ6=z6;

// 三星组选和值
exports.fc3d_zxhz=function(bet, kj){
bet=bet.split(',');kj=kj.split(',');
var kkjj=kj.concat().join(',');
if(kkjj.match(/(\d),\1,\1/)) return 0;
var a=parseInt(kj[0])+parseInt(kj[1])+parseInt(kj[2]);
if(bet.indexOf(a)!=-1)
	if(isRepeat(kj)){ return 2;}else{return 1;}
}

// 二星直选－前二单式
exports.fc3dQ2d=exports.rxwfQ2d;

// 二星直选－前二复式
exports.fc3dQ2f=exports.rxwfQ2f;

// 二星直选－后二单式
exports.fc3dH2d=function(bet, kj){
	return ds(bet, kj.substr(2,5));
}

// 二星直选－后二复式
exports.fc3dH2f=function(bet, kj){
	return fs(bet, kj.substr(2,5));
}

// 二星组选－前二组选单式
exports.fc3dZQ2d=exports.rxzxQ2d;

// 二星组选－前二组选复式
exports.fc3dZQ2f=exports.rxzxQ2f;

// 二星组选－后二组选单式
exports.fc3dZH2d=function(bet, kj){
	return z2d(bet, kj.substr(2,5));
}

// 二星组选－后二组选复式
exports.fc3dZH2f=function(bet, kj){
	return z2f(bet, kj.substr(2,5));
}

// 三星定位胆
exports.fc3d3xdw=exports.dwd5x;

// 不定胆
exports.fc3dbdd=exports.bddQ3;

// 后二大小单双
exports.fc3dH2dxds=function(bet, kj){
	return dxds(bet, kj.substr(2,3));
}

// 任选二大小单双
exports.fc3dR2dxds=function(bet, kj, w){
	kj=kj.split(',');
	[4, 2, 1].forEach(function(v, i){
		if((w&v)==0) delete kj[i];
	});
	kj=kj.filter(function(v){
		return v!=undefined;
	}).join(',');
	
	return dxds(bet, kj);
}
//}}}

// 趣味玩法  一帆风顺
exports.qwwfyffs=function(bet, kj){
	kj=filterArray(kj.split(',').sort());bet=bet.split(' ');
	if(kj.length>=bet.length){
		if(Sames(kj,bet)>=1){return Sames(kj,bet);}else{return 0;}
	}else{
		if(Sames(bet,kj)>=1){return Sames(bet,kj);}else{return 0;}
	}
}
// 趣味玩法  好事成双
exports.qwwfhscs=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(' ');var kjs="";
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1]){
         kjs+=kj[i];
      }
 }
 if(Sames(bet,kjs.split(''))>=1){
   return 1;
 }else{return 0;}
}

// 趣味玩法  三星报喜
exports.qwwfsxbx=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(' ');var kjs="";
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2]){
         kjs+=kj[i];break;
      }
 }
if(Sames(bet,kjs.split(''))==1){
   return 1;
}else{return 0;}
}

// 趣味玩法  四季发财
exports.qwwfsjfc=function(bet, kj){
kj=kj.split(',').sort();bet=bet.split(' ');var kjs="";
for(var i=0;i<kj.length;i++){
      if(kj[i]==kj[i+1] && kj[i+1]==kj[i+2] && kj[i+2]==kj[i+3]){
         kjs+=kj[i];break;
      }
 }
if(Sames(bet,kjs.split(''))==1){
   return 1;
}else{return 0;}
}

// 趣味玩法  前三趣味二星
exports.qwwfq3qw2x=function(bet, kj){
kj=kj.substr(0,5).split(',');bet=bet.split(',');
var bet0=bet[0].split('');var bet1=bet[1].split('');var bet2=bet[2].split('');
if(bet[1].indexOf(kj[1])!=-1){
        if(bet[2].indexOf(kj[2])!=-1){
            if(kj[0]<5){
               if(bet[0].indexOf('小')!=-1){return 2;}else{return 1;}
              }else{
               if(bet[0].indexOf('大')!=-1){return 2;}else{return 1;}
            }
        }else{ return 0;}
}else{ return 0;}
}

// 趣味玩法  后三趣味二星
exports.qwwfh3qw2x=function(bet, kj){
kj=kj.substr(4,5).split(',');bet=bet.split(',');
var bet0=bet[0].split('');var bet1=bet[1].split('');var bet2=bet[2].split('');
if(bet[1].indexOf(kj[1])!=-1){
        if(bet[2].indexOf(kj[2])!=-1){
            if(kj[0]<5){
               if(bet[0].indexOf('小')!=-1){return 2;}else{return 1;}
              }else{
               if(bet[0].indexOf('大')!=-1){return 2;}else{return 1;}
            }
        }else{ return 0;}
}else{ return 0;}
}

// 趣味玩法  四码趣味三星
exports.qwwf4mqw3x=function(bet, kj){
kj=kj.substr(2,7).split(',');bet=bet.split(',');
var bet0=bet[0].split('');var bet1=bet[1].split('');var bet2=bet[2].split('');var bet3=bet[3].split('');
if(bet[1].indexOf(kj[1])!=-1){
     if(bet[2].indexOf(kj[2])!=-1){
		 if(bet[3].indexOf(kj[3])!=-1){
            if(kj[0]<5){
               if(bet[0].indexOf('小')!=-1){return 2;}else{return 1;}
              }else{
               if(bet[0].indexOf('大')!=-1){return 2;}else{return 1;}
            }
		 }else{ return 0;}
     }else{ return 0;}
}else{ return 0;}
}

// 趣味玩法  五码趣味三星
exports.qwwf5mqw3x=function(bet, kj){
kj=kj.split(',');bet=bet.split(',');
var bet0=bet[0].split('');var bet1=bet[1].split('');var bet2=bet[2].split('');var bet3=bet[3].split('');var bet4=bet[4].split('');
if(bet2.indexOf(kj[2])!=-1){
   if(bet3.indexOf(kj[3])!=-1){
      if(bet4.indexOf(kj[4])!=-1){
         if(kj[0]<5){
           if(kj[1]<5){
             if(bet0.indexOf('小')!=-1){
               if(bet1.indexOf('小')!=-1){
                    return 8;
               }else{return 1;}
             }else{return 1;}
           }     
         }
         if(kj[0]>=5){
           if(kj[1]>=5){
            if(bet0.indexOf('大')!=-1){
               if(bet1.indexOf('大')!=-1){
                    return 8;
               }else{return 1;}
             }else{return 1;}
           }     
         }
         if(kj[0]>=5){
           if(kj[1]<5){
            if(bet0.indexOf('大')!=-1){
               if(bet1.indexOf('小')!=-1){
                    return 8;
               }else{return 1;}
             }else{return 1;}
           }     
         }
         if(kj[0]<5){
           if(kj[1]>=5){
            if(bet0.indexOf('小')!=-1){
               if(bet1.indexOf('大')!=-1){
                    return 8;
               }else{return 1;}
             }else{return 1;}
           }     
         }
      }else{return 0;}
   }else{return 0;}
}else{return 0;}
}
//{{{ 十一选五玩法
// 任选一
exports.gd11x5R1=function(bet, kj){
	bet=bet.split(' ');kj=kj.split(',');
    if(bet.length>kj.length){
		return Sames(bet,kj);
	}else if(kj.length>bet.length){
		return Sames(kj,bet);
	}else{
		return Sames(kj,bet);
    }
}
// 任选一单式
exports.gd11x5R1ds=function(bet, kj){
	kj=kj.split(',');
	if(kj.indexOf(bet)!=-1) return 1;
}
exports.gd11x5R2=function(bet, kj){
	return rx(bet, kj, 2);
}
// 任选二单式
exports.gd11x5R2ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(kj,bet)==2) return 1;
}
exports.gd11x5R3=function(bet, kj){
	return rx(bet, kj, 3);
}
// 任选三单式
exports.gd11x5R3ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(kj,bet)==3) return 1;
}
exports.gd11x5R4=function(bet, kj){
	return rx(bet, kj, 4);
}
// 任选四单式
exports.gd11x5R4ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(kj,bet)==4) return 1;
}
exports.gd11x5R5=function(bet, kj){
	return rx(bet, kj, 5);
}
// 任选五单式
exports.gd11x5R5ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(kj,bet)==5) return 1;
}
exports.gd11x5R6=function(bet, kj){
	return rx(bet, kj, 6);
}
// 任选六单式
exports.gd11x5R6ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(bet,kj)==5) return 1;
}
exports.gd11x5R7=function(bet, kj){
	return rx(bet, kj, 7);
}
// 任选七单式
exports.gd11x5R7ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(bet,kj)==5) return 1;
}
exports.gd11x5R8=function(bet, kj){
	return rx(bet, kj, 8);
}
// 任选八单式
exports.gd11x5R8ds=function(bet, kj){
	kj=kj.split(',');bet=strCut(bet,2);
	if(Sames(bet,kj)==5) return 1;
}
exports.gd11x5R9=function(bet, kj){
	return rx(bet, kj, 9);
}
exports.gd11x5R10=function(bet, kj){
	return rx(bet, kj, 10);
}

// 前一直选
exports.gd11x5Q1=function(bet, kj){
	kj=kj.split(',');bet=bet.split(' ');
    for(var i=0;i<bet.length;i++){
		if(parseInt(kj[0])==parseInt(bet[i])){return 1;break;}
	}
}

// 前二直选
exports.gd11x5Q2=function(bet, kj){
	return qs(bet, kj, 2);
}

// 前二组选
exports.gd11x5Q2z=function(bet, kj){
	return zx(bet, kj.substr(0,5));
}

// 前三直选
exports.gd11x5Q3=function(bet, kj){
	return qs(bet, kj, 3);
}

// 前三组选
exports.gd11x5Q3z=function(bet, kj){
	return zx(bet, kj.substr(0,8));
}

// 前四组选
exports.gd11x5Q4z=function(bet, kj){
	return zx(bet, kj.substr(0,11));
}

// 定位胆
exports.gd11x5dwd=function(bet, kj){
kj=kj.substr(0,8).split(',');bet=bet.split(',');var bets="";
if(bet[0].split(' ').indexOf(kj[0])!=-1) bets+=kj[0];
if(bet[1].split(' ').indexOf(kj[1])!=-1) bets+=kj[1];
if(bet[2].split(' ').indexOf(kj[2])!=-1) bets+=kj[2];
    return bets.length/2;
}

// 不定位
exports.gd11x5bdw=function(bet, kj){
kj=kj.substr(0,8).split(',');bet=bet.split(' ');
    return Sames(bet,kj);
}

// 趣味_猜中位
exports.qwwfczw=function(bet, kj){
    bet=bet.split(' ');var zs="";
    kj=kj.split(',').sort(function compare(a,b){return a-b;});
    for(var i=0;i<bet.length;i++){
       if(kj[2]==bet[i]) zs+=bet[i];
    }
	return zs.length/2;
}
// 趣味_定单双
exports.qwwfdds=function(bet, kj){
var ds="";var ss="";var zs="";
var num=bet.replace(/[^0-9]/ig,"");
var k=strCut(num,2);
var h=k.join(',').split(',');
kj=kj.split(',');
for(var i=0;i<kj.length;i++){
   if(kj[i]%2==0){ss+=kj[i];}else{ds+=kj[i];}
}
ds=ds.length/2;ds=ds.toString();
ss=ss.length/2;ss=ss.toString();
m=parseInt(ds+ss);
for(j=0;j<h.length;j++){
   if(m==h[j]) zs+=h[j];
}
return zs.length/2;
}
 
//{{{ 快乐十分玩法
// 任选一 选一数投
exports.klsfR1B=function(bet, kj){
	return bet.split(' ').filter(function(v){
		return kj.substr(0,2).indexOf(v)!=-1;
	}).length;
}

// 任选一 选一红投
exports.klsfR1R=function(bet, kj){
	return bet.split(' ').filter(function(v){
		return kj.substr(0,2).indexOf(v)!=-1;
	}).length;
}
exports.klsfR2=function(bet, kj){
	return rx(bet, kj, 2);
}
exports.klsfR3=function(bet, kj){
	return rx(bet, kj, 3);
}
exports.klsfR4=function(bet, kj){
	return rx(bet, kj, 4);
}
exports.klsfR5=function(bet, kj){
	return rx(bet, kj, 5);
}

// 前二直选
exports.klsfQ2=function(bet, kj){
	return qs(bet, kj, 2);
}

// 前二组选
exports.klsfQ2z=function(bet, kj){
	return zx(bet, kj.substr(0,5));
}

// 前三直选
exports.klsfQ3=function(bet, kj){
	return qs(bet, kj, 3);
}

// 前三组选
exports.klsfQ3z=function(bet, kj){
	return zx(bet, kj.substr(0,8));
}

//}}}


// 
//{{{ 北京PK10玩法 1至10位开奖

// 冠军
exports.kjq1=function(betData, kjData){
	return qs(betData, kjData, 1);
}
// 冠亚军
exports.kjq2=function(betData, kjData){
	return qs(betData, kjData, 2);
}

// 前三
exports.kjq3=function(betData, kjData){
	return qs(betData, kjData, 3);
}
// 定位胆 exports.dwd10x
// 
exports.pk10lmdxds1=function(betData, kjData){
	return dxds2(betData, kjData.substr(0,2));
}
exports.pk10lmdxds2=function(betData, kjData){
	return dxds2(betData, kjData.substr(3,2));
}
exports.pk10lmdxds3=function(betData, kjData){
	return dxds2(betData, kjData.substr(6,2));
}
exports.pk10lmdxds4=function(betData, kjData){
	return dxds2(betData, kjData.substr(9,2));
}
exports.pk10lmdxds5=function(betData, kjData){
	return dxds2(betData, kjData.substr(12,2));
}
exports.pk10lmdxds6=function(betData, kjData){
	return dxds2(betData, kjData.substr(15,2));
}
exports.pk10lmdxds7=function(betData, kjData){
	return dxds2(betData, kjData.substr(18,2));
}
exports.pk10lmdxds8=function(betData, kjData){
	return dxds2(betData, kjData.substr(21,2));
}
exports.pk10lmdxds9=function(betData, kjData){
	return dxds2(betData, kjData.substr(24,2));
}
exports.pk10lmdxds10=function(betData, kjData){
	return dxds2(betData, kjData.substr(27,2));
}
exports.pk10lmdxds22=function(bet, kj){
	kj=kj.split(',');
	val=parseInt(kj[0],10)+parseInt(kj[1],10);
	bet=bet.split('');
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i]=='大'){
				if(val>11 && val<20) count+=1;
				}
			else if(bet[i]=='小'){
				if(val>2 && val<12) count+=1;
			}else if(bet[i]=='单'){
				if(val%2!=0) count+=1;
			}else if(bet[i]=='双'){
				if(val%2==0) count+=1;
				}else{}
		}
	return count;
}
exports.pk10lmdxds33=function(betData, kjData){
	kjData=kjData.split(',');
	var gyzh=parseInt(kjData[0],10)+parseInt(kjData[1],10)+parseInt(kjData[2],10);
	return DescartesAlgorithm.apply(null, betData.split(',').map(function(v){return v.split('')}))
	.filter(function(v){
		//console.log(v);
		var o={
			'大':'17,18,19,20,21,22,23,24,25,26,27',
			'小':'6,7,8,9,10,11,12,13,14,15,16',
			'单':'7,9,11,13,15,17,19,21,23,25,27',
			'双':'6,8,10,12,14,16,18,20,22,24,26'
		};
		//throw(v[0]);
		return o[v[0]].indexOf(gyzh)!=-1
	})
	.length;
}

//冠亚季选一
exports.pk10r123=function(bet, kj){
	return rx(bet, kj.substr(0,8), 1);
	/*return bet.split(' ').filter(function(v){
		return kj.substr(0,8).indexOf(v)!=-1;
	}).length;*/
}


// 冠亚总和
exports.pk10gy2=function(bet, kj){
	kj=kj.split(',');
	val=parseInt(kj[0],10)+parseInt(kj[1],10);
	bet=bet.split(' ');
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(parseInt(bet[i],10)==val){
				count+=1;
			}else{}
		}
	return count;
}

//冠亚组合
exports.pk10gyzh=function(bet, kj){
	kj=kj.split(',');
	val1=parseInt(kj[0],10);
	val2=parseInt(kj[1],10);
	str1=val1+'-'+val2;
	str2=val2+'-'+val1;
	bet=bet.split(' ');
	count=0;
	//console.log(str1);
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i]==str1 || bet[i]==str2){
				count+=1;
			}else{}
		}
	return count;
}

//龙虎
exports.pk10lh1=function(bet, kj){
	return pk10lh(bet, kj, 1);
}
exports.pk10lh2=function(bet, kj){
	return pk10lh(bet, kj, 2);
}
exports.pk10lh3=function(bet, kj){
	return pk10lh(bet, kj, 3);
}
exports.pk10lh4=function(bet, kj){
	return pk10lh(bet, kj, 4);
}
exports.pk10lh5=function(bet, kj){
	return pk10lh(bet, kj, 5);
}
exports.pk10lh12=function(bet, kj){
	kj=kj.split(',');
	val1=parseInt(kj[0],10)+parseInt(kj[1],10);
	val2=parseInt(kj[9],10)+parseInt(kj[8],10);
	bet=bet.split('');
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i]=='龙'){
				if(val1>val2) count+=1;
				}
			else if(bet[i]=='虎'){
				if(val1<val2) count+=1;
				}else{}
		}
	return count;
}
exports.pk10lh123=function(bet, kj){
	kj=kj.split(',');
	val1=parseInt(kj[0],10)+parseInt(kj[1],10)+parseInt(kj[2],10);
	val2=parseInt(kj[9],10)+parseInt(kj[8],10)+parseInt(kj[7],10);
	bet=bet.split('');
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i]=='龙'){
				if(val1>val2) count+=1;
				}
			else if(bet[i]=='虎'){
				if(val1<val2) count+=1;
				}else{}
		}
	return count;
}

// 前二组选
exports.kjzx2=function(bet, kj){
	return zx(bet, kj.substr(0,5));
}

// 前三组选
exports.kjzx3=function(bet, kj){
	return zx(bet, kj.substr(0,8));
}
//}}}

//北京快乐8
exports.k8R1=function(bet, kj){
	return rx(bet, kj.split("|")[0], 1);
}
exports.k8R2=function(bet, kj){
	return rx(bet, kj.split("|")[0], 2);
}
exports.k8R3=function(bet, kj){
	return rx(bet, kj.split("|")[0], 3);
}
exports.k8R4=function(bet, kj){
	return rx(bet, kj.split("|")[0], 4);
}
exports.k8R5=function(bet, kj){
	return rx(bet, kj.split("|")[0], 5);
}
exports.k8R6=function(bet, kj){
	return rx(bet, kj.split("|")[0], 6);
}
exports.k8R7=function(bet, kj){
	return rx(bet, kj.split("|")[0], 7);
}


//快3
// 和值
exports.k3hz=function(bet, kj){
	kj=kj.split(',');
	bet=bet.split(' ');
	var val=parseInt(kj[0])+parseInt(kj[1])+parseInt(kj[2]);
	var count=0;
	for (var i=0;i<bet.length;i++){
			if(parseInt(bet[i])==val){
				count+=1;
			}else{}
		}
	return count;
}

// 三同号通选
exports.k33tx=function(bet, kj){
	kj=kj.replace(/\,/g,"");
	count=0;
	if(bet.indexOf(kj)!=-1) count=1;
	return count;
}

// 三连号通选
exports.k33ltx=exports.k33tx

// 三同号单选
exports.k33dx=function(bet, kj){
	bet=bet.replace(/\*/g,"");
	bet=bet.split(',');
	kj=kj.split(',');
	kj1=kj[0]+kj[1];
	kj2=kj[2];
	kj=kj1+","+kj2;
	return kj.split(',')
	.some(function(v,i){
		return bet[i].indexOf(v)==-1;
	})?0:1;
}

// 三不同号
exports.k33x=function(bet, kj){
	return zx(bet, kj);
}

// 二不同号
exports.k32x=exports.k33x


// 二同号复选
exports.k32fx=function(bet, kj){
bet=bet.replace(/\*/g,"").replace(/\ /g,"").split('');kj=kj.split(',');
if(Sames(kj,bet)==2){return 1;}else{return 0;}
}

// 二同号单选
exports.k32dx=function(bet, kj){
	bet=bet.split(' ');
	kj=kj.replace(/\,/g,"");
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i].indexOf(kj)!=-1) count=1;
		}
	return count;
}

/*特别号*/
exports.SP=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	if(bet==kjtm) count=1;
	return count;
}
exports.SPBSOE=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	switch(bet){
		case '特大':
		if(parseInt(kjtm)>24 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '特小':
		if(parseInt(kjtm)<25) count=1;
		break;
		
		case '特单':
		if(parseInt(kjtm) % 2 != 0 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '特双':
		if(parseInt(kjtm) % 2 == 0) count=1;
		break;
	}

	return count;
}

exports.SPTBSOE=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	var kjtmh=kjtm.split('');
	var val=parseInt(kjtmh[0],10)+parseInt(kjtmh[1],10);
	switch(bet){
		case '合大':
		if(parseInt(val)>6 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '合小':
		if(parseInt(val)<7 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '合单':
		if(parseInt(val) % 2 != 0 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '合双':
		if(parseInt(val) % 2 == 0 && parseInt(kjtm)!=49) count=1;
		break;
	}

	return count;
}

exports.SPSBS=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	var kjtmh=kjtm.split('');
	var val=parseInt(kjtmh[1],10);
	switch(bet){
		case '特尾大':
		if(parseInt(val)>4 && parseInt(kjtm)!=49) count=1;
		break;
		
		case '特尾小':
		if(parseInt(val)<5 && parseInt(kjtm)!=49) count=1;
		break;
	}

	return count;
}

exports.SPH2=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	switch(bet){
		case '大单':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 != 0) count=1;
		break;
		
		case '大双':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 == 0) count=1;
		break;
		
		case '小单':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 != 0) count=1;
		break;
		
		case '小双':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 == 0) count=1;
		break;
	}

	return count;
}

/*生肖头尾*/
exports.SPANM=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	if(CheckANM(kjtm,bet)) count=1; 
	return count;
}

exports.SPTD=function(bet, kj){
	bet=bet.replace(new RegExp("头","g"),'');
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	var kjtmh=kjtm.split('');
	var val=parseInt(kjtmh[0],10);
	if(parseInt(val)==parseInt(bet)) count=1;
	return count;
}

exports.SPSD=function(bet, kj){
	bet=bet.replace(new RegExp("尾","g"),'');
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	var kjtmh=kjtm.split('');
	var val=parseInt(kjtmh[1],10);
	if(parseInt(val)==parseInt(bet)) count=1;
	return count;
}

/*波色*/
exports.SPCLR=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	if(CheckCLR(kjtm,bet)) count=1; 
	return count;
}
exports.SPHC=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	switch(bet){
		case '红大':
		if(parseInt(kjtm)>24 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红小':
		if(parseInt(kjtm)<25 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红单':
		if(parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红双':
		if(parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '蓝大':
		if(parseInt(kjtm)>24 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝小':
		if(parseInt(kjtm)<25 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝单':
		if(parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝双':
		if(parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '绿大':
		if(parseInt(kjtm)>24 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿小':
		if(parseInt(kjtm)<25 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿单':
		if(parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿双':
		if(parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
	}
	return count;
}

exports.SPHHC=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var kjtm=kj[6];
	switch(bet){
		case '红大单':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红大双':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红小单':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '红小双':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'红波')) count=1;
		break;
		
		case '蓝大单':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝大双':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝小单':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '蓝小双':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'蓝波')) count=1;
		break;
		
		case '绿大单':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿大双':
		if(parseInt(kjtm)>24 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿小单':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 != 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
		
		case '绿小双':
		if(parseInt(kjtm)<25 && parseInt(kjtm) % 2 == 0 && CheckCLR(kjtm,'绿波')) count=1;
		break;
	}
	return count;
}
/*正码平码*/
exports.LOTTO=function(bet, kj){
	var count=0;
	var kj=kj.removeFromList(',', 6);
	if(kj.indexOf(bet)!=-1) count=1;
	return count;
}
exports.LTTBSOE=function(bet, kj){
	var count=0;
	var kj=kj.split(',');
	var val=0;
	for(var i=0;i<kj.length;i++){
		val+=parseInt(kj[i],10);
	}
	
	switch(bet){
		case '总大':
		if(parseInt(val)>174) count=1;
		break;
		
		case '总小':
		if(parseInt(val)<175) count=1;
		break;
		
		case '总单':
		if(parseInt(val) % 2 != 0) count=1;
		break;
		
		case '总双':
		if(parseInt(val) % 2 == 0) count=1;
		break;
	}
	return count;
}

/*平特肖尾 一肖 正特尾数*/
exports.LTTBP=function(bet, kj){
	bet=GetANM(bet);
	return bet.split(',').filter(function(v){
		return kj.indexOf(v)!=-1;
	}).length;
}
exports.LTTSD=function(bet, kj){
	var count=0;
	bet=bet.replace(new RegExp("尾","g"),'');
	kj=kj.split(',').map(function(v){return v.split('')[1].split('').join(',')});
	if(kj.indexOf(bet)!=-1) count=1;
	return count;
}

/*连肖*/
exports.SNBP2=function(bet, kj){
	return SNBP(bet, kj, 2);
}
exports.SNBP3=function(bet, kj){
	return SNBP(bet, kj, 3);
}
exports.SNBP4=function(bet, kj){
	return SNBP(bet, kj, 4);
}
exports.SNBP5=function(bet, kj){
	return SNBP(bet, kj, 5);
}

//连肖函数
function SNBP(bet, kj, num){
	var hbet='';
	return combine(bet.split(' '), num).filter(function(v){
		
		return v.every(function(c){
				hbet=GetANM(c);
				return hbet.split(',').some(function(v,i){
					return kj.indexOf(v)!=-1;
					
				});
			});
	}).length;
}

/*连尾*/
exports.SNSD2=function(bet, kj){
	return SNSD(bet, kj, 2);
}
exports.SNSD3=function(bet, kj){
	return SNSD(bet, kj, 3);
}
exports.SNSD4=function(bet, kj){
	return SNSD(bet, kj, 4);
}
exports.SNSD5=function(bet, kj){
	return SNSD(bet, kj, 5);
}

//连尾函数
function SNSD(bet, kj, num){
	bet=bet.replace(new RegExp("尾","g"),'');
	kj=kj.split(',').map(function(v){return v.split('')[1].split('').join(',')});
	return combine(bet.split(' '), num).filter(function(v){
		
		return v.some(function(c){
				return kj.indexOf(c)!=-1;
			});
	}).length;
}


/*连码*/
exports.LM4OF4=function(bet, kj){
	return rx(bet, kj.removeFromList(',', 6), 4);
}
exports.LM3OF3=function(bet, kj){
	return rx(bet, kj.removeFromList(',', 6), 3);
}
exports.LM2OF2=function(bet, kj){
	return rx(bet, kj.removeFromList(',', 6), 2);
}
//三中二
exports.LM2OF3=function(bet, kj){
	var num=0;
	var kj=kj.removeFromList(',', 6);
	var	count=combine(bet.split(' '), 3)
	.filter(function(v){
		num=0;
		v.every(function(c){
			if(kj.indexOf(c)!=-1) num+=1;
		});
		if(num==2){return true;}else{return false;}
	}).length;
	if(parseInt(count)<1){
		count=exports.LM3OF3;
	}
	return count;

}
//二中特
exports.LMSPOF2=function(bet, kj){
	var	count=exports.LM2OF2;
	if(parseInt(count)<1){
		count=exports.LMSPOF;
	}
	return count;
}
//特串
exports.LMSPOF=function(bet, kj){
	var kj2=kj.removeFromList(',', 6);
	var kjtm=kj.split(',')[6];
	return combine(bet.split(' '), 2)
	.filter(function(v){
		return (kj2.indexOf(v[0])!=-1 && kjtm.indexOf(v[1])!=-1)||(kj2.indexOf(v[1])!=-1 && kjtm.indexOf(v[0])!=-1);
	}).length;
}


/*自选不中*/
exports.NOHIT5=function(bet, kj){
	return NOHIT(bet, kj, 5);
}
exports.NOHIT6=function(bet, kj){
	return NOHIT(bet, kj, 6);
}
exports.NOHIT7=function(bet, kj){
	return NOHIT(bet, kj, 7);
}
exports.NOHIT8=function(bet, kj){
	return NOHIT(bet, kj, 8);
}
exports.NOHIT9=function(bet, kj){
	return NOHIT(bet, kj, 9);
}
exports.NOHIT10=function(bet, kj){
	return NOHIT(bet, kj, 10);
}
exports.NOHIT11=function(bet, kj){
	return NOHIT(bet, kj, 11);
}
exports.NOHIT12=function(bet, kj){
	return NOHIT(bet, kj, 12);
}

/*自选不中函数*/
function NOHIT(bet, kj, num){
	return combine(bet.split(' '), num)
		.filter(function(v){
			if(num<7){
				return v.every(function(c){
					return kj.indexOf(c)==-1;
				});
			}else{
				return kj.split(',').every(function(c){
					return v.indexOf(c)==-1;
				});
			}
	}).length;
}



//判断生肖
function CheckANM(bet,xs){
	var xsbet,flag=false;
	switch(xs){
		case '鼠':
		xsbet='09,21,33,45';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '牛':
		xsbet='08,20,32,44';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '虎':
		xsbet='07,19,31,43';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '兔':
		xsbet='06,18,30,42';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '龙':
		xsbet='05,17,29,41';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '蛇':
		xsbet='04,16,28,40';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '马':
		xsbet='03,15,27,39';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '羊':
		xsbet='02,14,26,38';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '猴':
		xsbet='01,13,25,37,49';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '鸡':
		xsbet='12,24,36,48';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '狗':
		xsbet='11,23,35,47';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '猪':
		xsbet='10,22,34,46';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
	}
   return flag;
}

function GetANM(xs){
	var xsbet;
	switch(xs){
		case '鼠':
		xsbet='09,21,33,45';
		break;
		
		case '牛':
		xsbet='08,20,32,44';
		break;
		
		case '虎':
		xsbet='07,19,31,43';
		break;
		
		case '兔':
		xsbet='06,18,30,42';
		break;
		
		case '龙':
		xsbet='05,17,29,41';
		break;
		
		case '蛇':
		xsbet='04,16,28,40';
		break;
		
		case '马':
		xsbet='03,15,27,39';
		break;
		
		case '羊':
		xsbet='02,14,26,38';
		break;
		
		case '猴':
		xsbet='01,13,25,37,49';
		break;
		
		case '鸡':
		xsbet='12,24,36,48';
		break;
		
		case '狗':
		xsbet='11,23,35,47';
		break;
		
		case '猪':
		xsbet='10,22,34,46';
		break;
		
	}
   return xsbet;
}

//判断波色
function CheckCLR(bet,xs){
	var xsbet,flag=false;
	switch(xs){
		case '红波':
		xsbet='01,02,07,08,12,13,18,19,23,24,29,30,34,35,40,45,46';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '蓝波':
		xsbet='03,04,09,10,14,15,20,25,26,31,36,37,41,42,47,48';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '绿波':
		xsbet='05,06,11,16,17,21,22,27,28,32,33,38,39,43,44,49';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
	}
   return flag;
}

//{{{ 常用算法

/**
 * 常用前选算法
 *
 * @params bet		投注列表：01 02 03,04 05
 * @params data		开奖所需的那几个：04,05
 * @params weizhu   开奖前几位数
 *
 * @return 			返回中奖注数
 */
function qs(bet, data, weizhu){
	
	bet=bet.split(',');
	return data.substr(0,weizhu*3-1).split(',')
	.some(function(v,i){
		return bet[i].indexOf(v)==-1;
	})?0:1;
}

/**
 * 常用复式算法
 *
 * @params bet		投注列表：123,45,2,59
 * @params data		开奖所需的那几个：4,5,0,8
 *
 * @return 			返回中奖注数
 */
function fs(bet, data){
	
	// 笛卡尔乘取得所投的号码
	return DescartesAlgorithm.apply(null, bet.split(',').map(function(v){return v.split('')}))
	
	// 把号码由数组变成字符串，以便比较
	.map(function(v){ return v.join(','); })
	
	// 过滤掉不中奖的号码
	.filter(function(v){ return v==data})
	
	// 返回中奖号码的总数
	.length;
}

/**
 * 单式算法
 *
 * @params bet		投注列表：1,5,2,9|3,2,4,6
 * @params data		开奖所需的那几位号码：4,5,3,6
 *
 * @return			返回中奖注数
 */
function ds(bet, data){
	return bet.split('|')
	.filter(function(v){ return v==data})
	.length;
}

/**
 * 组三
 *
 * @params bet		投注列表：135687或112,334
 * @params data		开奖所需的那几位号码：4,5,3
 *
 * @return			返回中奖注数
 */
function z3(bet, data){
	
	// 豹子不算中奖
	if(data.match(/^(\d),\1,\1/)) return 0;
	var reg=/(\d)\d?\1/;
	
	if(bet.indexOf(',')!=-1||reg.test(bet)){
		// 单选处理
		bet=bet.split(',');
		data=data.split(',').join('');
		
		var m=data.match(reg);
		if(!m) return 0;		// 如果三位数没有相同，则不中奖
		m=m[1];		// 重复位数
		reg=new RegExp(m, 'g')
		var s=data.replace(reg,'');	// 不重复的位数
		
		return bet.filter(function(v){
			//console.log('v:%s, s:%s', v, s);
			//console.log(reg);
			return v.replace(reg,'')==s;
		}).length;
	}else{
		// 复选处理
		bet=combine(bet.split(''),2).map(function(v){return v.join(',')});
		data=data.split(',');
		return bet.filter(function(v){
			var i=0;
			for(i in data){
				if(v.indexOf(data[i])==-1) return false;
			}
			return true;
		})
		.length;
	}

}

/**
 * 组六
 *
 * @params bet		投注列表：135687
 * @params data		开奖所需的那几位号码：4,5,3
 *
 * @return			返回中奖注数
 */
function z6(bet, data){
	
	// 豹子不算中奖
	if(data.match(/^(\d),\1,\1/)) return 0;
	
	data=permutation(data.split(','),3).map(function(v){return v.join('');});
	if(bet.indexOf(',')!=-1){
		// 录入式投注
		bet=bet.split(',');
	}else{
		// 点击按钮投注
		bet=combine(bet.split(""),3).map(function(v){return v.join("");});
	}
	return bet.filter(function(v){return data.indexOf(v)!=-1}).length;
}

/**
 * 组二复式
 *
 * @params bet		投注列表：135687
 * @params data		开奖所需的那几位号码：4,5
 *
 * @return			返回中奖注数
 */
function z2f(bet, data){
	// 对子不算中奖
	if(data.match(/^(\d),\1/)) return 0;

	data=data.split(',');
	var data1=data.join('');
	data=data.reverse().join('');
	return combine(bet.split(''), 2)
	.map(function(v){return v.join('');})
	.filter(function(v){
		return v==data||v==data1;
	}).length;
}

/**
 * 组二单式
 *
 * @params bet		投注列表：1,3|5,6|8,7
 * @params data		开奖所需的那几位号码：4,5
 *
 * @return			返回中奖注数
 */
function z2d(bet, data){
	// 对子不算中奖
	if(data.match(/^(\d),\1/)) return 0;

	var data1=data.reverse();
	return bet.split('|').filter(function(v){
		return v==data||v==data1;
	}).length;
}


/**
 * 大小单双
 *
 * @params bet		投注列表：大单,小单
 * @params data		开奖所需的那几位号码：4,5
 *
 * @return			返回中奖注数
 */
function dxds(bet, data){
	
	data=data.split(',');
	return DescartesAlgorithm.apply(null, bet.split(',').map(function(v){return v.split('')}))
	.filter(function(v){
		//console.log(v);
		var o={
			'大':'56789',
			'小':'01234',
			'单':'13579',
			'双':'02468'
		};
		//throw(v[0]);
		return o[v[0]].indexOf(data[0])!=-1 && o[v[1]].indexOf(data[1])!=-1
	})
	.length;
}

function dxds2(bet, data){
	
	data=data.split(',');
	return DescartesAlgorithm.apply(null, bet.split(',').map(function(v){return v.split('')}))
	.filter(function(v){
		//console.log(v);
		var o={
			'大':'06,07,08,09,10',
			'小':'01,02,03,04,05',
			'单':'01,03,05,07,09',
			'双':'02,04,06,08,10'
		};
		//throw(v[0]);
		return o[v[0]].indexOf(data[0])!=-1
	})
	.length;
}

//龙虎
function pk10lh(bet, kj, num){
	kj=kj.split(',');
	val1=parseInt(kj[num-1],10);
	val2=parseInt(kj[10-num],10);
	bet=bet.split('');
	count=0;
	for (var i=0,l=bet.length; i<l; i++){
			if(bet[i]=='龙'){
				if(val1>val2) count+=1;
				}
			else if(bet[i]=='虎'){
				if(val1<val2) count+=1;
				}else{}
		}
	return count;
}

function rx(bet, kj, num){
	
	var m,reg=/^\(([\d ]+)\)([\d ]+)$/;
	if(m=bet.match(reg)){
		// 胆拖投注
		var d=m[1].split(' ');
		
		if(d.some(function(c){return kj.indexOf(c)==-1})) return 0;
		
		return combine(m[2].split(' '), num-d.length)
		.filter(function(v){
			if(num<5){
				return v.every(function(c){
					return kj.indexOf(c)!=-1;
				});
			}else{
				v=v.concat(d);
				return kj.split(',').every(function(c){
					return v.indexOf(c)!=-1;
				});
			}
		}).length;
	}else{
		// 普通投注
		
		return combine(bet.split(' '), num)
		.filter(function(v){
			if(num<5){
				return v.every(function(c){
					return kj.indexOf(c)!=-1;
				});
			}else{
				return kj.split(',').every(function(c){
					return v.indexOf(c)!=-1;
				});
			}
		}).length;
	}
}

function zx(bet, kj){
	var m,reg=/^\(([\d ]+)\)([\d ]+)$/;
	kj=kj.split(',');
	if(m=bet.match(reg)){
		// 胆拖投注
		var d=m[1].split(' ');
		if(d.some(function(c){return kj.indexOf(c)==-1})) return 0;
		return combine(m[2].split(' '), kj.length-d.length)
		.filter(function(v){
			return v.every(function(c){
				return kj.indexOf(c)!=-1;
			});
		}).length;
	}else{
		// 普通投注
		return combine(bet.split(' '), kj.length)
		.filter(function(v){
			return v.every(function(c){
				return kj.indexOf(c)!=-1;
			});
		}).length;
	}
}



/**
 * 笛卡尔乘积算法
 *
 * @params 一个可变参数，原则上每个都是数组，但如果数组只有一个值是直接用这个值
 *
 * useage:
 * console.log(DescartesAlgorithm(2, [4,5], [6,0],[7,8,9]));
 */
function DescartesAlgorithm(){
	var i,j,a=[],b=[],c=[];
	if(arguments.length==1){
		if(!Array.isArray(arguments[0])){
			return [arguments[0]];
		}else{
			return arguments[0];
		}
	}
	
	if(arguments.length>2){
		for(i=0;i<arguments.length-1;i++) a[i]=arguments[i];
		b=arguments[i];
		
		return arguments.callee(arguments.callee.apply(null, a), b);
	}

	if(Array.isArray(arguments[0])){
		a=arguments[0];
	}else{
		a=[arguments[0]];
	}
	if(Array.isArray(arguments[1])){
		b=arguments[1];
	}else{
		b=[arguments[1]];
	}

	for(i=0; i<a.length; i++){
		for(j=0; j<b.length; j++){
			if(Array.isArray(a[i])){
				c.push(a[i].concat(b[j]));
			}else{
				c.push([a[i],b[j]]);
			}
		}
	}
	
	return c;
}

/*自选不中函数*/
function NOHIT(bet, kj, num){
	return combine(bet.split(' '), num)
		.filter(function(v){
			if(num<7){
				return v.every(function(c){
					return kj.indexOf(c)==-1;
				});
			}else{
				return kj.split(',').every(function(c){
					return v.indexOf(c)==-1;
				});
			}
	}).length;
}



//判断生肖
function CheckANM(bet,xs){
	var xsbet,flag=false;
	switch(xs){
		case '鼠':
		xsbet='09,21,33,45';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '牛':
		xsbet='08,20,32,44';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '虎':
		xsbet='07,19,31,43';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '兔':
		xsbet='06,18,30,42';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '龙':
		xsbet='05,17,29,41';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '蛇':
		xsbet='04,16,28,40';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '马':
		xsbet='03,15,27,39';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '羊':
		xsbet='02,14,26,38';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '猴':
		xsbet='01,13,25,37,49';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '鸡':
		xsbet='12,24,36,48';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '狗':
		xsbet='11,23,35,47';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '猪':
		xsbet='10,22,34,46';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
	}
   return flag;
}

function GetANM(xs){
	var xsbet;
	switch(xs){
		case '鼠':
		xsbet='09,21,33,45';
		break;
		
		case '牛':
		xsbet='08,20,32,44';
		break;
		
		case '虎':
		xsbet='07,19,31,43';
		break;
		
		case '兔':
		xsbet='06,18,30,42';
		break;
		
		case '龙':
		xsbet='05,17,29,41';
		break;
		
		case '蛇':
		xsbet='04,16,28,40';
		break;
		
		case '马':
		xsbet='03,15,27,39';
		break;
		
		case '羊':
		xsbet='02,14,26,38';
		break;
		
		case '猴':
		xsbet='01,13,25,37,49';
		break;
		
		case '鸡':
		xsbet='12,24,36,48';
		break;
		
		case '狗':
		xsbet='11,23,35,47';
		break;
		
		case '猪':
		xsbet='10,22,34,46';
		break;
		
	}
   return xsbet;
}

//判断波色
function CheckCLR(bet,xs){
	var xsbet,flag=false;
	switch(xs){
		case '红波':
		xsbet='01,02,07,08,12,13,18,19,23,24,29,30,34,35,40,45,46';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '蓝波':
		xsbet='03,04,09,10,14,15,20,25,26,31,36,37,41,42,47,48';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
		case '绿波':
		xsbet='05,06,11,16,17,21,22,27,28,32,33,38,39,43,44,49';
		if(xsbet.indexOf(bet)!=-1) flag=true;
		break;
		
	}
   return flag;
}

/**
 * 组合算法
 *
 * @params Array arr		备选数组
 * @params Int num
 *
 * @return Array			组合
 *
 * useage:  combine([1,2,3,4,5,6,7,8,9], 3);
 */
function combine(arr, num) {
	var r = [];
	(function f(t, a, n) {
		if (n == 0) return r.push(t);
		for (var i = 0, l = a.length; i <= l - n; i++) {
			f(t.concat(a[i]), a.slice(i + 1), n - 1);
		}
	})([], arr, num);
	return r;
}

/**
 * 排列算法
 */
function permutation(arr, num){
	var r=[];
	(function f(t,a,n){
		if (n==0) return r.push(t);
		for (var i=0,l=a.length; i<l; i++){
			f(t.concat(a[i]), a.slice(0,i).concat(a.slice(i+1)), n-1);
		}
	})([],arr,num);
	return r;
}
//}}}

/**
 * 分割字符串
 *
 * @params str		字符串
 * @params len      长度
 */
function strCut(str, len){
	var strlen = str.length;
	if(strlen == 0) return false;
	var j = Math.ceil(strlen / len);
	var arr = Array();
	for(var i=0; i<j; i++)
		arr[i] = str.substr(i*len, len)
	return arr;
}

//两个数组，返回包含相同数字的个数
function Sames(a,b){
	var num=0;
	for (i=0;i<a.length;i++)
	{   var zt=0;
		for (j=0;j<b.length;j++)
		{
			if(a[i]-b[j]==0){
				zt=1;
			}
		}
		if(zt==1){
			num+=1; 
		}
	}
	return num;
}

function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}


//过滤重复的数组
function filterArray(arrs){
    var k=0,n=arrs.length; 
	var arr = new Array(); 
    for(var i=0;i<n;i++)
    {
        for(var j=i+1;j<n;j++)
        {
            if(arrs[i]==arrs[j])
            {
                arrs[i]=null;
                break;
            }
        }
    }    
    for(var i=0;i<n;i++)
    {
        if(arrs[i])
        {
            arr[k++]=arrs[i]; // arr.push(this[i]);
        }
    } 
    return arr;
}

//是否有重复值
  function isRepeat(arr){  
      
         var hash = {};  
      
         for(var i in arr) {  
      
             if(hash[arr[i]])  
      
                  return true;  
      
             hash[arr[i]] = true;  
      
         }  
      
         return false;  
      
    }