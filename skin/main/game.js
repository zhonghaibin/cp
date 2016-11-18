$(function(){
	$('input.code').live('click', function(){
		var $this=$(this);
		if($this.is('.checked')){
			$this.removeClass('checked');
		}else{
			$this.addClass('checked');
		}
		gameCalcAmount();
	});
	if($.browser.msie){
		$('a, :button, :radio, :checkbox').live('focus', function(){
			this.blur();
		});
	}
	$('input.action').live('click', function(){
		var $this=$(this),
		call=$this.attr('action'),
		pp=$this.parent();
		$this.addClass("on").siblings(".action").removeClass("on");
		if(call && $.isFunction(call=window[call])){
			call.call(this, pp);
		}else if($this.is('.all')){
			$('input.code',pp).addClass('checked');
		}else if($this.is('.large')){
			$('input.code.max',pp).addClass('checked');
			$('input.code.min',pp).removeClass('checked');
		}else if($this.is('.small')){
			$('input.code.min',pp).addClass('checked');
			$('input.code.max',pp).removeClass('checked');
		}else if($this.is('.odd')){
			$('input.code.d',pp).addClass('checked');
			$('input.code.s',pp).removeClass('checked');
		}else if($this.is('.even')){
			$('input.code.s',pp).addClass('checked');
			$('input.code.d',pp).removeClass('checked');
		}else if($this.is('.none')){
			$('input.code',pp).removeClass('checked');
		}
	});
	$('td.code-list').live('click', function(){
		var data=$(this).parent().data('code');
		displayCodeList(data);
	});
	$('.touzhu-cont .del').live('click', function(){
		$(this).closest('tr').remove();
		$('.touzhu-bottom :checkbox[name=zhuiHao]').removeData()[0].checked=false;
		gameCalcAmount();
	});
	$('#btnPostBet').unbind('click');
	$('#btnPostBet').bind('click',gamePostCode);
	$('.slider').each(function(){
		var $this=$(this),
		onslide, attr={};
		['value', 'min', 'max', 'step'].forEach(function(p){
			if(!isNaN(value=parseFloat($this.attr(p)))){
				attr[p]=value;
			}
		});
		if(onslide=$this.attr('slideCallBack')){
			if(typeof window[onslide]=='function'){
				attr.slide=function(event, ui){
					window[onslide].call(this, ui.value);
				}
			}
		}
		$this.slider(attr);
	});
	$('.fandian-box input').click(function(){
		var $slider=$('#slider'),
		min=parseFloat($slider.attr('min')),
		max=parseFloat($slider.attr('max')),
		value=$slider.slider('option', 'value');
		
		value+=parseFloat($(this).attr('step'));
		if(value<min) value=min;
		if(value>max) value=max;
		
		$slider.slider('option', 'value', value);
		gameSetFanDian.call($slider[0], value);
	});
	$('#textarea-code').live('keypress', function(event){
		event.keyCode=event.keyCode||event.charCode;
		return !!(
			event.ctrlKey
			|| event.altKey
			|| event.shiftKey
			|| event.keyCode==13
			|| event.keyCode==8
			|| (event.keyCode>=48
			&& event.keyCode<=57)
		);
	}).live('keyup', gameMsgAutoTip);
	$('#textarea-code').live('change', function(){
		var str=$(this).val();
		if(/[a-zA-Z]+/.test(str)){
			winjinAlert('投注号码不能含有字母字符',"alert");
			$(this).val('');
		}
	});
	$('.pp :button, :radio[name=danwei]').live('click', gameMsgAutoTip);
	$('#beishu').live('change', gameMsgAutoTip);
	$('.surbeishu').live('click', function(){
		var newVal=parseInt($('#beishu').val())-1;
		if(newVal<1) newVal=1;
		$('#beishu').val(newVal);
		gameMsgAutoTip();
	});
	$('.addbeishu').live('click', function(){
		var newVal=parseInt($('#beishu').val())+1;
		$('#beishu').val(newVal);
		gameMsgAutoTip();
	});
	$('.touzhu-bottom :checkbox[name=zhuiHao]')
	.click(function(){
		var bet=$('.touzhu-cont tbody tr'),
		len=bet.length
		if(len==0){
			winjinAlert('请选投注',"alert");
			return false;
		}else if(len>1){
			winjinAlert('只能针对一个方案发起追号！',"alert");
			return false;
		}
		setGameZhuiHao(bet.data('code'));
		return false;
	});
	$('.touzhu-bottom :checkbox[name=fpEnable]')
	.click(function(){
		var bet=$('.touzhu-cont tbody tr'),
		len=bet.length,
		amount=parseInt($('#all-amount').text());
		if($(this).attr("checked")){
			if(len==0){
				winjinAlert('请选投注',"alert");
				return false;
			}
			amount*=2;
			$('#all-amount').text(amount.round(2));
		}else{
			amount/=2;
			$('#all-amount').text(amount.round(2));
			}
		return true;
	});
	$('.zhui-hao-modal thead :checkbox').live('change', function(){
		$(this).closest('table').find('tbody :checkbox').prop('checked', this.checked).trigger('change');
	});
	$('.zhui-hao-modal tbody :checkbox').live('change', function(){
		var $this=$(this),
		$ui=$this.closest('div[rel]'),
		data=$ui.data(),
		amount=$ui.attr('rel') * Math.abs($this.closest('tr').find('.beishu').val()),
		$show=$ui.closest('.zhui-hao-modal').find('.ui-dialog-title');
		if(!data.count){
			data.count=0;
			data.amount=0;
		}
		if(this.checked){
			data.count++;
			data.amount+=amount;
		}else{
			data.count--;
			data.amount-=amount;
		}
		$('.qs', $show).text(data.count);
		$('.amount', $show).text(Math.round(data.amount*100)/100);
		$this.closest('tr').find('.amount').text(Math.round(amount*100)/100);
		$this.data('amount', amount);
	});
	$('.zhui-hao-modal tbody .beishu').live('change', function(e){
		var $this=$(this);
		var re=/^[1-9][0-9]*$/;
		if(!re.test($this.val())){winjinAlert('倍数只能为正整数',"alert");$this.val(1);return;}
		if(!$this.closest('tr').find(':checkbox')[0].checked) return ;

		var $ui=$this.closest('div[rel]'),
		data=$ui.data(),
		$checkbox=$this.closest('tr').find(':checkbox'),
		_amount=Math.abs($checkbox.data('amount'));
		amount=$ui.attr('rel') * Math.abs($this.val()),
		$show=$ui.closest('.zhui-hao-modal').find('.ui-dialog-title');
		data.amount+=amount-_amount;
		$checkbox.data('amount', amount);
		$('.qs', $show).text(data.count);
		$('.amount', $show).text(Math.round(data.amount*100)/100);
		$this.closest('tr').find('.amount').text(Math.round(amount*100)/100);
	});
	$('.game-btn a[href]').live('click', function(){
		var $this=$(this);
		if($this.is('.current')) return false;
		$('.game-btn2').load($this.attr('href'), function(){
			$this.closest('.game-btn').find('.current').removeClass('current');
			$this.closest('div').addClass('current');
			$('.game-btn2 a[href]:first').trigger('click');
		});
		return false;
	});
	$('.game-btn2 a[href]').live('click', function(){
		var $this=$(this);
		loadPlayTips($this.attr('data_id'));
		$('#num-select').load($this.attr('href'), function(){
			$this.closest('.game-btn2').find('.current').removeClass('current');
			$this.parent().addClass('current');
		});
		return false;
	});
	$('.showhelp .showeg').live("mouseover",function(){
		var $action=$(this).attr('action');
		var ps = $(this).position();
		$('#'+$action+'s_div').siblings('.game_eg').hide();
		$('#'+$action+'s_div').css({top:ps.top + 20,left:ps.left + 20}).fadeIn(100);
	})
	$('.showhelp .showeg').live("mouseout",function(){
		$('#game-helptips').find('.game_eg').hide();
	})
	$('.kjabtn').live('click', function(){
		var $this=$(this);
		$this.closest('.kaijiangall').find('ul').load($this.attr('src'), function(){
			$('.kjabtn.current').removeClass('current');
			$this.addClass('current');
		});
	});
	$('.jiang').live('click', function(){
		var $this=$(this);
		if($this.is('.current')) return true;
		$('.jiang.current').removeClass('current');
		$this.addClass('current');
		return true;
	})
	.find('select').live('change', function(){
		$('.zj-cont tbody').load(this.value);
	});
	$('#switch-znz-bet').toggle(function(){
		if($(this).data('status')=='0'){
			winjinAlert('庄内庄功能目前关闭中...',"alert");
			return;
		}
		$('#znz-game').load('/index.php/index/znz/'+game.type, function(){
			$('#bet-game').hide();
			$(this).show();
		});
	},function(){
		if($(this).data('status')=='0'){
			winjinAlert('庄内庄功能目前关闭中...',"alert");
			return;
		}
		$('#bet-game').show();
		$('#znz-game').hide();
	});
	$('#znz-code-list .view-code').live('click', function(){
		displayCodeList($(this).closest('tr').data('code'));
	});
	$('#znz-code-list .qzbtn').live('click', function(){
		var data=$(this).closest('tr').data('code'),
		amount=data.actionNum * data.mode * data.beiShu,
		chouShi=amount * (data.gameFanDian - data.userFanDian + 3) / 100,
		fandDian=amount * data.setFanDian / 100,
		zjCount=MaxZjCount[data.zjFun].call(data.actionData),
		zjAmount=zjCount * data.bonusProp * data.beiShu * data.mode / 2,
		dongjieCoin=zjAmount+fandDian+chouShi;
		$('<div><p>最大中奖金额：<span class="zj-amount"></span>元</p><p>支付返点：<span class="fan-dian"></span>元</p><p>需要冻结资金共：<span class="dj-amount"></span>元</p></div>')//<p>支付抽水：<span class="shou-shui">元</span></p>
		.find('.zj-amount').text(zjAmount.round(2))
		.end().find('.fan-dian').text((chouShi+fandDian).round(2))
		.end().find('.dj-amount').text(dongjieCoin.round(2))
		.end().dialog({
			title:'抢庄',
			modal:true,
			buttons:{
				"确定抢庄":function(){
					
					$.ajax({
						url:'/index.php/game/znzPost/' + data.id,
						type:'POST',
						dataType:'json',
						data:{
							fanDianAmount:fandDian,
							qz_chouShui:chouShi,
							qz_fcoin:zjAmount+fandDian+chouShi
						},
						error:function(xhr, textStatus, errThrow){
							var errorMessage=xhr.getResponseHeader('X-Error-Message');
							if(errorMessage){
								alert(decodeURIComponent(errorMessage));
							}else{
								alert(textStatus || errThrow);
							}
						},
						success:function(data, textStatus, xhr){
							var errorMessage=xhr.getResponseHeader('X-Error-Message');
							if(errorMessage){
								alert(decodeURIComponent(errorMessage));
							}else{
								$('#znz-game').load('/index.php/index/znz/'+game.type);
								alert(data);
								reloadMemberInfo();
							}
						}
					});
					$(this).dialog("destroy");
				},
				"取消":function(){
					$(this).dialog("destroy");
				}
			}
		});
	});
	$('.dantuo :radio').live('click', function(){
		var $dom=$(this).closest('.dantuo');
		
		if(this.value){
			$dom.next().hide().next().show();
		}else{
			$dom.next().show().next().hide();
		}
	});
	$('.dmtm :input.code').live('click',function(event){
		var $this=$(this),
		$dom=$this.closest('.dmtm');
		if($('.code.checked[value=' + this.value +']', $dom).not(this).length==1){
			$this.removeClass('checked');
			winjinAlert('选择胆码不能与拖码相同',"alert");
			return false;
		}
	});
	$('.zhixu115 :input.code').live('click',function(event){
		var $this=$(this);
		if(!$this.is('.checked')) return false;
		
		var $dom=$this.closest('.zhixu115');
		$('.code.checked[value=' + this.value +']', $dom).removeClass('checked');
		$this.addClass('checked');
	});
	if(getVoiceStatus()=='off'){
		$('#voice').removeClass('voice-on').addClass('voice-off').attr('title', '声音关闭，点击开启');
	}
});
var MaxZjCount={
	ds:function(){
		var zjCount=0,t=1,s;
		$.each(this.split('|').sort(), function(){
			if(s==String(this)){
				t++;
			}else{
				s=this;
				if(t>zjCount) zjCount=t;
				t=1;
			}
		});
		if(t>zjCount) zjCount=t;
		
		return zjCount;
	},
	fs:function(){
		return 1;
	},
	dxds:function(){
		var d=this.split(',').map(function(v){
			return v
			.replace('单','双')
			.replace('大', '小')
			.split("").sort().join('')
			.replace(/双{2,}/,'双')
			.replace(/小{2,}/,'小')
			.length;
		});
		return d[0] * d[1];
	},
	dd5x:function(){
		return this.split(',').filter(function(v){return v!='-'}).length;
	},
	bdd:function(){
		return this.length>3?3:this.length;
	}
}
function playVoice(src, domId){
	if(getVoiceStatus()=='off') return;
	var $dom=$('#'+domId)
	if($.browser.msie){
		if($dom.length){
			$dom[0].src=src;
		}else{
			$('<bgsound>',{src:src, id:domId}).appendTo('body');
		}
	}else{
		if($dom.length){
			$dom[0].play();
		}else{
			$('<audio>',{src:src, id:domId}).appendTo('body')[0].play();
		}
	}
}
function setVoiceStatus(flag){
	var session=(typeof sessionStorage!='undefined');
	var key='voiceStatus';
	if(session){
		if(!flag){
			sessionStorage.setItem(key,'off');
		}else{
			sessionStorage.removeItem(key);
		}
	}else{
		if(!flag){
			$.cookie(key, 'off');
		}else{
			$.cookie(key, null);
		}
	}
}
function getVoiceStatus(){
	var key='voiceStatus';
	if(typeof sessionStorage!='undefined'){
		return sessionStorage.getItem(key);
	}else{
		return $.cookie(key);
	}
}
function voiceKJ(){
	var $dom=$('#voice');
	if(getVoiceStatus()!='off'){
		setVoiceStatus(false);
		$dom.attr('class','voice-off').attr('title', '声音关闭，点击开启');
	}else{
		setVoiceStatus(true);
		$dom.attr('class','voice-on').attr('title', '声音开启，点击关闭');
	}
}
function sxznz(){
	$('#znz-game').load('/index.php/index/znz/'+game.type, function(){
		$('#bet-game').hide();
		$(this).show();
	});
}
function loadPlayTips(playedid){
	$('#game-helptips').load('/index.php/index/playTips/'+playedid);
}