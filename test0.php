<!DOCTYPE html>
<html>
<head>
	<title>출퇴근 테스트</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div id="mainArea">
		<h1>This is a heading</h1>
		<p>This is a paragraph.</p>
	</div>
	<iframe id='my_frame' src="https://www.cmsedu.co.kr/attendance/index.php?attend=out" sandbox="allow-same-origin"></iframe>
	<script>
		$(function() {
			//$('#my_iframe').contentWindow.attend();
			$(("#my_iframe")[0].contentWindow).attend();
		});
	</script>
</body>
</html>
