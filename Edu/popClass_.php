<?php
include "../config/config.inc.php";

include $CFG[module_dir]."/lms/lms_config/lms.cfg.php";
include $CFG[module_dir]."/lms/lms_class/lesson.class.php";
include $CFG[module_dir]."/lms/lms_class/chapter.class.php";

include $CFG[module_dir]."/contents/contents.inc.php";
include $CFG[module_dir]."/contents/contents.class.php";

include $CFG[module_dir]."/quiz/quiz.inc.php";
include $CFG[module_dir]."/quiz/quiz.class.php";

if( !$l_no ) {
	alert("과정을 선택해주세요.");
	exit;
}

$LESSON = new LESSON($l_no);
$LESSON->read();

$CHAPTER = new CHAPTER($c_no);
$CHAPTER->read();
if( !$CHAPTER ){
		$rtn[res] = false;
		$rtn[msg] = "차시정보가 존재하지 않습니다.";
		echo json_encode($rtn);
		exit;
}
## 신청기간 확인
if( !($LESSON->lssn_sdate <= $CFG["cdate"] && $LESSON->lssn_edate >= $CFG["cdate"]) ) {
	alert("수강 가능한 과정이 아닙니다.");
	exit;
}

## 기신청내역 확인
if( !$LESSON->apply_user_exist( $_user["id"] ) ) {
	alert("수강 내역이 없습니다.");
	exit;
}

$CONTENTS = new CONTENTS( $CHAPTER->cpt_contents );
$CONTENTS->read();

if( !$CONTENTS->c_url ) {
	alert("수강컨텐츠가 존재하지 않습니다.");
	exit;
}

############################## 기존 진행상태 확인 ###############################
$my_info = array();
$my_info["uid"] = $_user["id"];
$my_info["lesson"] = $l_no;
$my_info["chapter"] = $c_no;
$my_info["contents"] = $CHAPTER->cpt_contents;

$attend_info = $CHAPTER->attend_exist($my_info);



if( $attend_info ) { 
	if( $attend_info->att_study_page == 0 ) $open_page = 1;
	elseif( $attend_info->att_study_page >= $CONTENTS->c_page ) $open_page = 1;
	else $open_page = $attend_info->att_study_page;
	//else $open_page = $attend_info->att_study_page + 2;
}
else $open_page = 1;
//echo $attend_info->att_study_page." 페이지 진행";
############################## 기존 진행상태 확인 ###############################

//$CONTENTS->c_url = "00";
//$page_url = $CFG["url"]."/chapter/".$CONTENTS->c_url."/".$CONTENTS->c_url."_".sprintf("%02d",$open_page).".html";
//$page_url = $CFG["url"]."/contents/cp01/00/01.htm";
$page_url = $CFG["url"]."/contents/cp01/".$CONTENTS->c_url."/".sprintf("%02d",$open_page).".htm";

## 컨트롤바 상태
if( $LESSON->lssn_controlbar == "Y" ) {
	$controlbar_enable = "yes";
} else {
	$controlbar_enable = "No";
}
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>한국관광공사 사업자안전교육</title>
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/common.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/styleDefault.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/content.css" />
<script  type="text/javascript" src="../_Js/jquery/jquery-1.11.3.min.js"></script>
<script  type="text/javascript" src="../_Js/jquery/jquery.easing.1.3.js"></script>
<script>
	var urls = 'pop02.php'
    var width = 1080;
    var height = 625;
    var tops = (window.screen.height - height) / 2;
    var lefts = (window.screen.width - width) / 2;

    var strFeature;
    strFeature = 'height=' + height + ',width=' + width + ',menubar=no,toolbar=no,location=no,resizable=no,status=no,scrollbars=no,top=' + tops + ', left=' + lefts
	
	$(function() {
		$('.class-regist').click(function(){
			self.close();
		});						
	});
	
	function endProc()
	{
		location.reload();
	}
</script>
<script language="javaScript" src="/module/contents/contents.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function(){
			$(".con03 dt").click(function(){
				$(".con03 dt").show();
				$(".con03 dd").slideUp();
				$(this).hide();
				$(this).next("dd").slideDown();
			});
		});
		
		controlbar_enable = "<?=$controlbar_enable?>";
</script>
</head>
<body id="pop">
<div style="width:100%;height:100%;position:absolute;left:0;top:0;">
 <iframe src="" name="frm" id="frm" style="width:100%;height:100%;border:0px;"></iframe>
 <script type="text/javascript">
 var control_enable = '';
 setClass( <?=$LESSON->lssn_no?>, <?=$CHAPTER->cpt_no?>, <?=$CONTENTS->c_no?> );
 setClassUrl("<?=$page_url?>");
 </script>
 <?if( $open_page >= 2 ) {?>
 <script type="text/javascript">	 
 //index_move(<?=$open_page?>);
 </script>
 <?}?>
</div>
</body>
</html>