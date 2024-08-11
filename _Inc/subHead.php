<?php
include_once('_common.php');

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link href='http://api.mobilis.co.kr/webfonts/css/?fontface=NanumGothicWeb' rel='stylesheet' type='text/css' />
	<!--ie 최상위버전 -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0 ,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no,target-densitydpi=medium-dpi"> -->
	<title><?php echo $g5_head_title; ?></title>
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
</script>	
	<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/common.css?v20190409" />
	<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/styleDefault.css?v20190409" />
	<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/layout.css?v20190409" />
	<link type="text/css" rel="stylesheet" media="all" href=" ../_Css/content.css?v20190614" />
	
	<link rel="stylesheet" href="../_Js/jquery/animate.css">
	<link rel="stylesheet" href="../_Js/jquery/slick-theme.css">
	<link rel="stylesheet" href="../_Js/jquery/slick.css">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script  type="text/javascript" src="../_Js/jquery/jquery-1.11.3.min.js"></script>
	<script  type="text/javascript" src="../_Js/jquery/jquery.easing.1.3.js"></script>
	<script  type="text/javascript" src="../_Js/jquery/owl.carousel.js"></script>
	<script  type="text/javascript" src="../_Js/jquery/jquery.mousewheel.js"></script>
	<script  type="text/javascript" src="../_Js/jquery/slick.js"></script>
	<script  type="text/javascript" src="../_Js/topmenu.js"></script>
	<script  type="text/javascript" src="../_Js/defalut.js"></script>
	<script  type="text/javascript" src="../_Js/common.js"></script>

	<script  type="text/javascript" src="../_Js/sub.js"></script>
	
	<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=8">
<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->
</head>
<body id="sub">
<div id="skipNavi">
	<h1 class="blind">NS홈쇼핑 스킵네비게이션</h1>
	<ul>
		<li><a href="#contents" class="skipLink">본문바로가기</a></li>
		<li><a href="#topmenu" class="skipLink">주메뉴바로가기</a></li>
	</ul>
</div>
<!-- s: #doc //-->
<div id="doc" class="isPage">	
	<!-- s : header-wrap -->
	<?php include_once ('../_Inc/headerInc.php');?>
	<!-- e : header-wrap -->
	<!-- s: #container-wrap //-->
	<div id="container-wrap"  class="scontainer" >
		
		
			