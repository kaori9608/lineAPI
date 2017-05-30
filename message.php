<?php
require_once('./vendor/autoload.php');
require_once('setting.php');

$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$source = $jsonObj->{"events"}[0]->{"source"};

$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};


$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('$ACCESSTOKEN');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '$CHANNEL_SECRET']);
$response = $bot->getProfile('$MID');
if ($response->isSucceeded()) {
    $profile = $response->getJSONDecodedBody();
    echo $profile['displayName'];
    // echo $profile['pictureUrl'];
    // echo $profile['statusMessage'];
};

// 送られてきたメッセージの中身からレスポンスのタイプを選択、ボタンの内容を発言にする
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
                    'data' => 'work_datanum=1'
                ],
                [
                    'type' => 'postback',
                    'label' => '直行',
                    'text' => '直行',
                    'data' => 'work_datanum=2',
                ],
                [
                    'type' => 'postback',
                    'label' => '遅出',
                    'text' => '遅出',
                    'data' => 'work_datanum=3'
                ],
                [
                    'type' => 'postback',
                    'label' => '遅刻',
                    'text' => '遅刻',
                    'data' => 'work_datanum=4',
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
                    'data' => 'work_datanum=5'
                ],
                [
                    'type' => 'postback',
                    'label' => '直帰',
                    'text' => '直帰',
                    'data' => 'work_datanum=6',
                ],
                [
                    'type' => 'postback',
                    'label' => '早退',
                    'text' => '早退',
                    'data' => 'work_datanum=7'
                ],
                [
                    'type' => 'postback',
                    'label' => '宿着',
                    'text' => '宿着',
                    'data' => 'work_datanum=8',
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
                    'label' => '今日',
                    'text' => '今日',
                    'data' => 'work_datanum=12'
                ],
                [
                    'type' => 'postback',
                    'label' => '明日',
                    'text' => '明日',
                    'data' => 'work_datanum=9'
                ],
                [
                    'type' => 'postback',
                    'label' => '明後日',
                    'text' => '明後日',
                    'data' => 'work_datanum=10',
                ],
                [
                    'type' => 'postback',
                    'label' => '明々後日',
                    'text' => '明々後日',
                    'data' => 'work_datanum=11'
                ],
            ]
        ]
    ];
} else {
    $send_userId = $message->{"userId"}
    // テキストについての対応
    // それ以外は送られてきたテキストをオウム返し
    $messageData = [
         'type' => 'text',
         'text' => $message->{"text"}
     ];

     //勤務形態などが文章に入っていた場合について
     //勤務の文字置換
    // $str = $message->{"text"};
    // $search = array('通常出勤','直行','遅出','遅刻','退社','直帰','早退','宿着','明日','明後日','明々後日','今日');
    // $replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
    // $work_datanum = str_replace($search,$replace,$str);
    //時刻の取得
    $now = date('Y-m-d H:i:s');

    // tryにPDOの処理を記述
    try {
      // PDOインスタンスを生成
      $dbh = new PDO($DSN, $USER, $PASSWORD);
    // エラー処理を記述
    } catch (PDOException $e) {
      echo 'データベースにアクセスできません！' . $e->getMessage();
      exit;
    }
    // INSERT文を変数に格納
    $sql = "INSERT INTO n_work_time (`idn_work_time`, `work_date`, `me_staff_detail_id`, `me_staff_detail_name`, `wo_work_status_id`, `wo_work_status_name`, `updated`) VALUES (:idn_work_time, :work_date, :me_staff_detail_id, :me_staff_detail_name, :wo_work_status_id, :wo_work_status_name, :updated)";
    // 挿入する値は空のまま、SQL実行の準備をする
    $stmt = $dbh->prepare($sql);
    // 挿入する値を配列に格納する
    $params = array(':idn_work_time' => '', ':work_date' => $now, ':me_staff_detail_id' => $profile_array->$send_userId, ':me_staff_detail_name' => $profile_array->{"displayName"}, ':wo_work_status_id' => postback.data{work_datanum}, ':wo_work_status_name' => $message->{"text"}, ':updated' => $now);
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
    'Authorization: Bearer ' . $ACCESSTOKEN
));
$result = curl_exec($ch);
error_log($result);
curl_close($ch);

