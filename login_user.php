<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head.php');
?>

<style>
.login-box--wrap{
	width:100%;
	display:flex;
	align-items: center;
	justify-content: center;
	margin:220px auto 100px;
}
.login-box{
	box-shadow: 0 10px 57px rgba(0,0,0,.14);
	padding:80px;
	border-radius: 20px;
	width:640px;
}
.login-box--label{
	display:block;
	font-size:18px;
}
.login-box .frm_input{
	width:100%;
	height:60px;
	border:1px solid #dedede;
	padding:0 10px 0 60px;
	border-radius: 4px;
	box-sizing: border-box;
	margin:20px 0;
	font-size:18px;
}
.login-box .login-btn{
	width:100%;
	height:80px;
	border-radius: 40px;
	background-color:#5853a3;
	font-size:25px;
	color:#fff;
	display:flex;
	align-items: center;
	justify-content: center;
	border:none;
	margin-top:30px;
}
.login-box--id{
	background:url(./_Img/Icon/user.png)no-repeat 20px center;
}
.login-box--pass{
	background:url(./_Img/Icon/lock.png)no-repeat 20px center;
}
</style>
</head>

<body>
<div class="content-top">
	<div class="content-top--wrap">
		<div class="content-top--tit">로그인</div>
		<div class="content-top--right">
			<span><img src="./_Img/Icon/home.png" alt="" /></span>
			<span>로그인</span>
		</div>
	</div>
</div>
<form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
<input type="hidden" name="url" value="">
<div class="login-box--wrap">
	<div class="login-box">
		<label class="login-box--label">아이디</label>
		<input type="text" name="mb_id" id="login_id" required class="frm_input required login-box--id" autocomplete="off" onFocus="clearText(this)" onblur="defaultText(this)" placeholder="아이디를 입력해 주세요"/>
		<label class="login-box--label">비밀번호</label>
		<input type="password" name="mb_password" id="login_pw" required class="frm_input required login-box--pass" class="passValue" autocomplete="off" onFocus="clearText(this)" onblur="defaultText(this)" placeholder="비밀번호를 입력해 주세요"/>
		<button type="submit" class="login-btn">로그인</button>
	</div>
</div>
</form>

</body>
<script>
function flogin_submit(f)
{
    return true;
}
</script>
</html>
    
