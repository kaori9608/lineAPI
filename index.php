<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
this is line api content
<?php 
// データベースに接続するために必要なデータソースを変数に格納
  // mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:us-cdbr-iron-east-03.cleardb.net;dbname=heroku_e84ff0594615ec5;charset=utf8';
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
  // 強制終了
  exit;
}

 ?>>
</body>
</html>