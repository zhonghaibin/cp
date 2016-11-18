$(function(){
	//{{{ 主框架相关
	// 左边收缩菜单
	$('.copy').live('click', function(){
		var $this=$(this);
		if($this.is('[src]')){
			CopyToClipboard($($this.attr('src')).val(), function(){
				alert('复制成功');
			});
		}else if($this.is('[rel]')){
			CopyToClipboard($this.attr('rel'), function(){
				alert('复制成功');
			});
		}
	});

	$('#sidebar h3').live('click', function(){
		var $dom=$(this).next(),
		speed='slow';
		
		if($dom.is(':hidden')){
			$dom.show(speed);
			$('a', this).html('－');
		}else{
			$dom.hide(speed);
			$('a', this).html('＋');
		}
	});
	
	// 左边菜单点击事件
	$('#sidebar ul.toggle a[href]').live('click', function(){
		var arr=[],$this=$(this),url=$(this).attr('href');
		if(url=='#') return false;
		
		load(url);
		arr.unshift($this.text());
		arr.unshift($this.closest('ul').prev().text().substr(0,4));
		setPosition.apply(null, arr);
		
		$('.current', $('#sidebar')).removeClass('current');
		$this.addClass('current');
		
		return false;
	});
	
	// 当前位置栏点击事件
	$('#secondary_bar .breadcrumbs a').live('click', function(){
		return false;
	});
	
	// 全选/全取消选择操作
	$(':checkbox.select-all').live('click', function(){
		$(this).closest('table').find('tbody :checkbox').attr('checked',this.checked);
	});
	
	// 连接重置
	$('#main a, a.load').live('click', function(){
		var $this=$(this);
		
		// 对ajax请求和外连接不做处理
		if($this.is('[target], [onclick]')) return;
		
		load($this.attr('href'));
		return false;
	});
	
	// 分页AJAX动作
	$('ul.pageinfo li[value]').live('click', function(){
		var $this=$(this);
		if($this.is('.disabled')) return false;
		
		var context=$this.closest('ul'),
		action=context.attr('action')||'defaultPageAction';
		if(!action || typeof window[action] != 'function') return false;
		
		try{
			window[action].call(context, $this.attr('value'));
		}catch(e){
			debug(e);
		}
		
		return false;
	});
	
	// 查看号码
	//$('[data-code]').live('click', viewBetList);
	
	// 登录按Enter进入
	if(!$.browser.opera && !$.browser.mozilla){
		$('input[name=vcode]').live('keypress', function(event){
			if(event.keyCode==13){
				$(this.form).trigger('submit');
			}
		});
	}

	
	//}}}
	
	//{{{ HTML标签扩展部分
	//HTML5扩展支持
	//if($.broswer.msie){
		$(':submit[formaction]').live('click', function(){
			$(this.form).attr('action', $(this).attr('formaction'));
		});
	// }
	
	// A链接扩展
	/**
	 * AJAX链接
	 * target="ajax"：AJAX请求
	 * onajax：AJAX调用前触发，返回false时阻止
	 * call：AJAX完后触发，callback(err, data, xhr) this指向当前html元素，err当出错的时间有值，data为服务器返回值(解析过)，xhr为HttpRequest对象
	 * dataType：默认html，服务器响应类型，可用json，xml
	 */
	$('a[target=ajax]').live('click', function(){
		var $this	= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		title		= $this.attr('title'),
		call		= window[$this.attr('call')];
		
		if(title && !confirm(title)) return false;
		
		if(typeof call!='function'){
			// 设置一个默认的响应回调
			call=function(){}
		}
		
		if('function'==typeof onajax){
			// 如果ajax请求前事件处理返回false
			// 则阻止后继事件
			try{
				if(onajax.call(this)===false) return false;
			}catch(err){
				call.call(self, err);
				return false;
			}
		}

		$.ajax({
			url:$this.attr('href'),
			
			// 异步请求
			async:true,
			
			// 把当前存储的数据做为参数传递
			data:$this.data(),
			
			// 默认用GET请求，也可以用method属性设置
			type:$this.attr('method')||'get',
			
			// dataType属性用于设置响应数据格式，默认html，可选json和xml
			dataType:$this.attr('dataType')||'html',
			
			error:function(xhr, textStatus, errThrow){
				// 据jQuery官方说，textStatus和errThrow中只有一个包括错误信息
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
	
	
	// A弹出层打开链接
	/**
	 * target="modal"
	 * title="弹出层标题"
	 * width="弹出宽度"
	 * heigth=""
	 * modal=false
	 * buttons="确定:onsure|取消:oncancel"
	 * method="get"
	 */
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
	
	
	// form扩展
	/**
	 * 简单AJAX表单
	 * target="ajax"：AJAX提交
	 * onajax：AJAX调用前触发，this指向from元素，返回false时阻止
	 * call：AJAX完后触发，callback(err, data, xhr) this指向当前html元素，err当出错的时间有值，data为服务器返回值(解析过)，xhr为HttpRequest对象
	 * 服务器响应类型为json
	 */
	$('form[target=ajax]').live('submit', function(){
		var data	= [], 
		$this		= $(this),
		self		= this,
		onajax		= window[$this.attr('onajax')],
		call		= window[$this.attr('call')];
		
		if(typeof call!='function'){
			// 设置一个默认的响应回调
			call=function(){}
		}
		
		if('function'==typeof onajax){
			// 如果ajax请求前事件处理返回false
			// 则阻止后继事件
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
			
			if($this.is(':radio, :checked') && this.checked==false) return true;
			
			if(value===undefined) value=this.value;
			
			data.push({name:name, value:value});
		});
		
		$.ajax({
			url:$this.attr('action'),
			
			// 异步请求
			async:true,

			data:data,
			
			// 默认用GET请求，也可以用method属性设置
			type:$this.attr('method')||'get',
			
			// dataType属性用于设置响应数据格式，默认json，可选html、json和xml
			dataType:$this.attr('dataType')||'json',
			
			headers:{"x-form-call":1},
			
			error:function(xhr, textStatus, errThrow){
				// 据jQuery官方说，textStatus和errThrow中只有一个包括错误信息
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
	
	// 表单属性扩展
	/**
	 * pattern
	 */
	
	if($.datepicker) $('input[type=date]').datepicker({
		showOn: "button",
		buttonText:'快速选取日期',
		buttonImage: "/skin/main/images/date.jpg",
		buttonImageOnly: true
	});
	
	//}}}

	
});