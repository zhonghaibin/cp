/* 画线对象*/ // 
DrawLine={
	AttributeGroup:[],
	LineGroup:[],
	table:false,
	check:function(td){
		return /^(charball|cbg)/i.test(td.className);
	},
	on_off:true,
	bind:function(tid,_on_off){
		this.table=tid;
		this.on_off=_on_off;
		return this;
	},
	color:function(c){
		LG.color=c;
		return this;
	},
	draw:function(yes){
		if(!this.table)return;
		if(yes){
			var qL=this.AttributeGroup.length;
			for(var i=0;i<qL;i++){
				var it=this.AttributeGroup[i];
				LG.color=it.color;
				JoinLine.indent=it.indent;
				this.LineGroup.push(new LG(this.table,it[0],it[1],it[2],it[3],this.check));
			}
		}
		if(this.on_off){
			var _this=this;
			var isshowline=document.getElementById(this.on_off);
			if(isshowline)isshowline.onclick=function(){
				_this.show(this.checked);
			}
		}
		return this;
	},
	show:function(yes){
		var qL=this.LineGroup.length;
		for(var i=0;i<qL;i++){
			this.LineGroup[i].show(yes)
		}
	},
	/**
	* x：列开始处,y：行开始处,w：组与组之间的距离,mb：与底部间的距离
	* 把每一块封成组加上属性
	*/
	add:function(x,y,w,mb){
		this.AttributeGroup.push([x,y,w,mb]);
		this.AttributeGroup[this.AttributeGroup.length-1].color=LG.color;
		this.AttributeGroup[this.AttributeGroup.length-1].indent=JoinLine.indent;
		return this;
	}
}
/* 连线类 */
JoinLine=function(color,size){
	this.color=color||"#000000";
	this.size=size||1;
	this.lines=[];
	this.tmpDom=null;
	this.visible=true;
};
JoinLine.prototype={
	show:function(yes){
		for(var i=0;i<this.lines.length;i++)
			this.lines[i].style.visibility=yes?"visible":"hidden";		
	},
	remove:function(){
		for(var i=0;i<this.lines.length;i++)
			this.lines[i].parentNode.removeChild(this.lines[i]);
		this.lines=[];
	},
	join:function(objArray,hide){
		this.remove();
		this.visible=hide?"visible":"hidden";
		this.tmpDom=document.createDocumentFragment();	
		for(var i=0;i<objArray.length-1;i++){
			var a=this.pos(objArray[i]);
			var b=this.pos(objArray[i+1]);
				if(document.all){
					if(navigator.userAgent.indexOf("MSIE 9.0")>0){
						this.FFLine(a.x,a.y,b.x,b.y);
					}else{
						this.IELine(a.x,a.y,b.x,b.y);
					}
				}else{
					this.FFLine(a.x,a.y,b.x,b.y);
				};
		};
		document.body.appendChild(this.tmpDom);		
	},
	 pos:function(obj){
	 	if(obj.nodeType==undefined)return obj;
		var pos={x:0,y:0},a=obj;
		for(;a;a=a.offsetParent){pos.x+=a.offsetLeft;pos.y+=a.offsetTop};
		pos.x+=parseInt(obj.offsetWidth/2);
		pos.y+=parseInt(obj.offsetHeight/2);
		return pos;
	},
	FFLine:function(x1,y1,x2,y2){
		if(Math.abs(y1-y2)<(JoinLine.indent*2)&&x1==x2)return;//自动确定同列的是否连线		
		var np=this.nPos(x1,y1,x2,y2,JoinLine.indent);//两端缩减函数（防止覆盖球）
		x1=np[0];y1=np[1];x2=np[2];	y2=np[3];
		var cvs=document.createElement("canvas");
		cvs.style.position="absolute";
		cvs.style.visibility=this.visible;
		cvs.width=Math.abs(x1-x2)||this.size;
		cvs.height=Math.abs(y1-y2)||this.size;
		var newY=Math.min(y1,y2);
		var newX=Math.min(x1,x2);
		cvs.style.top=newY+"px";
		cvs.style.left=newX+"px";
		var FG=cvs.getContext("2d");
		FG.save();//缓存历史设置
		FG.strokeStyle=this.color;
		FG.lineWidth=this.size;
		FG.globalAlpha=1;//透明度；	
		FG.beginPath(); 
		FG.moveTo(x1-newX,y1-newY);
		FG.lineTo(x2-newX,y2-newY);
		FG.closePath();
		FG.stroke();
		FG.restore();//恢复历史设置
		this.lines.push(cvs);
		this.tmpDom.appendChild(cvs);		
	},	
	IELine:function(x1,y1,x2,y2){
		if(Math.abs(y1-y2)<(JoinLine.indent*2)&&x1==x2)return;//自动确定同列的是否连线
		var np=this.nPos(x1,y1,x2,y2,JoinLine.indent);//两端缩减函数（防止覆盖球）
		x1=np[0];y1=np[1];x2=np[2];	y2=np[3];		
		var line = document .createElement( "<esun:line></esun:line>" );
		line.from=x1+","+y1;
		line.to=x2+","+y2;
		line.strokeColor=this.color;
		line.strokeWeight=this.size+"px";
		line.style.cssText="position:absolute;z-index:999;top:0;left:0";
		line.style.visibility=this.visible;
		line.coordOrigin="0,0";
		this.lines.push(line);
		this.tmpDom.appendChild(line);
	},
	nPos:function(x1, y1, x2, y2, r){
		var a = x1 - x2, b = y1 - y2;
		var c = Math.round(Math.sqrt(Math.pow(a, 2) + Math.pow(b, 2)));
		var x3, y3, x4, y4;
		var _a = Math.round((a * r)/c);
		var _b = Math.round((b * r)/c);
		return [x2 + _a, y2 + _b, x1 - _a, y1 - _b]; 
	}
};

