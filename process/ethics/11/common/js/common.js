// [수정] HTTPS가 아니면 학습을 실행하지 않음 (file://, http:// 차단)
(function(){
  if (String(location.protocol || "").toLowerCase() !== "https:") {
    alert("이 과정은 HTTPS 환경에서만 실행됩니다.");
    try { window.stop(); } catch (e) {}
    throw new Error("HTTPS only");
  }
})();

function setButton($target, text, tab, func)
{
  $target.attr("title", text);
  $target.attr("tabIndex", tab);
  $target.off().on('click', function() {
      $(this).removeClass("hover");
      try { func(); }
      catch(exception) { console.log("The function is not registered."); }
  });
  $target.on('mouseenter', function() {
    $(this).addClass("hover");
    $(this).closest("div").children(".tooltips").addClass("hover");
  });
  $target.on('mouseleave focusout', function() {
    $(this).removeClass("hover");
    $(this).closest("div").children(".tooltips").removeClass("hover");
  });

}
function setTitle($target, text, tab){
  $target.attr("title", text);
  $target.attr("tabIndex", tab);
}

//비디오가 처음 시작할때 호출되는 함수
function videoStart(){
  _this.$media.css("display","block");
  var mediaEl = _this.$media.get(0);
  var playPromise = mediaEl.play();
  if (playPromise && typeof playPromise.catch === "function") {
    playPromise.catch(function(){
      $(document).off("click.videoUnlock").on("click.videoUnlock", function(){
        mediaEl.play();
        $(document).off("click.videoUnlock");
      });
    });
  }
  $("body").css("background","#ffffff");
}


function lineHover(_bolTemp){
if(_bolTemp){
  _this.$timeLine.addClass("hover");
  _this.$timeProgress.addClass("hover");
}
else {
  _this.$timeLine.removeClass("hover");
  _this.$timeProgress.removeClass("hover");
}
}

//사운드 조절
function setVolume(_vol){
  _this.$media.get(0).volume = _vol;
  _this.$soundProgress.css("width",_vol.toFixed(5) * 73);
  if(_this.$media.get(0).volume!=0)
    _this.$sound.find("button").removeClass("toggle");
  else
    _this.$sound.find("button").addClass("toggle");
}

function getPathSegments()
{
  var raw = location.pathname || location.href || "";
  try { raw = decodeURIComponent(raw); } catch (e) {}
  raw = String(raw).split("?")[0].split("#")[0].replace(/\\/g, "/");
  var parts = raw.split("/");
  var segs = [];
  for (var i = 0; i < parts.length; i++) {
    if (parts[i] && parts[i].toLowerCase() !== "file:") segs.push(parts[i]);
  }
  return segs;
}

function getURL(_lastIndex)
{
  var segs = getPathSegments();
  var token = segs[segs.length - _lastIndex - 1] || "";
  return token.replace(/\.[^.]+$/, "");
}

// 디지털 시간 변환
// input
//  time : 미디어 시간
// ouput
//  digital: 디지털시간 00 : 00
function clock(_time)
{
  if(_time == "undefined" || _time == undefined || _time == "NaN" || _time == NaN) return "00:00";
  var min = Math.floor(_time / 60);
  var sec = Math.floor(_time % 60);
  var digital = itostr(min) + ":" + itostr(sec);
  return digital;
}

// 디지털을 초로 변환
// input
//  time : 미디어 시간
// ouput
//  secTime : 초 시간
function secClock(_time)
{
  try {
    var min =_time.split(":")[0]
    var sec =_time.split(":")[1]
    var secTime = (min * 60) + (sec * 1);
    return secTime;
  }
  catch(exception) { console.log("markerArr_Time is not registered. "); }
}

// i to str
function itostr(_num)
{
  return _num < 10 ? "0" + _num : _num;
}


//폴더명
function get_contentsfolder()
{
  var segs = getPathSegments();
  return segs[segs.length - 2] || "";
}

