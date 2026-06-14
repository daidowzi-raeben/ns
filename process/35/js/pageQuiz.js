var quizNum = 1; //퀴즈를 불러올 번호
var chance = 2; //퀴즈를 풀 기회 수
var answerCount = 0; //정답 수를 저장할 변수
var result = ""; //정오답을 저장할 변수
var saveId; //클릭한 요소의 ID값을 저장할 함수
var changeUse = true; //OX퀴즈에서 마우스오버아웃 함수를 호출할 때 익스플로러에서 선택하고 나서도 함수가 호출되는 문제를 해결하기 위해 만든 스위치 변수

var soundQuizStart = new Audio("../common/sound/quiz/quizStart.mp3");
var soundAnswerO = new Audio("../common/sound/quiz/answer_O.mp3");
var soundAnswerX = new Audio("../common/sound/quiz/answer_X.mp3");
var soundAnswerAgain = new Audio("../common/sound/quiz/again.mp3");
var soundQuizResult = new Audio("../common/sound/quiz/quizResult.mp3");

makeQuizPage();
makeQuiz(quizNum);

// [수정] 퀴즈 완료(결과보기까지) 여부 플래그
var quizSolved = false;

// [수정] 다음 관련 버튼 상태 제어 함수 (활성/비활성 UI)
function setNextBtnState(enabled) {
	var opacity = enabled ? 1 : 0.35;
	var pointerEvents = enabled ? "auto" : "none";
	var cursor = enabled ? "pointer" : "default";

	$("#next, #bigNext, #nextBalloon").css({
		opacity: opacity,
		pointerEvents: pointerEvents,
		cursor: cursor
	});
}

// [수정] 초기 진입 시 다음 버튼 비활성화
setNextBtnState(false);

function makeQuizPage() {
	var html = '';

	html += '<div id="quizArea" style="width:' + contentsWidth + 'px; height:' + contentsHeight + 'px; display:none;">';
	html += '</div>';
	//퀴즈 시작화면
	html += '<div id="frontQuizArea">';
	//html += '<img id="frontQuiz" src="../common/images/quiz/frontQuizBg.png">';
	//html += '<div id="quizStart" onclick="quizStart()" style="display:none;"></div>';
	html += '<div id="quizStart" onclick="quizStart()"></div>';
	html += '</div>';

	$("videoLayer").append(html);
}

