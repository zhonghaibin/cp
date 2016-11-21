// 彩票开奖配置
exports.cp=[
	
	{
		title:'重庆时时彩',
		source:'360彩票网',
		name:'cqssc',
		enable:true,
		timer:'cqssc', 

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/ssccq/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFrom360CP(str,1);
			}catch(err){
				//throw('重庆时时彩解析数据不正确');
			}
		}
	},////////////

	
	/*//{{{
	{
		title:'CQC',
		source:'cailele',
		name:'cqssc',
		enable:true,
		timer:'cqssc',

		option:{
			host:"www.cailele.com",
			timeout:30000,
			path: '/static/ssc/newlyopenlist.xml',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				//return getFromCaileleWeb(str,1);
				str=str.substr(0,200);
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				//<row expect="20130720017" opencode="4,9,1,2,9" opentime="2013-07-20 01:25:30"/>
				var m;
	
				if(m=str.match(reg)){
                   if(m[2]=='255,255,255,255,255') throw('重庆时时彩解析数据不正确');
					return {
						type:1,
						time:m[3],
						number:m[1].replace(/^(\d{8})(\d{3})$/, '$1-$2'),
						data:m[2]
					};
				}					
				
			}catch(err){
				throw('重庆时时彩解析数据不正确');
			}
		}
	},
	//}}}

	{
		title:'江西时时彩',
		source:'香雨娱乐平台',
		name:'jxssc',
		enable:true,
		timer:'jxssc',
 

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/sscjx/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFrom360CP(str,3);
			}catch(err){
				throw('江西时时彩解析数据不正确');
			}
		}
	},////////////

	{
		title:'江西时时彩',
		source:'shishicai',
		name:'jxssc',
		enable:true,
		timer:'jxssc',
 

		option:{
			host:"data.shishicai.cn",
			timeout:50000,
			path: '/jxssc/haoma/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFromjxshishicai(str,3);
			}catch(err){
				throw('江西时时彩解析数据不正确');
			}
		}
	},////////////*/

	//{{{
	{
		title:'新疆时时彩',
		source:'官网',
		name:'xjssc',
		enable:true,
		timer:'xjssc',

		option:{
			host:"www.xjflcp.com",
			timeout:50000,
			path: '/game/sscIndex',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		
		parse:function(str){
			return getFromXJFLCPWeb(str,12);
		}
	},
	//}}}
	
	
	
	//{{{
	{
		title:'福彩3D',
		source:'香雨娱乐平台',
		name:'fc3d',
		enable:true,
		timer:'fc3d',

		option:{
			host:"www.500wan.com",
			timeout:50000,
			path: '/static/info/kaijiang/xml/sd/list10.xml',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		
		parse:function(str){
			try{
				str=str.substr(0,300);
				var m;
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)" trycode="[\d\,]*?" tryinfo="" \/>/;
                                        
				if(m=str.match(reg)){
					return {
						type:9,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('福彩3D解析数据不正确');
			}
		}
	},
	
	{
		title:'排列3',
		source:'香雨娱乐平台',
		name:'pai3',
		enable:true,
		timer:'pai3',

		option:{
			host:"www.500wan.com",
			timeout:50000,
			path: '/static/info/kaijiang/xml/pls/list10.xml',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		
		parse:function(str){
			try{
				str=str.substr(0,300);
				var m;	 
				var reg=/<row expect="(\d+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/;
				if(m=str.match(reg)){
					return {
						type:10,
						time:m[3],
						number:20+m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('排3解析数据不正确');
			}
		}
	},
	//}}}
	
	{
		title:'上海11选5',
		source:'香雨娱乐平台',
		name:'sh11x5',
		enable:true,
		timer:'sh11x5',

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/sh11/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFrom360CP(str,15);
			}catch(err){
				//throw('上海11选5解析数据不正确');
			}
		}
	},////

	/*{
		title:'上海11选5',
		source:'shishicai',
		name:'sh11x5',
		enable:true,
		timer:'sh11x5',

		option:{
			host:"data.shishicai.cn",
			timeout:50000,
			path: '/sh11x5/haoma/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFromsh11x5(str,15);
			}catch(err){
				//throw('上海11选5解析数据不正确');
			}
		}
	},////////////*/
	
	{
		title:'广东11选5',
		source:'香雨娱乐平台',
		name:'gd11x5',
		enable:true,
		timer:'gd11x5',

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/gd11/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFrom360CP(str,6);
			}catch(err){
				//throw('广东11选5解析数据不正确');
			}
		}
	},////

	/*{
		title:'广东11选5',
		source:'shishicai',
		name:'gd11x5',
		enable:true,
		timer:'gd11x5',

		option:{
			host:"data.shishicai.cn",
			timeout:50000,
			path: '/gd11x5/haoma/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFromgd11x5(str,6);
			}catch(err){
				//throw('广东11选5解析数据不正确');
			}
		}
	},////////////*/

	{
		title:'江西11选5',
		source:'香雨娱乐平台',
		name:'jx11x5',
		enable:true,
		timer:'jx11x5',
 

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/dlcjx/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFrom360CP(str,16);
			}catch(err){
				//throw('江西多乐彩解析数据不正确');
			}
		}
	},////////////

	/*{
		title:'江西11选5',
		source:'shishicai',
		name:'jx11x5',
		enable:true,
		timer:'jx11x5',

		option:{
			host:"data.shishicai.cn",
			timeout:50000,
			path: '/jx11x5/haoma/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFromjx11x5(str,16);
			}catch(err){
				//throw('江西多乐彩解析数据不正确');
			}
		}
	},////////////*/

	//}}}
	{
		title:'山东11选5',
		source:'360彩票网',
		name:'sd11x5',
		enable:true,
		timer:'sd11x5', 

		option:{
			host:"cp.360.cn",
			timeout:50000,
			path: '/yun11/',
			headers:{
				"User-Agent": "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; Sleipnir/2.9.8) "
			}
		},
		parse:function(str){
			try{
				return getFrom360sd11x5(str,7);
			}catch(err){
				//throw('山东11选5解析数据不正确');
			}
		}
	},////////

	/*{
		title:'山东11选5',
		source:'shishicai',
		name:'sd11x5',
		enable:true,
		timer:'sd11x5',

		option:{
			host:"data.shishicai.cn",
			timeout:50000,
			path: '/sd11x5/haoma/',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		parse:function(str){
			try{
				return getFromsd11x5(str,7);
			}catch(err){
				//throw('山东11选5解析数据不正确');
			}
		}
	},////////////*/
	
	//{{{
	{
		title:'北京PK10',
		source:'香雨娱乐平台',
		name:'bjpk10',
		enable:true,
		timer:'bjpk10',

		option:{

			host:"www.bwlc.gov.cn",
			timeout:50000,
			path: '/bulletin/trax.html',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)"
			}
		},
		
		parse:function(str){
			try{
				return getFromPK10(str,20);
			}catch(err){
				throw('解析数据不正确');
			}
		}
	},//(((
	
