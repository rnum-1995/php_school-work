<?php
require_once './inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: index.php');
  exit;
}

$id                = $_POST['id'] ?? '';
$name              = $_POST['name'] ?? '';
$breed_id          = $_POST['breed_id'] ?? '';
$gender            = $_POST['gender'] ?? '';
$age               = $_POST['age'] ?? '';
$profile           = $_POST['profile'] ?? '';

// 入力データ保持用
$_SESSION['form_data'] = [
  'name'              => $name,
  'breed_id'          => $breed_id,
  'gender'            => $gender,
  'age'               => $age,
  'profile'           => $profile
];

// 必須チェック
if (empty($id) || empty($name) || empty($breed_id) || empty($gender) || $age === '') {
  $_SESSION['err_msg'] = '必須項目が入力されていません。';
  header('Location: edit.php?id=' . $id);
  exit;
}

// 【TODO】データベースに接続する関数を呼び出し、変数 $db に代入してください。

try {
  // ★ユニーク制約チェック: 変更後の名前が、"自分以外の"他の猫ですでに使われていないかチェック
  // 【TODO】名前が $name と一致し、かつ id が $id と一致しないレコードの「件数」を取得するSQL文を変数 $sql_check に代入してください。


  // 【TODO】SQL文を準備し、プレースホルダに $name と $id をバインドして実行してください。


  // 【TODO】取得した件数を fetchColumn() などで取得し、変数 $count に代入してください。

  if ($count > 0) {
    $_SESSION['err_msg'] = '指定された名前のキャストは既に登録されています。';
    header('Location: edit.php?id=' . $id);
    exit;
  }

  // データベースの更新処理（画像は更新しない仕様）
  // 【TODO】catsテーブルの各データ（name, breed_id, gender, age, profile）を、指定された $id のレコードに対してUPDATEするSQL文を変数 $sql に代入してください。


  // 【TODO】SQL文を準備し、実行してください。（すべての変数について bindValue を行うこと。profileはNULLが許可される点に注意）

  unset($_SESSION['form_data']);
  $_SESSION['msg'] = '登録情報を更新しました。';

  header('Location: detail.php?id=' . $id);
  exit;
} catch (PDOException $e) {
  $_SESSION['err_msg'] = 'データベースエラー: ' . $e->getMessage();
  header('Location: edit.php?id=' . $id);
  exit;
}
