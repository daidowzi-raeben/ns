var locationCenter = true; //콘텐츠 위치 설정  ex) true : 화면 중앙   false : 화면 왼쪽  (true의 숫자 값 : 1    false의 숫자 값 : 0  대체 가능)
var footerInVideo = true; //컨트롤바 영상 내 존재 유무  ex) true : 영생 내부에 존재    false : 영상 외부에 존재


var realTimeScriptUse = false; //실시간 자막 사용 여부  ex) true : 사용    false : 미사용


var keyboardControlUse = true; //키보드 제어 사용 여부  ex) true : 사용    false : 미사용
var securityUse = false; //마우스 우클릭, 이미지 드래그, 텍스트 드래그, F12키 사용 여부(보안 관련 제어이긴 하지만 HTML은 쉽게 뚫을 수 있기 때문에 큰 의미는 없음)  ex) true : 사용    false : 미사용


var contentsWidth = 1280; //콘텐츠의 가로 크기
var contentsHeight = 720; //콘텐츠의 세로 크기


if (locationGet() == "localRGB" || locationGet() == "webRGB") {
    var videoPath = "../mp4/"; //내부 비디오 경로
}
else {
    var videoPath = "../mp4/"; //외부 비디오 경로(포팅용)
}