// os 탐지
function getOSType()
{
  var ua = navigator.userAgent;

  if (ua.indexOf("Windows NT 5.1") != -1) return "windows_xp";
  if (ua.indexOf("Windows NT 6.1") != -1) return "windows_7";
  if (ua.indexOf("Windows NT 6.2") != -1) return "windows_8";
  if (ua.indexOf("Windows NT 6.3") != -1) return "windows_8.1";
  if (ua.indexOf("Windows NT 10.0") != -1) return "windows_10";
  if (ua.indexOf("Windows") != -1) return "windows";

  if (ua.indexOf("Android") != -1) return "Android OS";
  if (ua.indexOf("iPhone") != -1) return "iPhone OS";
  if (ua.indexOf("iPad") != -1) return "iPad";
}
// Browser 탐지
function getBrowserType()
{
   var _ua = navigator.userAgent;
    /* IE7,8,9,10,11 */
    if (navigator.appName == 'Microsoft Internet Explorer' || _ua.indexOf("rv:11.0") != -1) {
        var rv = -1;
        var trident = _ua.match(/Trident\/(\d.\d)/i);

        //ie11에서는 MSIE토큰이 제거되고 rv:11 토큰으로 수정됨 (Trident표기는 유지)
        if(trident != null && trident[1]  == "7.0") return rv = "IE" + 11;
        if(trident != null && trident[1]  == "6.0") return rv = "IE" + 10;
        if(trident != null && trident[1]  == "5.0") return rv = "IE" + 9;
        if(trident != null && trident[1]  == "4.0") return rv = "IE" + 8;
        if(trident == null) return rv = "IE" + 7;

        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(_ua) != null) rv = parseFloat(RegExp.$1)
        return rv;
    }

    /* etc */
    var agt = _ua.toLowerCase();
    if (agt.indexOf("chrome") != -1) return 'Chrome';
    if (agt.indexOf("opera") != -1) return 'Opera';
    if (agt.indexOf("staroffice") != -1) return 'Star Office';
    if (agt.indexOf("webtv") != -1) return 'WebTV';
    if (agt.indexOf("beonex") != -1) return 'Beonex';
    if (agt.indexOf("chimera") != -1) return 'Chimera';
    if (agt.indexOf("netpositive") != -1) return 'NetPositive';
    if (agt.indexOf("phoenix") != -1) return 'Phoenix';
    if (agt.indexOf("firefox") != -1) return 'Firefox';
    if (agt.indexOf("safari") != -1) return 'Safari';
    if (agt.indexOf("skipstone") != -1) return 'SkipStone';
    if (agt.indexOf("netscape") != -1) return 'Netscape';
    if (agt.indexOf("mozilla/5.0") != -1) return 'Mozilla';
}
//====================================================================================================//

//=====================키보드 이벤트==============================//
/*
$(document).keydown(function(keyEvent) {
//  if(keyEvent.target == _this.$media.get(0)) return;
	
  getKey = keyEvent.keyCode;
  switch (getKey) {
  
    case 38:  //위
      volTemp = _this.$media.get(0).volume + 0.05;
      if(volTemp >= 1.0 ) volTemp = 1.0;
      setVolume(volTemp);
      break;
    case 40:  //아래1
      volTemp = _this.$media.get(0).volume - 0.05;
      if(volTemp <= 0 ) volTemp = 0;
      setVolume(volTemp);
      break;
    case 37: //왼
      if(_this.$media.get(0).currentTime - 5 <= 0) _this.$media.get(0).currentTime = 0;
      else _this.$media.get(0).currentTime = _this.$media.get(0).currentTime - 5;
      break;
    case 39: //오른
      if(_this.$media.get(0).currentTime + 5 >= _this.$media.get(0).duration ) _this.$media.get(0).currentTime = _this.$media.get(0).duration;
      else _this.$media.get(0).currentTime = _this.$media.get(0).currentTime + 5;
      break;
    case 32:  //스페이스
//    	alert(_this.$bolPlay);
    	if (_this.$bolPlay == false) {
	          _this.$media.get(0).play();
	    }else if(_this.$bolPlay == true) {
	          _this.$media.get(0).pause();
	    }
    	
     //이벤트의 기본 행동 중단 
      if (event.preventDefault) {
    	  event.preventDefault();
      } else {
      // IE
      event.returnValue = false;
      }
    	 break;
  }
  
});
*/
//===================================================================//


