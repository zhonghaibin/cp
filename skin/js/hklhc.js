$(function(){

$('.dGameStatus input[type=text]').live('change',function(){
		var $this=$(this),
		$val=$this.val(),
		re=/^[1-9][0-9]*$/;
		if(!re.test($val)){
			alert('只能为大于1正整数');
			$this.val('');
		}else{
			setlhcAmount();
		}
		
	});

})

function setlhcAmount(){
	var $amount=0;
	$('.dGameStatus :input[type=text]').each(function(){
		var $this=$(this),
		$val=$this.val(),
		$sRte=$this.closest('td').find('.sRte'),
		re=/^[1-9][0-9]*$/;
		
		if($val>0 && !isNaN($val)){
			if(!re.test($val)){
				alert('只能为大于1正整数');
				$this.val('');
			}else{
				$amount+=parseFloat($val);	
			}
			
		}
	});
	$('#sTotalCredit').text($amount);
}

//重设
function resetTotalCredit(){
	$('.dGameStatus :input[type=text]').each(function(){
		$(this).val('');
	});
	$('#sTotalCredit').text(0);
}

//确定购买
function bringRte(){
	var $amount=0,
	$flag=false;
	$('.dGameStatus :input[type=text]').each(function(){
		var $this=$(this),
		$val=$this.val(),
		$sRte=$this.closest('td').find('.sRte'),
		re=/^[1-9][0-9]*$/;
		
		if($val>0 && !isNaN($val)){
			if(!re.test($val)){
				alert('只能为大于1正整数');
				$this.val('');
			}else{
				$amount+=parseFloat($val);
				$flag=true;
			}
		}
	});
	if(!$flag){
		alert('请先购买！');
		return false;
	}else{
		if(confirm('是否确认购买？\n共 '+ $amount +' 元')){
			lhcPostData();
		}
	}
	
}

//添加购买信息
function lhcPostData(){
	var code=[],	// 存放投注号特有信息
	data={},		// 存放共同信息
	newcode;
	try{
		
		$('.dGameStatus :input[type=text]').each(function(){
		var $this=$(this),
		$val=$this.val(),
		$sRte=$this.closest('td').find('.sRte'),	
		re=/^[1-9][0-9]*$/;
		
		if($val>0 && !isNaN($val)){
			if(!re.test($val)){
				alert('只能为大于1正整数');
				$this.val('');
			}else{
			newcode={
				
				// 反点
				fanDian: 0,
				// 模式
				mode: 1.00,
				// 倍数
				beiShu: parseFloat($val)/1,
				
				bonusProp:parseFloat($sRte.text()),
				bonusPropName:$.trim($sRte.attr("id")),
				actionNum: 1,
				actionData:$this.attr('acno'),
				actionAmount:parseFloat($val),
				actionName:$this.attr('name'),
	
				// 预定单ID
				orderId: (new Date())-2147483647*623
			};
			if(newcode.max) delete newcode.max;
			if(newcode.min) delete newcode.min;
			code.push(newcode);
		}
	   }
	});	
	wait();
	var actionNo=$.parseJSON($.ajax('/index.php/game/getNo/'+game.type,{async:false}).responseText);
	
	if(!actionNo){
		alert('获取投注期号出错');
		return false;
	}else{
	
		data['actionNo']=actionNo.actionNo;
		data['kjTime']=actionNo.actionTime;
		}
	data['type']=$(':input[name=type]').val();
	data['playedGroup']=$(':input[name=playedGroup]').val();
	data['playedId']=$(':input[name=playedId]').val();
 	
 
	$.ajax('/index.php/game/postlhcData', {
		data:{
			code:code,
			para:data
		},
		type:'post',
		dataType:'json',
		error:function(xhr, textStatus, errorThrown){
			gamePostedLHCData(errorThrown||textStatus);
		},
		success:function(data, textStatus, xhr){
			gamePostedLHCData(null, data);
			if(data) alert(data);
		},
		complete:function(xhr, textStatus){
			// 服务器运行异常
			// 尝试获取服务器抛出
			destroyWait();
			var errorMessage=xhr.getResponseHeader('X-Error-Message');
			if(errorMessage) gamePostedLHCData(decodeURIComponent(errorMessage));
		}
	});
		
	}catch(err){
		alert(err);
	}
}

