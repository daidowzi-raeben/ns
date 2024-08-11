<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($bo_table == "schedule") {
	$strTitle = "교육일정";
	$eduOver6 = " over";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

include_once($board_skin_path."/moonday.php"); // 석봉운님의 음력날짜 함수

if (preg_match('%', $width)) {
  $col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
} else{
  $col_width = ($width/7)."%"; //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
//echo "col_width=".$col_width."<br>";

$col_height= 80 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
$today = getdate(); 
$b_mon = $today['mon']; 
$b_day = $today['mday']; 
$b_year = $today['year']; 
if ($year < 1) { // 오늘의 달력 일때
  $month = $b_mon;
  $mday = $b_day;
  $year = $b_year;
}

if(!$year) 	$year = date("Y");
$file_index = $board_skin_path."/day"; ### 기념일 폴더 위치 지정

### 양력 기념일 파일 지정 : 해당년도 파일이 없으면 기본파일(solar.txt)을 불러온다
if(file_exists($file_index."/".$year.".txt")) {
	$dayfile = file($file_index."/".$year.".txt");
} else { 
	$dayfile = file($file_index."/solar.txt");
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));
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
			<?php include_once (G5_PATH.'/Edu/edu_left.php');?>
		</div>
		<? include_once (G5_PATH.'/_Inc/helpInc.php');?>
	</div>
	
	<div id="contents">
		<div class="cont-top">
			<h2 class="tit"><?php echo $strTitle?></h2>
			<ul class="path">
				<li><img src="<?php echo G5_URL; ?>/_Img/Sub/icon_home.png" width="13" height="16">
				<li>사이버 & 집체교육</li>
				<li><?php echo $strTitle?></li>
			</ul>
		</div>
		
		<!-- page-start // -->
        <p style="text-align:center; padding-bottom:15px; ">
			<a href="<?php echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&"; ?><?php if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year={$year_pre}&month={$month_pre}&sc_no={$sc_no}");?>" style="width:83px; height:30px"><img src="../_Img/Sub/edu/btn_left.gif" width="21" height="21">&nbsp;이전달</a>
			&nbsp;&nbsp;l&nbsp;
			<span style="color:#e83f2e; font-size:25px; font-weight:bold; display:inline-block; width:150px; height:30px;">
				<?php echo "{$year}년&nbsp;{$month}월"; ?>
			</span>
			&nbsp;l&nbsp;&nbsp;
			<a href="<?php echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&"; ?><?php if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("year={$year_pre}&month={$month_pre}&sc_no={$sc_no}");?>" style="width:83px; height:30px">다음달&nbsp;<img src="../_Img/Sub/edu/btn_right.gif" width="21" height="21"></a>   
        </p>
		
		<table class="tbl-type04">
		<colgroup>
			<col width="20%"/>
			<col width="20%"/>
			<col width="20%"/>
			<col width="20%"/>
			<col width="20%"/>
		</colgroup>
		<thead>
			<tr>
				<th>월요일</th>
				<th>화요일</th>
				<th>수요일</th>
				<th>목요일</th>
				<th>금요일</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$cday = 1;
		$sel_mon = sprintf("%02d",$month);
			
		$query = "SELECT * FROM {$write_table} WHERE left(wr_1,6) = '{$year}{$sel_mon}' ORDER BY wr_id ASC";
		$result = sql_query($query);
		$j=0; // layer id
		
		while ($row = sql_fetch_array($result)) {  // 제목글 뽑아서 링크 문자열 만들기..
			if( substr($row['wr_1'],0,6) <  $year.$sel_mon ) {
				$start_day =1; 
				$start_day= (int)$start_day;
			} else {
				$start_day = substr($row['wr_1'],6,2);
				$start_day= (int)$start_day;
			}
			
			$row['wr_subject'] = cut_str(get_text($row['wr_subject']),$board['bo_subject_len'],"…"); // subject length cut
			$wr_time = sprintf("%02d", $row['wr_3']);
			$wr_time .= ":" . sprintf("%02d", $row['wr_4']);
			$wr_time .= "~" . sprintf("%02d", $row['wr_5']);
			$wr_time .= ":" . sprintf("%02d", $row['wr_6']);
			$html_day[$start_day].= "<ul>\n<li class=\"day\">{$start_day}</li>\n<li class=\"plan\"><a href=\"#\" onClick=\"window.open('plan.php?edu_id=".$row['wr_id']."','_blank','left=1,top=1,toolbar=no,location=no,status=yes,menubar=no,scrollbars=no,resizable=no,width=540,height=460')\" onfocus=\"this.blur()\" alt=\"교육일정\" >{$row['wr_subject']}</a></li>\n</ul>";
		}
		
		// 달력의 틀을 보여주는 부분
		$temp = 7 - (($lastday[$month] + $dayoftheweek) % 7);
		if ($temp == 7) $temp = 0;
		$lastcount = $lastday[$month]+$dayoftheweek + $temp;
		
		for ($iz = 1; $iz <= $lastcount; $iz++) { // 42번을 칠하게 된다.
			if (($iz%7) == 2 && $cday < 32) {// 주당 7개씩 한쎌씩을 쌓는다.
				echo ("<tr>\n");
			}
			
			if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{
				// 전체 루프안에서 숫자가 들어가는 셀들만 해당됨
				// 즉 11월 달에서 1일부터 30 일까지만 해당
				$daytext = $cday;   
				// $cday 는 숫자 예> 11월달은 1~ 30일 까지
				//$daytext 은 셀에 써질 날짜 숫자 넣을 공간
				
				// 기념일 파일 내용 비교위한 변수 선언, 월과 일을 두자리 포맷으로 고정
				if (strlen($month) == 1) { 
					$monthp = "0".$month ;
				} else {
					$monthp = $month ; 
				}
				
				if (strlen($cday) == 1) {
					$cdayp = "0".$cday ;
				} else { 
					$cdayp = $cday ; 
				}
				
				$memday = $year.$monthp.$cdayp;
				$daycont = "" ;
				$dayClass = "day";
				
				// 기념일(양력) 표시
				for($i=0 ; $i < sizeof($dayfile) ; $i++) {  // 파일 첫 행부터 끝행까지 루프
					$arrDay = explode("|", $dayfile[$i]);
					if($memday == $year.$arrDay[0]) {
						$daycont = $arrDay[1]; 
						$daycontcolor = $arrDay[2];
						if(substr($arrDay[2],0,3)=="red") { // 공휴일은 날짜를 빨간색으로 표시
							$daytext = "<ul>\n<li class=\"day_red\">{$daytext}</li>\n<li class=\"plan\">{$daycont}</li>\n</url>\n";
						}
						if(substr($arrDay[2],0,3)=="#ff0000") $daycolor = "#ff0000"; // 공휴일은 날짜를 빨간색으로 표시
					}
				}
				
				if($html_day[$cday] != "") $daytext = $html_day[$cday];
				
				// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고 
				// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
				if($iz%7 != 1 && $iz%7 != 0) {	//토, 일 제외
					echo("<td class=\"{$dayClass}\">{$daytext}</td>");
				}
				$cday++; // 날짜를 카운팅
			} else { // 유효날짜가 아니면 그냥 회색을 칠한다.
				if($iz%7 != 1 && $iz%7 != 0 && $iz < 35) {	//토, 일 제외
					echo("<td>&nbsp;</td>");
				}
			}
		
			
			if (($iz%7) == 6) {
				echo ("</tr>\n");
			}
		}
		?>
		
		</tbody>
        </table>
        
        <!-- page-end //--> 
	</div>
</div>
<script language="JavaScript">
<!--
// 미리보기 팝업 보이기
function PopupShow(n) {
	var position = $("#subject_"+n).position(); 
	$("#popup_"+n).animate({left:position.left-10+"px", top:position.top+30+"px"},0);
	$("#popup_"+n).show();
}

// 미리보기 팝업 숨기기
function PopupHide(n) {
	$("#popup_"+n).hide();
}
//-->
</script>