//{{{
	/*{
		title:'五分彩',
		source:'qtllc',
		name:'qtllc',
		enable:true,
		timer:'qtllc',

		option:{
			host:"127.0.1.5",
			timeout:50000,
			path: '/index.php/xyylcp/xml',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				str=str.substr(0,200);
				var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 			
				var m;
				if(m=str.match(reg)){
					return {
						type:14,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('五分彩解析数据不正确');
			}
		}
	},*/
//}}}

//{{{
	/*{
		title:'两分彩',
		source:'lfc',
		name:'lfc',
		enable:true,
		timer:'lfc',

		option:{
			host:"127.0.1.5",
			timeout:50000,
			path: '/index.php/xyylcp/xml2',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				str=str.substr(0,200);
				var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 			
				var m;
				if(m=str.match(reg)){
					return {
						type:26,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}
			}catch(err){
				throw('五分彩解析数据不正确');
			}
		}
	},*/
//}}}

//{{{
/*	{
		title:'分分彩',
		source:'ffc',
		name:'ffc',
		enable:true,
		timer:'ffc',
		option:{
			host:"127.0.1.5",
			timeout:50000,
			path: '/index.php/xyylcp/xml3',
			headers:{
				"User-Agent": "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0) "
			}
		},
		parse:function(str){
			try{
				str=str.substr(0,200);	
				var reg=/<row expect="([\d\-]+?)" opencode="([\d\,]+?)" opentime="([\d\:\- ]+?)"/; 
				var m;
				if(m=str.match(reg)){
					return {
						type:5,
						time:m[3],
						number:m[1],
						data:m[2]
					};
				}					
			}catch(err){
				throw('分分彩解析数据不正确');
			}
		}
	}*/
