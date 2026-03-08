<?php
include_once('./common.php');

$mb_id = $_GET['mb_id'];
$h = $_GET['h'];

if (!$mb_id || !$h) {
    alert('잘못된 접근입니다.');
}

// Verify Hash
if (md5($mb_id . 'edu_secret') !== $h) {
    alert('보안 검증에 실패하였습니다.');
}

// Check if already unsubscribed
$sql = " SELECT * FROM sj_edu_mail_unsubscribe WHERE mb_id = '{$mb_id}' ";
$exists = sql_fetch($sql);

if ($exists) {
    alert('이미 수신거부 처리가 되어 있습니다.');
}

// Add to Unsubscribe table
$sql = " INSERT INTO sj_edu_mail_unsubscribe SET mb_id = '{$mb_id}', unsub_date = '" . G5_TIME_YMDHIS . "' ";
sql_query($sql);

$g5['title'] = '수신거부 완료';
include_once('./head.sub.php');
?>

<div style="margin:100px auto; width:400px; text-align:center; padding:50px; border:1px solid #ddd; background:#fff;">
    <h2 style="color: #d32f2f;">이메일 수신거부 완료</h2>
    <p style="margin-top:20px; line-height:1.6;">
        정상적으로 이메일 수신거부 처리가 되었습니다.<br>
        앞으로 교육 안내 메일 발송 대상에서 제외됩니다.
    </p>
    <div style="margin-top:30px;">
        <a href="<?php echo G5_URL?>"
            style="display:inline-block; padding:10px 20px; background:#333; color:#fff; text-decoration:none;">홈으로
            이동</a>
    </div>
</div>

<?php
include_once('./tail.sub.php');
?>