JoinLine.indent=8;

/* 过滤搜索连线操纵类*/
LG=function(table,_x,_y,width,margin_bottom,fn_check){
	var rect={x:_x||0,y:_y||0,w:width||0,oh:margin_bottom||0};	
	var trs=document.getElementById(table).rows;
	var row_start=rect.y<0?(trs.length+rect.y):rect.y;
	var row_end=trs.length-rect.oh;
	var col_start=rect.x<0?(trs[row_start].cells.length+rect.x):rect.x;
	var col_end=col_start+rect.w;
	if(col_end>trs[row_start].cells.length)col_end=trs[row_start].cells.length;	
	if(rect.w==0)col_end=trs[row_start].cells.length;	
	this.g=[];
	for(var i=row_start;i<row_end;i++){/* 检测每一组图形 */
		var tr=trs[i].cells;
		for(var j=col_start;j<col_end;j++){
			var td=tr[j];
			/* 检测器返回绝对真时，单元格才被添加到组 */
			if(td){
				if(fn_check(td,j,i)===true)this.g.push(td);
			}
		};
	};
	if(LG.autoDraw)this.draw();
};
LG.color='#E4A8A8';/*折线默认色*/
LG.size=2;/*折线宽度*/
LG.autoDraw=true;/* 默认自动绘线 */
LG.isShow=true;
LG.prototype={
	draw:function(){
		this.line=new JoinLine(LG.color,LG.size);
		this.line.join(this.g,LG.isShow);
	},
	show:function(yes){this.line.show(yes)}
}

Chart={};
Chart.on=function(o,type,fn){
	o.attachEvent?o.attachEvent('on'+type,function(){
		fn.call(o)
	}):o.addEventListener(type,fn,false);
};
/* 默认显示折线 */
Chart.ini={
	default_has_line:true
};
/* 初始化折线的显示*/
Chart.init=function(){
	if(!Chart.ini.default_has_line)return;
	var on_off=document.getElementById("has_line");
	if(!on_off)return;
	on_off.checked='checked';
};
/* 重写fw.onReady 延迟执行到window.onload */
fw={}
fw.onReady=function(fn){
	Chart.on(window,'load',fn);
}