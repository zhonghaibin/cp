function userBeforeLogin(){
	var u=this.username.value;
	if(!u || u=='帐号'){alert("请输入用户名");}
	else{return true;}
	return false;
}
function userLogin(err, data){
	if(err){
		alert(err);
		$("#vcode").trigger("click");
	}else{
		location='/';
	}
}