function makeQuiz(num) {
	$("#quizArea").empty();

	var html = '';

	//퀴즈 배경
	if (quizType[num - 1] == "OX") {
		html += '<img id="quizBg" src="../common/images/quiz/quizBg_OX.png">';
	}
	else {
		html += '<img id="quizBg" src="../common/images/quiz/quizBg_N.png">';
	}

	//퀴즈 질문 영역
	html += '<div id="quizQuestionArea" style="width:' + contentsWidth + 'px; height:' + quizQuestionHeight[num - 1] + 'px;">';
	html += '<img id="quizQuestion" src="./images/quiz/quizQuestion_' + zerofill(num) + '.png">';
	html += '</div>';

	//퀴즈 보기 영역
	html += '<div id="quizExampleArea" style="width:' + contentsWidth + 'px; height:' + (contentsHeight - quizQuestionHeight[num - 1] - quizAnswerHeight[num - 1]) + 'px; top:' + quizQuestionHeight[num - 1] + 'px;">';
	if (quizType[num - 1] == "OX") {
		html += '<div id="quizTypeOX">';
		html += '<img id="select_O" src="../common/images/quiz/select_O.png" onmouseover="mouseOverCommon(this)" onmouseout="mouseOutCommon(this)" onclick="quizExampleClick(this)">';
		html += '<img id="select_X" src="../common/images/quiz/select_X.png" onmouseover="mouseOverCommon(this)" onmouseout="mouseOutCommon(this)" onclick="quizExampleClick(this)">';
		html += '</div>';
	}
	else if (quizType[num - 1].split("_")[0] == "N") {
		html += '<div id="quizTypeN">';
		for (var j = 1; j <= quizType[num - 1].split("_")[1]; j++) {
			if (exampleType == "img") {
				html += '<img id="quizExample_' + zerofill(num) + '_' + zerofill(j) + '" src="./images/quiz/quizExample_' + zerofill(num) + '_' + zerofill(j) + '.png" onmouseover="mouseOverExample(this)" onmouseout="mouseOutExample(this)" onclick="quizExampleClick(this)">';
			}
			else if (exampleType == "text") {
				html += '<div id="quizExample_' + zerofill(num) + '_' + zerofill(j) + '">';
				html += '<div class="quizExampleNum" id="quizExampleNum_' + zerofill(j) + '" onclick="quizExampleClick(this)">' + j + '</div>';
				html += '<span class="quizExampleText" id="quizExampleText_' + zerofill(j) + '" onclick="quizExampleClick(this)">' + exampleText[num][j - 1] + '</span>';
				html += '</div>';
			}
		}
		html += '</div>';
	}
	else if (quizType[num - 1] == "drag") {
		html += '<div id="quizTypeDragDrop">';
		html += '<img id="confirm" src="../common/images/quiz/confirm.png" onmouseover="mouseOverCommon(this)" onmouseout="mouseOutCommon(this)" onclick="confirmDragDrop()">';
		for (var i = 0; i < quizAnswer[num - 1].length; i++) {
			html += '<div class="dropZone" id="dropZone_' + zerofill(i + 1) + '" style="width:' + (dragImgInfo[num - 1][0] + 2) + 'px; height:' + (dragImgInfo[num - 1][1] + 2) + 'px; top:' + dropZoneInfo[num - 1][i][0] + 'px; left:' + dropZoneInfo[num - 1][i][1] + 'px;" ondrop="drop(this, event);" ondragover="dropDefault(event);"></div>';
		}
		html += '<table id="dragExampleArea">';
		html += '<tbody>';
		html += '<tr>';
		html += '<th id="dragExampleText"><div>보기</div></th>';
		for (var i = 0; i < quizAnswer[num - 1].length; i++) {
			html += '<th class="dragExampleItem">';
			html += '<div class="exampleZone" id="exampleZone_' + zerofill(i + 1) + '" style="width:' + (dragImgInfo[num - 1][0] + 2) + 'px; height:' + (dragImgInfo[num - 1][1] + 2) + 'px;" ondrop="drop(this, event);" ondragover="dropDefault(event);">';
			html += '<img id="exampleItem_' + zerofill(i + 1) + '" src="./images/quiz/dragItem_' + zerofill(num) + '_' + zerofill(i + 1) + '.png" style="width:' + dragImgInfo[num - 1][0] + 'px; height:' + dragImgInfo[num - 1][1] + 'px;" draggable="true" ondragstart="drag(this, event);">';
			html += '</div>';
			html += '</th>';
		}
		html += '</tr>';
		html += '</tbody>';
		html += '</th>';
		html += '</table>';
		html += '</div>';
	}
	html += '</div>';
	html += '<div id="ClickProhibition" style="width:' + contentsWidth + 'px; height:' + (contentsHeight - quizQuestionHeight[num - 1] - quizAnswerHeight[num - 1]) + 'px; top:' + quizQuestionHeight[num - 1] + 'px; display:none;"></div>'; //정답 공개후 클릭을 막기위한 가림막

	//퀴즈 정답해설 영역(해설 스크롤 기능을 위해 정답&해설 이미지를 나눠 놨음 - 스크롤 기능이 필요 없으면 퀴즈 해설 이미지를 주석처리하고 퀴즈 정답 이미지에 해설까지 넣어서 뽑으면 됨)
	html += '<div id="quizAnswerArea" style="width:' + contentsWidth + 'px; height:' + quizAnswerHeight[num - 1] + 'px; display:none;">';
	html += '<img id="quizAnswer" src="./images/quiz/quizAnswer_' + zerofill(num) + '.png">'; //퀴즈 정답 이미지
	/*
	html += '<div id="quizAnswerTextArea">';
	html += '<img id="quizAnswerText" src="images/quiz/quizAnswerText_' + zerofill(num) + '.png">'; //퀴즈 해설 이미지(스크롤 기능있음)
	html += '</div>';
	*/
	if (quizNum == quizType.length) {
		html += '<img id="resultQuiz" src="../common/images/quiz/resultQuiz.png" onmouseover="mouseOverCommon(this)" onmouseout="mouseOutCommon(this)" onclick="resultQuiz()">';
	}
	else {
		html += '<img id="nextQuiz" src="../common/images/quiz/nextQuiz.png" onmouseover="mouseOverCommon(this)" onmouseout="mouseOutCommon(this)" onclick="nextQuiz()">';
	}
	html += '</div>';

	//퀴즈에 띄울 이미지들 미리 세팅
	if (quizType[num - 1] == "OX") {
		html += '<img class="answer_OX" id="answer_O" src="../common/images/quiz/answer_O.png" style="display:none;">';
		html += '<img class="answer_OX" id="answer_X" src="../common/images/quiz/answer_X.png" style="display:none;">';
	}
	else if (quizType[num - 1].split("_")[0] == "N") {
		html += '<img class="answer_N" id="answer_O" src="../common/images/quiz/answer_O.png" style="display:none;">';
		html += '<img class="answer_N" id="answer_X" src="../common/images/quiz/answer_X.png" style="display:none;">';
	}
	html += '<img id="quizRight" src="../common/images/quiz/quizRight.png" style="display:none;">';
	html += '<img id="quizWrong" src="../common/images/quiz/quizWrong.png" style="display:none;">';
	html += '<img id="quizAgain" src="../common/images/quiz/quizAgain.png" style="display:none;">';
	html += '<div id="quizResultArea" style="display:none;">';
	html += '<img id="quizResult">';
	if (resultType == "text") {
		html += '<span id="resultTotalText">' + quizType.length + '</span>';
		html += '<span id="rightResultText"></span>';
		html += '<table>';
		html += '<tbody>';
		html += '<tr id="resultQuizNum">';
		for (var i = 0; i < quizType.length; i++) {
			html += '<th id="resultQuizNum_' + (i + 1) + '">Q' + (i + 1) + '</th>';
		}
		html += '</tr>';
		html += '<tr id="resultQuizLine">';
		for (var i = 0; i < quizType.length; i++) {
			html += '<th>_</th>';
		}
		html += '</tr>';
		html += '<tr id="resulChecktText">';
		for (var i = 0; i < quizType.length; i++) {
			html += '<th id="resulChecktText_' + (i + 1) + '"></th>';
		}
		html += '</tr>';
		html += '</tbody>';
		html += '</table>';
	}
	html += '<div id="replayQuiz" onclick="replayQuiz()"></div>';
	html += '</div>';

	$("#quizArea").append(html);

	if (resultType == "text") {
		$("#resultQuizNum > th , #resulChecktText > th , #resultQuizLine > th").css({ width: $("#quizResultArea > table").width() / quizType.length + "px" });
	}

	if (quizType[num - 1] == "drag") { //드래그 아이템들 갯수에 따라 위치 자동 정렬
		for (var i = 1; i <= quizAnswer[num - 1].length; i++) {
			$("#exampleZone_" + zerofill(i)).css({ left: ((($("#dragExampleArea").width() - $("#dragExampleText").width() - ((dragImgInfo[num - 1][0] + 2) * quizAnswer[num - 1].length)) / (quizAnswer[num - 1].length + 1)) * i + 100) + (dragImgInfo[num - 1][0] + 2) * (i - 1) });
		}
	}


	//퀴즈 스크롤 적용
	$("#quizAnswerTextArea").mCustomScrollbar({
		theme: "rounded", // 테마 적용
		mouseWheelPixels: 100, // 마우스휠 속도
		scrollInertia: 1400 // 부드러운 스크롤 효과 적용
	});

	$("#quizAnswerTextArea .mCSB_draggerRail").css({ "background": "#E4E4E4" }); //스크롤바 배경색
	$("#quizAnswerTextArea .mCSB_dragger_bar").css({ "background": "#8b6ce7" }); //스크롤바 포인트색
}

