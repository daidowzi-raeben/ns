<?php
$sub_menu = "300410";
include_once('./_common.php');

if($no)
	$qstn = get_question($no);
else
	alert_close('존재하지 않는 정보입니다.');


?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="/_Css/common.css?ver=<?php echo G5_CSS_VER ?>">
    <link rel="stylesheet" href="/_Css/styleDefault.css?ver=<?php echo G5_CSS_VER ?>">
    <link rel="stylesheet" href="/_Css/content.css?ver=<?php echo G5_CSS_VER ?>">
</head>
<body id="pop">
<div>
    <div class="layer-wrap guide">
        <div class="is-top">
            <h2>학습평가</h2>
        </div>
        <div class="is-con is-con__quiz">
            <div class="quiz__header">
                <h4>
                    문제. <?php echo $qstn['qq_title']?>
                </h4>
            </div>
            <div class="quiz__body">
                <ul class="">
				<?php
					if( $qstn['qq_type'] == "A" )
						$ex = explode($_TAB, $qstn['qq_ex']);
				?>
                    <li>
                        <label for="answer1">
                            보기1 <input type="radio" id="answer1" name="quiz"> <?php echo $ex[0]?>
                        </label>
                    </li>
                    <li>
                        <label for="answer2">
                            보기2 <input type="radio" id="answer2" name="quiz"> <?php echo $ex[1]?>
                        </label>
                    </li>
                    <li>
                        <label for="answer3">
                            보기3 <input type="radio" id="answer3" name="quiz"> <?php echo $ex[2]?>
                        </label>
                    </li>
                    <li>
                        <label for="answer4">
                            보기4 <input type="radio" id="answer4" name="quiz"> <?php echo $ex[3]?>
                        </label>
                    </li>
                </ul>
                <div class="btn-wrap c">
                    <a href="#//" onclick="window.close();" class="class-regist"><span>닫기</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>