<?php
if (!defined('_GNUBOARD_')) exit; // ���� ������ ���� �Ұ�

/*if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}*/

include_once(G5_THEME_PATH.'/head.php');

$lssn_no = trim($lssn);
//���� ���� �н� ���� ��������
$userLessData = get_lessonApply($member['mb_id'], $lssn_no);
//�н� ������ ���ٸ�, ���� ����
if( !$userLessData ) {
	$sql = "insert into {$g5['less_apply_table']} set
			app_lssn_no = '{$lssn_no}',
			app_uid = '{$member['mb_id']}',
			app_rdate = now()";
	sql_query($sql);
}

if (!$sst) {
    $sst = "ls.lssn_rdate";
    $sod = "asc";
}

$sql_where = " where ap.app_uid = '{$member['mb_id']}' and ap.app_lssn_no = '$lssn_no' ";
$sql_order = " order by {$sst} {$sod} ";

$sql = "select ls.*, ap.* 
			from  {$g5['less_apply_table']} as ap 
			left join {$g5['lesson_table']} as ls on( ls.lssn_no = ap.app_lssn_no ) {$sql_where} {$sql_order}";
#echo $sql;
$result = sql_fetch($sql);

#�н��� ����
$sql = " select qa_pointTotal from {$g5['quiz_answer_table']} 
			where
				qa_quiz_code='{$result['lssn_quiz']}' and 
				qa_uid='{$member['mb_id']}' and qa_end = 'Y'
				order by qa_no desc limit 1";
//echo $sql;
$res = sql_fetch($sql);
$pointTotal = $res['qa_pointTotal'];

