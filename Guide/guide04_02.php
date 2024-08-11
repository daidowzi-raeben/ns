<?
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}
	$guideOver5 = ' over';
?>
<div id="svisual-wrap">
	<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
		<p class="btxt"><span>가이드라인</span></p>
		<p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
	</div>
	<div class="visimg vis05"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">Sustainability</p>
					<p class="stxt">가이드라인</p>
				</div>
			</div>		
			<?php include_once (G5_PATH.'/Guide/guide_left.php');?>
		</div>
		<? include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">청탁금지법 가이드라인</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16"></li>
				<li>가이드라인</li>
				<li>청탁금지법 가이드라인</li>
			</ul>
		</div>
		<!-- page-start // -->
		<div class="tab_menu3">
          <ul>
            <li><a href="guide04.php">청탁금지법 안내</a></li>
            <li class="on"><a href="guide04_02.php">청탁금지법 FAQ</a></li>
          </ul>
        </div>
        <div class="gap40"></div>
        <div class="board-search">
			<div class="total"><span>Total : <strong>1523건</strong></span></div>
			<div class="search">
				<select title="검색내용을 선택해주세요">
					<option>전체</option>
					<option>등록자</option>
					<option>제목</option>
				</select>
				<input type="text" title="검색 내용을 입력해주세요">
				<button type='submit'><span>검색</span></button>
			</div>
		</div>
		<div class="board-list-wrap">
			<p class="bd-line"></p>
			<table>
				  <colgroup>
					 <col scope="col" width="70">
					 <col scope="col" width="*">
					 <col scope="col" width="100">
					 <col scope="col" width="100">
					 <col scope="col" width="80">
				  </colgroup>
				  <thead>
					 <tr>
						  <th>No</th>
						  <th>제목</th>
						  <th>작성자</th>
						  <th>등록일</th>
						  <th>조회수</th>
					  </tr>
				  </thead>
				  <tbody>
					
					  <tr>
						  <td>10</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a></td>
						  <td>운영자</td>
						  <td>2017-05-16</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>9</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a></td>
						  <td>운영자</td>
						  <td>2017-04-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>8</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a></td>
						  <td>운영자</td>
						  <td>2017-03-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>7</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>6</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>5</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
                      <tr>
						  <td>4</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a></td>
						  <td>운영자</td>
						  <td>2017-03-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>3</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>2</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
					  <tr>
						  <td>1</td>
						  <td class="l"><a href="#" class="f14">[카테고리] 테스트입니다.</a> </td>
						  <td>운영자</td>
						  <td>2017-02-26</td>
						  <td>14</td>
					  </tr>
				  </tbody>
			</table>
		</div>
		<div class="sgap"></div>
		<div class="paging-wrap">
			<a href="#" class="first ctrl"><span class="blind">첫페이지로</span></a>
			<a href="#" class="prev ctrl"><span class="blind">이전 페이지로</span></a>
			<ul>
				<li><a href="#">1</a></li>
				<li><a href="#" class="active">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
			</ul>
			<a href="#" class="next ctrl"><span class="blind">다음페이지로</span></a>
			<a href="#" class="last ctrl"><span class="blind">끝페이지로</span></a>	
		</div>
		<!-- page-end //-->
	</div>
</div>
<? include_once ('../_Inc/subTail.php');?>