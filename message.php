<?php

$accessToken = 'aWauEUHKwacwEryzppEW/hoquAKyuCXKQvSbsLggJ7jjG2N/KQTEpvXzoNsm5mESnUOyZfhXn+5WqSIQ5ZggTlvASS0Cy6xvWS1JDXkeDeON3x6pEzaBmKHmljyXyAqOhV8cCJonYvFtHwmXB9AiLAdB04t89/1O/w1cDnyilFU=';

$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

// 送られてきたメッセージの中身からレスポンスのタイプを選択
if ($message->{"text"} == '出勤') {
    // 確認ダイアログタイプ
    $messageData = [
        'type' => 'template',
        'altText' => '確認ダイアログ',
        'template' => [
            'type' => 'buttons',
            'text' => '出勤パターンは',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '通常出勤',
                    'text' => '通常出勤で登録',
                    'data' => '通常'
                ],
                [
                    'type' => 'postback',
                    'label' => '直行',
                    'text' => '直行で登録',
                    'data' => '直行',
                ],
                [
                    'type' => 'postback',
                    'label' => '通常',
                    'text' => '通常で登録',
                    'data' => '通常'
                ],
                [
                    'type' => 'postback',
                    'label' => '直行',
                    'text' => '直行で登録',
                    'data' => '直行',
                ],
            ]
        ]
    ];
} elseif ($message->{"text"} == '退勤') {
    // 確認ダイアログタイプ
    $messageData = [
        'type' => 'template',
        'altText' => '確認ダイアログ',
        'template' => [
            'type' => 'buttons',
            'text' => '退勤パターンは',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '通常',
                    'text' => '通常で登録',
                    'data' => '通常'
                ],
                [
                    'type' => 'postback',
                    'label' => '直帰',
                    'text' => '直帰で登録',
                    'data' => '直帰',
                ],
            ]
        ]
    ];
} elseif ($message->{"text"} == '公休') {
    // 確認ダイアログタイプ
    $messageData = [
        'type' => 'template',
        'altText' => '確認ダイアログ',
        'template' => [
            'type' => 'buttons',
            'text' => '日付は',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => '明日',
                    'text' => '明日で登録',
                    'data' => '明日'
                ],
                [
                    'type' => 'postback',
                    'label' => '明後日',
                    'text' => '明後日で登録',
                    'data' => '明後日',
                ],
            ]
        ]
    ];
} else {
    // それ以外は送られてきたテキストをオウム返し
    $messageData = [
        'type' => 'text',
        'text' => $message->{"text"}
    ];
}

$response = [
    'replyToken' => $replyToken,
    'messages' => [$messageData]
];
error_log(json_encode($response));

$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
));
$result = curl_exec($ch);
error_log($result);



curl_close($ch);