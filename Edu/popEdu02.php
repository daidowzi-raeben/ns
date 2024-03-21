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
$page_url = G5_URL . "/process/ethics/{$vdir}/01/01.htm";
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
	var urls = 'pop02.php'
    var width = 900;
    var height = 704;
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
<script src="/js/campaign.js" type="text/javascript"></script>
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
			setClass( <?php echo $vdir?> );
			setClassUrl("<?=$page_url?>");
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