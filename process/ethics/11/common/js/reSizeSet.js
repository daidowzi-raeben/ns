var contentsWidth = 1280;
var contentsHeight = 720;

function scaleSet() {
	var scaleSet;
	if (window.innerWidth / contentsWidth > window.innerHeight / contentsHeight) {
		scaleSet = window.innerHeight / contentsHeight;
	}
	else {
		scaleSet = window.innerWidth / contentsWidth;
	}
	if(scaleSet > 1){
		$("body").css({ transformOrigin: "0% 0%", transform: "scale(1)" });
	}else{
		$("body").css({ transformOrigin: "0% 0%", transform: "scale(" + scaleSet + ")" });
		
	}
}

scaleSet();

$(window).resize(function () {
	scaleSet();
});