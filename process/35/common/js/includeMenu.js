function includeMenu() {
	article(); //아래 컨텐츠들이 들어갈 article영역을 만들어 줌(삭제나 주석처리하면 안됨)
	videoLayer();
	if (currentPageNum != "01" && currentPageNum != totalPage) {
		header();
	}
	//navigation();
	//scriptLayer();
	//index();
	footer();
	windowClickBlock();


	//모바일은 locationCenter값을 false로 고정(변경 불가) - 모바일 크기에 맞게 들어가게 하기 위해서
	if (userAgentNavigator() == "iPhone" || userAgentNavigator() == "iPad" || userAgentNavigator() == "android" || userAgentNavigator() == "touch") {
		locationCenter = false;
	}

	//페이지 타입별 css파일과 js파일 추가
	if (pageType == "videoChange") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageVideoChange.css">');
		document.write('<script src="../common/js/pageVideoChange.js"></script>');
	}
	else if (pageType == "image") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageImage.css">');
		document.write('<script src="../common/js/pageImage.js"></script>');
	}
	else if (pageType == "imageVR") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageImageVR.css">');
		document.write('<script src="../common/js/pageImageVR.js"></script>');
	}
	else if (pageType == "write") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageWrite.css">');
		document.write('<script src="../common/js/pageWrite.js"></script>');
	}
	else if (pageType == "quiz") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageQuiz.css">');
		document.write('<script src="../common/js/pageQuiz.js"></script>');

		if (quizType.indexOf("drag") != -1) { //드래그앤드랍이 사용되면 모바일 지원을 위한 js파일 추가
			if (userAgentNavigator() == "iPhone" || userAgentNavigator() == "iPad" || userAgentNavigator() == "android" || userAgentNavigator() == "touch") {
				document.write('<script src="../common/js/DragDropTouch.js"></script>');
			}
		}
	}
	else if (pageType == "summary") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageSummary.css">');
		document.write('<script src="../common/js/pageSummary.js"></script>');
	}
	else if (pageType == "initialQuiz") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageInitialQuiz.css">');
		document.write('<script src="../common/js/pageInitialQuiz.js"></script>');
	}
	else if (pageType == "beforeQuiz") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageBeforeQuiz.css">');
		document.write('<script src="../common/js/pageBeforeQuiz.js"></script>');
	}
	else if (pageType == "choiceQuiz") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageChoiceQuiz.css">');
		document.write('<script src="../common/js/pageChoiceQuiz.js"></script>');
	}
	else if (pageType == "lineQuiz") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageLineQuiz.css">');
		document.write('<script src="../common/js/pageLineQuiz.js"></script>');
	}
	else if (pageType == "checkList") {
		$("head").append('<link rel="stylesheet" href="../common/css/pageCheckList.css">');
		document.write('<script src="../common/js/pageCheckList.js"></script>');
	}

	//이미지로된 페이지에서 순서때문에 안보이는 내용들 z-index값으로 위로 올림
	$("#courseTitle, #subTitle, #pageTitle").css({ zIndex: "1" });
	$("bookMark, windowclickblock, #opacityBarArea, #opacityPopupBtn").css({ zIndex: "2" });
	$("index, scriptlayer, realTimeScriptLayer, footer, chasiMove, #playLoad, #nextBalloon, #download, #print").css({ zIndex: "1" });


	//콘텐츠 위치에 따른 설정 변경(기본세팅은 중앙으로 되어있음)
	if (locationCenter == false) {
		$("navigation").css({ display: "none" });
		$("article").css({ top: "0px", left: "0px", marginTop: "0px", marginLeft: "0px" });
		$("#courseTitle").css({ position: "absolute" });

		if (footerInVideo == true) {
			$("footer").css({ position: "absolute", bottom: "0px" });
			$("#skip").css({ bottom: "48px" });
			$(".videoRateList").css({ bottom: "0px" });
			$("scriptLayer").css({ position: "absolute", bottom: "38px" });
			$("realTimeScriptLayer").css({ position: "absolute", bottom: "48px" });
		}
		else {
			$("footer").css({ position: "absolute", bottom: "-38px" });
			$("#skip").css({ bottom: "10px" });
			$(".videoRateList").css({ bottom: "0px" });
			$("scriptLayer").css({ position: "absolute", bottom: "0px" });
			$("realTimeScriptLayer").css({ position: "absolute", bottom: "10px" });
		}
	}
	else {
		if (footerInVideo == true) {
			$("footer").css({ position: "absolute", bottom: "-38px" });
			$("scriptLayer, realtimescriptlayer, #courseTitle, #subTitle, #pageTitle, #indexIcon, #indexLayer").css({ position: "absolute" });
		}
	}

	//컨트롤바가 영상내에 있을 경우 article의 overflow:hidden 의 css 추가(컨트롤바 숨김/보임 효과를 위한 세팅)
	if (footerInVideo == true) {
		//$("article").css({ overflow: "hidden" });
	}

	//컨텐츠들이 들어갈 article 생성
	function article() {
		var html = "";

		html += '<article style="width:' + contentsWidth + 'px; height:' + contentsHeight + 'px; margin-top:' + (-(contentsHeight + 38) / 2) + 'px; margin-left:' + (-contentsWidth / 2) + 'px;">';
		html += '</article>';

		$("body").append(html);
	}

	//팝업창이 열렸을시 화면클릭을 막기위한 투명가림막
	function windowClickBlock() {
		var html = "";
		html += '<windowClickBlock id="windowClickBlock"></windowClickBlock>';

		$("article").append(html);
	}

	//상단 이미지 영역 세팅(과정명, 차시명, 페이지명)
	function header() {
		var html = "";

		html += '<header>';
		html += '<div>';
		//과정명
		html += '<img id="courseTitle" src="./images/header/courseTitle.png" alt="과정명">';
		//차시명
		html += '<img id="subTitle" src="./images/header/subTitle_' + currentPageNum + '.png" alt="차시명">';
		//페이지명
		//html += '<img id="pageTitle" src="./images/header/pageTitle_' + currentPageNum + '.png" alt="페이지명">';

		html += '</div>';
		html += '</header>';

		$("videoLayer").append(html);
	}

	//비디오 영역 세팅
	function videoLayer() {
		var html = "";

		html += '<videoLayer>';
		html += '<video id="video" data-setup="{}" autoplay webkit-playsinline playsinline disablePictureInPicture>';

		//pageType에 따른 비디오 설정
		if (pageType == "video") {
			html += '<source src="' + videoPath + chasi + '_' + currentPageNum + '.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "videoChange") {
			html += '<source src="' + videoPath + 'videoChange.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "image") {
			html += '<source src="' + videoPath + 'imagePage.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "imageVR") {
			html += '<source src="' + videoPath + 'imageVR.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "write") {
			html += '<source src="' + videoPath + 'write.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "quiz") {
			html += '<source src="' + videoPath + 'quiz.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "summary") {
			if (summaryType == "vod") {
				html += '<source src="' + videoPath + chasi + '_' + currentPageNum + '.mp4" type="video/mp4"></source>';
			}
			else {
				html += '<source src="' + videoPath + 'summary.mp4" type="video/mp4"></source>';
			}
		}
		else if (pageType == "initialQuiz") {
			html += '<source src="' + videoPath + 'initialQuiz.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "beforeQuiz") {
			html += '<source src="' + videoPath + 'beforeQuiz.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "choiceQuiz") {
			html += '<source src="' + videoPath + 'choiceQuiz.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "lineQuiz") {
			html += '<source src="' + videoPath + 'lineQuiz.mp4" type="video/mp4"></source>';
		}
		else if (pageType == "checkList") {
			html += '<source src="' + videoPath + chasi + '_' + currentPageNum + '.mp4" type="video/mp4"></source>';
		}
		html += '</video>';

		//영상내 재생 버튼
		html += '<videoPlay>';
		html += '<div id="playLoad" style="line-height:' + contentsHeight + 'px;"><span class="icon-play-circled2-1 control-icon" id="videoPlay"></span></div>';
		html += '</videoPlay>';
		//스킵 버튼
		if (useType.indexOf("skip") != -1) {
			html += '<img id="skip" src="../common/images/controller/skip.png" alt="스킵" style="display:none;">';
		}
		//북마크 버튼
		if (useType.indexOf("bookMark") != -1) {
			html += '<bookMark>';
			html += '<img id="bookMark" src="../common/images/bookMark/bookMark.png" alt="북마크">';
			html += '<div id="bookMarkArea">';
			html += '<img id="bookMarkTitle" src="../common/images/bookMark/bookMark_title.png" alt="북마크 타이틀">';
			html += '<div class="icon-cancel control-icon" id="bookMarkAreaClose"></div>';
			html += '<div id="bookMarkListArea">';

			for (var j = 1; j <= bookMarkInfo.length; j++) {
				html += '<div id="bookMarkList_' + zerofill(j) + '">' + bookMarkInfo[j - 1][1] + '</div>';
			}
			html += '</div>';
			html += '</div>';
			html += '</bookMark>';
		}
		//다운로드 버튼
		if (useType.indexOf("download") != -1) {
			if (userAgentNavigator() != "iPhone" && userAgentNavigator() != "iPad" && userAgentNavigator() != "android") {
				html += '<img id="download" src="../common/images/controller/download.png" title="다운로드" style="opacity:0; display:none;">';
			}
		}
		//프린트 버튼
		if (useType.indexOf("print") != -1) {
			if (userAgentNavigator() != "iPhone" && userAgentNavigator() != "iPad" && userAgentNavigator() != "android") {
				html += '<img id="print" src="../common/images/controller/print.png" title="프린트" style="opacity:0; display:none;">';
			}
		}
		//팝업 버튼
		if (useType.indexOf("videoPopup") != -1) {
			for (var i = 0; i < videoPopupInfo.length; i++) {
				html += '<img class="videoPopup" id="videoPopup_' + zerofill(i + 1) + '" src="./images/videoPopup/videoPopup_' + currentPageNum + '_' + zerofill(i + 1) + '.png" style="top:' + videoPopupInfo[i][1] + 'px; left:' + videoPopupInfo[i][2] + 'px; display:none;">';
			}
			for (var i = 0; i < videoPopupInfo.length; i++) {
				for (var j = 0; j < videoPopupContentsInfo[i][0]; j++) {
					html += '<img class="videoPopupContents" id="videoPopupContents_' + zerofill(i + 1) + '_' + zerofill(j + 1) + '" src="./images/videoPopup/videoPopupContents_' + currentPageNum + '_' + zerofill(i + 1) + '_' + zerofill(j + 1) + '.png" style="display:none;">';
				}
				//팝업 내 넥백
				if (videoPopupContentsInfo[i][0] > 1) {
					html += '<div class="videoPopupContentsPrevNext" id="videoPopupContentsPrevNext_' + zerofill(i + 1) + '" style="top:' + videoPopupContentsInfo[i][1] + 'px; left:' + videoPopupContentsInfo[i][2] + 'px; display:none;">';
					html += '<span class="icon-left-dir videoPopupContentsPrev" style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 - 70) + 'px; display:none;"></span>';
					html += '<span id="videoPopupContentsNumText">';
					html += '<span class="videoPopupnumText" style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 - 20) + 'px;">1</span>';
					html += '<span style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2) + 'px;"> ㆍ </span>';
					if (videoPopupContentsInfo[i][0] < 10) {
						html += '<span style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 + 30) + 'px;">' + videoPopupContentsInfo[i][0] + '</span>';
					}
					else {
						html += '<span style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 + 25) + 'px;">' + videoPopupContentsInfo[i][0] + '</span>';
					}
					html += '</span>';
					html += '<span class="icon-right-dir videoPopupContentsNext" style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 + 60) + 'px;"></span>';
					html += '</div>';
				}

				html += '<div class="videoPopupClose" id="videoPopupClose_' + zerofill(i + 1) + '" style="top:' + videoPopupCloseInfo[i][0] + 'px; left:' + videoPopupCloseInfo[i][1] + 'px; display:none;"></div>';
			}
		}
		//투명도 조절 이미지 영역
		if (useType.indexOf("opacityPopup") != -1) {
			html += '<div id="opacityArea" style="display:none;">';
			//투명도 조절 이미지
			html += '<div id="opacityPopupArea">';
			for (var i = 0; i < opacityPopupCount; i++) {
				if (i == 0) {
					html += '<img class="opacityPopup" id="opacityPopup_' + zerofill(i + 1) + '" src="./images/opacityPopup/opacityPopupImage_' + zerofill(i + 1) + '.png">';
				}
				else {
					html += '<img class="opacityPopup" id="opacityPopup_' + zerofill(i + 1) + '" src="./images/opacityPopup/opacityPopupImage_' + zerofill(i + 1) + '.png" style="display:none;">';
				}
			}
			//넥백 버튼
			if (opacityPopupCount > 1) {
				html += '<div id="opacityPopupPrevNext">';
				html += '<span class="icon-left-big" id="opacityPopupPrev" style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 - 80) + 'px; display:none;"></span>';
				html += '<span class="icon-right-big" id="opacityPopupNext" style="left:' + contentsWidth + 'px; margin-left:' + (-contentsWidth / 2 + 60) + 'px;"></span>';
				html += '</div>';
			}
			html += '</div>';
			//투명도 조절바
			html += '<div id="opacityBarArea">';
			html += '<div id="opacityBar"></div>';
			html += '<div id="opacityBarPoint"></div>';
			html += '</div>';

			html += '</div>';
			//투명도 조절 이미지 버튼
			html += '<img id="opacityPopupBtn" src="../common/images/opacityPopup/opacityPopup.png" style="display:none;">';
		}
		html += '</videoLayer>';

		$("article").append(html);
	}

	function navigation() {
		var html = "";

		html += '<navigation>';
		//이전 버튼
		html += '<div>';
		html += '<div class="icon-left-big control-icon" id="bigPrev" title="이전 페이지"></div>';
		html += '</div>';
		//다음 버튼
		html += '<div>';
		html += '<div class=" icon-right-big control-icon" id="bigNext" title="다음 페이지"></div>';
		html += '</div>';

		html += '</navigation>';

		$("article").append(html);
	}

	//자막 영역 세팅
	function scriptLayer() {
		var html = "";

		if (realTimeScriptUse == false) {
			html += '<scriptLayer style="width: ' + contentsWidth + 'px;">';
			html += '<div class="icon-cancel control-icon" id="scriptClose"></div>';
			html += '<div id="scriptText"></div>';
			html += '</scriptLayer>';
		}
		else {
			html += '<realTimeScriptLayer style="width: ' + (contentsWidth - 150) + 'px; margin-left:' + (150 / 2) + 'px;">';
			html += '<div id="realTimeScriptText"></div>';
			html += '</realTimeScriptLayer>';
		}

		$("videoLayer").append(html);

		if (realTimeScriptUse == false) {
			$("scriptLayer #scriptText").mCustomScrollbar({
				theme: "rounded", // 테마 적용
				mouseWheelPixels: 60, // 마우스휠 속도
				scrollInertia: 1400 // 부드러운 스크롤 효과 적용
			});
			$("scriptLayer #mCSB_1_container").css({ marginRight: "20px" }); //스크립트 오른쪽 여백
			$("scriptLayer .mCSB_draggerRail").css({ background: "#ffffff" }); //스크롤바 배경색
			$("scriptLayer .mCSB_dragger_bar").css({ background: "#728dff" }); //스크롤바 포인트색
			$("scriptLayer .mCSB_container").html(scriptText[Number(currentPageNum)]);
		}
	}

	//인덱스 영역 세팅
	function index() {
		var html = "";

		html += '<index>';
		//인덱스 영역
		//html += '<img id="indexIcon" src="../common/images/controller/index.png" title="인덱스" style="margin-top:' + (contentsHeight - 62) / 2 + 'px;">'; //가운데에 위치하기 위해 margin-top의 값은 (contentsHeight - 인덱스 아이콘의 세로 길이) / 2 로 줌

		if (indexTitle[1][1].length == 2) {
			html += '<div id="indexLayer" style="height:' + 460 + 'px; top:' + 130 + 'px;">';
		}
		else {
			html += '<div id="indexLayer" style="height:' + 500 + 'px; top:' + 110 + 'px;">';
		}
		//html += '<div class="icon-cancel-squared control-icon" id="indexClose"></div>';

		var titleNum = 0;
		var pageNum = 0;
		for (var i = 0; i < indexTitle.length; i++) {
			for (var j = 0; j < indexTitle[i][1].length; j++) {
				if (indexTitle[i][1][j][1] == 0) {
					titleNum++;
				}
				else {
					titleNum += indexTitle[i][1][j][1];
				}
			}
			//인덱스 모듈명
			if (zerofill(pageNum + 1) <= currentPageNum && zerofill(titleNum) >= currentPageNum) {
				html += '<div class="indexTitle" id="indexTitle_' + zerofill(pageNum + 1) + '"><div class="indexTitleText" id="indexTitleText_' + zerofill(pageNum + 1) + '" style="color:#728dff;">' + indexTitle[i][0] + '</div>';
			}
			else {
				html += '<div class="indexTitle" id="indexTitle_' + zerofill(pageNum + 1) + '"><div class="indexTitleText" id="indexTitleText_' + zerofill(pageNum + 1) + '">' + indexTitle[i][0] + '</div>';
			}

			//인덱스 페이지명
			for (var j = 0; j < indexTitle[i][1].length; j++) {
				pageNum++;
				if (indexTitle[i][1][j][1] == 1) { //페이지가 1개일 경우
					html += '<div class="indexSubTitle" id="indexSubTitle_' + zerofill(pageNum) + '">' + indexTitle[i][1][j][0] + '</div>';
				}
				else { //페이지가 1개가 아닐 경우
					for (var k = 0; k < indexTitle[i][1][j][1]; k++) {
						if (k == 0) {
							html += '<div class="indexSubTitle" id="indexSubTitle_' + zerofill(pageNum) + '">';
							if (indexTitle[i][1][j][2] != undefined && indexTitle[i][1][j][2] != null && indexTitle[i][1][j][2] != "") {
								html += '<div class="indexSubSubMark icon-right-dir" id="indexSubSubMark_' + zerofill(pageNum) + '"></div>';
							}
							html += indexTitle[i][1][j][0];
							if (indexTitle[i][1][j][2] != undefined && indexTitle[i][1][j][2] != null && indexTitle[i][1][j][2] != "") {
								html += '<div class="indexSubSubTitleArea" id="indexSubSubTitleArea_' + zerofill(pageNum) + '" style="display:none;">';
								for (var l = 0; l < indexTitle[i][1][j][2].length; l++) {
									if (zerofill(pageNum + l) == currentPageNum) {
										html += '<div class="indexSubSubTitle" id="indexSubSubTitle_' + zerofill(pageNum + l) + '" style="color:#728dff; background-color:#ffffff;">' + indexTitle[i][1][j][2][l] + '</div>';
									}
									else {
										html += '<div class="indexSubSubTitle" id="indexSubSubTitle_' + zerofill(pageNum + l) + '">' + indexTitle[i][1][j][2][l] + '</div>';
									}
								}
								html += '</div>';
							}
							html += '</div>';
						}
						else {
							pageNum++;
						}
					}
				}

				if (j + 1 == indexTitle[i][1].length) {
					if (i + 1 != indexTitle.length) {
						html += '<hr>';
					}
					else {
						html += '<hr style="opacity:0;">';
					}
				}
			}
			html += '</div>';
		}

		html += '</div>';
		html += '</index>';

		$("videoLayer").append(html);

		//indexSubSubMark의 중앙 정렬 세팅
		var subSubMarkNum = 0;
		for (var i = 0; i < indexTitle.length; i++) {
			for (var j = 0; j < indexTitle[i][1].length; j++) {
				subSubMarkNum++;
				if (indexTitle[i][1][j][1] > 1) {
					for (var k = 0; k < indexTitle[i][1][j][1]; k++) {
						if (k == 0) {
							if (indexTitle[i][1][j][2] != undefined && indexTitle[i][1][j][2] != null && indexTitle[i][1][j][2] != "") {
								$("#indexSubSubMark_" + zerofill(subSubMarkNum)).css({ marginTop: "1px" });
							}
						}
						else {
							subSubMarkNum++;
						}
					}
				}
			}
		}

		//인덱스 목록에 현재 페이지에 해당하는 id값이 존재하면 인덱스 컬러 변경
		if ($("#indexSubTitle_" + zerofill(currentPageNum)).length > 0) {
			$("#indexSubTitle_" + zerofill(currentPageNum)).css({ "color": "#ffffff", "background": "#728dff" });
		}

		//숨겨진 페이지에 해당하는 인덱스 컬러 변경
		var behindPageNum1 = 0;
		var behindPageNum2 = 0;
		for (var i = 0; i < indexTitle.length; i++) {
			for (var j = 0; j < indexTitle[i][1].length; j++) {
				behindPageNum1++;

				if (indexTitle[i][1][j][1] != 1) {
					if (indexTitle[i][1][j][1] == 0) {
						behindPageNum2 = behindPageNum1 + indexTitle[i][1][j][1];
					}
					else {
						behindPageNum2 = behindPageNum1 + indexTitle[i][1][j][1] - 1;
					}

					if (Number(currentPageNum) > behindPageNum1 && Number(currentPageNum) <= behindPageNum2) {
						$("#indexSubTitle_" + zerofill(behindPageNum1)).css({ "color": "#ffffff", "background": "#728dff" });
					}
					behindPageNum1 = behindPageNum2;
				}
			}
		}
	}

	//컨트롤바 영역 세팅
	function footer() {
		var html = "";

		html += '<footer>';
		//컨트롤바 숨김/보임 버튼
		/*
		html += '<div id="controlLock">';
		html += '<div class="icon-lock-filled control-icon" id="controlLockOnOff" title="Control Bar Hide"></div>';
		html += '</div>';
		*/
		//재생속도 버튼
		//숫자만 바꿔주면 자동으로 그 숫자 속도로 설정되고 목록을 더 추가하면 자동으로 칸 늘어남  ex) html += '<div id="videoRate_5_0">5.0</div>'; 추가하면 높이조절할 필요없이 칸늘어나서 생김
		html += '<div id="videoRateLArea">';
		html += '<div class="videoRateList">';
		html += '<div id="videoRate_2_0">2.0</div>';
		html += '<div id="videoRate_1_5">1.5</div>';
		html += '<div id="videoRate_1_2">1.2</div>';
		html += '<div id="videoRate_1_0" style="background-color:#728dff;">1.0</div>';
		html += '</div>';
		html += '<div id="videoRateBg">';
		html += '<div id="videoRate" title="Playback Speed"> 1.0 </div>';
		html += '</div>';
		html += '</div>';
		//재생바
		html += '<div id="progressArea">';
		html += '<div id="progressBarArea">';
		html += '<div id="progressBar"></div>';
		if (useType == "progressBookMark") { //재생바 내 북마크
			for (var i = 1; i <= progressBookMarkInfo.length; i++) {
				html += '<img class="progressBookMarkPoint" id="progressBookMarkPoint_' + zerofill(i) + '" src="../common/images/bookMark/progressBookMarkPoint.png">';
				html += '<img class="progressBookMarkText" id="progressBookMarkText_' + zerofill(i) + '" src="./images/bookMark/bookMarkText_' + currentPageNum + '_' + zerofill(i) + '.png" style="display:none;">';
			}
		}
		html += '</div>';
		html += '</div>';

		//재생/일시정지 버튼
		html += '<div id="playPauseBtn">';
		html += '<div class="icon-play-5 control-icon" id="playPause" title="Play"></div>';
		html += '</div>';
		//타임라인
		html += '<div id="timeArea">';
		html += '<div id="timeAreaSpan">';
		html += '<span id="playTime">00:00</span>';
		html += '<span>/</span>';
		html += '<span id="totalTime">00:00</span>';
		html += '</div>';
		html += '</div>';
		//자막 버튼
		/*
		html += '<div id="scriptBtn">';
		html += '<div class="icon-menu control-icon" id="script" title="Script"></div>';
		html += '</div>';
		*/
		//인덱스 버튼
		/*
		html += '<div id="indexBtn">';
		html += '<div class="control-icon" id="index" title="인덱스"> INDEX</div>';
		html += '</div>';
		*/
		//러닝맵 버튼
		/*
		html += '<div id="learningMapBtn">';
		html += '<div class="icon-news control-icon" id="learningMap" title="러닝맵"></div>';
		html += '</div>';
		*/
		//다시듣기 버튼
		html += '<div id="rePlayBtn">';
		html += '<div class="icon-ccw control-icon" id="rePlay" title="Replay"></div>';
		html += '</div>';
		//전체화면 버튼
		html += '<div id="fullScreenBtn">';
		html += '<div class="icon-resize-full control-icon" id="fullScreen" title="Full Screen"></div>';
		html += '</div>';
		//다운로드 버튼
		/*
		html += '<div id="mainDownloadBtn">';
		html += '<div class="icon-download control-icon" id="mainDownload" title="교안 다운로드"></div>';
		html += '</div>';
		*/
		//음소거 버튼
		html += '<div id="muteBtn">';
		html += '<div class="icon-volume-off control-icon" id="mute" title="Mute"></div>';
		html += '</div>';
		//음량조절 버튼
		html += '<div id="volumeArea">';
		html += '<div id="volumeBarArea" title="Volume Control">';
		html += '<div id="volumeBar"></div>';
		html += '</div>';
		html += '</div>';
		//뒤로감기 버튼
		/*
		html += '<div id="backwardBtn">';
		html += '<div class="icon-fast-backward control-icon" id="backward" title="10초 뒤로"></div>';
		html += '</div>';
		*/
		//앞으로감기 버튼
		/*
		html += '<div id="forwardBtn">';
		html += '<div class="icon-fast-forward control-icon" id="forward" title="10초 앞으로"></div>';
		html += '</div>';
		*/
		//이전 버튼
		html += '<div id="prevBtn">';
		html += '<div class="icon-left-open control-icon" id="prev" title="Previous Page"></div>';
		html += '</div>';
		//다음 버튼
		html += '<div id="nextBtn">';
		html += '<div class="icon-right-open control-icon" id="next" title="Next Page"></div>';
		html += '</div>';
		//말풍선 다음 버튼
		html += '<div id="balloonBtn">';
		if (currentPageNum != zerofill(Number(totalPage))) {
			html += '<img id="nextBalloon" src="../common/images/controller/next_balloon.png" alt="다음 페이지" title="Next Page">';
		}
		else {
			html += '<img id="nextBalloon" src="../common/images/controller/last_balloon.png" alt="마지막 페이지" title="Last Page">';
		}
		html += '</div>';
		//현재페이지/총페이지
		html += '<div id="pageArea">';
		html += '<div id="pageAreaSpan">';
		html += '<span>' + currentPageNum + '</span>';
		html += '<span>|</span>';
		html += '<span>' + zerofill(Number(totalPage)) + '</span>';
		html += '</div>';
		html += '</div>';

		html += '</footer>';

		$("videoLayer").append(html);
	}
}
includeMenu();