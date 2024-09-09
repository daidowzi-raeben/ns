<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    $g5_head_title = $g5['title']; // 상태바에 표시될 제목
    $g5_head_title .= " | ".$config['cf_title'];
}

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0 ,maximum-scale=1.0, minimum-scale=1.0,user-scalable=no,target-densitydpi=medium-dpi"> 반응형용 -->
    <?php

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
    <title><?php echo $g5_head_title; ?></title>
    <!--[if lte IE 8]>
<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
    <script>
    // 자바스크립트에서 사용하는 전역변수 선언
    var g5_url = "<?php echo G5_URL ?>";
    var g5_bbs_url = "<?php echo G5_BBS_URL ?>";
    var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
    var g5_is_admin = "<?php echo isset($is_admin)?$is_admin:''; ?>";
    var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
    var g5_bo_table = "<?php echo isset($bo_table)?$bo_table:''; ?>";
    var g5_sca = "<?php echo isset($sca)?$sca:''; ?>";
    var g5_editor = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
    var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
    </script>
    <script src="<?php echo G5_JS_URL ?>/jquery.menu.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_JS_URL ?>/common.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_JS_URL ?>/wrest.js?ver=<?php echo G5_JS_VER; ?>"></script>
    <script src="<?php echo G5_JS_URL ?>/placeholders.min.js"></script>
    <link rel="stylesheet" href="<?php echo G5_JS_URL ?>/font-awesome/css/font-awesome.min.css">
    <?php
if(G5_IS_MOBILE) {
    echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
    <link type="text/css" rel="stylesheet" media="all"
        href="<?php echo G5_URL ?>/_Css/common.css?v=<?php echo date("his")?>" />
    <link type="text/css" rel="stylesheet" media="all"
        href="<?php echo G5_URL ?>/_Css/styleDefault.css?v=<?php echo date("his")?>" />
    <link type="text/css" rel="stylesheet" media="all"
        href="<?php echo G5_URL ?>/_Css/layout.css?v=<?php echo date("his")?>" />
    <link type="text/css" rel="stylesheet" media="all"
        href="<?php echo G5_URL ?>/_Css/main.css?v=<?php echo date("his")?>" />
    <link type="text/css" rel="stylesheet" media="all"
        href="<?php echo G5_URL ?>/static/css/common.css?v=<?php echo time(); ?>" />

    <link rel="stylesheet" href="<?php echo G5_URL ?>/_Js/jquery/animate.css">
    <link rel="stylesheet" href="<?php echo G5_URL ?>/_Js/jquery/slick-theme.css">
    <link rel="stylesheet" href="<?php echo G5_URL ?>/_Js/jquery/slick.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/slick.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/jquery/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/topmenu.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/defalut.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/common.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL ?>/_Js/main.js"></script>
</head>

<body id="body">
    <div id="skipNavi">
        <h1 class="blind">NS홈쇼핑 스킵네비게이션</h1>
        <ul>
            <li><a href="#contents" class="skipLink">본문바로가기</a></li>
            <li><a href="#topmenu" class="skipLink">주메뉴바로가기</a></li>
        </ul>
    </div>
    <!-- s: #doc //-->
    <div id="doc" class="isPage">
        <!-- s:	.doc-pg //-->
        <!-- s: header-Warp //-->
        <?php include_once (G5_PATH.'/_Inc/headerInc.php');?>
        <!-- e : header-wrap //-->
        <!-- s: #container-wrap //-->
        <div id="container-wrap" class="div-wrap mcontainer">
            <div id="contents" class="div-cont">