//드래그할 때
var dragParentId = ""; //드래그당하는 객체의 부모 id를 저장할 변수
function drag(target, e) {
	e.dataTransfer.setData("text", target.id); //드래그당하는 객체의 id를 저장
	dragParentId = document.getElementById(e.target.getAttribute("id")).parentNode.id; //드래그당하는 객체의 부모 id를 저장
}
//드롭할 때
function drop(target, e) {
	if (!document.getElementById(target.id).hasChildNodes()) { //드롭한 곳에 다른 객체가 없을 경우
		e.preventDefault();
		var data = e.dataTransfer.getData("text"); //저장한 객체를 가져와서
		target.appendChild(document.getElementById(data)); //드롭한 곳에 추가
	}
	else { //드롭한 곳에 다른 객체가 있을 경우
		e.preventDefault();
		var data = e.dataTransfer.getData("text"); //저장한 객체를 가져와서
		target.appendChild(document.getElementById(data)); //드롭한 곳에 추가
		$("#" + document.getElementById(target.id).firstChild.id).prependTo("#" + dragParentId); //기존에 있던 객체를 드래그를 시작한 위치로 이동
	}
}
//드롭끝나면 기본 동작 해제
function dropDefault(e) {
	e.preventDefault();
}
//드래그앤드롭 확인 버튼 클릭했을 때
function confirmDragDrop() {
	var DragDropCount = 0; //드롭한 갯수를 저장할 변수
	var DragDropAnswerCount = 0; //정답 수를 저장할 변수
	for (var i = 0; i < quizAnswer[quizNum - 1].length; i++) {
		if (document.getElementById("dropZone_" + zerofill(i + 1)).hasChildNodes()) {
			DragDropCount++;
		}
	}

	if (DragDropCount == quizAnswer[quizNum - 1].length) {
		for (var i = 0; i < quizAnswer[quizNum - 1].length; i++) {
			if (Number(document.getElementById("dropZone_" + zerofill(i + 1)).firstChild.id.split("_")[1]) == quizAnswer[quizNum - 1][i]) {
				DragDropAnswerCount++;
			}
			else {
				if (chance > 1) {
					$("#exampleItem_" + document.getElementById("dropZone_" + zerofill(i + 1)).firstChild.id.split("_")[1]).prependTo("#exampleZone_" + document.getElementById("dropZone_" + zerofill(i + 1)).firstChild.id.split("_")[1]); //틀린 드롭은 보기의 자기 위치로 이동
				}
			}
		}

		if (DragDropAnswerCount == quizAnswer[quizNum - 1].length) {
			soundAnswerO.play();
			result += "o";
			answerCount++;

			$("#quizRight").fadeIn(500, function () { setTimeout(function () { $("#quizRight").fadeOut(1000) }, 1000); });
			$("#quizAnswerArea , #answer_O , #ClickProhibition").show();
			$("#quizTypeDragDrop > #confirm").hide();
		}
		else {
			if (chance > 1) {
				soundAnswerAgain.play();
				chance--;

				$("#quizAgain").fadeIn(500, function () { setTimeout(function () { $("#quizAgain").fadeOut(1000) }, 1000); });
			}
			else {
				for (var i = 0; i < quizAnswer[quizNum - 1].length; i++) {
					$("#exampleItem_" + zerofill(quizAnswer[quizNum - 1][i])).prependTo("#dropZone_" + zerofill(i + 1)); //정답 위치로 이동
				}
				soundAnswerX.play();
				result += "x";

				$("#quizWrong").fadeIn(500, function () { setTimeout(function () { $("#quizWrong").fadeOut(1000) }, 1000); });
				$("#quizAnswerArea , #answer_X , #ClickProhibition").show();
				$("#quizTypeDragDrop > #confirm").hide();
			}
		}
	}
	else {
		soundAnswerAgain.play();
		$("#quizUncompleted").fadeIn(500, function () { setTimeout(function () { $("#quizUncompleted").fadeOut(1000) }, 1000); });
	}
}

