<?php
include_once('./_common.php');
## 캠페인 교육 ##
//로그인 체크
if(!$is_member) {
	alert(CD_LOGIN_MSG);
}
if( !$l_no ) {
	alert("과정을 선택해주세요.");
	exit;
}

$LESSON = get_lesson($l_no);
//$CHAPTER = get_chapter($c_no);

## 신청기간 확인
if( !($LESSON['lssn_sdate'] <= G5_TIME_YMDHIS && strtotime(G5_TIME_YMDHIS) < strtotime($LESSON['lssn_edate']."+1 day"))) {
	alert("학습기간이 아닙니다.");
	exit;
}

##학습기록 오픈 확인
#if( !get_lessonApply($member['mb_id'], $l_no) ) {
#	alert("학습가능한 교육이 없습니다.");
#}

$CONTENTS = "01";

############################## 기존 진행상태 확인 ###############################
$my_info = array();
$my_info["uid"] = $member['mb_id'];
$my_info["lesson"] = $l_no;
$my_info["chapter"] = $c_no;
$my_info["contents"] = $CHAPTER['cpt_contents'];

$attend_info = chapter_attend_exist($my_info);

if( $attend_info ) { 
	if( $attend_info['att_study_page'] == 0 ) $open_page = 1;
	elseif( $attend_info['att_study_page'] >= $CONTENTS['c_page'] ) $open_page = 1;
	else $open_page = $attend_info['att_study_page'];
}
else $open_page = 1;

$page_url = G5_URL . "/process/{$LESSON['lssn_div']}/{$CONTENTS}/" . sprintf("%02d",$open_page) . ".html";
echo $page_url;

## 컨트롤바 상태
if( $LESSON['lssn_controlbar'] == "Y" ) {
	$controlbar_enable = "yes";
} else {
	$controlbar_enable = "No";
}

if($page == '1') $LESSON['lssn_no'] = '20';
if($page == '2') $LESSON['lssn_no'] = '21';
if($page == '3') $LESSON['lssn_no'] = '22';
if($page == '4') $LESSON['lssn_no'] = '23';
if($page == '5') $LESSON['lssn_no'] = '24';
if($page == '6') $LESSON['lssn_no'] = '25';
if($page == '7') $LESSON['lssn_no'] = '26';
if($page == '8') $LESSON['lssn_no'] = '27';
if($page == '9') $LESSON['lssn_no'] = '28';
if($page == '10') $LESSON['lssn_no'] = '29';
if($page == '11') $LESSON['lssn_no'] = '30';
if($page == '12') $LESSON['lssn_no'] = '31';
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $config['cf_title']; ?></title>
<link type="text/css" rel="stylesheet" media="all" href="http://cd.sejong21.co.kr/theme/lofa/_Css/common.css" />
<link type="text/css" rel="stylesheet" media="all" href="http://cd.sejong21.co.kr/theme/lofa/_Css/styleDefault.css" />
<link type="text/css" rel="stylesheet" media="all" href="http://cd.sejong21.co.kr/theme/lofa/_Css/content.css" />
<script  type="text/javascript" src="/_Js/jquery/jquery-1.11.3.min.js"></script>
<script  type="text/javascript" src="/_Js/jquery/jquery.easing.1.3.js"></script>
<script>
	/*
	var urls = 'pop02.php'
    var width = 1080;
    var height = 625;
    var tops = (window.screen.height - height) / 2;
    var lefts = (window.screen.width - width) / 2;

    var strFeature;
    strFeature = 'height=' + height + ',width=' + width + ',menubar=no,toolbar=no,location=no,resizable=no,status=no,scrollbars=no,top=' + tops + ', left=' + lefts
	*/
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
<script src="/_Js/contents.js?v2008" type="text/javascript"></script>
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

			// $.ajax({
			// type: "POST",
			// url: "/cd.update.php?mode=w&idx=<?php echo $LESSON['lssn_no'] ?>",
			// success: function(res){
			// 	console.log(res)
			// },
			// error: function(err){ alert("호출 실패하였습니다.") ;}
		// });

</script>
</head>
<body id="pop">
	<div style="width:100%;height:100%;position:absolute;left:0;top:0;">
		<iframe src="" name="frm" id="frm" style="width:100%;height:100%;border:0px;" onLoad="isPage(this)"></iframe>
		<script type="text/javascript">
$(function(){
	setTimeout(() => {
		// console.log(document.getElementById('frm').contentWindow.document.querySelectorAll('.btn-play')[0].click())
	}, 1500);
});

			var control_enable = '';
			setClass( <?php echo $LESSON['lssn_no']?>, "01", "01" );
			setClassUrl("<?=$page_url?>");

					function isPage(v) {
let a = 0				
setTimeout(()=>{
	
	if(document.getElementById('frm').contentWindow.document.querySelectorAll('video')[0]?.src) {
a = document.getElementById('frm').contentWindow.document.querySelectorAll('video')[0].src
 a= Number(a.split('/')[a.split('/').length - 1].substr(0,2))
 console.log(a.split('/')[4])
		}
if(a == <?php echo $LESSON['lssn_total'] ?>) {



		$.ajax({
			type: "POST",
			url: "/cd.update.php?mode=w&idx=<?php echo $LESSON['lssn_no'] ?>",
			success: function(res){
				console.log(res)
			},
			error: function(err){ alert("호출 실패하였습니다.") ;}
		});


}
console.log('>>>>', a)
},3000)


		}


		</script>
		<?php
		if( $open_page >= 2 ) {
		?>
		<script type="text/javascript">	 
		//index_move(<?=$open_page?>);
		</script>
		<?php
		}?>
	</div>
</body>
</html>