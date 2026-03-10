<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';
// 1.登録日を生成
// 2.ユーザーIDを生成
// 3.受信データ＋ID＋登録日のデータをmembers.csvに追記する

// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// 書き込みファイルのパスを設定
$filename = './data/members.csv';

// 登録日を生成
$register_date = date('Y-m-d');
// echo $register_date;

// ユーザーIDを生成
$fp = fopen($filename, 'r');
$cnt = 0;
while (fgetcsv($fp) !== false) {
  $cnt++;
}
fclose($fp);
$id = $cnt;

// post送信で受け取ったデータを変数に代入
$user_name = $_POST['user-name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$password = $_POST['password'];
$gendar = $_POST['gendar'];
$interest = $_POST['interest'];

// csv一行分の配列データを作成
$record = [
  $id,
  $user_name,
  $email,
  $birthday,
  $password,
  $gendar,
  $interest,
  $register_date,
  'false'
];

// 会員データの登録
// 追記モードで開く
$fp = fopen($filename, 'a');

// ファイロックをかける
if (flock($fp, LOCK_EX)) {
  // ファイル操作を実行する
  // CSVファイルに一行書き込む
  fputcsv($fp,$record);
  // ロック解除
  flock($fp,LOCK_UN);
}else{
  echo 'ファイルロックが失敗しました。';
}

fclose($fp);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録完了画面</title>
</head>

<body>
  <h1>会員登録完了画面</h1>
  <p>会員登録が完了しました。</p>
  <a href="./form.php">入力画面へ戻る</a>
</body>

</html>