//퀴즈 공통 이미지 마우스 오버/아웃
function mouseOverCommon(str) {
	if (changeUse == true) {
		var getId = str.id;
		$("#" + getId).attr({ src: "../common/images/quiz/" + getId + "_up.png" });
	}
}
function mouseOutCommon(str) {
	if (changeUse == true) {
		var getId = str.id;
		$("#" + getId).attr({ src: "../common/images/quiz/" + getId + ".png" });
	}
}
//퀴즈 보기 이미지 마우스 오버/아웃
function mouseOverExample(str) {
	var getId = str.id;
	if (saveId != getId) {
		$("#" + getId).attr({ src: "./images/quiz/" + getId + "_up.png" });
	}
}
function mouseOutExample(str) {
	var getId = str.id;
	if (saveId != getId) {
		$("#" + getId).attr({ src: "./images/quiz/" + getId + ".png" });
	}
}

//퀴즈의 색을 바꾸는 함수
function quizColorChange(getStr) {
	//$("#quizExampleArea > #quizTypeN > div > div").css({ backgroundColor: "" });
	//$("#quizExampleArea > #quizTypeN > div > #quizExampleNum_" + zerofill(getStr)).css({ backgroundColor: "" });
	$("#quizExampleArea > #quizTypeN > div > span").css({ background: "" });
	$("#quizExampleArea > #quizTypeN > div > #quizExampleText_" + zerofill(getStr)).css({ background: "linear-gradient(#00000000, #00000000, #ffe57c, #ffe57c)" });
}

