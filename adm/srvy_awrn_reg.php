<?php
include_once('./_common.php');

if($type == "B")
{
	$sub_menu = "300520";
	$g5['title'] = "설문지관리 ▶ 윤리CP인식도조사 ▶ 신규등록";
	$strType = "ethc";
	$strSrvyType = "B";
}
else
{
	$sub_menu = "300510";
	$g5['title'] = "설문지관리 ▶ CP교육만족도 조사 ▶ 신규등록";
	$strType = "awrn";
	$strSrvyType = "A";
}

auth_check($auth[$sub_menu], 'r');

//등록일 경우
if($w == "")
{
	//required 태그 관련 변수
	$required_str = 'required';
	//$required_class_str = 'required alnum_';	
}
else if ($w == 'u')	//수정일 경우
{
	//required 태그 관련 변수
	$required_str = 'required';
	//$required_class_str = 'required alnum_';
	
	$srvy = get_survey($code);
	
	if (!$srvy['srvy_code'])
        alert('존재하지 않는 데이터입니다.');
	
}

//기본 마일리지 점수 설정
$srvy_point = $srvy['srvy_point'] ? $srvy['srvy_point'] : 10;
//등록일=현재 날짜
$srvy_rdate = $srvy['srvy_rdate'] ? str_replace('-', '', substr($srvy['srvy_rdate'], 0, 10)) : date("Ymd");
//기본 설문잠금 설정일
$srvy_keep = $srvy['srvy_keep'] ? $srvy['srvy_keep'] : 0;
//기본 설문지 x,y 좌표값
$srvy_coord_x = $srvy['srvy_coord_x'] ? $srvy['srvy_coord_x'] : 0;
$srvy_coord_y = $srvy['srvy_coord_y'] ? $srvy['srvy_coord_y'] : 0;

//sql_query("update sj_survey SET srvy_year = '2023' WHERE srvy_code = 14");

include_once('./admin.head.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');	//jquery 달력
add_javascript('<script type="text/javascript" src="'.G5_JS_URL.'/jquery.bpopup.min.js"></script>', 0); //bPopup 
?>

