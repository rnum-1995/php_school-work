<?php
$id = $_POST['id'];
$user_name = $_POST['user-name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$password = $_POST['password'];
$gendar = $_POST['gendar'];
$interest = $_POST['interest'];

$filename = './data/members.csv';
$fp = fopen($filename, 'r');

// 全データ格納用の空の配列を用意
$all_records = array();
// CSVの全データを変数へ格納
while ($record = fgetcsv($fp)) {
  $all_records[] = $record;
}

// echo '<pre>';
// var_dump($all_records);
// echo '</pre>';

// 変更後のデータを格納する空の配列を用意
$result = array();

foreach ($all_records as $record) {
  if ($record[0] == $id) {
    $record[1] = $user_name;
    $record[2] = $email;
    $record[3] = $birthday;
    $record[4] = $password;
    $record[5] = $gendar;
    $record[6] = $interest;
  }
  $result[] = $record;
}

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

$fp = fopen($filename, 'w');
// 編集したデータを一行ずつCSVファイルへ書き込む
foreach ($result as $record) {
  fputcsv($fp, $record);
}

// 強制的に会員一覧画面へ画面遷移させる
header('location:member.php?id=' . $id);