//퀴즈 보기의 줄수에 따라 간격을 다르게 하는 함수
var exampleHeightCount = 0;
function exampleInterval() {
	if (quizType[quizNum - 1].split("_")[0] == "N") {
		for (var i = 0; i < exampleText[quizNum].length; i++) {
			if (exampleText[quizNum][i].indexOf("<br>") != -1) {
				exampleHeightCount++;
			}
		}

		for (var i = 0; i <= exampleText[quizNum].length; i++) {
			if (exampleHeightCount == i) {
				if (Number(quizType[quizNum - 1].split("_")[1]) > 4) {
					$("#quizArea > #quizExampleArea > #quizTypeN > div").css({ marginBottom: (30 - i * 5) + "px" }); //세팅에 맞게 값 수정 필요
				}
				else {
					$("#quizArea > #quizExampleArea > #quizTypeN > div").css({ marginBottom: (44 - i * 7) + "px" }); //세팅에 맞게 값 수정 필요
				}
			}
		}
		exampleHeightCount = 0;
	}
}

//퀴즈 시작 버튼 클릭했을 때
function quizStart() {
	$("#frontQuizArea").hide();
	$("#quizArea").show();
	soundQuizStart.play();
	exampleInterval();

	if ($("#progressBarArea > #progressBar").css("width") == "0px") {
		video.play();
	}
	else {
		video.currentTime = video.duration;
	}
}
//퀴즈 다음문제 버튼 클릭했을 때
function nextQuiz() {
	if (quizNum < quizType.length) {
		changeUse = true;
		chance = 2;
		quizNum++;
		makeQuiz(quizNum);
		exampleInterval();
	}
}
//퀴즈 결과보기 버튼 클릭했을 때
function resultQuiz() {
	soundQuizResult.play();

	if (resultType == "text") {
		$("#quizResult").attr({ src: "../common/images/quiz/resultBg.png" });
		rightResultText.innerHTML = answerCount;

		for (var i = 0; i < quizType.length; i++) {
			$("#resulChecktText_" + (i + 1)).text(result.substring(i, i + 1));
			if (result.substring(i, i + 1) == "O") {
				$("#resulChecktText_" + (i + 1)).css({ color: "#a090f7" });
			}
			else if (result.substring(i, i + 1) == "X") {
				$("#resulChecktText_" + (i + 1)).css({ color: "#c7b47a" });
			}
			if (i != 0 && i != quizType.length - 1) {
				$("#resultQuizNum_" + (i + 1)).css({ borderLeft: "2px dotted #00ff00", borderRight: "2px dotted #00ff00", paddingBottom: "140px" });
			}
		}
	}
	else if (resultType == "img") {
		$("#quizResult").attr({ src: "../common/images/quiz/case/" + result + ".png" });
	}

	$("#quizResultArea").show();
	showBalloon();
	showFooter = true;

	// [수정] 모든 퀴즈 완료(결과보기) 이후 다음 버튼 활성화
	quizSolved = true;
	setNextBtnState(true);
}
//퀴즈 다시풀기 버튼 클릭했을 때
function replayQuiz() {
	showFooter = false;
	$("#quizResultArea").hide();
	$("#nextBalloon").hide();
	result = "";
	changeUse = true;
	answerCount = 0;
	chance = 2;
	quizNum = 1;
	makeQuiz(quizNum);
	exampleInterval();

	// [수정] 다시풀기 시 완료 상태 해제 + 다음 버튼 비활성화
	quizSolved = false;
	setNextBtnState(false);
}

