//파일을 연 위치를 가져와서 페이지 정보로 컷팅
var dir = window.location.href;
var fileName = dir.split("/");
var curChasi = fileName[fileName.length - 2];
var curFileName = fileName[fileName.length - 1].split(".html")[0];
var currentPageNum = curFileName.substring(curFileName.length - 2, curFileName.length);

//각페이지에 맞는 페이지 세팅 자바스크립트 파일을 추가
document.write('<script src="./js/pageSet_' + currentPageNum + '.js"></script>');
///////////////////////////////////////////////////////////////////////////////

//랜덤한 문자열을 만들어 주는 함수
var randomString = function () {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 15;
	var randomstring = '';
	for (var i = 0; i < string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum, rnum + 1);
	}
	return randomstring;
}

//파일경로를 검색해서 RGB경로인지 외부경로인지 알아내는 함수
var locationGet = function () {
	if (dir.indexOf("file://") != -1) {
		return "localRGB";
	}
	else if (dir.indexOf("1.235.57.49") != -1) { //RGB접속 ip주소 바뀔경우 변경해줘야 됨
		return "webRGB";
	}
	else {
		return "notRGB";
	}
}

//사용환경 정보를 알아내는 함수
var userAgentNavigator = function () {
	var agent = navigator.userAgent.toLowerCase();
	if (/Android/i.test(navigator.userAgent)) {
		return "android";
	}
	else if (/iPhone/i.test(navigator.userAgent)) {
		return "iPhone";
	}
	else if (/iPad|iPod/i.test(navigator.userAgent)) {
		return "iPad";
	}
	else if (navigator.maxTouchPoints || 'ontouchstart' in document.documentElement) { //android, iPhone, iPad으로 안잡히는 터치 기반 기기
		return "touch";
	}
	else if (agent.indexOf("msie 9.0") != -1) {
		return "IE9";
	}
	else if (agent.indexOf("msie 10.0") != -1) {
		return "IE10";
	}
	else if (agent.indexOf("rv:11.0") != -1) {
		return "IE11";
	}
	else if (agent.indexOf("edge") != -1) {
		return "edge";
	}
	else if (agent.indexOf("chrome") != -1) {
		return "chrome";
	}
	else if (agent.indexOf("firefox") != -1) {
		return "firefox";
	}
	else if (agent.indexOf("safari") != -1) {
		return "safari";
	}
	else {
		alertShow("noAgentNavigator");
		self.close();
	}
}

//숫자에 0을 붙여 문자열로 만들어주는 함수(ex: 1->"01")
//num : 적용할 숫자    size : 0으로 채울 길이(안적으면 기본적으로 1개만 들어감)
var zerofill = function (num, size) {
	size = size ? size : 2;
	num = (num + "");
	while (num.length < size) { num = "0" + num; }
	return num;
}

//timeSec값으로 시분초로 만드는 함수
var videoTime = function (timeSec) {
	var hour = parseInt(timeSec / (60 * 60));
	var minute = parseInt((timeSec / (60)) - (hour * 60));
	var second = parseInt(timeSec % 60);
	var timeStr = (hour ? zerofill(hour) + ":" : "") + zerofill(minute) + ":" + zerofill(second);

	return timeStr;
}

//알럿창을 띄우는 함수
var alertShow = function (use) {
	if (use == "LowIE") {
		alert("익스플로러10 이하 에서는 전체화면을 지원하지 않습니다.");
	}
	else if (use == "noAgentNavigator") {
		alert("본 컨텐츠는 HTML5로 제작되어 인터넷 익스플로러 9 이상, 크롬 브라우저에 최적화되어 있습니다.");
	}
	else if (use == "differentChasi") {
		alert("폴더의 차시번호와 세팅된 차시번호가 다릅니다.");
	}
	else if (use == "videoChange") {
		alert("현재 페이지는 본 영상에서만 전체화면을 지원합니다.");
	}
	else if (use == "notFullScreen") {
		alert("현재 페이지는 전체화면을 지원하지 않습니다.");
	}
	else if (use == "currentIndex") {
		alert("현재 페이지입니다.");
	}
	else if (use == "firstPage") {
		alert("첫 페이지입니다.");
	}
	else if (use == "lastPage") {
		alert("마지막 페이지입니다.");
	}
}

//말풍선 띄우는 함수
var showBalloon = function () {
	$("#nextBalloon").show();
	$("#nextBalloon").stop().animate({ opacity: 1 }, 1000);
	balloonSound.play();
}

//page값으로 페이지 이동
// var movePage = function (page) {
// 	if (page == currentPageNum) {
// 		alertShow("currentIndex");
// 	}
// 	else if (page == 0) {
// 		alertShow("firstPage");
// 	}
// 	else if (page == (Number(totalPage) + 1)) {
// 		alertShow("lastPage");
// 	}
// 	else {
// 		//document.location.href = curFileName.substring(0, curFileName.length - 2) + zerofill(page) + ".html";
// 		window.location.replace(curFileName.substring(0, curFileName.length - 2) + zerofill(page) + ".html"); //같은 차시 다음 페이지 이동
// 	}
// }