<?php
include_once('./_common.php');

//echo "TEST";
if(!$is_member) {
	alert(NS_LOGIN_MSG);
}

if( !$vdir ) {
	alert("해당컨텐츠가 존재하지 않습니다.");
	exit;
}

//Open할 페이지 설정
$page_url = G5_URL . "/process/compliance/{$vdir}/01/01.htm";
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $config['cf_title']; ?></title>
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/common.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/styleDefault.css" />
<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/content.css" />
<script  type="text/javascript" src="../_Js/jquery/jquery-1.11.3.min.js"></script>
<script  type="text/javascript" src="../_Js/jquery/jquery.easing.1.3.js"></script>
<script>
	
</script>
<script src="/js/campaign.js" type="text/javascript"></script>
<script type="text/javascript">
	document.domain = "nstest.sejong21.co.kr";
	
	controlbar_enable = "<?=$controlbar_enable?>";
	
	//진도 체크
	function eduCheck(val) {
		
		//alert(val);
		window.opener.location.href = '/Edu/edu01.php';
		
		$.ajax({
			type: "POST",
			url: "/bbs/ajax.conf_point.php",
			data : {
				"conf": "p_comp",
				"num" : val
			},
			success: function(data){
				//alert(data);
				//window.opener.reload();
				//opener.parent.location.href = '/Edu/edu01.php';
				//parent.location.href = '/Edu/edu01.php';
				//opener.location.href = '/Edu/edu01.php';
				//window.close();
			},
			error: function(err){ alert("호출 실패하였습니다.") ;}
		});
	}
</script>
</head>
<body id="pop">
	<div style="width:100%;height:100%;position:absolute;left:0;top:0;">
		<iframe src="" name="frm" id="frm" style="width:100%;height:100%;border:0px;"></iframe>
		<script type="text/javascript">
			var control_enable = '';
			setClass( <?php echo $vdir?> );
			setClassUrl("<?=$page_url?>");
		</script>
	</div>
</body>
</html>