//퀴즈 보기 클릭 했을 때
function quizExampleClick(str) {
	var getId = str.id;
	var getStr = getId.split("_")[getId.split("_").length - 1];

	if (quizType[quizNum - 1] == "OX") {
		changeUse = false;
		setTimeout(function () { changeUse = true }, 500);

		if (quizAnswer[quizNum - 1][0] == getStr) {
			$("#quizAnswerArea , #answer_O , #ClickProhibition").show();
			$("#quizRight").fadeIn(500, function () { setTimeout(function () { $("#quizRight").fadeOut(1000) }, 1000); });
			soundAnswerO.play();
			result += "o";
			answerCount++;
		}
		else {
			$("#quizAnswerArea , #answer_X , #ClickProhibition").show();
			$("#quizWrong").fadeIn(500, function () { setTimeout(function () { $("#quizWrong").fadeOut(1000) }, 1000); });
			soundAnswerX.play();
			result += "x";
		}
		setTimeout(function () { $("#select_" + getStr).attr({ src: "../common/images/quiz/select_" + getStr + "_up.png" }); }, 100);
	}
	else if (quizType[quizNum - 1].split("_")[0] == "N") {
		getStr = Number(getStr);

		if (quizAnswer[quizNum - 1][0] == getStr) {
			$("#quizAnswerArea , #answer_O , #ClickProhibition").show();
			$("#quizRight").fadeIn(500, function () { setTimeout(function () { $("#quizRight").fadeOut(1000) }, 1000); });
			soundAnswerO.play();
			result += "o";
			answerCount++;

			if (exampleType == "img") {
				$("#" + saveId).attr({ src: "./images/quiz/" + saveId + ".png" });
				imageChange = setInterval(function () { $("#" + getId).attr({ src: "./images/quiz/" + getId + "_up.png" }); });
				setTimeout(function () { clearInterval(imageChange); }, 100);
			}
			else if (exampleType == "text") {
				quizColorChange(getStr);
			}
		}
		else {
			if (chance > 1) {
				$("#quizAgain").fadeIn(500, function () { setTimeout(function () { $("#quizAgain").fadeOut(1000) }, 1000); });
				soundAnswerAgain.play();
				saveId = getId;
				chance--;

				if (exampleType == "img") {
					$("#" + getId).attr({ src: "./images/quiz/" + getId + "_up.png" });
				}
				else if (exampleType == "text") {
					quizColorChange(getStr);
				}
			}
			else {
				$("#quizAnswerArea , #answer_X , #ClickProhibition").show();
				$("#quizWrong").fadeIn(500, function () { setTimeout(function () { $("#quizWrong").fadeOut(1000) }, 1000); });
				soundAnswerX.play();
				result += "x";

				if (exampleType == "img") {
					$("#" + saveId).attr({ src: "./images/quiz/" + saveId + ".png" });
					imageChange = setInterval(function () { $("#" + getId).attr({ src: "./images/quiz/" + getId + "_up.png" }); });
					setTimeout(function () { clearInterval(imageChange); }, 100);
				}
				else if (exampleType == "text") {
					quizColorChange(getStr);
				}
			}
		}
	}
}


$("#video").on("timeupdate", function () {
	if (video.currentTime > quizStratShowTime) {
		$("#quizStart").show();
	}
	else {
		$("#quizStart").hide();
	}
});


$("#rePlay , #progressBarArea").on("click", function () {
	result = "";
	changeUse = true;
	answerCount = 0;
	chance = 2;
	quizNum = 1;
	makeQuiz(quizNum);
	exampleInterval();

	$("#frontQuizArea").show();
	setTimeout(function () { $("#quizArea").hide(); }, 100);

	// [수정] 재생/재시작 시 완료 상태 해제 + 다음 버튼 비활성화
	quizSolved = false;
	setNextBtnState(false);
});