/**
 * 投注后置函数
 */
function gamePostedLHCData(err, data){
	if(err){
		if('您的可用资金不足，是否充值？'==err){
			if(window.confirm(err)) window.location,href='/index.php/cash/recharge';
		}else{
			alert(err);
		}
	}else{
		gameFreshOrdered();
		resetTotalCredit();
	}
}

//勾选玩法

//勾选
$(function(){
	$('.dGameStatus :radio').live('click',function(){
		var plMoney=$(this).attr("pri");
		$("#txtRate").val(plMoney);
		resetPlayedPL(plMoney);
		resetTotal();
	});
	
	$('.dGameStatus :checkbox').live('click',function(){
		lhcGameMsgAutoTip();
	});
	
	//演示展缩
	$(".instructionsLink").live("click",function(){$(".instructions").slideDown(80);return false;})
	$("#bHandleRuleClose").live("click",function(){$(".instructions").slideUp(80);return false;})
	
	//标题变化
	$('.dGameStatus .specialtr :radio').live('click',function(){

		html='<span>==================================</span><br><span>共0 种组合：</span><br>';
		changeZXBZTit(html);

	});
	//自选不中勾选
	$('.dGameStatus .specialtable :checkbox').live('click',function(){
		var obj=$(this);
		var chk=$('.dGameStatus .specialtr :radio:checked');
		var codes=[], codeLen=parseInt(chk.attr('rel')), maxlen=parseInt(chk.attr('maxlen'));
		$('.dGameStatus .specialtable :checkbox:checked').each(function(i,o){
			codes[i]=$(this).attr('acno');
		});
		var codesLen=combine(codes, codeLen).length;
		if(codesLen>maxlen){
			alert('最大不能超过'+maxlen+'种');
			obj.attr('checked',false);
			return false;
		}else{
		if(codes.length>=codeLen){
			var codeArr=combine(codes, codeLen);
			var codeStr='';
			//遍历组合
			for(i=0;i<codesLen;i++){
				codeStr+='<span>'+codeArr[i]+'</span><br/>';
			}
			html=codeStr+'<span>==================================</span><br><span>共 '+codesLen+' 种组合：</span><br>';
			changeZXBZTit(html);
		}
		}
	});
	
	$('#sTotalBeishu').live('change', function(){
		var txt=$(this).val();
		var re=/^[1-9][0-9]*$/;
		if(!re.test(txt)){
			alert('倍数只能为大于1正整数');
			$(this).val(1);
		}
		lhcGameMsgAutoTip();
	});

})

//自选不中
function changeZXBZTit(html){
	var obj=$('.dGameStatus .specialtr :radio:checked');
	var titName=obj.next("span").text();
	var codeLen=obj.attr("rel");
	var maxLen=obj.attr("maxLen");
	$("#sItemTitle").html(titName);
	$("#sExplain").html('(&nbsp;'+titName+'最多选择'+maxLen+'种组合&nbsp;)');
	$("#mulCollocation").html('<span>(&nbsp;'+titName+'最多选择'+maxLen+'种组合&nbsp;)</span><br>'+html);
	
}

//重设赔率
function resetPlayedPL(pl){
	$('.dGameStatus :checkbox').each(function(){
		var obj=$(this).closest('td').find('.sRte');
		obj.text(pl);
	});
}

//重设
function resetTotal(){
	$('.dGameStatus :checkbox:checked').each(function(){
		$(this).attr('checked',false);
	});
	$('#sTotalCredit').text(0);
	$('#sTotalBeishu').val(1);
}

//确定购买
function checkToSubmit(){
	var $count=0,
	$flag=false,
	$len=$('.dGameStatus :radio:checked').attr('rel');
	$('.dGameStatus :checkbox:checked').each(function(){
		var $this=$(this),
		$sRte=$this.closest('td').find('.sRte');	
		$flag=true;
		$count+=1;
	});
	if(!$len){
		alert('请先选择玩法！');
		return false;
	}else if(!$flag){
		alert('请先购买！');
		return false;
	}else if(parseInt($len)>$count){
		alert('请至少选择'+$len+'个！');
		return false;
	}else{
		if(confirm('是否确认购买？')){
			lhcToPostData();
		}
	}
	
}