<div class="tbl_frm02 tbl_wrap">
    
    <form action="./srvy_awrn_reg_update.php" enctype="multipart/form-data" method="post" name="nsform" id="nsform" onsubmit="return form_submit(this);">
		<input type="hidden" name="srvy_code" value="<?php echo $srvy['srvy_code']?>" />
		<input type="hidden" name="srvy_type" value="<?php echo $strSrvyType?>" />
		<input type="hidden" name="w" value="<?=$w?>" />		
        <table>
            <tbody>
			<tr>
                <th scope="row"><label for="srvy_name">설문지명</label></th>
                <td>
                    <input type="text" class="new__input <?php echo $required_class_str?>" name="srvy_name" id="srvy_name" value="<?=$srvy['srvy_name']?>" <?php echo $required_str?> />
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="srvy_stat">상태</label></th>
                <td>
                    <label for="ck5">
                        <input type="radio" name="srvy_stat" id="ck5" value="Y"<?if( $w == "" || $srvy['srvy_status'] == "Y" ){?> checked<?}?>> 사용
                    </label>
                    <label for="ck6">
                        <input type="radio" name="srvy_stat" id="ck6" value="N" <?if( $srvy['srvy_status'] == "N" ){?> checked<?}?>> 사용안함
                    </label>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="srvy_sdate">설문기간</label></th>
                <td>
                    <input type="text" class="new__input <?php echo $required_class_str?>" name="srvy_sdate" id="srvy_sdate" value="<?=$srvy['srvy_sdate']?>" <?php echo $required_str?> /> ~ <input type="text" class="new__input <?php echo $required_class_str?>" name="srvy_edate" id="srvy_edate" value="<?=$srvy['srvy_edate']?>" <?php echo $required_str?> />
                </td>
            </tr>
			<tr>
                <th scope="row"><label for="srvy_rdate">등록일</label></th>
                <td>
                    <input type="text" class="new__input" name="srvy_rdate" id="srvy_rdate" value="<?=$srvy_rdate?>" readonly />
                </td>
            </tr>
			
			<tr>
                <th scope="row"><label for="srvy_point">마일리지</label></th>
                <td>
                    <input type="text" class="new__input" name="srvy_point" value="<?=$srvy_point?>" <?php echo $required_str?> /> 점
                </td>
            </tr>
			<tr>
                <th scope="row"><label for="srvy_link">연결링크</label></th>
                <td>
                    <input type="text" class="new__input" name="srvy_link" id="srvy_link" value="<?=$srvy['srvy_link']?>" <?php echo $required_str?> />
					<a href="javascript:view_dir();" class="btn btn_02">찾아연결</a>
					<a href="javascript:view_priview();" class="btn btn_01">미리보기</a>
                </td>
            </tr>
			<tr>
                <th scope="row"><label for="srvy_coord_x">설문지 위치</label></th>
                <td>
                    X좌표 : 스크린에서 <input type="text" class="new__input" name="srvy_coord_x" id="srvy_coord_x" value="<?=$srvy_coord_x?>" size="3" /> Px / Y좌표 : 스크린에서 <input type="text" class="new__input" name="srvy_coord_y" id="srvy_coord_y" value="<?=$srvy_coord_y?>" size="3" /> Px
                </td>
            </tr>
			<tr>
                <th scope="row"><label for="srvy_keep">설문잠금</label></th>
                <td>
                    <input type="text" class="new__input" name="srvy_keep" id="srvy_keep" value="<?=$srvy_keep?>" size="5" /> 일(0은 계속 띄움)
                </td>
            </tr>

            </tbody>
        </table>
        <div class="sch_div">
            <input type="submit" class="btn btn_03" value="확인">
            <a href="srvy_<?php echo $strType?>_list.php" class="btn btn_02">닫기</a>
        </div>
		<div id="popup_win" class="pop-layer bPopup">  
			<div class="popup_container" id="popup_container">
				test
			</div>
		</div>
    </form>
</div>

<script>
	$( function() {
		$( "#srvy_sdate, #srvy_edate" ).datepicker();
	} );
    
	function view_dir(dir) {
		var datas = "";
		if( dir != undefined ) {
			datas = "dir=" + dir;
			alert(dir);
		}
		$("#popup_win").bPopup();
		//$( "#popup_win" ).show( "blind");
		
		$.ajax({
			type: "POST",
			url: "./ajax.survey_dir.php",
			data :  datas,
			success: function(res){
				$("#popup_container").html("");
				var res_info = $.parseJSON( res );
				if( res_info.result == true ){	
					for(i=0;i<=res_info.directory.length-1;i++){
							var new_directory = '<div rel_code="'+res_info.directory[i]+'" style="padding:10px;cursor:pointer;width:200px;display: inline-block;"><span onclick="view_dir(\''+res_info.directory[i]+'\')">'+res_info.directory[i]+'</span><input type="button" value="선택" class="btn btn_03" onclick="select_dir(\''+res_info.directory[i]+'\')"/></div>';
							$("#popup_container").append(new_directory);
					}
					
					
				} else {
					//alert( $("#pannel_dept2 div").length );
				}
			},
			error: function(err){ alert("호출 실패하였습니다.") ;}
		});
	}

	function select_dir(url) {
		$("#srvy_link").val(url);
		$("#popup_win").bPopup().close();
	}

	function view_priview() {
		var v_link = $("#srvy_link").val();
		//var size_w = $("#size_w").val();
		//var size_h = $("#size_h").val();
		var size_w = 830;
		var size_h = 720;
		
		if( v_link.length > 0 ) {	
				window.open("<?php echo SJ_SURVEY_URL ?>/form/"+ v_link,"content_preview","width="+size_w+"px,height="+size_h+"px");
		} else {
				alert("URL 입력후 미리보기가 가능합니다.")
		}
	}
	
	function form_submit(f)
	{

		return true;
	}
</script>

<?php
include_once ('./admin.tail.php');
?>
