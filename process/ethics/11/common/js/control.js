//페이지 초기화
$(document).ready(function(){
  setPage();
});

function itostr(inum){
	return inum<10?"0"+inum:inum;
}

/**
 * 쿠키 키 값의 접두사로 하이인재원ID 추가 
 * - hihrdUsrid의 쿠키 값은 하이인재원 강의실 입장 시 생성됩니다.
 * - 쿠키 생성 시
 *   setCookie(getCookie('hihrdUsrid') + "_" + keyName, value);
 * - 쿠키 조회 시
 * getCookie(getCookie('hihrdUsrid') + "_" + keyName);
 */
var hihrdUsrid = getCookie('hihrdUsrid');
console.log("hihrdUsrid>>>>"+hihrdUsrid);
if (hihrdUsrid == undefined || hihrdUsrid == ""){
	  hihrdUsrid = "guest"
}
var curPage = parseInt(_this.$curPageNumber);
var totalPage = parseInt(_this.$totalPageNumber);

var data = new Array();
var UsrData = hihrdUsrid + "_" + subjectCode + "_"+ strChapter; //하이인재원ID + 과목코드 + 차시번호
console.log("UsrData>>>"+UsrData);
 
function setPage()
{
  var lastIndex = 201; 
  var mouseDrag = false; 
  var perMouseX = 0; 
  var viewMouseX = 0; 
  var barWid = 0; 
  var bolReplay = false; 
  var fullTarget = $(".content"); 
  var barLeft = 0;
  var barRigth = 0;
  var boolflag = false; //배속
//  var summaryPage = false;
//  var progressControll = jindoCompleteChk(); //LMS 용

//  _this.$contentWidth = _this.$content.css("width");
//  _this.$contentHeight = _this.$content.css("height");
  _this.$control = _this.$content.find(".controlBar");
  _this.$media = _this.$content.find(".video1");
  _this.$start_btn = _this.$content.find(".start_btn");
	
  checkItem();
  videoStart();

  //정리하기
//  $('#content').find(".summary").each(function() {
//		summaryPage = true;
//  });
  
  // 인덱스 네비
  $('#indexNavi').load('index_navi.html',function(){
	  var de1 = depth1 - 1;
	  var de2 = depth2 - 1;
	  $('#navigation > ul > li:eq('+de1+') > a').addClass('on');
	  $('#navigation > ul > li:eq('+de1+') ul li:eq('+de2+') a').addClass('on');
	
	  if(depth2 == 0){
		  $('#navigation > ul > li:eq('+de1+') > a').addClass('on');
		  $('#navigation > ul > li:eq('+de1+') ul li:eq('+de2+') a').removeClass('on');
	  }
  });  

  //인덱스 창
  $('.indexMenu').bind('click',function(){
//		var h = $('#navigation').outerHeight();
		if ($(this).is('.on')){
		  $('#indexNavi').stop().animate({'width':'0'},300);
		  $(this).removeClass('on');
		} else {
		  $('#indexNavi').stop().animate({'width':'342'},300);
		  $(this).addClass('on');
		}
  });
  
  //인덱스 이동
  $("li").click(function(){
//	  var movePageNum = parseInt($(this).index()) + 1;
////	  console.log("movePageNum>>>>"+movePageNum);
//	  var movePageFlag = data[movePageNum];
//	  var movepageLocation = strChapter + "_" +(itostr(movePageNum)) + ".html";
//	  
//	  
//	  if(movePageNum < curPage){//이동하는 페이지가 현재 페이지보다 작을때
//		  location.href = movepageLocation;
//	  
//	  }else if(movePageNum > curPage){
//		  if(data[curPage] == "1"){
//			  if(movePageNum == curPage + 1){
//				  location.href = movepageLocation;
//			  }else{
//				  if(data[curPage] == "1" && data[movePageNum] == "1"){
//					  location.href = movepageLocation;  
//				  }
//				  else if(data[curPage] == "1" && data[movePageNum-1] == "1"){
//					  location.href = movepageLocation;
//				  }
//				  else{
//					  alert("학습 완료 후 이동 가능 합니다.");
//				  }
//			  }
//		  }else{
//			  alert("학습 완료 후 이동 가능 합니다.");
//		  }
//	  }
  });

    _this.$attribute = $(
        '<div class="timeLine timeLinePadding">\
    		<div class="progress timeLinePadding">\
            </div>\
          </div>\
    	  <div class="button play playPause"><button></button></div>\
          <div class="button replay"><button></button></div>\
          <div class="button movePrev"><button></button></div>\
          <div class="button digClock curPage">'+ _this.$curPageNumber +'</div>\
          <div class="button digClock pageSlash">·</div>\
          <div class="button digClock totalPage">'+ itostr(_this.$totalPageNumber) +'</div>\
          <div class="button moveNext"><button></button></div>\
          <div class="button digClock curTime">00:00</div>\
          <div class="button digClock slash">|</div>\
          <div class="button digClock totalTime">00:00</div>\
          <div class="button sound"><button></button></div>\
          <div class="soundLine soundLinePadding">\
             <div class="soundProgress soundLinePadding "></div>\
          </div>\
          <div class="nextAlert"></div>\
          <div class="setUpBg">\
	          <div class="setUp">x1.0</div>\
	          <div class="speedWrap">\
	          <div class="speedPart speed13">x3.0</div>\
	          <div class="speedPart speed12">x2.8</div>\
	          <div class="speedPart speed11">x2.6</div>\
	          <div class="speedPart speed10">x2.4</div>\
	          <div class="speedPart speed9">x2.2</div>\
	          <div class="speedPart speed8">x2.0</div>\
	          <div class="speedPart speed7">x1.8</div>\
	          <div class="speedPart speed6">x1.6</div>\
	          <div class="speedPart speed5">x1.4</div>\
	          <div class="speedPart speed4">x1.2</div>\
	          <div class="speedPart speed3 toggle">x1.0</div>\
	          <div class="speedPart speed2">x0.8</div>\
	          <div class="speedPart speed1">x0.6</div>\
	          </div>\
          </div>\
          <div class="button fullScreen"><button></button></div>\
          <div class="button lock close"></div>\ '
    );
//    <div class="button guid"><button></button></div>\

    _this.$control.append(_this.$attribute);
    _this.$content.append(_this.$control);
    _this.$content.append(_this.$menu);
    
    
    //배속쿠키
//	if(boolflag == false){
//		if(!checkItem()){ //완료안된페이지
//			_this.$media.get(0).playbackRate = 1;
//			for(var i=1; i<=13; i++){
//				var togleClear = $('.speed'+i);
//				togleClear.removeClass("toggle");
//			}
//			$('.speed3').addClass("toggle");
//			$('.setUp').text("x1.0");
//			localStorage.setItem(UsrData + "_speedCookie", "1.0");
//	}else{
//		//쿠키
////		var speedCookie = getCookie('speedCookie');
//		var speedCookie = localStorage.getItem(UsrData + "_speedCookie");
//		if (speedCookie >= 0.6){
//			_this.$media.get(0).playbackRate = speedCookie;
//			console.log("speedCookie>>>>>>>"+speedCookie)
//			
//			for(var i=1; i<=13; i++){
//				var togleClear = $('.speed'+i);
//				togleClear.removeClass("toggle");
//			}
//			
////			$('.speed'+speedCookie).addClass("toggle");
//			playBackRateToggle(speedCookie);
//			$('.setUp').text("x"+speedCookie);
//		}
//		boolflag = true;
//	 }
//	}

    //볼륨쿠키
//    var volumNum = localStorage.getItem(UsrData + "_setVolume");
//    if(volumNum == "" || volumNum == null || volumNum == undefined){
//    	_this.$media.get(0).volume= 0.5;
//    }else{
//    	_this.$media.get(0).volume= localStorage.getItem(UsrData + "_setVolume");
//    }
    
    _this.$guid = _this.$control.find(".guid");
    _this.$etc2 = _this.$control.find(".etc2");
    _this.$etc3 = _this.$control.find(".etc3");
    _this.$data_down = _this.$control.find(".data_down");
    _this.$play = _this.$control.find(".playPause");
    _this.$pause = _this.$control.find(".pause");
    _this.$replay = _this.$control.find(".replay");
    _this.$trackBtn = _this.$control.find(".trackBtn");
    _this.$sound = _this.$control.find(".sound");
    _this.$script = _this.$control.find(".script");
    _this.$fullSc = _this.$control.find(".fullScreen");
    _this.$timeLine = _this.$control.find(".timeLine");
    _this.$timeProgress = _this.$timeLine.children(".progress");
    _this.$soundLine = _this.$control.find(".soundLine");
    _this.$soundProgress = _this.$soundLine.children(".soundProgress");
    _this.$timeDrag = _this.$timeProgress.find(".timeDrag");
    _this.$curTime = _this.$control.find(".curTime");
    _this.$totalTime = _this.$control.find(".totalTime");
    _this.$prevBtn = _this.$control.find(".movePrev");
    _this.$nextBtn = _this.$control.find(".moveNext");
    _this.$nextAlert = _this.$control.find(".nextAlert");
    _this.$indexMenu = _this.$content.find(".indexMenu");
    _this.$openMenu = _this.$content.find(".openMenu");
    _this.$closeMenu = _this.$content.find(".closeMenu");
    _this.$indexList = _this.$indexMenu.find(".list");
    _this.$leftSymbol = _this.$content.find(".leftSymbol");
    _this.$rightSymbol = _this.$content.find(".rightSymbol");
    _this.$setUp =  _this.$control.find('.setUp');
    _this.$prevrate =  _this.$control.find(".prevrate"); //배속 느리게
    _this.$nextrate =  _this.$control.find(".nextrate"); //배속 빠르게
    
	var spd1 = $(".speed1");
	var spd2 = $(".speed2");
	var spd3 = $(".speed3");
	var spd4 = $(".speed4");
	var spd5 = $(".speed5");
	var spd6 = $(".speed6");
	var spd7 = $(".speed7");
	var spd8 = $(".speed8");
	var spd9 = $(".speed9");
	var spd10 = $(".speed10");
	var spd11 = $(".speed11");
	var spd12 = $(".speed12");
	var spd13 = $(".speed13");
	
    $(".speed1").bind("click",function(){ fnSetPlayBackRate(0.6, spd1) });
	$(".speed2").bind("click",function(){ fnSetPlayBackRate(0.8, spd2) });
	$(".speed3").bind("click",function(){ fnSetPlayBackRate(1.0, spd3) });
	$(".speed4").bind("click",function(){ fnSetPlayBackRate(1.2, spd4) });
	$(".speed5").bind("click",function(){ fnSetPlayBackRate(1.4, spd5) });
	$(".speed6").bind("click",function(){ fnSetPlayBackRate(1.6, spd6) });
	$(".speed7").bind("click",function(){ fnSetPlayBackRate(1.8, spd7) });
	$(".speed8").bind("click",function(){ fnSetPlayBackRate(2.0, spd8) });
	$(".speed9").bind("click",function(){ fnSetPlayBackRate(2.2, spd9) });
	$(".speed10").bind("click",function(){ fnSetPlayBackRate(2.4, spd10) });
	$(".speed11").bind("click",function(){ fnSetPlayBackRate(2.6, spd11) });
	$(".speed12").bind("click",function(){ fnSetPlayBackRate(2.8, spd12) });
	$(".speed13").bind("click",function(){ fnSetPlayBackRate(3.0, spd13) });
	
	//차시명 
//    _this.$leftSymbol.css("background","url(../common/img/leftSymbol_"+strChapter+".png) no-repeat");
   
    barLeft = _this.$timeLine.offset().left;
    barRigth = barLeft + _this.$timeLine.css("width").split("px")[0] * 1;

    
    var openMenu = 0;
    setButton(_this.$openMenu,'',lastIndex++,function(){
    	_this.$indexMenu.fadeIn(100);
    	_this.$indexMenu.css("left","0px");
    });
    
    setButton(_this.$closeMenu,'',lastIndex++,function(){
      var width = _this.$indexMenu.css("width").split("px")[0] * -1;
      
      _this.$indexMenu.css("left", width );
      _this.$indexMenu.fadeOut(100);
    });
    
	//정리하기 프린트,다운로드
	var btnDown = $('#downBtn');
	var btnPrint = $('#printBtn');
	
    btnDown.bind("click",function(){
		var fileName = 'summary_'+strChapter;
		window.open("../common/down/"+fileName+".zip", "_down");
	});

    //러닝가이드 팝업
    var guide_pop = $('<iframe src="../common/html/learning_guide.html" frameborder="0" width="1020" height="720" marginwidth="0" marginheight="0" scrolling="no" id="learning_guide" style="position: absolute; z-index:300;">');
    var guide_close= $('<button type="button" class="close" id="guide_close"><span aria-hidden="true">X</span></button>');
    
    setButton(_this.$guid.children("button"),'학습안내',lastIndex++, function() {
    	_this.$media.get(0).pause();
    	_this.$content.append(guide_pop);
    	_this.$content.append(guide_close);
    
    //러닝가이드 닫기버튼
  		guide_close.on('click', function(e) {
	  		guide_pop.remove();
	      	guide_close.remove();
	      	var curTime = _this.$media.get(0).currentTime;
	      	var endTime = _this.$media.get(0).duration;
	      	
	      	if(curTime == endTime){
	      		_this.$media.get(0).pause();
	      	}else{
	      		_this.$media.get(0).play();
	      	}
      });
    });
    
    //재생
    setButton(_this.$play.children("button"),'재생/일시정지',lastIndex++, function() {
    	if (_this.$bolPlay == false) {
          	_this.$media.get(0).play();
        } else {
          _this.$media.get(0).pause();	         
        }
    });
    
    //일시정지버튼
//    setButton(_this.$pause.children("button"),'',lastIndex++, function() {
////        if(!quizPage){
// 	          _this.$media.get(0).pause();
////        }
//     });
    
    //리플레이버튼
    setButton(_this.$replay.children("button"),'다시재생',lastIndex++, function() {
      _this.$media.get(0).currentTime = 0;
      _this.$media.get(0).play();
    });
    
    
    //사운드버튼
    setButton(_this.$sound.children("button"),'',lastIndex++, function() {
      if(_this.$media.get(0).volume!=0) _this.$media.get(0).volume = 0;
      else _this.$media.get(0).volume = 0.5;
    });
    
    //전체화면버튼
    setButton(_this.$fullSc.children("button"),'전체화면',lastIndex++, function() {
      var targetDom = fullTarget.get(0);
      var targetDoc = document;
      if (!_this.$bolFullScreen)
      {
          if (targetDom.requestFullscreen) targetDom.requestFullscreen();
          else if (targetDom.msRequestFullscreen) targetDom.msRequestFullscreen();
          else if (targetDom.mozRequestFullScreen) targetDom.mozRequestFullScreen();
          else if (targetDom.webkitRequestFullscreen) targetDom.webkitRequestFullscreen();
      }
      else
      {
          if (targetDoc.exitFullscreen) document.exitFullscreen();
          else if(targetDoc.msExitFullscreen) document.msExitFullscreen();
          else if (targetDoc.mozCancelFullScreen) document.mozCancelFullScreen();
          else if (targetDoc.webkitCancelFullScreen) document.webkitCancelFullScreen();
      }
    });
    
    //이전페이지 이동버튼
    setButton(_this.$prevBtn.children("button"),'',lastIndex++, function() {
//    	var move_page = strChapter + "_" +(itostr(parseInt(_this.$curPageNumber) - 1)) + ".html";
//    		if(bolPorted){
//    			goBack(); //현대CNR 하이인재원
//    		}else{
//    			if(parseInt(_this.$curPageNumber) - 1 <= 0 ) {
//    				alert("처음 페이지 입니다.");
//    				return;
//    			}
//    			location.href = move_page;
//    		}
    	prevpage(Number(_this.$curChapter),Number(_this.$curPageNumber)); //navi.js 함수호출
    });
    
    //다음페이지 이동버튼
    setButton(_this.$nextBtn.children("button"),'',lastIndex++, function() {
//    	var move_page = strChapter + "_" +(itostr(parseInt(_this.$curPageNumber) + 1)) + ".html";
//    	if(!checkItem()){
//			alert("학습 완료 후 이동 가능 합니다.");
//    	}else{
//    		if(bolPorted){
//    			setCommit();//현대CNR 하이인재원
//    			goNext(); //현대CNR 하이인재원
//    		}else{
//    			if(parseInt(_this.$curPageNumber) + 1 > _this.$totalPageNumber ) {
//    				alert("마지막 페이지 입니다.");
//    				return;
//    			}
//    			location.href = move_page;
//    		}
//    	}
    	nextpage(Number(_this.$curChapter), Number(_this.$curPageNumber)); //navi.js 함수호출
    });

      
    // 사운드 조절
    _this.$soundLine.on('click', function(event) {
      var soudWid = _this.$soundLine.css("width").split("px")[0] ;
      var perSoundX = event.offsetX / soudWid;
      setVolume(perSoundX);
    });
    
    
    //배속기능 - 빠르게
    setButton(_this.$nextrate,'배속',lastIndex++,function(){
    	if(!checkItem()){
			alert("학습 완료 후 이동 가능 합니다.");
    	}else{
    		var rateindex = $(".setUp").text();
    		var res;
    		res = rateindex.replace(/[^0-9]/g,"");
    		
    		var speed = parseInt(res) + 2;
    		speed= itostr(speed).toString();
    		
    		if(speed > "30"){
    			return;
    		}else{
    			formatted = speed.slice(0, 1) + '.' + speed.slice(1, 2) 
    			
    			$('.setUp').html("x"+formatted);
    			_this.$media.get(0).playbackRate = formatted; //배속기능
    			localStorage.setItem(UsrData + "_speedCookie", formatted); //배속저장
    			console.log("formatted>>>>>"+formatted);
    		}
    	}
    });
    
    //배속기능 - 느리게
    setButton(_this.$prevrate,'배속',lastIndex++,function(){
    	if(!checkItem()){
			alert("학습 완료 후 이동 가능 합니다.");
    	}else{
    		var rateindex = $(".setUp").text();
    		var res;
    		res = rateindex.replace(/[^0-9]/g,"");
    		
    		var speed = parseInt(itostr(res)) - 2;
    		speed= itostr(speed).toString();
    		
    		if(speed < "06"){
    			return;
    		}else{
    			formatted = speed.slice(0, 1) + '.' + speed.slice(1, 2) 
    			
    			$('.setUp').html("x"+formatted);
    			_this.$media.get(0).playbackRate = formatted; //배속기능
    			localStorage.setItem(UsrData + "_speedCookie", formatted); //배속저장
    			console.log("formatted>>>>>"+formatted);
    		}
    	}
    });
    
    //배속
    setButton(_this.$setUp,'',lastIndex++,function(){
    	if(!checkItem()){
     		alert("학습 완료 후 이동 가능 합니다.");
     	}else{
     		($('.speedWrap').css("display") == "none") ? $('.speedWrap').show() : $('.speedWrap').hide();
     	}
    });
    var speedNum = 1;
    
    function fnSetPlayBackRate(_spd,_target){
   		  _this.$media.get(0).playbackRate = _spd;
   		  
   		  for(var i=1; i<=13; i++){
   			  var togleClear = $('.speed'+i);
   			  togleClear.removeClass("toggle");
   		  }
   		  _target.addClass("toggle");
   		  
   		  $('.speedWrap').hide();
   		  $('.setUp').text("x"+_spd.toFixed(1));
   		  
//   		  localStorage.setItem(UsrData + "_speedCookie", _spd.toFixed(1));
//   	  setCookie("speedCookie", _spd, 1);
   		speedNum = _spd.toFixed(1);
   		  console.log("_spd>>>>>"+_spd);
    }
    
    function playBackRateToggle(speedCookie){
		if(speedCookie == "0.6") $('.speed1').addClass("toggle");
		else if(speedCookie == "0.8") $('.speed2').addClass("toggle");
		else if(speedCookie == "1.0") $('.speed3').addClass("toggle");
		else if(speedCookie == "1.2") $('.speed4').addClass("toggle");
		else if(speedCookie == "1.4") $('.speed5').addClass("toggle");
		else if(speedCookie == "1.6") $('.speed6').addClass("toggle");
		else if(speedCookie == "1.8") $('.speed7').addClass("toggle");
		else if(speedCookie == "2.0") $('.speed8').addClass("toggle");
		else if(speedCookie == "2.2") $('.speed9').addClass("toggle");
		else if(speedCookie == "2.4") $('.speed10').addClass("toggle");
		else if(speedCookie == "2.6") $('.speed11').addClass("toggle");
		else if(speedCookie == "2.8") $('.speed12').addClass("toggle");
		else if(speedCookie == "3.0") $('.speed13').addClass("toggle");
    }
    
    //잠금
    var lock = true;
    $('.lock').on('click', function(e) {
    	if(lock){
    		lock = false;
    		$('.lock').removeClass("close");
    		$('.lock').addClass("open");
    		_this.$control.animate({"bottom":"-66px"});
    		_this.$content.unbind('mouseover');
    	}else{
    		lock = true;
    		$('.lock').removeClass("open");
    		$('.lock').addClass("close");
    		_this.$control.animate({"bottom":"0px"});
    	}
    });
    
    //컨트롤바 
	$('.content').bind('mouseenter', function(){
		if(lock == false){
			$('.controlBar').animate({"bottom":"0px"},0);
		}
	});
	$('.content').bind('mouseleave', function(){
		if(lock == false && !_this.$nextAlert.is(":visible")){
			$('.controlBar').animate({"bottom":"-66px"},0);
		}
	});
	$('.content').on('click', function(e) {
		if(lock == false){
			$('.controlBar').animate({"bottom":"0px"},0);
		}
	});

  	 //드래그
      _this.$timeLine.on('mousedown touchstart', function() {
    	  if(!checkItem()){
    		  alert("학습 완료 후 이동 가능 합니다.");
    	  }else{
    		  mouseDrag = true;
    		  _this.$media.get(0).pause();
    	  }
      });
      
      // 드래그 중
      $(document).on('mousemove touchmove', function(e) {
    	  
        if(!mouseDrag) return;
        if(e.pageX > barRigth || e.pageX < barLeft) return;
        barWid = _this.$timeLine.css("width").split("px")[0];
        perMouseX =  (e.pageX - barLeft) / barWid;
        percent = perMouseX * 100;
        _this.$timeProgress.css("width",percent.toFixed(5)+"%");
        curTime = clock(_this.$media.get(0).duration * perMouseX);
        _this.$curTime.get(0).innerHTML = curTime;
        lineHover(true);
        
      });
      
      // 드래그 끝
      $(document).on('mouseup touchend', function() {
        if(!mouseDrag) return;
        mouseDrag = false;
        _this.$media.get(0).currentTime = _this.$media.get(0).duration * perMouseX;
        _this.$media.get(0).play();
        lineHover(false);
      });



    // 타임라인 클릭했을때 화면 이동
    _this.$timeLine.on('click', function(e) {
    	if(!checkItem()){
			alert("학습 완료 후 이동 가능 합니다.");
    	}else{
		      if(mouseDrag) return;
		      barWid = _this.$timeLine.css("width").split("px")[0];
		      barWid = (_this.$bolFullScreen && _this.$browser.indexOf("IE") != -1) ? barWid / 100 : barWid;
		      perMouseX = e.offsetX / barWid;
		      _this.$media.get(0).currentTime = _this.$media.get(0).duration * perMouseX;
    	}
    });
	   
	    
	  _this.$media.on('timeupdate', function() {
	    curTime = clock(_this.$media.get(0).currentTime);
	    endTime = clock(_this.$media.get(0).duration);
	    percent = _this.$media.get(0).currentTime / _this.$media.get(0).duration * 100 ;
	    _this.$curTime.get(0).innerHTML = curTime;
	    if(endTime == "NaN:NaN") _this.$totalTime.get(0).innerHTML = "00:00";
	    else _this.$totalTime.get(0).innerHTML = endTime;
	    _this.$timeProgress.css("width",percent.toFixed(5)+"%");
	    
	    var remain = _this.$media.get(0).duration - _this.$media.get(0).currentTime;
	    if(bolReplay && remain > 0.5){
	        _this.$nextAlert.fadeOut(1);
	        _this.$nextAlert.css("right","30px");
	        _this.$media.fadeIn(100);
	        bolReplay=false;
	    }
	  });
     

      //영상 완료 시 (완료시 이벤트)
      _this.$media.on('ended',function(){
    	  data[curPage] = 1;
    	  localStorage.setItem(UsrData, JSON.stringify(data));
      	  console.log(data);
    	  _this.$media.get(0).pause();
    	  if(Number(_this.$curChapter) >= 8){
    	    _this.$nextAlert.css("background","url(../common/img/moveAlert_end.png) no-repeat");
    	  }else{
    	    _this.$nextAlert.css("background","url(../common/img/moveAlert.png) no-repeat");
    	  }
    	  _this.$control.animate({"bottom":"0px"},0);
    	  _this.$nextAlert.fadeIn(1500);
    	  _this.$nextAlert.css("right","5px");
    	  bolReplay=true;
      });
      // 볼륨 변환시
      _this.$media.on('volumechange', function() {
        setVolume(_this.$media.get(0).volume);
        localStorage.setItem(UsrData + "_setVolume", _this.$media.get(0).volume);
      });

      // 미디어 일시정지일 떄
      _this.$media.on('pause', function() {
          _this.$play.addClass("play");
          _this.$play.removeClass("pause");
          _this.$play.children(".tooltips").text("재생");
          _this.$bolPlay = false;
      });
      
      // 미디어 재생중일 때
      _this.$media.on('play', function() {
          _this.$play.addClass("pause");
          _this.$play.removeClass("play");
          _this.$play.children(".tooltips").text("일시정지");
          _this.$media.get(0).playbackRate = speedNum; //배속기능
          _this.$bolPlay = true;
      });

      // 화면 전환시 토글
      $(document).on('MSFullscreenChange webkitfullscreenchange mozfullscreenchange fullscreenchange', function(e) {
		  var parentWidth = $(".content").width();
          _this.$bolFullScreen = !_this.$bolFullScreen;
          if (!_this.$bolFullScreen){
//            _this.$fullSc.find("button").removeClass("toggle");
            fullTarget.css("width","1280px");
            fullTarget.css("height","720px");
			$(".content > .controlBar > .timeLine").css("width", "1260px");  //hdcnr 추가
          }
          else {
		
//            _this.$fullSc.find("button").addClass("toggle");
        //    var width = _this.$indexMenu.css("width").split("px")[0] * -1;
//            _this.$indexMenu.css("height", width );
            _this.$openMenu.css("opacity","1");
            fullTarget.css("width","100%");
            fullTarget.css("height","100%");
			_this.$control.css("width", "100%"); // hdcnr 추가

			$(".timeLine").css("width", parentWidth - 20 + "px"); // 여백 고려
	
          }
		//   console.log("TimeLine Width:", $(".timeLine").width());
      });
}

function checkItem(){
//	var Item = localStorage.getItem(UsrData);	
//	if(Item == "" || Item == null || Item == undefined){
//		  for(i=1; i<=totalPage; i++){
//			  data[i] = 0;
//		  }
////		  console.log("data[i]>>>>"+data);
//	}else{
//		for(i=1; i<=totalPage; i++){
//			data[i] = JSON.parse(Item)[i];
////			console.log("data[curPage]>>>>"+data[curPage]);
//		}
//		if(data[curPage] == 1) return true;	
//		else return false;
//	}
	return true;
  }


function summaryCheck(){
	data[curPage] = 1;
	localStorage.setItem(UsrData, JSON.stringify(data));
	console.log(data);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cName) {
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
			 start += cName.length;
			 var end = cookieData.indexOf(';', start);
			 if(end == -1)end = cookieData.length;
			 cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}




