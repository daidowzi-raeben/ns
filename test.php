<?php

$token = "YOUR_SLACK_TOKEN_HERE";
$channel = "#999_bot_녹취";

$data = [
    "channel" => $channel,
    "text" => "🚀 테스트 메시지"
];

$ch = curl_init("https://slack.com/api/chat.postMessage");

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;