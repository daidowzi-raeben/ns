<?php
include_once('./_common.php');

define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>세종교육원</title>
<style>
html{padding:0;margin:0;}
body{background:url(<?php echo G5_URL ?>/img/bg.jpg) no-repeat center / cover;width:100vw;height:100vh;padding:0;margin:0;display:flex;align-items:center;justify-content: center;}
.login{background:url(<?php echo G5_URL ?>/img/login_box.png) no-repeat; position:relative;width:700px;margin-top:200px;}
.login ul{ width:200px; height:40px; padding:82px 0 0 390px; float:left}
.login ul li{padding-bottom:5px; list-style:none;}
input{border:1px solid #333; height:26px; font-size:15px; box-sizing:border-box; width:140px; padding:0 5px;}
.login button{width:90px; height:57px; background:url(<?php echo G5_URL ?>/img/btn_login.jpg) no-repeat; display:block; cursor:pointer; float:right; position:absolute; right:70px; top:98px; border:0px;}
.copyright{padding:300px 0 0 190px; clear:both}
</style>
</head>

<body>

<form name="flogin" action="<?php echo G5_BBS_URL ?>/login_check.php" onsubmit="return flogin_submit(this);" method="post">
<input type="hidden" name="url" value="/adm">
<div class="login">
	<ul>
		<li>
			<input type="text" name="mb_id" id="login_id" autocomplete="off" onFocus="clearText(this)"  onblur="defaultText(this)"/>
		</li>
		<li>
			<input type="password" name="mb_password" id="login_pw" class="passValue" autocomplete="off" onFocus="clearText(this)"  onblur="defaultText(this)"/>
		</li>
	</ul>
	<button class="login-btn"></button>
	<p class="copyright"><img src="<?php echo G5_URL ?>/img/copyright.png" width="330" height="16" /></p>
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
    
