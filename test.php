<?php
$conn = mysqli_connect(
    '127.0.0.1',
    'root',
    '비밀번호',
    'test_g2',
    3307
);

if (!$conn) {
    die(mysqli_connect_error());
}

echo '✅ DB 연결 성공';