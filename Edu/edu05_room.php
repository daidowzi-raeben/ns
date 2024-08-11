<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
?>
    <div id="svisual-wrap">
		<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
			<p class="btxt"><span>사이버 & 집체교육</span></p>
			<p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
		</div>
		<div class="visimg vis04"></div>
    </div>
    <div class="content-ov">
		<div id="subNavi-wrap">
			<div id="subNavi">
				<div class="lm-tit">
					<div class="tit">
						<p class="btxt">EDUCATION section</p>
						<p class="stxt">사이버&집체교육 </p>
					</div>
				</div>
				<?php 
				$eduOver5 = ' over';
				include_once 'edu_left.php';
				?>
			</div>
        <?php include_once ('../_Inc/helpInc.php');?>
		</div>
      <div id="contents">
        <div class="cont-top">
          <h2 class="tit">사이버교육 / 학습방
</h2>
          <ul class="path">
            <li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
            <li>사이버 & 집체교육
</li>
            <li>사이버교육
</li>
          </ul>
        </div>
        <!-- page-start // -->
         <h3 class="u-tit01">나의 학습 진도율</h3>
		<div class="progress-wrap">
			<div class="progress-info">
				<p class="fl"><span>진도율</span> 100 %</p>
				<p class="fr"><span>학습평가</span> 0 점 </p>
			</div>
		</div>
		
		<div class="gap"></div>
		<h3 class="u-tit01">강의목차</h3>
		<table class="tbl-type01">
			<colgroup>
				<col width="7%"/>
				<col width="*"/>
				<col width="14%"/>
				<col width="14%"/>
				<col width="14%"/>
				<col width="20%"/>
			</colgroup>
			<thead>
				<tr>
					<th>차시</th>
					<th>과정제목</th>
					<th>학습시작</th>
					<th>학습종료</th>
					<th>진도율</th>
					<th>학습</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
					<td>0</td>
					<td style="text-align:left;">오리엔테이션</td>
					<td>2019-09-30</td>
					<td>2019-12-31</td>
					<td>미진행</td>
					<td><a href="#" class="cg-btn"><span class="enterClass2">학습완료</span></a>
					<a href="#" class="cw-btn"><span class="enterClass2" lno="">학습하기</span></a>
					</td>
				</tr>
                <tr>
					<td>1</td>
					<td style="text-align:left;">알기 쉬운 공정거래법</td>
					<td>2019-09-30</td>
					<td>2019-12-31</td>
					<td>미진행</td>
					<td><a href="#" class="cg-btn"><span class="enterClass2">학습완료</span></a>
					<a href="#" class="cw-btn"><span class="enterClass2" lno="">학습하기</span></a>
					</td>
				</tr>
                <tr>
					<td>2</td>
					<td style="text-align:left;">알기 쉬운 대규모유통업법</td>
					<td>2019-09-30</td>
					<td>2019-12-31</td>
					<td>미진행</td>
					<td><a href="#" class="cg-btn"><span class="enterClass2">학습완료</span></a>
					<a href="#" class="cw-btn"><span class="enterClass2" lno="">학습하기</span></a>
					</td>
				</tr>
</tbody>
		</table>
		<div class="sssgap"></div>
		<div class="btn-wrap r">
			<div class="btn_area">
				<a href="#" class="class-regist2"><span>응시완료</span></a>
				<a href="#" class="class-regist"><span>응시하기</span></a>												
			</div>
		</div>
            
        
        <!-- page-end //--> 
      </div>
    </div>
    <?php include_once ('../_Inc/subTail.php');?>