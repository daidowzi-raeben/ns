<?php
include_once('./_common.php');

$emq_id = (int)$_GET['emq_id'];

if (!$emq_id) {
    die('Invalid EMQ ID');
}

// Check authorization
$sub_menu = '600800';
auth_check($auth[$sub_menu], 'w');

// Check job status
$sql = " SELECT * FROM sj_edu_mail_queue WHERE emq_id = '{$emq_id}' ";
$row = sql_fetch($sql);

if (!$row) {
    die('Job not found');
}

if (!in_array($row['emq_status'], array('WAIT', 'FAIL'))) {
    alert('발송 가능한 상태가 아닙니다. (WAIT 또는 FAIL 상태만 가능)', './edu_mail_list.php');
}

// Trigger sending using the sender script via HTTP loopback or direct inclusion
// We use a secret key to bypass general admin check if needed, but here we are in admin dir.
// However, the sender script expects super admin or key.

$url = G5_URL . "/adm/edu_mail_sender.php?key=test1234&emq_id=" . $emq_id;

// We use curl to trigger it and show the output or just redirect
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>즉시 발송 처리</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            line-height: 1.6;
        }

        .console {
            background: #333;
            color: #eee;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>메일 즉시 발송을 시작합니다.</h2>
    <p>잠시만 기다려 주세요...</p>

    <div class="console" id="output">처리 중...</div>

    <script>
        fetch('<?php echo $url; ?>')
            .then(response => response.text())
            .then(data => {
                document.getElementById('output').innerText = data;
                setTimeout(() => {
                    if (confirm('발송이 완료되었습니다. 목록으로 돌아가시겠습니까?')) {
                        location.href = './edu_mail_list.php';
                    }
                }, 500);
            })
            .catch(error => {
                document.getElementById('output').innerText = '오류 발생: ' + error;
            });
    </script>
</body>

</html>