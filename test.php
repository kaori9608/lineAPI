<?php

// 各コンテンツの内容をJSONに格納
$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

// メッセージ    
$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
// ユーザ情報
$send_userId = $jsonObj->{"events"}[0]->{"source"}[0]->{"userId"};
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
//勤務の文字置換
$str = $message->{"text"};
$search = array('出勤','直行','遅出','遅刻','退社','直帰','早退','宿着','明日','明後日','明々後日','今日');
$replace = array('1','2','3','4','5','6','7','8','9','10','11','12');
$work_datanum = str_replace($search,$replace,$str);
//時刻の取得
$now = date('Y-m-d H:i:s');

// INSERT文を変数に格納
$sql = "INSERT INTO n_work_time (`idn_work_time`, `work_date`, `me_staff_detail_id`, `me_staff_detail_name`, `wo_work_status_id`, `wo_work_status_name`, `updated`) VALUES (:idn_work_time, :work_date, :me_staff_detail_id, :me_staff_detail_name, :wo_work_status_id, :wo_work_status_name, :updated)";
// 挿入する値は空のまま、SQL実行の準備をする
$stmt = $dbh->prepare($sql);
// 挿入する値を配列に格納する
$params = array(':idn_work_time' => '', ':work_date' => $now, ':me_staff_detail_id' => $work_datanum, ':me_staff_detail_name' => $send_userId, ':wo_work_status_id' => $work_datanum, ':wo_work_status_name' => $message->{"text"}, ':updated' => $now);
// 挿入する値が入った変数をexecuteにセットしてSQLを実行
$stmt->execute($params);


