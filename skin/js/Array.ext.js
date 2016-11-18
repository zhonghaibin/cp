if(!Array.prototype.forEach) Array.prototype.forEach=function(callback){
	for(var i=0; i<this.length; i++){
		callback(this[i], i);
	}
}

if(!Array.prototype.random){
	
}

if(!Array.prototype.remove) Array.prototype.remove=function(i){
	return this.splice(i,1);
}

if(!Array.prototype.sum) Array.prototype.sum=function(){
	var i, sum=0;
	for(i=0; i<this.length; i++){
		sum+=this[i];
	}
	return sum;
}

if(!Array.prototype.max) Array.prototype.max=function(){
	if(this.length==0) return;
	var i=0, value=this[i];
	for(i=1; i<this.length; i++){
		if(value<this[i]) value=this[i];
	}
	return value;
}

if(!Array.prototype.min) Array.prototype.min=function(){
	if(this.length==0) return;
	var i=0; value=this[i];
	for(i=1; i<this.length; i++){
		if(value>this[i]) value=this[i];
	}
	return value;
}

if(!Array.prototype.indexOf) Array.prototype.indexOf=function(value){
	for(var i=0; i<this.length; i++){
		if(this[i]===value) return i;
	}
	return -1;
}

if(!Array.prototype.lastIndexOf) Array.prototype.lastIndexOf=function(value){
	for(var i=this.length-1; i>=0; i--){
		if(this[i]===value) return i;
	}
	return -1;
}

if(!Array.prototype.every) Array.prototype.every=function(callback){
	for(var i=0; i<this.length; i++){
		if(!callback(this[i])) return false;
	}
	return true;
}

if(!Array.prototype.some) Array.prototype.some=function(callback){
	for(var i=0; i<this.length; i++){
		if(callback(this[i])) return true;
	}
	return false;
}

if(!Array.prototype.filter) Array.prototype.filter=function(callback){
	var i,arr=[];
	for(i=0; i<this.length; i++){
		if(callback(this[i])) arr.push(this[i]);
	}
	return arr;
}

if(!Array.prototype.map) Array.prototype.map=function(callback){
	var i,arr=[];
	for(i=0; i<this.length; i++){
		arr.push(callback(this[i]));
	}
	return arr;
}

if(!Array.prototype.reduce){

}

if(!Array.prototype.reduceRight){

}