//}}}
];

// 出错时等待 15
exports.errorSleepTime=15;

// 重启时间间隔，以小时为单位，0为不重启
//exports.restartTime=0.4;
exports.restartTime=0;

exports.submit={

	host:'localhost',
	path:'/admin778899.php/dataSource/kj'
}

exports.dbinfo={
	host:'localhost',
	user:'root',
	password:'root',
	database:'xy_yule'

}

global.log=function(log){
	var date=new Date();
	console.log('['+date.toDateString() +' '+ date.toLocaleTimeString()+'] '+log)
}



function getFromXJFLCPWeb(str, type){

	str=str.substr(str.indexOf('class="con_left"')+30, 1200).replace(/[\r\n]+/g,'');
   str=str.substr(str.indexOf('class="con_left"'), 1000).replace(/[\r\n]+/g,'');
	//console.log(str);
   //console.log(str);
   var reg=/\d{10}/;
   match1=str.match(reg); //期号
   

   var reg=/kj_ball.*<\/div>/;
   match2=str.match(reg); //
   
   _data = match2[0];
   var reg=/\d+/g;
   match3=_data.match(reg); //获奖

   _qishu = match1[0].substr(8,2);

   _shi = parseInt(_qishu*10/60) + 10;
   if(_shi>23){
      _shi = _shi-24;
   }
   _fen = _qishu*10%60;


   _time = match1[0].replace(/^(\d{4})(\d{2})(\d{2})\d{2}/, '$1-$2-$3 ')+_shi+":"+_fen;
 

   if(!match1) throw new Error('数据不正确');
   try{
      var data={
         type:type,
         time:_time,
         number:match1[0].replace(/^(\d{8})(\d{2})$/, '$1-$2'),
         data:match3.join(',')
      };
      //console.log(data);
      return data;
   }catch(err){
      throw('解析数据失败');
   }
}


