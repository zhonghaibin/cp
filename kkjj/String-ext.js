String.prototype.format=function(){
	if(arguments.length==0) return this;
	
	var args=[], i=0;
	for(;i<arguments.length;i++) args[i]=arguments[i];
	
	return this.replace(/\%[sSfdDTt\%]/g, function(m){
		if(m=='%%') return '%';
		
		var v=args.shift();
		switch(m.substr(1,1)){
			case 's': return v.toString();
			case 'S': return "'"+v.replace("'","\\'")+"'";
			case 'f': return v-0;
			case 'd': return v.getFullYear()+'-'+v.getMonth()+'-'+v.getDate();
			case 'D': return v.getMonth()+'-'+v.getDate();
			case 't': return v.getHours()+'-'+v.getMinutes()+'-'+v.getSeconds();
			case 't': return v.getHours()+'-'+v.getMinutes();
		}
	});
}

String.prototype.removeFromList=function(c){
	var arr=this.split(c), i=1;
	for(;i<arguments.length;i++) delete arr[arguments[i]-1];
	return arr.filter(function(v){return v!==undefined}).join(c);
}

String.prototype.replaceList=function(c,i,s){
	s=s||',';
	var ret=this.split(s);
	ret[i-1]=c;
	return ret.join(s);
}

String.prototype.reverse=function(){
	return this.split("").reverse().join("");
}