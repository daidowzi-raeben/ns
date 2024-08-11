<?php
include_once ('../_Inc/subHead.php');

	if(!$is_member) {
		alert(NS_LOGIN_MSG);
	}

$eduOver1 = ' over';

$sql_common = " from {$g5['compliance_table']} ";
$sql_search = " where (1) ";

if (!$sst) {
    $sst = "pc_no";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);

$startNum = $total_count;
?>
    <div id="svisual-wrap">
		<div class="vistxt" data-aos="fade-up" data-aos-duration="1000">
			<p class="btxt"><span>e-준법교육 캠페인</span></p>
			<div class="content-top--right">
				<span><img src="../_Img/Icon/home.png" width="25" height="24"></span>
				<span>교육/컨텐츠</span>
				<span>e-준법교육 캠페인</span>
			</div>
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
			<?php include_once (G5_PATH.'/_Inc/helpInc.php');?>
		</div>
		<div id="contents">
		<div class="cont-top">
			<h2 class="tit">e-준법교육 캠페인</h2>
			<ul class="path">
				<li><img src="<?php echo G5_URL; ?>/_Img/Sub/icon_home.png" width="13" height="16">
				<li>사이버 & 집체교육</li>
				<li>e-준법교육 캠페인</li>
			</ul>
		</div>
        <!-- page-start // -->
        <table class="tbl-type01">
        <colgroup>
            <col width="10%"/>
			<col width="*"/>
			<col width="15%"/>
			<col width="20%"/>
		</colgroup>
		<thead>
			<tr>
				<th>회차</th>
				<th>내용</th>
				<th>완료일시</th>
				<th>수강</th>
			</tr>
		</thead>
		<?php
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$chkView = check_point($member['mb_id'], "p_comp", $row['pc_no']);
			
			$p_subject = $row['pc_subject'];
			$p_startdate = $row['pc_startdate'];
			$p_enddate = $row['pc_enddate'];
			$p_ctrbar = $row['pc_ctrbar'];
			$p_url = $row['pc_contents_url'];
			
		?>
			<tr>
				<td><?php echo $startNum; ?>회</td>
				<td class="txt-left"><?php echo $p_subject?></td>
				<td><?php echo substr($chkView['po_datetime'], 0, 10) ?></td>
				<td>
				<?php
				if(!$chkView) {
				?>
					<a href="javascript:view_contents('<?php echo $p_url?>');" class="class-enter btn">학습하기</a>
				<?php
				} else {
				?> 
					<a href="javascript:view_contents('<?php echo $p_url?>');" class="class-end btn">학습완료</a>
				<?php
				}
				?>
				</td>
			</tr>
		<?php
			$startNum--;
		}
		?>
		</table>
		<div class="exmark-txt">[주의][e-준법교육캠페인] 퀴즈 풀이 중 다른 페이지로 이동하시면 학습완료 인정이 안됩니다.</div>
        <!-- page-end //--> 
      </div>
    </div>
<script>
$( document ).ready(function() {
    
});

function view_contents(v_dir) {
	
	var size_w = 900;
	var size_h = 704;
	
	if( v_dir.length > 0 ) {	
		//window.name = 'mainWin';
		//window.open("<?php echo G5_URL ?>/Edu/popEdu01.php?vdir="+v_dir,"content_preview","width="+size_w+"px,height="+size_h+"px");
		//window.open("<?php echo G5_URL ?>/process/compliance/"+v_dir+"/01/01.htm","content_preview","width="+size_w+"px,height="+size_h+"px");
		window.open("<?php echo G5_URL ?>/process/comp_new/"+v_dir+"/01.html","content_preview","width="+size_w+"px,height="+size_h+"px");
	}
}

//진도 체크
function eduCheck(val) {
	
	$.ajax({
		type: "POST",
		url: "/bbs/ajax.conf_point.php",
		data : {
			"conf": "p_comp",
			"num" : val
		},
		success: function(data){
			location.reload();
		},
		error: function(err){ alert("호출 실패하였습니다.") ;}
	});
}

</script>
    <?php include_once ('../_Inc/subTail.php');?>