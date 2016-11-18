$.ajaxSetup({
	complete:function(xhr, textStatus){
		var url=xhr.getResponseHeader('location');
		if(top.location=url);
	}
});