function getFromCaileleWeb(str, type, slen){
	if(!slen) slen=500;
	str=str.substr(str.indexOf('<span class="cz_name">'),slen);
	//console.log(str);
	var reg=/<td.*?>(\d+)<\/td>[\s\S]*?<td.*?>([\d\- \:]+)<\/td>[\s\S]*?<td.*?>((?:[\s\S]*?<span class="red_ball">\d+<\/span>){3,5})\s*<\/td>/,
	match=str.match(reg);
	if(match.length>1){
		
		if(match[1].length==7) match[1]='2014'+match[1].replace(/(\d{4})(\d{3})/,'$1-$2');
		if(match[1].length==8){
			if(parseInt(type)!=11){
				match[1]='20'+match[1].replace(/(\d{6})(\d{2})/,'$1-0$2');
			}else{match[1]='20'+match[1].replace(/(\d{6})(\d{2})/,'$1-$2');}
		}
		if(match[1].length==9) match[1]='20'+match[1].replace(/(\d{6})(\d{2})/,'$1-$2');
		if(match[1].length==10) match[1]=match[1].replace(/(\d{8})(\d{2})/,'$1-0$2');
		var mynumber=match[1].replace(/(\d{8})(\d{3})/,'$1-$2');
	try{
		var data={
			type:type,
			time:match[2],
			number:mynumber
		}
		reg=/<div.*>(\d+)<\/div>/g;
		data.data=match[3].match(reg).map(function(v){
			var reg=/<div.*>(\d+)<\/div>/;
			return v.match(reg)[1];
		}).join(',');
		
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
   }
}

function getFrom360CP(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年   
    var month = myDate.getMonth() + 1;     //月   
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(match);
	if(match.length>1){
		if(match[1].length==7) match[1]=year+match[1].replace(/(\d{8})(\d{3})/,'$1-$2');
		if(match[1].length==6) match[1]=year+match[1].replace(/(\d{4})(\d{2})/,'$1-0$2');
		if(match[1].length==9) match[1]='20'+match[1].replace(/(\d{6})(\d{2})/,'$1-$2');
		if(match[1].length==10) match[1]=match[1].replace(/(\d{8})(\d{2})/,'$1-0$2');
		var mynumber=match[1].replace(/(\d{8})(\d{3})/,'$1-$2');
		
		try{
			var data={
				type:type,
				time:mytime,
				number:mynumber
			}
			
			reg=/<li class=".*?">(\d+)<\/li>/g;
			data.data=match[2].match(reg).map(function(v){
				var reg=/<li class=".*?">(\d+)<\/li>/;
				return v.match(reg)[1];
			}).join(',');
			
			//console.log(data);
			return data;
		}catch(err){
			throw('解析数据失败');
		}
	}
}

function getFrom360CPK3(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年   
    var month = myDate.getMonth() + 1;     //月   
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(match);
	match[1]=match[1].replace(/(\d{4})(\d{2})/,'$1$2');
		
		try{
			var data={
				type:type,
				time:mytime,
				number:match[1]
			}
			
			reg=/<li class=".*?">(\d+)<\/li>/g;
			data.data=match[2].match(reg).map(function(v){
				var reg=/<li class=".*?">(\d+)<\/li>/;
				return v.match(reg)[1];
			}).join(',');
			
			//console.log(data);
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromPK10(str, type){
	str=str.substr(str.indexOf('<tr class="'),200).replace(/[\r\n]+/g,'');
	var reg=/<tr class=".*?">[\s\S]*?<td>(\d+)<\/td>[\s\S]*?<td>(.*)<\/td>[\s\S]*?<td>([\d\:\- ]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:match[3],
			number:match[1],
			data:match[2]
		};
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}

function getFromK8(str, type){

	str=str.substr(str.indexOf('<div class="lott_cont">'),450).replace(/[\r\n]+/g,'');
    //console.log(str);
	var reg=/<tr class=".*?">[\s\S]*?<td>(\d+)<\/td>[\s\S]*?<td>(.*)<\/td>[\s\S]*?<td>(.*)<\/td>[\s\S]*?<td>([\d\:\- ]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	//console.log(match);
	try{
		var data={
			type:type,
			time:match[4],
			number:match[1],
			data:match[2]+'|'+match[3]
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}


function getFromCJCPWeb(str, type){

	//console.log(str);
	str=str.substr(str.indexOf('<table class="qgkj_table">'),1200);
	
	//console.log(str);
	
	var reg=/<tr>[\s\S]*?<td class=".*">(\d+).*?<\/td>[\s\S]*?<td class=".*">([\d\- \:]+)<\/td>[\s\S]*?<td class=".*">((?:[\s\S]*?<input type="button" value="\d+" class=".*?" \/>){3,5})[\s\S]*?<\/td>/,
	match=str.match(reg);
	
	//console.log(match);
	
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:match[2],
			number:match[1].replace(/(\d{8})(\d{2})/,'$1-0$2')
		}
		
		reg=/<input type="button" value="(\d+)" class=".*?" \/>/g;
		data.data=match[3].match(reg).map(function(v){
			var reg=/<input type="button" value="(\d+)" class=".*?" \/>/;
			return v.match(reg)[1];
		}).join(',');
		
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
	
}

function getFromCaileleWeb_1(str, type){
	str=str.substr(str.indexOf('<tbody id="openPanel">'), 120).replace(/[\r\n]+/g,'');
         
	var reg=/<tr.*?>[\s\S]*?<td.*?>(\d+)<\/td>[\s\S]*?<td.*?>([\d\:\- ]+?)<\/td>[\s\S]*?<td.*?>([\d\,]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	//console.log(match);
	var number,_number,number2;
	var d = new Date();
	var y = d.getFullYear();
	if(match[1].length==9 || match[1].length==8){number='20'+match[1];}else if(match[1].length==7){number='2014'+match[1];}else{number=match[1];}
	_number=number;
	if(number.length==11){number2=number.replace(/^(\d{8})(\d{3})$/, '$1-$2');}else{number2=number.replace(/^(\d{8})(\d{2})$/, '$1-0$2');_number=number.replace(/^(\d{8})(\d{2})$/, '$10$2');}
	try{
		var data={
			type:type,
			time:_number.replace(/^(\d{4})(\d{2})(\d{2})\d{3}/, '$1-$2-$3 ')+match[2],
			number:number2,
			data:match[3]
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFrom360sd11x5(str, type){

	str=str.substr(str.indexOf('<em class="red" id="open_issue">'),380);
	//console.log(str);
	var reg=/[\s\S]*?(\d+)<\/em>[\s\S].*?<ul id="open_code_list">((?:[\s\S]*?<li class=".*?">\d+<\/li>){3,5})[\s\S]*?<\/ul>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年   
    var month = myDate.getMonth() + 1;     //月   
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString(); 
	//console.log(mytime);
	//console.log(match);
	
	if(!match) throw new Error('数据不正确');
	try{
		var data={
			type:type,
			time:mytime,
			number:year+match[1].replace(/(\d{4})(\d{2})/,'$1-0$2')
		}
		
		reg=/<li class=".*?">(\d+)<\/li>/g;
		data.data=match[2].match(reg).map(function(v){
			var reg=/<li class=".*?">(\d+)<\/li>/;
			return v.match(reg)[1];
		}).join(',');
		
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromCaileleWeb_2(str, type){

	str=str.substr(str.indexOf('<tbody id="openPanel">'), 500).replace(/[\r\n]+/g,'');
	//console.log(str);
	var reg=/<tr>[\s\S]*?<td>(\d+)<\/td>[\s\S]*?<td>([\d\:\- ]+?)<\/td>[\s\S]*?<td>([\d\,]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	if(!match) throw new Error('数据不正确');
	//console.log(match);
	var number,_number,number2;
	var d = new Date();
	var y = d.getFullYear();
	if(match[1].length==9 || match[1].length==8){number='20'+match[1];}else if(match[1].length==7){number='2014'+match[1];}else{number=match[1];}
	_number=number;
	if(number.length==11){number2=number.replace(/^(\d{8})(\d{3})$/, '$1-$2');}else{number2=number.replace(/^(\d{8})(\d{2})$/, '$1-0$2');_number=number.replace(/^(\d{8})(\d{2})$/, '$10$2');}
	try{
		var data={
			type:type,
			time:_number.replace(/^(\d{4})(\d{2})(\d{2})\d{3}/, '$1-$2-$3 ')+match[2],
			number:number2,
			data:match[3]
		};
		//console.log(data);
		return data;
	}catch(err){
		throw('解析数据失败');
	}
}

function getFromfrgcsc(str, type){
	str=str.substr(str.indexOf('<th>开奖号码</th>'),380);
	//console.log(str);
	//var reg=/<th>[\s\S]*?<\/th>[\s\S]*?<\/tr>[\s\S]*?<\/thead>[\s\S]*?<tbody>[\s\S]*?<tr>[\s\S]*?<td>(\d+)<\/td>[\s\S]*?<td>([\d\,]+?)<\/td>[\s\S]*?<\/tr>/,
	var reg=/<th>[\s\S]*?<\/th>[\s\S]*?<\/tr>[\s\S]*?<\/thead>[\s\S]*?<tbody>[\s\S]*?<tr>[\s\S]*?<td>([\d+\-]+?)<\/td>[\s\S]*?<td>([\d\,]+?)<\/td>[\s\S]*?<\/tr>/,
	match=str.match(reg);
	//console.log(match);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年   
    var month = myDate.getMonth() + 1;     //月   
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	//console.log(match);
		var mynumber=match[1].replace(/(\d{8})(\d{3})/,'$1-$2');	
		try{
			var data={
				type:type,
				time:mytime,
				number:mynumber,
				data:match[2]
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromshishicai(str, type){
	str=str.substr(str.indexOf('<th class="borRB">'),380);
	//console.log(str);
	var reg=/<th class=".*?">[\s\S]*?<\/th>[\s\S]*?<th class=".*?">[\s\S]*?<\/th>[\s\S]*?<tr><td class=".*?">([\d+\-]+?)<\/td><td class=".*?">(\d+)<\/td><\/tr>/,
	match=str.match(reg);
	var myDate = new Date();
	var year = myDate.getFullYear();       //年   
    var month = myDate.getMonth() + 1;     //月   
    var day = myDate.getDate();            //日
	if(month < 10) month="0"+month;
	if(day < 10) day="0"+day;
	var mytime=year + "-" + month + "-" + day + " " +myDate.toLocaleTimeString();
	    try{
			var data={
				type:type,
				time:mytime,
				number:match[1],
				data:match[2].split('').join(',')
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromjxshishicai(str, type){
	str=str.substr(str.indexOf('<meta name="description" content="'),380);
	var reg=/<meta name=".*?" content="江西时时彩第([\d+\-]+?)期开奖号码:(\d+),开奖时间:([\d\:\- ]+?).免费手机订阅江西时时彩开奖号码,买江西时时彩来时时彩网" \/>/,
	match=str.match(reg);
	    try{
			var data={
				type:type,
				time:match[3],
				number:match[1],
				data:match[2].split('').join(',')
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromgd11x5(str, type){
	str=str.substr(str.indexOf('<meta name="description" content="'),380);
	var reg=/<meta name=".*?" content="广东11选5第([\d+\-]+?)期开奖号码:([\d\,]+?),开奖时间:([\d\:\- ]+?).免费手机订阅广东11选5开奖号码,买广东11选5来时时彩网" \/>/,
	match=str.match(reg);
	    try{
			var data={
				type:type,
				time:match[3],
				number:match[1],
				data:match[2]
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromjx11x5(str, type){
	str=str.substr(str.indexOf('<meta name="description" content="'),380);
	var reg=/<meta name=".*?" content="江西11选5第([\d+\-]+?)期开奖号码:([\d\,]+?),开奖时间:([\d\:\- ]+?).免费手机订阅江西11选5开奖号码,买江西11选5来时时彩网" \/>/,
	match=str.match(reg);
	    try{
			var data={
				type:type,
				time:match[3],
				number:match[1],
				data:match[2]
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromsd11x5(str, type){
	str=str.substr(str.indexOf('<meta name="description" content="'),380);
	var reg=/<meta name=".*?" content="山东11选5第([\d+\-]+?)期开奖号码:([\d\,]+?),开奖时间:([\d\:\- ]+?).免费手机订阅山东11选5开奖号码,买山东11选5来时时彩网" \/>/,
	match=str.match(reg);
	    try{
			var data={
				type:type,
				time:match[3],
				number:match[1],
				data:match[2]
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}

function getFromsh11x5(str, type){
	str=str.substr(str.indexOf('<meta name="description" content="'),380);
	var reg=/<meta name=".*?" content="上海11选5第([\d+\-]+?)期开奖号码:([\d\,]+?),开奖时间:([\d\:\- ]+?).免费手机订阅上海11选5开奖号码,买上海11选5来时时彩网" \/>/,
	match=str.match(reg);
	    try{
			var data={
				type:type,
				time:match[3],
				number:match[1],
				data:match[2]
			}
			return data;
		}catch(err){
			throw('解析数据失败');
		}
}