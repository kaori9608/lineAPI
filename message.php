<?php

$accessToken = 'aWauEUHKwacwEryzppEW/hoquAKyuCXKQvSbsLggJ7jjG2N/KQTEpvXzoNsm5mESnUOyZfhXn+5WqSIQ5ZggTlvASS0Cy6xvWS1JDXkeDeON3x6pEzaBmKHmljyXyAqOhV8cCJonYvFtHwmXB9AiLAdB04t89/1O/w1cDnyilFU=';

$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};


// 送られてきたメッセージの中身からレスポンスのタイプを選択
// ボタンの内容を発言にする
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
                    'text' => '通常出勤',
                    'data' => '1'
                ],
                [
                    'type' => 'postback',
                    'label' => '直行',
                    'text' => '直行',
                    'data' => '2',
                ],
                [
                    'type' => 'postback',
                    'label' => '遅出',
                    'text' => '遅出',
                    'data' => '3'
                ],
                [
                    'type' => 'postback',
                    'label' => '遅刻',
                    'text' => '遅刻',
                    'data' => '4',
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
                    'label' => '退社',
                    'text' => '退社',
                    'data' => '5'
                ],
                [
                    'type' => 'postback',
                    'label' => '直帰',
                    'text' => '直帰',
                    'data' => '6',
                ],
                [
                    'type' => 'postback',
                    'label' => '早退',
                    'text' => '早退',
                    'data' => '7'
                ],
                [
                    'type' => 'postback',
                    'label' => '宿着',
                    'text' => '宿着',
                    'data' => '8',
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
                    'text' => '明日',
                    'data' => '明日'
                ],
                [
                    'type' => 'postback',
                    'label' => '明後日',
                    'text' => '明後日',
                    'data' => '明後日',
                ],
                [
                    'type' => 'postback',
                    'label' => '明々後日',
                    'text' => '明々後日',
                    'data' => '明々後日'
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

    $link = mysql_connect("us-cdbr-iron-east-03.cleardb.net", "b230e075a82da6", "36098907", "heroku_e84ff0594615ec5");
    if (!$link) {
    die('接続失敗です。'.mysql_error());
    }
    $db_selected = mysql_select_db('heroku_e84ff0594615ec5', $link);
    if (!$db_selected) {
    die('データベース選択失敗です。'.mysql_error());
    }
    mysql_set_charset('utf8');
    $result = mysql_query("INSERT INTO `test` (`testcol`, `testcol1`) VALUES ($displayName, $messageData)");
    if (!$result) {
    }
    $row = mysql_fetch_assoc($result);
    die('接続失敗です。'.mysql_error());


     //DBに接続
    // try {
    //     $pdo = new PDO('mysql:host=us-cdbr-iron-east-03.cleardb.net;dbname=heroku_e84ff0594615ec5;charset=utf8','b230e075a82da6','36098907');
    //     } catch (PDOException $e) {
    //      exit('データベース接続失敗。'.$e->getMessage());
    // }
    //      // インサートする  
    // $stmt = $pdo -> prepare("INSERT INTO `test` (`testcol`, `testcol1`) VALUES ($displayName, $messageData)");
    // $stmt -> execute();

    // //$massege_arrayの中に$messageDataを格納
    // $message_array = json_decode($message);
    // foreach ($messages as $key => $value) {
    //     $obj->{$key}  = "〜".$value."〜" ;
    //     if ($message_array) {
    //         # code...
    //     }
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


