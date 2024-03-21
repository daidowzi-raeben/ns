<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

	<!--s: layer-guide(안내문) -->
	<div class="layer-wrap guide">
        <div class="is-top">
            <h2>학습평가</h2>
            <p class="ex">“나가기” 버튼을 누르면 학습 이력이 저장되지 않습니다. </p>
            <a href="#n" class="close"><span>나가기</span></a>
        </div>
        <div class="is-con">
            <h3>안내문</h3>
            <div class="txt">
                전체학습 진도율이 100% 이상일때 시험을 응시 하실 수 있습니다.<br/>
                시험은 객관식 10문항이며 100점 만점에 60점 이상 수료가 됩니다.<br/>
                시험 답안은 학습기간 내 제출이 가능합니다.<br/>
                시험 60점 미달시 1회 한하여 재시험 기회를 부여합니다.
            </div>
            <div class="btn-wrap c">
                <a href="?l_no=<?=$l_no?>&step=question" class="class-regist"><span>응시하기</span></a>
				<!--<a href="quiz.php?no=1" class="class-regist"><span>응시하기</span></a>-->
            </div>
        </div>
    </div>
	<!--e: layer-guide(안내문) -->