<?php
// require_once('./vendor/autoload.php');
$accessToken = 'aWauEUHKwacwEryzppEW/hoquAKyuCXKQvSbsLggJ7jjG2N/KQTEpvXzoNsm5mESnUOyZfhXn+5WqSIQ5ZggTlvASS0Cy6xvWS1JDXkeDeON3x6pEzaBmKHmljyXyAqOhV8cCJonYvFtHwmXB9AiLAdB04t89/1O/w1cDnyilFU=';

// 各コンテンツの内容をJSONに格納
$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

// メッセージ    
$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

// // ユーザ情報
$send_userId = $jsonObj->{"events"}[0]->{"source"}[0]->{"userId"};

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
                    'data' => '2'
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
                    'data' => '4'
                ]
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
                    'data' => '6'
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
                    'data' => '8'
                ]
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
                    'label' => '今日',
                    'text' => '今日',
                    'data' => '12'
                ],
                [
                    'type' => 'postback',
                    'label' => '明日',
                    'text' => '明日',
                    'data' => '9'
                ],
                [
                    'type' => 'postback',
                    'label' => '明後日',
                    'text' => '明後日',
                    'data' => '10'
                ],
                [
                    'type' => 'postback',
                    'label' => '明々後日',
                    'text' => '明々後日',
                    'data' => '11'
                ]
            ]
        ]
    ];
} else {
    // それ以外は送られてきたテキストをオウム返し
    $messageData = [
         'type' => 'text',
         'text' => $message->{"text"}.ですね
     ];
     //勤務の文字置換
    $str = $message->{"text"};
    $search = array('通常出勤','直行','遅出','遅刻','退社','直帰','早退','宿着','明日','明後日','明々後日','今日');
    $replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
    $work_datanum = str_replace($search,$replace,$str);
    //時刻の取得
    $now = date('Y-m-d H:i:s');

    // データベースに接続するために必要なデータソースを変数に格納
    $dsn = 'mysql:host=us-cdbr-iron-east-03.cleardb.net;dbname=heroku_e84ff0594615ec5;charset=utf8;reconnect=true';
      // データベースのユーザー名
    $user = 'b230e075a82da6';
      // データベースのパスワード
    $password = '36098907';

    // tryにPDOの処理を記述
    try {
      // PDOインスタンスを生成
      $dbh = new PDO($dsn, $user, $password);
    // エラー（例外）が発生した時の処理を記述
    } catch (PDOException $e) {
      // エラーメッセージを表示させる
      echo 'データベースにアクセスできません！' . $e->getMessage();
      exit;
    }
    // INSERT文を変数に格納
    $sql = "INSERT INTO n_work_time (`idn_work_time`, `work_date`, `me_staff_detail_id`, `me_staff_detail_name`, `wo_work_status_id`, `wo_work_status_name`, `updated`) VALUES (:idn_work_time, :work_date, :me_staff_detail_id, :me_staff_detail_name, :wo_work_status_id, :wo_work_status_name, :updated)";
    // 挿入する値は空のまま、SQL実行の準備をする
    $stmt = $dbh->prepare($sql);
    // 挿入する値を配列に格納する
    $params = array(':idn_work_time' => '', ':work_date' => $now, ':me_staff_detail_id' => $work_datanum, ':me_staff_detail_name' => $send_userId, ':wo_work_status_id' => $work_datanum, ':wo_work_status_name' => $message->{"text"}, ':updated' => $now);
     
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
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