//添加购买信息
function lhcToPostData(){
	var code=[],	// 存放投注号特有信息
	data={},		// 存放共同信息
	newcode,
	actionData,
	actionAmount,
	actionNum;
	try{
	
	var codes=[], codeLen=parseInt($('.dGameStatus :radio:checked').attr('rel'));
		$('.dGameStatus :checkbox:checked').each(function(i,o){
			codes[i]=$(this).attr('acno');
		});
		if(codes.length<codeLen) alert('至少选择'+codeLen+'个');
		
		actionData=codes.join(' ');
		actionNum=combine(codes, codeLen).length;
		actionAmount=parseInt(actionNum)*1.00*gameGetLHCBeiShu();
	
	newcode={
		
		// 反点
		fanDian: 0,
		// 模式
		mode: 1.00,
		// 倍数
		beiShu: gameGetLHCBeiShu(),
		
		bonusProp:parseFloat($("#txtRate").val()),
		bonusPropName:$.trim('Rte'+$('.dGameStatus :radio:checked').val()),
		actionNum: actionNum,
		actionData:actionData,
		actionAmount:actionAmount,
		actionName:$('.dGameStatus :radio:checked').val(),
	
		// 预定单ID
		orderId: (new Date())-2147483647*623
	};
	if(newcode.max) delete newcode.max;
	if(newcode.min) delete newcode.min;
	code.push(newcode);
	
	wait();
	var actionNo=$.parseJSON($.ajax('/index.php/game/getNo/'+game.type,{async:false}).responseText);
	
	if(!actionNo){
		alert('获取投注期号出错');
		return false;
	}else{
	
		data['actionNo']=actionNo.actionNo;
		data['kjTime']=actionNo.actionTime;
		}
	data['type']=$(':input[name=type]').val();
	data['playedGroup']=$(':input[name=playedGroup]').val();
	data['playedId']=$(':input[name=playedId]').val();
 	
 
	$.ajax('/index.php/game/postlhcData', {
		data:{
			code:code,
			para:data
		},
		type:'post',
		dataType:'json',
		error:function(xhr, textStatus, errorThrown){
			gameToPostedLHCData(errorThrown||textStatus);
		},
		success:function(data, textStatus, xhr){
			gameToPostedLHCData(null, data);
			if(data) alert(data);
		},
		complete:function(xhr, textStatus){
			// 服务器运行异常
			// 尝试获取服务器抛出
			destroyWait();
			var errorMessage=xhr.getResponseHeader('X-Error-Message');
			if(errorMessage) gameToPostedLHCData(decodeURIComponent(errorMessage));
		}
	});
		
	}catch(err){
		alert(err);
	}
}

/**
 * 投注后置函数
 */
function gameToPostedLHCData(err, data){
	if(err){
		if('您的可用资金不足，是否充值？'==err){
			if(window.confirm(err)) window.location,href='/index.php/cash/recharge';
		}else{
			alert(err);
		}
	}else{
		resetTotal();
	}
}

function checkGameItem(obj){
	
}

// 读取倍数
function gameGetLHCBeiShu(){
	var txt=$('#sTotalBeishu').val();
	if(!txt) return 1;
	var re=/^[1-9][0-9]*$/;
	if(!re.test(txt)){
		alert('倍数只能为大于1正整数');
		$('#sTotalBeishu').val(1);
	}
	return txt;
}

//信息提示
function lhcGameMsgAutoTip(){
	var codes=[], codeLen=parseInt($('.dGameStatus :radio:checked').attr('rel'));
	$('.dGameStatus :checkbox:checked').each(function(i,o){
		codes[i]=$(this).attr('acno');
	});
	if(codes.length<codeLen){
		actionAmount=0;
	}else{
		actionNum=combine(codes, codeLen).length;
		actionAmount=parseInt(actionNum)*1.00*gameGetLHCBeiShu();
	}
	
	
	$('#sTotalCredit').text(actionAmount);
}




