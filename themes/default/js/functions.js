$(document).ready(function(){
	var lHeight = $("#sideLeft").height();
	var mHeight = $("#container").height();
	if (lHeight>mHeight){
		$("#container").css({
			"height": lHeight +70
		});
	} else {
		$("#container").css({
			"height": mHeight
		});
	}
});