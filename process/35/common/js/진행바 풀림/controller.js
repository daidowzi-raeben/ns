var getScale = 1; //ÀüÃ¼È­¸éÀ¸·Î ÀÎÇÑ »çÀÌÁî º¯È­¿¡ µû¸¥ ½ºÄÉÀÏ °ª ÀúÀå
var mobileScale = 1; //¸ð¹ÙÀÏ¿¡¼­ »çÀÌÁî º¯È­¿¡ µû¸¥ ½ºÄÉÀÏ °ª ÀúÀå
var balloonSound = new Audio("../common/sound/balloon.mp3");

//DOMÀÌ ·ÎµåµÇ¸é ½ÇÇà(window.onload¸¦ »ç¿ëÇÏ¸é ÀÌ¹ÌÁö±îÁö ÀüºÎ ·Îµå µÇ¾î¾ß ½ÇÇàµÇ¹Ç·Î $(document).ready¸¦ »ç¿ëÇÏ´Â°Ô ÁÁ´Ù.)
$(document).ready(function () {

  //Æú´õÀÇ Â÷½Ã¿Í ¼¼ÆÃµÈ Â÷½Ã°¡ µ¿ÀÏÇÑÁö ºñ±³ÇØ¼­ ´Ù¸£¸é Ã¢´Ý±â
  if (Number(curChasi) != Number(chasi)) {
    if (locationGet() != "notRGB") {
      alertShow("differentChasi");
      self.close();
    }
  }

  //¸¶¿ì½º ¿ìÅ¬¸¯ »ç¿ë ¿©ºÎ(securityUse®B¿¡ µû¶ó »ç¿ë ¿©ºÎ °áÁ¤)
  document.oncontextmenu = function () {
    return securityUse;
  }
  //ÀÌ¹ÌÁö µå·¡±× ¹æÁö ¿©ºÎ(securityUse®B¿¡ µû¶ó »ç¿ë ¿©ºÎ °áÁ¤)
  document.ondragstart = function () {
    if (pageType == "quiz" && quizType.indexOf("drag") != -1) {
      return true;
    }
    else {
      return securityUse;
    }
  }
  //ÅØ½ºÆ® µå·¡±× ¹æÁö ¿©ºÎ(securityUse®B¿¡ µû¶ó »ç¿ë ¿©ºÎ °áÁ¤)
  document.onselectstart = function () {
    return securityUse;
  }

  //////////////////////////////////////////////////////////////////////////////////////
  //ºñµð¿ÀÀÇ Àç»ýÀ¯¹«¿¡ µû¶ó Àç»ý/ÀÏ½ÃÁ¤Áö ¹öÆ°ÀÌ ÀÚµ¿À¸·Î ¹Ù²îµµ·Ï ¼¼ÆÃ
  $("#video").on("timeupdate", function () {
    if (video.paused == true) {
      $("footer > div > #playPause").attr({ class: "icon-play-5 control-icon", title: "Play" });
    }
    else {
      $("footer > div > #playPause").attr({ class: "icon-pause-5 control-icon", title: "Pause" });
      $("#playLoad").hide();
    }
  });
  $("#video").on("ended", function () {
    $("footer > div > #playPause").attr({ class: "icon-play-5 control-icon", title: "Play" });
    setTimeout(function () { video.pause(); }, 500);
  });
  //////////////////////////////////////////////////////////////////////////////////////

  //È­¸éÀÇ Àç»ý ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#playLoad > #videoPlay").on("click", function () {
    $("#playLoad").hide();
    video.play();
  });

  //ºñµð¿À°¡ ·ÎµåµÇ¾î¾ß¸¸ ½ºÅµ ¹öÆ°ÀÌ º¸ÀÌµµ·Ï timeupdate·Î ÁÜ
  $("#video").on("timeupdate", function () {
    if (useType.indexOf("skip") != -1) {
      if (video.currentTime > skipTime[0] && video.currentTime < skipTime[1]) { //¼³Á¤ÇÑ ½Ã°£¿¡¼­¸¸ º¸ÀÌµµ·Ï
        $("#skip").fadeIn(500);
      }
      else {
        $("#skip").fadeOut(500);
      }
    }
  });
  //ºñµð¿À°¡ ³¡³ªÁö ¾ÊÀº °æ¿ì¿¡´Â ´ÙÀ½ÆäÀÌÁö ¸»Ç³¼±ÀÌ ¾Èº¸ÀÌµµ·Ï ÇÔ
  $("#video").on("ended", function () {
    if (pageType == "video") {
      showBalloon();

      if (pageType == "video") {
        var page = Number(currentPageNum) + 1;
        setTimeout(function () {
          nextpage(Number(chasi), Number(currentPageNum));
        }, 2000);
      }
    }
    else if (pageType == "imageVR") {
      showBalloon();
    }
    else if (pageType == "checkList") {
      showBalloon();
    }
    else if (pageType == "videoChange" && videoChangeShow == false) {
      showBalloon();
    }
    else if (pageType == "summary" && summaryType == "vod" || pageType == "summary" && (summaryAmount == 1 || lastSummary == true)) {
      showBalloon();
    }
    else if (pageType == "image" && imageAmount == 1) {
      showBalloon();
    }
  });
  $("#video").on("timeupdate", function () {
    if (video.currentTime < video.duration) {
      if (pageType != "write") {
        $("#nextBalloon").hide();
        $("#nextBalloon").css({ opacity: 0 });
      }
    }
  });

  //ºñµð¿À°¡ ·ÎµåµÇ¾î¾ß¸¸ ºÏ¸¶Å© ¹öÆ°ÀÌ º¸ÀÌµµ·Ï timeupdate·Î ÁÜ
  $("#video").one("timeupdate", function () { //ÇÑ¹ø¸¸ ½ÇÇàµÇµµ·Ï one »ç¿ë
    $("#bookMark").fadeIn(500);
  });
  //ºñµð¿ÀÀÇ ½Ã°£¿¡ µû¶ó ºÏ¸¶Å© »ö»óÀÌ º¯ÇÏµµ·Ï timeupdate·Î ÁÜ
  $("#video").on("timeupdate", function () {
    if (useType.indexOf("bookMark") != -1) {
      var bookMarkListNum = 0;
      for (var i = 1; i <= bookMarkInfo.length; i++) {
        if (video.currentTime >= bookMarkInfo[i - 1][0]) {
          bookMarkListNum = i;
        }
      }
      $("#bookMarkArea > #bookMarkListArea > div").css({ color: "", backgroundColor: "" });
      $("#bookMarkArea > #bookMarkListArea > #bookMarkList_" + zerofill(bookMarkListNum)).css({ color: "#333333", backgroundColor: "#ffffff" });
    }
  });

  //ºÏ¸¶Å© ¹öÆ° ¸¶¿ì½º ¿À¹ö
  $("#bookMark").on("mouseenter", function () {
    $("#bookMark").attr({ src: "../common/images/bookMark/bookMark_up.png" });
  });
  //ºÏ¸¶Å© ¹öÆ° ¸¶¿ì½º ¾Æ¿ô
  $("#bookMark").on("mouseleave", function () {
    $("#bookMark").attr({ src: "../common/images/bookMark/bookMark.png" });
  });
  //ºÏ¸¶Å© ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#bookMark").on("click", function () {
    $("#bookMark").hide();
    $("#bookMarkArea").fadeIn(1000);
  });
  //ºÏ¸¶Å© ´Ý±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#bookMarkArea > #bookMarkAreaClose").on("click", function () {
    $("#bookMark").fadeIn(1000);
    $("#bookMarkArea").fadeOut(500);
  });
  //ºÏ¸¶Å© ¸®½ºÆ® Å¬¸¯ÇßÀ» ¶§
  $("#bookMarkArea > #bookMarkListArea > *").on("click", function (e) {
    var getId = e.target.getAttribute("id"); //Å¬¸¯ÇÑ °´Ã¼ÀÇ id°ªÀ» ¾Ë¾Æ³»´Â ÇÔ¼ö
    var getNum = getId.split("_")[1]; //¾Ë¾Æ³½ id°ª¿¡¼­ ³Ñ¹ö¸¸ Àß¶ó³»´Â ÀÛ¾÷
    video.currentTime = bookMarkInfo[getNum - 1][0];
  });

  //Àç»ý¹ÙÀÇ ºÏ¸¶Å© À§Ä¡ µî·Ï
  $("#video").on("timeupdate", function () {
    if (useType == "progressBookMark") {
      for (var i = 1; i <= progressBookMarkInfo.length; i++) {
        $("footer > div > #progressBarArea > #progressBookMarkPoint_" + zerofill(i)).css({ left: ((100 / video.duration) * progressBookMarkInfo[i - 1]) + "%" });
        $("footer > div > #progressBarArea > #progressBookMarkText_" + zerofill(i)).css({ left: ((100 / video.duration) * progressBookMarkInfo[i - 1]) + "%" });
      }
    }
  });
  //Àç»ý¹ÙÀÇ ºÏ¸¶Å©¸¦ Å¬¸¯ÇßÀ» ¶§
  $("#progressBarArea > .progressBookMarkPoint").on("mousedown", function (e) {
    var getId = e.target.getAttribute("id");
    var getNum = getId.split("_")[1];

    video.currentTime = progressBookMarkInfo[getNum - 1];
    $("footer > div > #progressBarArea > .progressBookMarkText").hide();
  });
  //Àç»ý¹ÙÀÇ ºÏ¸¶Å© ¸¶¿ì½º ¿À¹ö
  $("#progressBarArea > .progressBookMarkPoint").on("mouseenter", function (e) {
    var getId = e.target.getAttribute("id");
    var getNum = getId.split("_")[1];

    $("footer > div > #progressBarArea > #progressBookMarkText_" + zerofill(getNum)).show();
  });
  //Àç»ý¹ÙÀÇ ºÏ¸¶Å© ¸¶¿ì½º ¾Æ¿ô
  $("#progressBarArea > .progressBookMarkPoint").on("mouseleave", function () {
    $("footer > div > #progressBarArea > .progressBookMarkText").hide();
  });

  //½ºÅµ ¹öÆ° ¸¶¿ì½º ¿À¹ö
  $("#skip").on("mouseenter", function () {
    $("#skip").attr({ src: "../common/images/controller/skip_up.png" });
  });
  //½ºÅµ ¹öÆ° ¸¶¿ì½º ¾Æ¿ô
  $("#skip").on("mouseleave", function () {
    $("#skip").attr({ src: "../common/images/controller/skip.png" });
  });
  //½ºÅµ ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#skip").on("click", function () {
    video.currentTime = skipTime[1];
  });

  //ºñµð¿ÀÆË¾÷ ¹öÆ° ½Ã°£¿¡ µû¶ó º¸¿©Áö°í ºñµð¿À Á¤Áö
  var videoPopupOn = true; //ÆË¾÷ ¶ç¿ò ¿©ºÎ¸¦ ¼³Á¤ÇÏ´Â º¯¼ö
  $("#video").on("timeupdate", function () {
    if (useType.indexOf("videoPopup") != -1) {
      for (var i = 0; i < videoPopupInfo.length; i++) {
        if (video.currentTime > videoPopupInfo[i][0] && video.currentTime < videoPopupInfo[i][0] + 0.3 && videoPopupOn == true) {
          $("#videoPopup_" + zerofill(i + 1)).fadeIn(500);
          video.pause();
        }
        else {
          videoPopupContentsNum = 1;
          $(".videoPopupnumText").text(videoPopupContentsNum);
          $(".videoPopupContentsPrev").hide();
          $(".videoPopupContentsNext").show();
          $(".videoPopupContents , .videoPopupContentsPrevNext , .videoPopupClose , #videoPopup_" + zerofill(i + 1)).hide();
        }
      }
    }
  });
  //ºñµð¿ÀÆË¾÷ ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var videoPopupNum; //¸î¹øÂ° ÆË¾÷ÀÎÁö ÀúÀåÇÒ º¯¼ö
  var videoPopupContentsNum = 1; //ÆË¾÷¿¡¼­ ¸î¹øÂ° ÀÌ¹ÌÁöÀÎÁö ÀúÀåÇÒ º¯¼ö
  $(".videoPopup").on("click", function (e) {
    var getId = e.target.getAttribute("id");
    var getNum = getId.split("_")[1];
    videoPopupNum = getNum;

    $("#videoPopup_" + getNum).hide();
    $("#videoPopupContents_" + getNum + "_01 , #videoPopupContentsPrevNext_" + getNum).fadeIn(500);
    if (videoPopupContentsInfo[videoPopupNum - 1][0] == 1) {
      $("#videoPopupClose_" + getNum).fadeIn(500);
    }
  });
  //ºñµð¿ÀÆË¾÷ ´Ý±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $(".videoPopupClose").on("click", function () {
    videoPopupOn = false;
    videoPopupContentsNum = 1;
    video.play();
    setTimeout(function () { videoPopupOn = true; }, 1000);
    $(".videoPopupContents , .videoPopupClose").fadeOut(500);
    $(".videoPopupContentsPrevNext").hide();
    $(".videoPopupContentsPrev").hide();
    $(".videoPopupContentsNext").show();
  });
  //ºñµð¿ÀÆË¾÷ ÄÜÅÙÃ÷ ÀÌÀü ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $(".videoPopupContentsPrev").on("click", function () {
    if (videoPopupContentsNum > 1) {
      videoPopupContentsNum--;

      $(".videoPopupnumText").text(videoPopupContentsNum);
      $("#videoPopupContents_" + videoPopupNum + "_" + zerofill(videoPopupContentsNum + 1)).hide();
      $("#videoPopupContents_" + videoPopupNum + "_" + zerofill(videoPopupContentsNum)).show();
    }
    if (videoPopupContentsNum < videoPopupContentsInfo[videoPopupNum - 1][0]) {
      $(".videoPopupContentsNext").show();
      $("#videoPopupClose_" + videoPopupNum).hide();
    }
    if (videoPopupContentsNum == 1) {
      $(".videoPopupContentsPrev").hide();
    }
    if (videoPopupContentsNum < 10) {
      $(".videoPopupnumText").css({ marginLeft: -contentsWidth / 2 - 20 });
    }
  });
  //ºñµð¿ÀÆË¾÷ ÄÜÅÙÃ÷ ´ÙÀ½ ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $(".videoPopupContentsNext").on("click", function () {
    if (videoPopupContentsNum < videoPopupContentsInfo[videoPopupNum - 1][0]) {
      videoPopupContentsNum++;

      $(".videoPopupnumText").text(videoPopupContentsNum);
      $("#videoPopupContents_" + videoPopupNum + "_" + zerofill(videoPopupContentsNum - 1)).hide();
      $("#videoPopupContents_" + videoPopupNum + "_" + zerofill(videoPopupContentsNum)).show();
    }
    if (videoPopupContentsNum == videoPopupContentsInfo[videoPopupNum - 1][0]) {
      $(".videoPopupContentsNext").hide();
      $("#videoPopupClose_" + videoPopupNum).show();
    }
    if (videoPopupContentsNum > 1) {
      $(".videoPopupContentsPrev").show();
    }
    if (videoPopupContentsNum >= 10) {
      $(".videoPopupnumText").css({ marginLeft: -contentsWidth / 2 - 35 });
    }
  });

  //Åõ¸íµµ Á¶Àý ÀÌ¹ÌÁö ¹öÆ° ½Ã°£¿¡ µû¶ó º¸¿©Áü/¾Èº¸¿©Áü
  $("#video").on("timeupdate", function () {
    if (useType.indexOf("opacityPopup") != -1) {
      if (video.currentTime > opacityPopupShowTime) {
        $("#opacityPopupBtn").fadeIn(500);
      }
      else {
        $("#opacityPopupBtn").hide();
      }
    }
  });
  //Åõ¸íµµ Á¶Àý ÀÌ¹ÌÁö ¹öÆ° ¸¶¿ì½º ¾Æ¿ô/¿À¹ö
  $("#opacityPopupBtn").on("mouseenter", function () {
    $("#opacityPopupBtn").attr({ src: "../common/images/opacityPopup/opacityPopup_up.png" });
  });
  $("#opacityPopupBtn").on("mouseleave", function () {
    $("#opacityPopupBtn").attr({ src: "../common/images/opacityPopup/opacityPopup.png" });
  });

  //Åõ¸íµµ Á¶Àý ÀÌ¹ÌÁö ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§
  var opacityPopupShow = false; ///Åõ¸íµµ Á¶Àý ÀÌ¹ÌÁö°¡ º¸ÀÌ´Â »óÅÂÀÎÁö ÀúÀåÇÒ º¯¼ö
  $("#opacityPopupBtn").on("click", function () {
    if (opacityPopupShow == false) {
      opacityPopupShow = true;
      $("#opacityArea").show();
    }
    else {
      opacityPopupShow = false;
      $("#opacityArea").hide();
    }
  });
  //Åõ¸íµµ Á¶Àý ¿µ¿ªÀ» Å¬¸¯ÇßÀ» ¶§
  $("#opacityBarArea").on("mousedown", function (e) {
    var relativeX = (e.pageX - $(this).offset().left);
    var EventWidth = $(this).width();
    var pointWidth = $("#opacityBarPoint").width();
    var value = relativeX / EventWidth;

    if (relativeX >= 0 && value <= 1) {
      if (userAgentNavigator() == "iPhone" || userAgentNavigator() == "iPad" || userAgentNavigator() == "android" || userAgentNavigator() == "touch") {
        $("#opacityBarArea > #opacityBarPoint").css({ right: (EventWidth - (relativeX / mobileScale) - (pointWidth / 2)) + "px" });
        $("#opacityPopupArea").css({ opacity: value / mobileScale });
      }
      else {
        $("#opacityBarArea > #opacityBarPoint").css({ right: (EventWidth - relativeX - (pointWidth / 2)) + "px" });
        $("#opacityPopupArea").css({ opacity: value });
      }
    }
    $("#opacityBarArea").on("mousemove", function (e) {
      var relativeX = (e.pageX - $(this).offset().left);
      var EventWidth = $(this).width();
      var pointWidth = $("#opacityBarPoint").width();
      var value = relativeX / EventWidth;

      if (relativeX >= 0 && value <= 1) {
        if (userAgentNavigator() == "iPhone" || userAgentNavigator() == "iPad" || userAgentNavigator() == "android" || userAgentNavigator() == "touch") {
          $("#opacityBarArea > #opacityBarPoint").css({ right: (EventWidth - (relativeX / mobileScale) - (pointWidth / 2)) + "px" });
          $("#opacityPopupArea").css({ opacity: value / mobileScale });
        }
        else {
          $("#opacityBarArea > #opacityBarPoint").css({ right: (EventWidth - relativeX - (pointWidth / 2)) + "px" });
          $("#opacityPopupArea").css({ opacity: value });
        }
      }
    });
    $("body").on("mouseup", function (e) {
      $("#opacityBarArea").off("mousemove");
    });
  });
  //Åõ¸íµµ Á¶Àý ÀÌ¹ÌÁö ³Ø¹é ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var opacityPopupNum = 1;
  $("#opacityPopupPrevNext").on("click", function (e) {
    var getId = e.target.getAttribute("id");

    if (getId == "opacityPopupPrev") {
      if (opacityPopupNum > 1) {
        opacityPopupNum--;
        $("#opacityPopupArea > #opacityPopup_" + zerofill(opacityPopupNum + 1)).hide();
        $("#opacityPopupArea > #opacityPopup_" + zerofill(opacityPopupNum)).show();

        if (opacityPopupNum < opacityPopupCount) {
          $("#opacityPopupPrevNext > #opacityPopupNext").show();
        }
        if (opacityPopupNum == 1) {
          $("#opacityPopupPrevNext > #opacityPopupPrev").hide();
        }
      }
    }
    else if (getId == "opacityPopupNext") {
      if (opacityPopupNum < opacityPopupCount) {
        opacityPopupNum++;
        $("#opacityPopupArea > #opacityPopup_" + zerofill(opacityPopupNum - 1)).hide();
        $("#opacityPopupArea > #opacityPopup_" + zerofill(opacityPopupNum)).show();

        if (opacityPopupNum > 1) {
          $("#opacityPopupPrevNext > #opacityPopupPrev").show();
        }
        if (opacityPopupNum == opacityPopupCount) {
          $("#opacityPopupPrevNext > #opacityPopupNext").hide();
        }
      }
    }
  });

  //´Ù¿î·Îµå¿Í ÇÁ¸°Æ® ¹öÆ° ½Ã°£¿¡ µû¶ó º¸¿©Áü/¾Èº¸¿©Áü
  var downloadShow = false;
  var printShow = false;
  $("#video").on("timeupdate", function () {
    if (useType.indexOf("download") != -1) {
      if (video.currentTime > downloadInfo[0]) {
        if (downloadShow == false) {
          //$("#download").fadeIn(1000);
          $("#download").show();
          $("#download").animate({ opacity: 1 }, 800);
          downloadShow = true;
        }
      }
      else {
        $("#download").hide();
        $("#download").css({ opacity: 0 });
        downloadShow = false;
      }
    }
    if (useType.indexOf("print") != -1) {
      if (video.currentTime > printInfo[0]) {
        if (printShow == false) {
          //$("#print").fadeIn(1000);
          $("#print").show();
          $("#print").animate({ opacity: 1 }, 800);
          printShow = true;
        }
      }
      else {
        $("#print").hide();
        $("#print").css({ opacity: 0 });
        printShow = false;
      }
    }
  });

  //´Ù¿î·Îµå¿Í ÇÁ¸°Æ® ¸¶¿ì½º ¾Æ¿ô/¿À¹ö
  $("#download, #print").on("mouseenter", function (e) {
    var getId = e.target.getAttribute("id");
    $("#" + getId).attr({ src: "../common/images/controller/" + getId + "_up.png" });
  });
  $("#download, #print").on("mouseleave", function (e) {
    var getId = e.target.getAttribute("id");
    $("#" + getId).attr({ src: "../common/images/controller/" + getId + ".png" });
  });

  //ÄÁÆ®·Ñ¹Ù ´Ù¿î·Îµå ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§
  $("#mainDownload").on("click", function () {
    /*
    $("article").append('<iframe id="fileDown" style="visibility:hidden" src="" width="1" height="1"></iframe>');
    document.getElementById("fileDown").src = "./down/teachingPlan.zip";
    setTimeout(function() { document.getElementById("fileDown").remove(); }, 2000);
    */
    var downloadOpen = window.open("./down/teachingPlan.zip", "down", "toolbar=no, scrollbars=no, location=no, status=no, menubar=no, resizable=no, width=100, height=100");
    setTimeout(function () { downloadOpen.close(); }, 2000);
  });
  //´Ù¿î·Îµå ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§
  $("#download").on("click", function () {
    var downloadOpen = window.open(downloadInfo[1], "down", "toolbar=no, scrollbars=no, location=no, status=no, menubar=no, resizable=no, width=100, height=100");
    setTimeout(function () { downloadOpen.close(); }, 2000);
  });
  //ÇÁ¸°Æ® ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§
  $("#print").on("click", function () {
    window.open(printInfo[1], "print", "scrollbars=yes, width=" + (720 + 15) + "px, height=" + (window.screen.availHeight - 80) + "px, top=0, left=0");
  });

  //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì ºñµð¿À ½Ã°£¿¡ µû¸¥ ÀÚ¸· ÅØ½ºÆ® º¯°æ
  $("#video").on("timeupdate", function () {
    if (realTimeScriptUse == true) {
      for (var i = 0; i < realTimeScriptText.length; i++) {
        if (i < realTimeScriptText.length - 1) {
          if (video.currentTime >= Number(realTimeScriptText[i][0].split(":")[0] * 60) + Number(realTimeScriptText[i][0].split(":")[1]) && video.currentTime < Number(realTimeScriptText[i + 1][0].split(":")[0] * 60) + Number(realTimeScriptText[i + 1][0].split(":")[1])) {
            $("realTimeScriptLayer > #realTimeScriptText").html(realTimeScriptText[i][1]);
          }
          else if (video.currentTime < Number(realTimeScriptText[0][0].split(":")[0] * 60) + Number(realTimeScriptText[0][0].split(":")[1])) {
            $("realTimeScriptLayer > #realTimeScriptText").html("");
          }
        }
        else {
          if (video.currentTime >= Number(realTimeScriptText[i][0].split(":")[0] * 60) + Number(realTimeScriptText[i][0].split(":")[1])) {
            $("realTimeScriptLayer > #realTimeScriptText").html(realTimeScriptText[i][1]);
          }
        }
      }
    }
  });

  //ÀÚ¸· ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var scriptShow = false; //ÀÚ¸·ÀÌ º¸ÀÌ´Â »óÅÂÀÎÁö ¿©ºÎ  true : º¸ÀÓ  false : ¾Èº¸ÀÓ
  $("#script").on("click", function () {
    if (realTimeScriptUse == false) { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÏÁö ¾ÊÀ» °æ¿ì
      if ($("scriptLayer").css("display") == "none") {
        scriptShow = true;
        $("scriptLayer").fadeIn(1000);
      }
      else {
        scriptShow = false;
        $("scriptLayer").fadeOut(200);
      }
    }
    else { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì
      if (locationCenter == true) {
        //ÀÚ¸· ¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú
        if ($("realTimeScriptLayer").css("bottom") == "-50px") { //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú¸¦ ÁÖ±âÀ§ÇØ controller.cssÀÇ scriptLayer{} ¿¡¼­ bottom°ª ÁØ¸¸Å­ Àû¾îÁÜ
          scriptShow = true;
          $("realTimeScriptLayer").show();
          $("realTimeScriptLayer").stop().animate({ bottom: "50px" }, 600);
        }
        else if ($("realTimeScriptLayer").css("bottom") == "50px") {
          scriptShow = false;
          $("realTimeScriptLayer").stop().animate({ bottom: "-50px" }, 600, function () { //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú¸¦ ÁÖ±âÀ§ÇØ controller.cssÀÇ scriptLayer{} ¿¡¼­ bottom°ª ÁØ¸¸Å­ Àû¾îÁÜ
            $("realTimeScriptLayer").hide();
          });
        }
      }
      else {
        if ($("realTimeScriptLayer").css("display") == "none") {
          scriptShow = true;
          $("realTimeScriptLayer").fadeIn(1000);
        }
        else {
          scriptShow = false;
          $("realTimeScriptLayer").fadeOut(200);
        }
      }
    }
  });
  //ÀÚ¸· ´Ý±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#scriptClose").on("click", function () {
    scriptShow = false;
    $("scriptLayer").fadeOut(200);
  });

  //ÄÁÆ®·Ñ¹Ù ¼û±è/º¸ÀÓ ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var controlLock = true; //ÄÁÆ®·Ñ¹Ù ¶ôÀÌ °É·ÁÀÖ´Â »óÅÂÀÎÁö ¿©ºÎ lockOn : true  lockOff : false
  $("#controlLockOnOff").on("click", function () {
    if (controlLock == true) {
      controlLock = false;
      $("#controlLockOnOff").attr({ class: "icon-lock-open-filled control-icon", title: "Control Bar Show" });
    }
    else {
      controlLock = true;
      $("#controlLockOnOff").attr({ class: "icon-lock-filled control-icon", title: "Control Bar Hide" });
    }
  });
  //ÄÜÅÙÃ÷ ¸¶¿ì½º ¿À¹ö ¾Æ¿ô ÇßÀ»¶§ ÄÁÆ®·Ñ¹Ù ¼û±è/º¸ÀÓ
  if (locationCenter == true) {
    $("article").on("mouseenter", function () {
      if (controlLock == false) {
        $("footer").show();
        $("footer").stop().animate({ bottom: "0px" }, 300);
        if (scriptShow == true) {
          if (realTimeScriptUse == false) { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÏÁö ¾ÊÀ» °æ¿ì
            $("scriptLayer").stop().animate({ bottom: "38px" }, 300);
          }
          else { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì
            $("realtimescriptlayer").stop().animate({ bottom: "50px" }, 300);
          }
        }
      }
    });
    $("article").on("mouseleave", function () {
      if (controlLock == false) {
        $("footer").stop().animate({ bottom: "-38px" }, 300, function () {
          $("footer").hide();
        });
        if (scriptShow == true) {
          if (realTimeScriptUse == false) { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÏÁö ¾ÊÀ» °æ¿ì
            $("scriptLayer").stop().animate({ bottom: "0px" }, 300);
          }
          else { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì
            $("realtimescriptlayer").stop().animate({ bottom: "12px" }, 300);
          }
        }
      }
    });
  }
  else {
    if (footerInVideo == true) { //ÄÁÆ®·Ñ¹Ù°¡ ¿µ»ó ³»ºÎ¿¡ Á¸ÀçÇÒ °æ¿ì
      $("article").on("mouseenter", function () {
        if (controlLock == false) {
          $("footer").show();
          $("footer").stop().animate({ bottom: "0px" }, 300);
          $("#skip").stop().animate({ bottom: "48px" }, 300);
          if (scriptShow == true) {
            if (realTimeScriptUse == false) { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÏÁö ¾ÊÀ» °æ¿ì
              $("scriptLayer").stop().animate({ bottom: "38px" }, 300);
            }
            else { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì
              $("realtimescriptlayer").stop().animate({ bottom: "48px" }, 300);
            }
          }
        }
      });
      $("article").on("mouseleave", function () {
        if (controlLock == false) {
          $("footer").stop().animate({ bottom: "-38px" }, 300, function () {
            $("footer").hide();
          });
          $("#skip").stop().animate({ bottom: "10px" }, 300);
          if (scriptShow == true) {
            if (realTimeScriptUse == false) { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÏÁö ¾ÊÀ» °æ¿ì
              $("scriptLayer").stop().animate({ bottom: "0px" }, 300);
            }
            else { //½Ç½Ã°£ ÀÚ¸·À» »ç¿ëÇÒ °æ¿ì
              $("realtimescriptlayer").stop().animate({ bottom: "10px" }, 300);
            }
          }
        }
      });
    }
    else { //ÄÁÆ®·Ñ¹Ù°¡ ¿µ»ó ¿ÜºÎ¿¡ Á¸ÀçÇÒ °æ¿ì
      $("article").on("mouseenter", function () {
        if (controlLock == false) {
          $("footer, scriptlayer").fadeIn(300);
        }
      });
      $("article").on("mouseleave", function () {
        if (controlLock == false) {
          $("footer, scriptlayer").fadeOut(300);
        }
      });
    }
  }

  //ÀÎµ¦½º ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#index , #indexIcon").on("click", function () {
    /* 
    //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú ¾øÀÌ show, hide ¼³Á¤
    if ($("index").css("display") == "none") {
      $("index").show();
    }
    else {
      $("index").hide();
    }
    */
    //ÀÎµ¦½º ¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú
    if ($("#indexLayer").css("left") == "-240px") { //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú¸¦ ÁÖ±âÀ§ÇØ controller.cssÀÇ index > #indexLayer{} ¿¡¼­ left°ª ÁØ¸¸Å­ Àû¾îÁÜ
      $("#indexLayer").show();
      $("#indexLayer").stop().animate({ left: "0px" }, 600);
      $("#indexIcon").stop().animate({ left: "240px" }, 600);
    }
    else if ($("#indexLayer").css("left") == "0px") {
      $("#indexIcon").stop().animate({ left: "0px" }, 600);
      $("#indexLayer").stop().animate({ left: "-240px" }, 600, function () { //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú¸¦ ÁÖ±âÀ§ÇØ controller.cssÀÇ index > #indexLayer{} ¿¡¼­ left°ª ÁØ¸¸Å­ Àû¾îÁÜ
        $("#indexLayer").hide();
      });
    }
  });
  //ÀÎµ¦½º ´Ý±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#indexClose").on("click", function () {
    $("#indexIcon").stop().animate({ left: "0px" }, 600);
    $("#indexLayer").stop().animate({ left: "-240px" }, 600, function () { //¾Ö´Ï¸ÞÀÌ¼Ç È¿°ú¸¦ ÁÖ±âÀ§ÇØ controller.cssÀÇ index > #indexLayer{} ¿¡¼­ left°ª ÁØ¸¸Å­ Àû¾îÁÜ
      $("#indexLayer").hide();
    });
  });
  //ÀÎµ¦½º ¿µ¿ª¿¡¼­ indexSubTitle¸¦ Å¬¸¯ÇßÀ» ¶§
  $("index > #indexLayer > .indexTitle > .indexTitleText , index > #indexLayer > .indexTitle > .indexSubTitle").on("click", function (e) {
    var getId = e.target.getAttribute("id");
    var getNum = getId.split("_")[1];

    if (locationGet() == "localRGB" || locationGet() == "webRGB") { //¾ËÁöºñ ³»ºÎ
      movepage(Number(chasi), Number(getNum));
    }
    else { //¿ÜºÎ
      movepage(Number(chasi), Number(getNum)); //Æ÷ÆÃ¿ëÀÏ¶§ ÆäÀÌÁöÀÌµ¿ ¸í·É¾î
    }
  });
  //ÀÎµ¦½º ¼­ºê ¿µ¿ª ¸¶¿ì½º ¿À¹ö/¾Æ¿ô
  $("#indexLayer > .indexTitle > .indexSubTitle").on("mouseenter", function (e) {
    var getId = e.target.getAttribute("id");
    var getStr = getId.split("_")[1];

    $(".indexSubSubTitleArea").hide();
    $("#indexSubSubTitleArea_" + getStr).show();
  });
  $("#indexLayer > .indexTitle > .indexSubTitle").on("mouseleave", function (e) {
    $(".indexSubSubTitleArea").hide();
  });

  //·¯´×¸Ê ÆË¾÷Ã¢ÀÌ ÀÖ°í ¾ø°í¿¡ µû¶ó setIntervalÀ» ÀÌ¿ëÇÑ ºñµð¿À Àç»ý ÄÁÆ®·Ñ
  var videoEndState = false;
  function popupTimer() {
    var videoPlayState = false;
    var popupOpen = setInterval(function () {
      if (!popupState.closed && popupState) {
        if (videoPlayState == false) {
          videoPlayState = true;

          if (videoEndState == false) {
            video.pause();
          }

          $("#windowClickBlock").show();
          $("html").on("click", function () {
            popupState.focus();
          });
        }
      }
      else {
        if (videoPlayState == true) {
          if (videoEndState == false) {
            video.play();
          }

          $("#windowClickBlock").hide();
        }
        clearInterval(popupOpen);
      }
    }, 100);

    $("video").on("timeupdate", function () { videoEndState = false; });
    $("video").on("ended", function () { videoEndState = true; });
  }


  //·¯´×¸Ê ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var popupState;
  $("#learningMap").on("click", function () {
    popupTimer();
    var popupWidth = 1000; //ÆË¾÷Ã¢ÀÇ °¡·Î Å©±â
    var popupHeight = 580; //ÆË¾÷Ã¢ÀÇ ¼¼·Î Å©±â
    var popupX = ((window.screen.width - popupWidth) / 2); //È­¸é Áß¾Ó¿¡ ¶ç¿ì±â À§ÇÑ x°ª -> ÆË¾÷Ã¢À¸·Î ¶ç¿ï ÀÇ¹ÌÁöÀÇ width °ª º¯°æ
    var popupY = ((window.screen.height - popupHeight) / 2);  //È­¸é Áß¾Ó¿¡ ¶ç¿ì±â À§ÇÑ y°ª -> ÆË¾÷Ã¢À¸·Î ¶ç¿ï ÀÇ¹ÌÁöÀÇ height °ª º¯°æ
    popupState = window.open("./images/learningMap/learn.html", "learningMap", "width=" + popupWidth + ", height=" + popupHeight + ", top=" + popupY + ", left=" + popupX);
  });

  //ÀüÃ¼È­¸é ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#fullScreen").on("click", function () {
    var element = document.querySelector("body"); //body´ë½Å video³ÖÀ¸¸é ¿µ»ó¸¸ ÀüÃ¼È­¸éÀ¸·Î ³ª¿È

    if (fullSceenState == false) {
      if (userAgentNavigator() != "IE10" && userAgentNavigator() != "IE9") {
        if (element.requestFullscreen) { //ÀüÃ¼
          element.requestFullscreen();
        }
        else if (element.mozRequestFullScreen) { //Firefox
          element.mozRequestFullScreen();
        }
        else if (element.webkitRequestFullscreen) { //Chrome
          element.webkitRequestFullscreen();
        }
        else if (element.msRequestFullscreen) { //IE11,Edge
          element.msRequestFullscreen();
        }
        fullScreenSet();

        /*
        if ((pageType == "video" && useType.indexOf("videoPopup") == -1 && useType.indexOf("opacityPopup") == -1) || (pageType == "videoChange" && videoChangeShow == false) || (pageType == "summary" && summaryType == "vod")) {
          if (element.requestFullscreen) { //ÀüÃ¼
            element.requestFullscreen();
          }
          else if (element.mozRequestFullScreen) { //Firefox
            element.mozRequestFullScreen();
          }
          else if (element.webkitRequestFullscreen) { //Chrome
            element.webkitRequestFullscreen();
          }
          else if (element.msRequestFullscreen) { //IE11,Edge
            element.msRequestFullscreen();
          }
          fullScreenSet();
        }
        else if (pageType == "videoChange" && videoChangeShow == true) {
          alertShow("videoChange");
        }
        else {
          alertShow("notFullScreen");
        }
        */
      }
      else {
        alertShow("LowIE");
      }
    }
    else if (fullSceenState == true) {
      if (document.exitFullscreen) { //ÀüÃ¼
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) { //Firefox
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) { //Chrome
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) { //IE11,Edge
        document.msExitFullscreen();
      }
      resizeScreenSet();
    }
  });

  //ÀüÃ¼È­¸éÀ» Áö¿øÇÏÁö ¾Ê´Â ÆäÀÌÁö¿¡¼­ÀÇ ¹öÆ° ÄÃ·¯°ª º¯°æ
  if (!((pageType == "video" && useType.indexOf("videoPopup") == -1 && useType.indexOf("opacityPopup") == -1) || pageType == "videoChange" && videoChangeShow == false || pageType == "summary" && summaryType == "vod") || userAgentNavigator() == "IE10" || userAgentNavigator() == "IE9") {
    //$("footer > div > #fullScreen").css({ color: "#555555" });
  }

  //Àç»ý/ÀÏÁöÁ¤Áö ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#playPause").on("click", function () {
    videoPopupOn = false;
    setTimeout(function () { videoPopupOn = true; }, 1000);

    if (video.paused == true) {
      video.play();
    }
    else {
      video.pause();
    }
  });

  //´Ù½Ãµè±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§ 
  $("#rePlay").on("click", function () {
    video.play();
    video.currentTime = 0;
  });

  //¼Óµµ ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§ º¯°æÇÒ ¼Óµµ ¸ñ·Ï ¿­°í ´ÝÀ½
  $("#videoRate").on("click", function () {
    if ($("footer > div > .videoRateList").css("display") == "none") {
      $("footer > div > .videoRateList").fadeIn(500);
    }
    else {
      $("footer > div > .videoRateList").fadeOut(500);
    }
  });
  //¼Óµµ ¹öÆ°À» Å¬¸¯ÇßÀ» ¶§ playbackRateÀÇ ¼Óµµ°ª º¯°æ
  var videoRateListId = "videoRate_1_0";
  $("footer > div > .videoRateList").on("click", function (e) {
    var getId = e.target.getAttribute("id"); //Å¬¸¯ÇÑ °´Ã¼ÀÇ id°ªÀ» ¾Ë¾Æ³»´Â ÇÔ¼ö
    var getStr = getId.split("_")[1] + "." + getId.split("_")[2]; //¼Óµµ ¹®ÀÚ·Î ¸¸µå´Â ÀÛ¾÷  ex) videoRate_1_0 -> 1.0
    videoRateListId = getId;

    videoRateListShow = false;
    video.playbackRate = getStr;
    video.defaultPlaybackRate = video.playbackRate; //IE¿¡¼­ ÀÏ½ÃÁ¤Áö¿¡¼­ Àç»ý»óÅÂ·Î ¹Ù²ð¶§ Àç»ý¼Óµµ °ªÀÌ ÃÊ±âÈ­µÇ´Â ¹®Á¦ ÇØ°á
    videoRate.innerHTML = getStr;
    $("footer > div > .videoRateList").hide();
  });

  //¼Óµµ ¸ñ·Ï¿¡¼­ ¸¶¿ì½º ¿À¹ö/¾Æ¿ô
  $("footer > div > .videoRateList > div").on("mouseenter", function (e) {
    var getId = e.target.getAttribute("id");
    if (videoRateListId != getId) {
      $("footer > div > .videoRateList > #" + getId).css({ backgroundColor: "#728dff" });
    }
  });
  $("footer > div > .videoRateList > div").on("mouseleave", function () {
    $("footer > div > .videoRateList > div").css({ backgroundColor: "#aca9a9" });
    $("footer > div > .videoRateList > #" + videoRateListId).css({ backgroundColor: "#728dff" });
  });

  /******************************************************************/
  //currentTimeÀº ºñµð¿ÀÀÇ ÇöÀç Àç»ý °ªÀ» ¹ÝÈ¯ÇÏ°Å³ª °ªÀ» ¼³Á¤ÇÒ¼ö ÀÖ´Ù
  //durationÀº ºñµð¿À ½Ã°£ °ªÀ» ¹ÝÈ¯

  //Àç»ý¹ÙÀÇ À§Ä¡¸¦ º¯°æÇßÀ»¶§ ¿µ»ó Àç»ý À§Ä¡ º¯°æ
  $("#progressBarArea").on("mousedown", function (e) {
    var getId = e.target.getAttribute("id");

    if (getId.indexOf("progressBookMarkPoint") == -1) {
      var relativeX = (e.pageX - $(this).offset().left);
      var EventWidth = $(this).width() * getScale;

      if (relativeX >= 0) {
        var value = (100 / EventWidth) * relativeX;

        $("footer > div > #progressBarArea > #progressBar").css({ width: (value / mobileScale + "%") });
        video.currentTime = video.duration * (value / mobileScale / 100);
      }
      $("#progressBarArea").on("mousemove", function (e) {
        var relativeX = (e.pageX - $(this).offset().left);
        var EventWidth = $(this).width() * getScale;

        if (relativeX >= 0) {
          var value = (100 / EventWidth) * relativeX;

          $("footer > div > #progressBarArea > #progressBar").css({ width: (value / mobileScale + "%") });
          video.currentTime = video.duration * (value / mobileScale / 100);
        }
      });
      $("body").on("mouseup", function (e) { //Àç»ý¹Ù Á¶ÀýÁß¿¡ ¿µ¿ª¹Û¿¡¼­ ¸¶¿ì½º Å¬¸¯À» ¶§°í ´Ù½Ã ¿µ¿ª¾ÈÀ¸·Î µé¾î¿À¸é ¸¶¿ì½º ¿òÁ÷ÀÌ´Â´ë·Î Á¶ÀýÀÌ ¿òÁ÷ÀÌ´Â °ÍÀ» ¹æÁöÇÏ±â À§ÇØ mousemove¸¦ ÇØÁ¦
        $("#progressBarArea").off("mousemove");
      });
    }
  });
  //¿µ»óÀÌ Àç»ýµÇ´Â Á¤µµ¿¡ µû¶ó Àç»ý¹Ù ¿òÁ÷ÀÓ
  $("#video").on("timeupdate", function () {
    if ($("#progressBar").length) { //ÇØ´ç id°ªÀÌ Á¸Àç ÇØ¸é ½ÇÇà
      progressBar.value = (100 / video.duration) * video.currentTime;
      $("footer > div > #progressBarArea > #progressBar").css({ width: progressBar.value + "%" });
    }
  });
  //Àç»ý¹Ù¸¦ ¿òÁ÷ÀÌ°í ÀÖÀ»¶§ ¿µ»óÀÌ °è¼Ó Àç»ýµÇ°í ÀÖÀ¸¹Ç·Î ¸¶¿ì½º Å¬¸¯ÁßÀÏ¶§ ºñµð¿À¸¦ ¸ØÃã
  $("#progressBarArea").on("mousedown", function () {
    video.pause();
  });
  //¸¶¿ì½º Å¬¸¯ÀÌ ³¡³ª¸é ºñµð¿À ´Ù½Ã Àç»ý
  $("#progressBarArea").on("mouseup", function () {
    video.play();
  });
  /******************************************************************/

  //À½¼Ò°Å ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  //volume °ªÀº 0.0 ~ 1.0 »çÀÌÀÇ °ª¸¸ »ç¿ë°¡´ÉÇÏ¹Ç·Î ÁÖÀÇ(100À» °öÇØÁà¼­ °ªÀÇ ¹üÀ§¸¦ ³ÐÈû)
  var volumeSave; //À½¼Ò°Å ÀüÀÇ º¼·ý °ªÀ» ÀúÀåÇÒ º¯¼ö
  $("#mute").on("click", function () {
    if (video.muted == true) {
      video.muted = false;
      if (volumeSave == undefined) {
        video.volume = 1;
        $("footer > div > #volumeBarArea > #volumeBar").css({ width: "100%" });
      }
      else {
        video.volume = volumeSave;
        $("footer > div > #volumeBarArea > #volumeBar").css({ width: video.volume * 100 + "%" });
      }
    }
    else {
      video.muted = true;
      video.volume = 0;
      $("footer > div > #volumeBarArea > #volumeBar").css({ width: "0%" });
    }
  });
  //À½·®Á¶Àý ¿µ¿ªÀ» Å¬¸¯ÇßÀ»¶§ º¼·ýÀÇ °ªÀ» ºñµð¿À º¼·ý¿¡ ÀúÀå
  $("#volumeBarArea").on("mousedown", function (e) { //¸¶¿ì½º¸¦ Å¬¸¯ÇÑÃ¤·Î º¼·ý Á¶Àý½Ã Á¶ÀýÇÏ´ÂÁ¤µµ°¡ º¸ÀÌµµ·Ï mousedown¾È¿¡ mousemove¸¦ ÁÜ
    var relativeX = (e.pageX - $(this).offset().left);
    var EventWidth = $(this).width() * getScale;

    if (relativeX >= 0) {
      var value = (100 / EventWidth) * relativeX;
      $("footer > div > #volumeBarArea > #volumeBar").css({ width: (value + "%") });
      if (value <= 0) {
        video.muted = true;
        video.volume = value;
      }
      else {
        video.muted = false;
        video.volume = value / 100;
        volumeSave = video.volume;
      }
    }
    $("#volumeBarArea").on("mousemove", function (e) {
      var relativeX = (e.pageX - $(this).offset().left);
      var EventWidth = $(this).width() * getScale;

      if (relativeX >= 0) {
        var value = (100 / EventWidth) * relativeX;
        $("footer > div > #volumeBarArea > #volumeBar").css({ width: (value + "%") });
        if (value <= 0) {
          video.muted = true;
          video.volume = value;
        }
        else {
          video.muted = false;
          video.volume = value / 100;
          volumeSave = video.volume;
        }
      }
    });
    $("body").on("mouseup", function (e) { //º¼·ý Á¶ÀýÁß¿¡ ¿µ¿ª¹Û¿¡¼­ ¸¶¿ì½º Å¬¸¯À» ¶§°í ´Ù½Ã ¿µ¿ª¾ÈÀ¸·Î µé¾î¿À¸é ¸¶¿ì½º ¿òÁ÷ÀÌ´Â´ë·Î Á¶ÀýÀÌ ¿òÁ÷ÀÌ´Â °ÍÀ» ¹æÁöÇÏ±â À§ÇØ mousemove¸¦ ÇØÁ¦
      $("#volumeBarArea").off("mousemove");
    });
  });

  //µÚ·Î°¨±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  var backforwardSec = 10; //µÚ·Î°¨±â, ¾ÕÀ¸·Î°¨±â ÀÌµ¿ ½Ã°£(½Ã°£ º¯°æÇÏ°í ½ÍÀ¸¸é °ª¸¸ ¹Ù²ãÁÖ¸é µÊ)
  $("#backward").on("click", function () {
    if (video.currentTime < backforwardSec) {
      video.currentTime = 0;
    }
    else {
      video.currentTime = video.currentTime - backforwardSec;
    }
  });
  //¾ÕÀ¸·Î°¨±â ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#forward").on("click", function () {
    if (video.currentTime > video.duration - backforwardSec) {
      video.currentTime = video.duration;
    }
    else {
      video.currentTime = video.currentTime + backforwardSec;
    }
  });

  //ÀÌÀü ¹öÆ°, Å« ÀÌÀü ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#prev, #bigPrev").on("click", function () {
    var page = Number(currentPageNum) - 1;

    if (locationGet() == "localRGB" || locationGet() == "webRGB") {
      prevpage(Number(chasi), Number(currentPageNum));
    }
    else {
      prevpage(Number(chasi), Number(currentPageNum)); //Æ÷ÆÃ¿ëÀÏ¶§ ÆäÀÌÁöÀÌµ¿ ¸í·É¾î
    }
  });

  //´ÙÀ½ ¹öÆ°, Å« ´ÙÀ½ ¹öÆ°, ¸»Ç³¼± ¹öÆ° Å¬¸¯ÇßÀ» ¶§
  $("#next, #bigNext, #nextBalloon").on("click", function () {
    var page = Number(currentPageNum) + 1;

    if (locationGet() == "localRGB" || locationGet() == "webRGB") {
      nextpage(Number(chasi), Number(currentPageNum));
    }
    else {
      nextpage(Number(chasi), Number(currentPageNum)); //Æ÷ÆÃ¿ëÀÏ¶§ ÆäÀÌÁöÀÌµ¿ ¸í·É¾î
    }
  });

  //Å« ÀÌÀü/´ÙÀ½ ¹öÆ°ÀÌ º¸¿©Áö´Â ÆäÀÌÁö ¼¼ÆÃ
  if (currentPageNum == "01") {
    $("#bigPrev").hide();
  }
  else {
    $("#bigPrev").show();
  }
  if (currentPageNum == totalPage) {
    $("#bigNext").hide();
  }
  else {
    $("#bigNext").show();
  }

  /******************************************************************/
  //timeupdate¸¦ ½á¼­ ½Ã°£Ç¥½Ã°¡ °è¼Ó ¾÷µ¥ÀÌÆ® µÇ°ÔÇÔ
  //Utils.jsÀÇ zerofillÇÔ¼ö¸¦ ÀÌ¿ëÇØ¼­ ÀÏÀÇ ÀÚ¸®¼ö¿¡ 0À» ºÙ¿© 10ÀÇ ÀÚ¸®¼ö·Î Ç¥ÇöÇÏ°í ÃÊ·Î ³ª¿À´Â ½Ã°£À» ½ÃºÐÃÊ·Î ¹Ù²î°Ô ÇÔ

  //ºñµð¿ÀÀÇ ÇöÀç Àç»ý½Ã°£À» º¸¿©ÁÜ
  $("#video").on("timeupdate", function () {
    if ($("#playTime").length) { //ÇØ´ç id°ªÀÌ Á¸Àç ÇØ¸é ½ÇÇà
      playTime.innerHTML = videoTime(video.currentTime);
    }
  });
  //ºñµð¿ÀÀÇ ÃÑ Àç»ý½Ã°£À» º¸¿©ÁÜ
  $("#video").on("loadedmetadata timeupdate", function () { //¸ÞÅ¸µ¥ÀÌÅÍ°¡ ·ÎµåµÇ¸é ½Ã°£ÀÌ ¹Ù·Î ³ªÅ¸³ª°Ô loadedmetadata¸¦ »ç¿ëÇßÁö¸¸ ÆÄÀÌ¾îÆø½º¿¡¼­´Â »ç¿ëÇÒ ¼ö ¾ø¾î¼­ timeupdateµµ °°ÀÌ »ç¿ë
    if ($("#totalTime").length) { //ÇØ´ç id°ªÀÌ Á¸Àç ÇØ¸é ½ÇÇà
      totalTime.innerHTML = videoTime(video.duration);
    }
  });
  /******************************************************************/

  //Å°º¸µå ÀÌº¥Æ®
  $(document).on("keydown", function (e) {
    if (keyboardControlUse == true) {
      if (pageType != "write") {
        //¿£ÅÍ
        if (e.keyCode == 13) { return false; }
        //½ºÆäÀÌ½º
        else if (e.keyCode == 32) {
          if (video.paused == true) {
            video.play();
          }
          else {
            video.pause();
          }
        }
        //¿ÞÂÊ ¹æÇâÅ°
        else if (e.keyCode == 37) {
          return false;
        }
        //¿À¸¥ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 39) {
          return false;
        }
        //À§ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 38) {
          if (video.volume < 0.95) {
            video.volume = video.volume + 0.05;
            volumeSave = video.volume;
            video.muted = false;
            $("footer > div > #volumeBarArea > #volumeBar").css({ width: video.volume * 100 + "%" });
          }
          else {
            video.volume = 1;
            $("footer > div > #volumeBarArea > #volumeBar").css({ width: "100%" });
          }
        }
        //¾Æ·§ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 40) {
          if (video.volume > 0.05) {
            video.volume = video.volume - 0.05;
            volumeSave = video.volume;
            $("footer > div > #volumeBarArea > #volumeBar").css({ width: video.volume * 100 + "%" });
          }
          else {
            video.volume = 0;
            video.muted = true;
            $("footer > div > #volumeBarArea > #volumeBar").css({ width: "0%" });
          }
        }
        //F12Å°
        else if (e.keyCode == 123) { return securityUse; }
        //±×¿Ü
        //else { return false; }
      }
    }
    else {//IE¿¡¼­ ½ºÆäÀÌ½º¹Ù, ¹æÇâÅ°°¡ ¾Ë¾Æ¼­ ¸ÔÇô¼­ ºñµð¿À¸¦ Á¦¾î ÇÏ´Â°É ¸·À½
      if (pageType != "write") {
        //¿£ÅÍ
        if (e.keyCode == 13) { return false; }
        //½ºÆäÀÌ½º
        else if (e.keyCode == 32) { return false; }
        //¿ÞÂÊ ¹æÇâÅ°
        else if (e.keyCode == 37) { return false; }
        //¿À¸¥ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 39) { return false; }
        //À§ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 38) { return false; }
        //¾Æ·§ÂÊ ¹æÇâÅ°
        else if (e.keyCode == 40) { return false; }
        //F12Å°
        else if (e.keyCode == 123) { return securityUse; }
        //F5Å°
        else if (e.keyCode == 116) { return securityUse; }
        //±×¿Ü
        else { return false; }
      }
    }
  });
});