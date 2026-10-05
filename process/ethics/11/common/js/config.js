var aInfo	= new Array();  // 페이지 정보
aInfo[1]	= 1;
aInfo[2]	= 1;
aInfo[3]	= 1;
aInfo[4]	= 1;
aInfo[5]	= 1;
aInfo[6]	= 1;
aInfo[7]	= 1;
aInfo[8]	= 1;


_this = this;
var bolPorted = false; // 포팅여부
var subjectCode = "1005180"; // 과정코드
var strChapter = getURL(1); // 현재 차시문자 01
var strPage = getURL(0);    // 현재 페이지문자 01_01
var contentsFolder = get_contentsfolder(); //폴더명 01

_this.$strInitial = "hyundaicnr";                // 과정 이니셜
//_this.$curPageNumber = getURL(0) * 1;    // 현재 페이지
_this.$curPageNumber =  getURL(0).substr(3,5);    // 현재 페이지 01
_this.$curPageNumberEnd =  getURL(0).split("")[4];    // 현재 페이지 1
_this.$curChapter = getURL(1) * 1;       // 현재 차시 1
_this.$totalPageNumber = aInfo[_this.$curChapter]; //전체 페이지 수


//_this.$contentWidth = "100%";          // 콘텐츠 높이
//_this.$contentHeight = "100%";          // 콘텐츠 넓이
_this.$os = getOSType();                 // 사용 os
_this.$browser =  getBrowserType();      // 사용 browser
_this.$bolFullScreen = false; // 전체화면 여부 ( false : 창모드 true : 전체화면 )
_this.$bolPlay = false;  // 재생 여부 ( false : 일시정지 true : 재생중 )

_this.$movieName = strPage + ".mp4";
_this.$moviePath = "../mp4/" + _this.$movieName; // 로컬/상대경로: ../mp4/01_01.mp4

document.write('<script type="text/javascript" src="../common/js/navi.js?v=4"></script>');