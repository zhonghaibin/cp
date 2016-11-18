$(function(){
	$('a[target=ajax]').live('click', function(){
		var $this	= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		title		= $this.attr('title'),
		call		= window[$this.attr('call')];
		if(title && !confirm(title))
		 return false;
		if(typeof call!='function'){
			call=function(){}
		}
		if('function'==typeof onajax){
			try{
				if(onajax.call(this)===false) return false;
			}catch(err){
				call.call(self, err);
				return false;
			}
		}
		$.ajax({
			url:$this.attr('href'),
			async:true,
			data:$this.data(),
			type:$this.attr('method')||'get',
			dataType:$this.attr('dataType')||'html',
			error:function(xhr, textStatus, errThrow){
				call.call(self, errThrow||textStatus);
			},
			success:function(data, textStatus, xhr, headers){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call(self, decodeURIComponent(errorMessage), data);
				}else{
					call.call(self, null, data);
				}
			}
		});
		return false;
	});
	$('a[target=modal]').live('click', function(){
		var self=this,
		$self=$(self),
		title=$self.attr('title')||'',
		width=$self.attr('width')||'auto',
		heigth=$self.attr('heigth')||'auto',
		modal=($self.attr('modal')),
		method=$self.attr('method')||'get',
		buttons=$self.attr('button')||null;
		if(buttons) buttons=buttons.split('|').map(function(b){
			b=b.split(':');
			return {text:b[0], click:window[b[1]]};
		});
		$[method]($self.attr('href'), function(html){
			$(html).dialog({
				title:title,
				width:width,
				height:heigth,
				modal:modal,
				buttons:buttons
			});
		});
		
		return false;
	});
	$('form[target=ajax]').live('submit', function(){
		var data	= [], 
		$this		= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		call		= window[$this.attr('call')];
		
		if(typeof call!='function'){
			call=function(){}
		}
		if('function'==typeof onajax){
			try{
				if(onajax.call(this)===false) return false;
			}catch(err){
				call.call(self, err);
				return false;
			}
		}
		$(':input[name]', this).each(function(){
			var $this=$(this),
			value=$this.data('value'),
			name=$this.attr('name');
			if($this.is(':radio, :checkbox') && this.checked==false) return true;
			if(value===undefined) value=this.value;
			data.push({name:name, value:value});
		});
		$.ajax({
			url:$this.attr('action'),
			async:true,
			data:data,
			type:$this.attr('method')||'get',
			dataType:$this.attr('dataType')||'json',
			headers:{"x-form-call":1},
			error:function(xhr, textStatus, errThrow){
				call.call(self, errThrow||textStatus);
			},
			success:function(data, textStatus, xhr, headers){
				var errorMessage=xhr.getResponseHeader('X-Error-Message');
				if(errorMessage){
					call.call(self, decodeURIComponent(errorMessage), data);
				}else{
					call.call(self, null, data);
				}
			}
		});
		return false;
	});
	if($.datepicker){
		$(".datainput").datepicker({ onSelect: function(dateText, inst) {$(this).val(dateText+' 03:00:00');} });
	} 
	if(!$.browser.opera && !$.browser.mozilla){
		$('input[name=vcode]').live('keypress', function(event){
			if(event.keyCode==13){
				$(this.form).trigger('submit');
			}
		});
	}
	$('.ui-dialog .bottompage a').live('click', function(){
		var $this=$(this);
		$this.closest('.ui-dialog-content').load($this.attr('href'));
		return false;
	});
	
	////{{{系统提示 setInterval
	if(typeof(TIP)!='undefined' && TIP){
	setInterval(function(){
		parent.reloadMemberInfo();
		$.getJSON('/index.php/Tip/getTKTip', function(tip){
			if(tip){
				if(!tip.flag) return;
				$("<div>").append(tip.message).dialog({
						position:['right','bottom'],
						minHeight:40,
						title:'系统提示',
						buttons:''
				});
			}
		})
	}, 10000);
	setInterval(function(){
		parent.reloadMemberInfo();
		$.getJSON('/index.php/Tip/getCZTip', function(tip){
			if(tip){
				if(!tip.flag) return;
				$("<div>").append(tip.message).dialog({
						position:['right','bottom'],
						minHeight:40,
						title:'系统提示',
						buttons:''
				});
			}
		})
	}, 8000);
	setInterval(function(){
		parent.reloadMemberInfo();
		$.getJSON('/index.php/Tip/getZNX', function(tip){
			if(tip){
				if(!tip.flag) return;
				var buttons=[];
				tip.buttons.split('|').forEach(function(button){
					button=button.split(':');
					buttons.push({text:button[0], click:window[button[1]]});
				});
				$("<div>").append(tip.message).dialog({
						position:['right','bottom'],
						minHeight:40,
						title:'温馨提示',
						buttons:buttons
				});
			}
		})
	parent.msg();
	}, 9000);
	}
});

Number.prototype.round=Number.prototype.toFixed;