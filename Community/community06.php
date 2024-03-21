<?php include_once ('../_Inc/subHead.php');?>
<div id="svisual-wrap">
	<div class="vistxt">
		<p class="btxt"><span>커뮤니티
</span></p>
		<p class="stxt">고객, 사회, 협력사와의 동반성장을 추구합니다.</p>
	</div>
	<div class="visimg vis06"></div>
</div>
<div class="content-ov">
	<div id="subNavi-wrap">
		<div id="subNavi">
			<div class="lm-tit">
				<div class="tit">
					<p class="btxt">community</p>
					<p class="stxt">커뮤니티
</p>
				</div>
			</div>		
			<div class="leftmenu" id="leftmenu">
				<ul class="depth2">
					<li id="lm01" class='lm_l2 over'><a href="community01.php"  class='lm_a2'><span class='isTxt'>공지사항</span></a></li>
					<li id="lm02" class='lm_l2'><a href="community02.php"  class='lm_a2'><span class='isTxt'>헬프라인</span></a></li>
					<li id="lm03" class='lm_l2'><a href="community03.php"  class='lm_a2'><span class='isTxt'>자료실</span></a></li>
				</ul>
			</div>
		</div>
		<?php include_once ('../_Inc/helpInc.php');?>
	</div>
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit">공지사항</h2>
			<ul class="path">
				<li><img src="../_Img/Sub/icon_home.png" width="13" height="16">
				<li>커뮤니티
</li>
				<li>공지사항</li>
			</ul>
		</div>
		<!-- page-start // -->
	
		<div class="board-write-wrap">
			<span class="bd-line"></span>
			<table>
				  <caption><span class="blind">상담과목,지역,제목,작성자,연락처,글내용,이메일,파일첨부,비밀번호의 정보를 입력하는 글쓰기 표입니다.</span></caption>
				  <colgroup>
					  <col width="12%">
					  <col width="*">
				  </colgroup>
				  <tbody>
					 
					  <tr>
						  <th><span class="nec">제목</span></th>
						  <td>
							 <input class="w100p" type="text" title="비밀번호를 입력해주세요" onfocus="clearText(this)"  onblur="defaultText(this)"/>&nbsp;&nbsp;
						  </td>
					  </tr>
					  <tr>
						  <th><span>작성자</span></th>
						  <td>
							 <input class="w40p" type="text" title="비밀번호를 입력해주세요"/>
						  </td>
					  </tr>
					 
					   <tr>
						  <td colspan="2">
							 <textarea rows="15"></textarea>
						  </td>
					  </tr>
					  <tr>
						  <th><span>파일첨부</span></th>
						  <td>

							  <span class="filetype">
								  <input type="text" class="file-text" />
								  <span class="file-btn">파일찾기</span>
								  <span class="file-select"><input type="file" class="input-file"></span>
							  </span>
							  <a href="#n" class="cw-btn fileadd"><span>+ 파일추가</span></a>	
							 <!--필드 인풋 스크립트-->
							 <script>
								var $fileBox = $('.filetype');

								$fileBox.each(function() {
								  var $fileUpload = $(this).find('.input-file'),
									$fileText = $(this).find('.file-text')
								  $fileUpload.on('change', function() {
									var fileName = $(this).val();
									$fileText.attr('disabled', 'disabled').val(fileName);
								  })
								})
							 </script>
							 <!--//필드 인풋 스크립트-->
						  </td>
					  </tr>
					  <tr>
						  <th><span>비밀번호</span></th>
						  <td>
							 <input class="w20p" type="password" title="비밀번호를 입력해주세요"/>
						  </td>
					  </tr>
				  </tbody>
			</table>
		</div>
		<div class="ssgap"></div>
		<div class="r">
			<a href="#n" class="bw-btn"><span>글쓰기</span></a>
			<a href="center01.php" class="bp-btn"><span>목록</span></a>
		</div>


	
		<!-- page-end //-->
	</div>
</div>
<?php include_once ('../_Inc/subTail.php');?>