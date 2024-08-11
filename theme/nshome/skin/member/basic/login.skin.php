<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<style>
.login-box--wrap{
	width:100%;
	display:flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	margin:100px auto 100px;
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
    font-weight: 700;
    color:#000;
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
	color:#000;
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
	font-weight: 700;
}
.login-box--id{
	background:url(/_Img/Icon/user.png)no-repeat 20px center;
}
.login-box--pass{
	background:url(/_Img/Icon/lock.png)no-repeat 20px center;
}
.login-logo{
	margin-bottom:50px;
}
</style>

<!-- 로그인 시작 { -->
<!-- <div id="mb_login" class="mbskin">
    <h1><?php echo $g5['title'] ?></h1>

    <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
    <input type="hidden" name="url" value="<?php echo $login_url ?>">

    <fieldset id="login_fs">
        <legend>회원로그인</legend>
        <label for="login_id" class="sound_only">회원아이디<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" placeholder="아이디">
        <label for="login_pw" class="sound_only">비밀번호<strong class="sound_only"> 필수</strong></label>
        <input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="로그인" class="btn_submit">
        <input type="checkbox" name="auto_login" id="login_auto_login">
        <label for="login_auto_login">자동로그인</label>
    </fieldset>

    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_login.skin.php');
    ?>

    <aside id="login_info">
        <h2>회원로그인 안내</h2>
        <div>
            <a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" id="login_password_lost">아이디 비밀번호 찾기</a>
            <a href="./register.php">회원 가입</a>
        </div>
    </aside>

    </form>


</div> -->

<div class="content-top">
	<div class="content-top--wrap">
		<div class="content-top--tit">로그인</div>
		<div class="content-top--right">
			<span><img src="/_Img/Icon/home.png" alt="" /></span>
			<span>로그인</span>
		</div>
	</div>
</div>
<form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
<input type="hidden" name="url" value="">
<div class="login-box--wrap">
	<img src="/_Img/login_logo.png" class="login-logo" /> 
	<div class="login-box">
		<label class="login-box--label">아이디</label>
		<input type="text" name="mb_id" id="login_id" required class="frm_input required login-box--id" autocomplete="off" onFocus="clearText(this)" onblur="defaultText(this)" placeholder="아이디를 입력해 주세요"/>
		<label class="login-box--label">비밀번호</label>
		<input type="password" name="mb_password" id="login_pw" required class="frm_input required login-box--pass" class="passValue" autocomplete="off" onFocus="clearText(this)" onblur="defaultText(this)" placeholder="비밀번호를 입력해 주세요"/>
		<button type="submit" class="login-btn">로그인</button>
	</div>
</div>
</form>
<?php
include_once(G5_PATH.'/tail.php');
?>
<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 끝 -->
