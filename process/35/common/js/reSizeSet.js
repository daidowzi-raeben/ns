if (userAgentNavigator() == "iPhone" || userAgentNavigator() == "iPad" || userAgentNavigator() == "android" || userAgentNavigator() == "touch") { //모바일일 경우 사이즈 및 위치 관련 세팅
	var showFooter = false; //모바일에서 특수페이지의 컨트롤바를 보여줄 변수

	$("index, #indexIcon, #index, #controlLockOnOff, #script, #mainDownload, #videoRate, #videoRateBg, #volumeBarArea, #learningMap, #mute, #fullScreen, #backward, #forward").hide(); //안쓸 버튼들 hide

	//쓰는 버튼들 크기&위치 변경
	$("footer").css({ height: "55px", bottom: "0px" });
	$("#skip").css({ bottom: "75px" });

	$("footer > div > .control-icon").css({ fontSize: "35px", top: "28px" });
	$("footer > div > #progressBarArea").css({ width: (contentsWidth / 2 - 160), height: "18px", top: "18px", left: -(contentsWidth / 2 - 20) + "px" });
	$("footer > div > #timeAreaSpan").css({ top: "28px", left: "-100px", fontSize: "27px" });

	$("footer > div > #playPause").css({ left: (contentsWidth / 2 - 360) + "px" });

	$("footer > div > #rePlay").css({ left: (contentsWidth / 2 - 300) + "px" });

	$("footer > div > #prev").css({ left: (contentsWidth / 2 - 210) + "px" });
	$("footer > div > #next").css({ left: (contentsWidth / 2 - 40) + "px" });

	$("footer > #pageArea > #pageAreaSpan").css({ top: "28px", left: (contentsWidth / 2 - 170) + "px" });
	$("footer > #pageArea > #pageAreaSpan > span:nth-child(1)").css({ fontSize: "33px" });
	$("footer > #pageArea > #pageAreaSpan > span:nth-child(2)").css({ left: "50px", fontSize: "20px" });
	$("footer > #pageArea > #pageAreaSpan > span:nth-child(3)").css({ left: "65px", fontSize: "33px" });


	//header, footer 클릭으로 보임/숨김
	if (pageType != "imageVR") {
		var mobileHide = setTimeout(function () { $("header, footer").hide(); }, 3000);
	}

	if (pageType == "video" || pageType == "videoChange") {
		$("article").on("click", function () {
			clearTimeout(mobileHide);
			$("header, footer").show();
			mobileHide = setTimeout(function () { $("header, footer").hide(); }, 3000);
		});
	}
	else {
		$("article").on("click", function () {
			if (showFooter == true) {
				clearTimeout(mobileHide);
				$("header, footer").show();
				mobileHide = setTimeout(function () { $("header, footer").hide(); }, 3000);
			}
		});
	}

	//사이즈에 맞게 스케일 변경
	function scaleSetMobile() {
		if (window.innerWidth / contentsWidth > window.innerHeight / contentsHeight) {
			mobileScale = window.innerHeight / contentsHeight;
		}
		else {
			mobileScale = window.innerWidth / contentsWidth;
		}

		$("article").css({ left: (window.innerWidth - $("article").css("width").split("px")[0] * mobileScale) / 2 + "px" });
		$("article").css({ top: (window.innerHeight - $("article").css("height").split("px")[0] * mobileScale) / 2 + "px" });
		$("article").css({ transformOrigin: "0% 0%", transform: "scale(" + mobileScale + ")" });
		$(".progressBookMarkPoint").css({ top: "2px", transform: "scale(1.7)" });
	}

	scaleSetMobile();

	$(window).resize(function () {
		scaleSetMobile();
	});
}
else { //모바일이 아닐 경우 전체화면 관련 세팅
	var fullSceenState = false;

	var scaling;
	if (window.screen.width / contentsWidth > window.screen.height / contentsHeight) {
		scaling = window.screen.height / contentsHeight;
	}
	else {
		scaling = window.screen.width / contentsWidth;
	}

	//전체화면 모드일 때
	var fullScreenSet = function () {
		fullSceenState = true;
		$("#fullScreen").attr({ class: "icon-resize-small control-icon", title: "전체화면 해제" });

		function scaleSetPC() {
			getScale = window.innerWidth / contentsWidth;

			if (locationCenter == true) {
				$("article").css({ transformOrigin: "50% 50%", transform: "scale(" + getScale + ")" });
				$("article").css({ marginTop: "-360px" });
			}
			else {
				$("article").css({ transformOrigin: "0% 0%", transform: "scale(" + getScale + ")" });
				$("footer").css({ bottom: "0px" });
				$("scriptlayer").css({ bottom: "38px" });
				$("realTimeScriptLayer").css({ bottom: "48px" });
			}

			$("scriptLayer, realTimeScriptLayer, footer, #indexIcon, #indexLayer, #courseTitle, #subTitle, #pageTitle").css({ position: "absolute" });
		}

		scaleSetPC();

		$(window).resize(function () {
			scaleSetPC();
		});
	}
	//원래화면 모드일 때
	var resizeScreenSet = function () {
		fullSceenState = false;
		$("#fullScreen").attr({ class: "icon-resize-full control-icon", title: "전체화면" });

		function scaleSetPC() {
			getScale = 1;

			$("article").css({ transformOrigin: "", transform: "" });
			$("article").css({ marginTop: "-379px" });

			if (locationCenter == true && footerInVideo == false) {
				$("scriptLayer, realTimeScriptLayer, footer, #indexIcon, #indexLayer, #courseTitle, #subTitle, #pageTitle").css({ position: "" });
			}
			else if (locationCenter == false && footerInVideo == false) {
				$("footer").css({ bottom: "-38px" });
				$("scriptlayer").css({ bottom: "0px" });
				$("realTimeScriptLayer").css({ bottom: "10px" });
			}
		}

		scaleSetPC();

		$(window).resize(function () {
			scaleSetPC();
		});
	}
	//전체화면 모드에서 Esc를 눌러 종료했을 때
	document.addEventListener("fullscreenchange", exitHandler);
	document.addEventListener("webkitfullscreenchange", exitHandler);
	document.addEventListener("mozfullscreenchange", exitHandler);
	document.addEventListener("MSFullscreenChange", exitHandler);
	function exitHandler() {
		if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
			resizeScreenSet();
		}
	}
}