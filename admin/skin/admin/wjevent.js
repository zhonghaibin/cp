$(function(){
	//{{{系统提示
	if(typeof(TIP)!='undefined' && TIP){
	setInterval(function(){
		$.getJSON('/admin778899.php/business/getTip', function(tip){
			if(tip){
				// 只处理正确返回的数据
				//playVoice('/skin/sound/cash.wav', 'cash-voice');
				if(!tip.flag) return;
				
				var buttons=[];
				tip.buttons.split('|').forEach(function(button){
					button=button.split(':');
					buttons.push({text:button[0], click:window[button[1]]});
				});
				
				$('<div>').append(tip.message).dialog({
					position:['right','bottom'],
					minHeight:40,
					title:'系统提示',
					buttons:buttons
				});

			}
		})
	}, 10000);
	}
	//}}}
	if(typeof(TIP)!='undefined' && TIP){
	setInterval(function(){
		$.getJSON('/admin778899.php/business/getRecharge', function(tip){
			if(tip){
				// 只处理正确返回的数据
				playVoice('/skin/sound/backcash.wav', 'cash-voice');
				if(!tip.flag) return;
				
				var buttons=[];
				tip.buttons.split('|').forEach(function(button){
					button=button.split(':');
					buttons.push({text:button[0], click:window[button[1]]});
				});
				
				$('<div>').append(tip.message).dialog({
					position:['right','bottom'],
					minHeight:40,
					title:'系统提示',
					buttons:buttons
				});
			}
		})
	}, 10000);
	}
	//}}}
	//}}}
	if(typeof(TIP)!='undefined' && TIP){
	setInterval(function(){
		$.getJSON('/admin778899.php/business/getZNX', function(tip){
			if(tip){
				// 只处理正确返回的数据
				if(!tip.flag) return;
				var buttons=[];
				tip.buttons.split('|').forEach(function(button){
					button=button.split(':');
					buttons.push({text:button[0], click:window[button[1]]});
				});
				$('<div>').append(tip.message).dialog({
					position:['right','bottom'],
					minHeight:40,
					title:'温馨提示',
					buttons:buttons
				});
			}
		})
	}, 15000);
	}
	//}}}
});