$ck = sql_fetch("SELECT * FROM cd_lms_lesson AS a
inner join cd_member AS b ON a.lssn_company = b.mb_profile
WHERE lssn_no = '".$idx."' and mb_id = '".$member[mb_id]."' ");
?>
	<div id="svisual-wrap">
		<div class="vistxt">
			<p class="btxt"><span>��������</span></p>
			<p class="stxt">���������� �������� ����,û��,�ع�,�α� �� <br />
			���̹� ����,�޽��� ����, ķ���� ������ ����<br />
			�¶������� �н��� �����ϱ� ���� �����Դϴ�. </p>
		</div>
		<div class="visimg vis01"></div>
    </div>
    <div class="content-ov">
		<div id="subNavi-wrap">
			<div id="subNavi">
				<div class="lm-tit">
					<div class="tit">
						<p class="btxt">EDUCATION section</p>
						<p class="stxt">��������</p>
					</div>
				</div>
				<div class="leftmenu" id="leftmenu">
					<ul class="depth2">
						<li id="lm01" class='lm_l2 over'><a href="edu01.php"  class='lm_a2'><span class='isTxt'>���̹� ����</span></a></li>
						<li id="lm02" class='lm_l2'><a href="#"  class='lm_a2'><span class='isTxt'>�޽��� ����</span></a></li>
						<li id="lm03" class='lm_l2'><a href="#"  class='lm_a2'><span class='isTxt'>ķ���� ����</span></a></li>
						<!--<li id="lm04" class='lm_l2'><a href="edu04.php"  class='lm_a2'><span class='isTxt'>������ �긮����</span></a></li>-->
					</ul>
				</div>
			</div>
			<?php include_once(G5_THEME_PATH.'/help.php');?>
		</div>
		<div id="contents">
			<div class="cont-top">
				<h2 class="tit">���̹� ����</h2>
				<ul class="path">
					<li>HOME
					<li>��������</li>
					<li>���̹� ����</li>
				</ul>
			</div>
			<!-- page-start // -->
			<h3 class="txt_title">���� �н� ������</h3>
		<div class="progress-wrap">
			<div class="progress-info">
				<p class="fl"><span>������</span> <?php echo get_int2num($userLessData['app_study_rate'])?> %</p>
				<p class="fr">
					<span>�н���</span> 
					<?php 
						if($result['lssn_quiz']) {
							echo get_int2num($pointTotal) . " ��";
						} else {
							echo "����";
						}
					?>
				</p>
			</div>
		</div>
		
		<div class="gap"></div>
		<h3 class="txt_title">���Ǹ���</h3>
		<table class="tbl-type01">
			<colgroup>
				<col width="7%"/>
				<col width="*"/>
				<col width="14%"/>
				<col width="14%"/>
				<col width="14%"/>
				<col width="14%"/>
			</colgroup>
			<thead>
				<tr>
					<th>����</th>
					<th>��������</th>
					<th>�н�����</th>
					<th>�н�����</th>
					<th>������</th>
					<th>�н�</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql = "select * from {$g5['chapter_table']} where cpt_lesson='$lssn_no' order by cpt_seq asc";
			$cpt_data = sql_query($sql);
			
			for ($i=1; $row=sql_fetch_array($cpt_data); $i++) 
			{
				$sql = "select * from {$g5['chapter_att_table']} where 
							att_uid = '{$member['mb_id']}' and 
							att_lssn_no = '$lssn_no' and 
							att_chapter_no = '{$row['cpt_no']}' and 
							att_contents = '{$row['cpt_contents']}'";
				$att_info = sql_fetch($sql);
				
				if( $att_info ) {
					$att_rate = $att_info['att_study_rate'];
					$att_rate_text = $att_rate."%";
				} else {
					$att_info = "";
					$att_rate ="";
					$att_rate_text = "������";
				}
				
				$cpt_study_rate[$i] = $att_info['att_study_rate'];
			?>
				<tr>
					<td><?php echo $i?></td>
					<td><?php echo get_chapterName($row['cpt_contents'])?></td>
					<td><?=substr($result['lssn_sdate'],0,10)?></td>
					<td><?=substr($result['lssn_edate'],0,10)?></td>
					<td><?php echo $att_rate_text?></td>
					<td>
					<?php
					if( $cpt_study_rate[$i] >= 100  ) {
					?>
						<a href="#" onclick="$('.new__pop').show();" class="cg-btn"><span class="enterClass" lno="<?php echo $lssn_no?>" cno="<?php echo $row['cpt_no']?>">�н��Ϸ�</span></a>
					
					<?php
					} elseif( $cpt_study_rate[$i-1] >= 100 || $i == 1 ) {
					?>
						<a href="#" class="cg-btn active"><span class="enterClass" lno="<?php echo $lssn_no?>" cno="<?php echo $row['cpt_no']?>">�н��ϱ�</span></a>
					<?php
					} ?>
					</td>
				</tr>
			<?php
			}
			?>

			</tbody>
		</table>
		<div class="sssgap"></div>
		<div class="btn-wrap r">
			<!--<p class="info-ex01">*��,  �н������� 12��31�ϱ����Դϴ�.</p>-->
			<?php
			if(  $result['app_study_rate'] >= $result['lssn_completerate'] ) {
			?>
			<div class="btn_area">
				<?php
				if( $result['app_evaluation'] == "Y") {
				?>
				<a href="#" class="class-end"><span>���ÿϷ�</span></a>
				<?php
				} else {
					if($result['lssn_quiz']) {
				?>
					<a href="#" onclick="window.open('/Edu/pop01.php', '_blank', 'top=0,left=0,width=1050,height=750')" class="class-regist "><span>�����ϱ�</span></a>
				<?php
					}
				}
				?>
			</div>
			<?php
			} ?>
		</div>
        
        <!-- page-end //--> 
      </div>
    </div>
	<script src="<?php echo CD_THEME_JS_URL?>/jquery.bpopup.min.js"></script>
	<script src="<?php echo CD_THEME_JS_URL?>/lms.js"></script>
	<style>
		.popup_container{position:absolute;left: 0;top: 0;width: 100%;height: 100%;z-index: 500;background:#fff;}
		.new__pop-close{position:absolute;right: 1em;top: 1em;z-index: 600;background:url('/_Img/Sub/close-x.png') no-repeat center;width: 45px;height: 45px;border: none;}
	</style>
	<!--s: layer-movie(�н� ����) -->
	<div id="popup_win" class="layer-wrap movie" style="width: 100%;height: 100%; left:50%; top:50%;">
		<div class="is-top" style="padding: 0;">
			<h2>�н���</h2>
			<a href="#n" class="close b-close" id="closeBtn"><span class="blind">�ݱ��</span></a>
		</div>
		<div class="is-con">
			<div class="movie">
				<div class="popup_container movie" id="popup_container">
			
				</div>
			</div>
		</div>
	</div>
	<!--e: layer-movie(�н� ����) -->
<?php
include_once(G5_THEME_PATH.'/tail.php');	