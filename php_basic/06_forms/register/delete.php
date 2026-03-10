<?php
// HTMLを記述しない場合はスクリプティングデリミタは開始だけで良い
// echo 'delete.phpです';
$id = $_GET['id'];

// echo '<br>';
// echo 'id:' . $id;

$filename = './data/members.csv';
$fp = fopen($filename, 'r');

// 全データ格納用の空の配列を用意
$all_records = array();
// CSVの全データを変数へ格納
while($record = fgetcsv($fp)){
  $all_records[]=$record;
}

// echo '<pre>';
// var_dump($all_records);
// echo '</pre>';

// 変更後のデータを格納する空の配列を用意
$result = array();

foreach($all_records as $record){
  if($record[0]==$id){
    $record[8]='true';
  }
  $result[] = $record;
}

// echo '<pre>';
// var_dump($result);
// echo '</pre>';

$fp = fopen($filename,'w');
// 編集したデータを一行ずつCSVファイルへ書き込む
foreach($result as $record){
  fputcsv($fp,$record);
}

// 強制的に会員一覧画面へ画面遷移させる
header('location:index.php');