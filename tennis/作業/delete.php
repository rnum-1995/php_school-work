<?php
include './includes/includes_login.php';

//データの受け取り
$id = $_POST['id'];
$pass = $_POST['pass'];

//必須項目チェック
if ($id === '' || $pass === '') {
    header('location: bbs.php');
    exit();
}

//DBへ接続
$dsn = 'mysql: host=localhost;dbname=tennis;charset=utf8';
$user = 'tennisuser';
$password = 'password';

//例外をtryしてcatchする例外処理のための構文
try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //仮のSQLにプリペアードステートメントの作成
    $sql = 'DELETE FROM bbs WHERE id = :id AND pass = :pass';
    $stmt = $db->prepare($sql);
    //$stmt->bindParam('プレースホルダー',プレースホルダーに埋め込みたい値,データ型 )
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); //idのため「PARAM_INT」
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

    //SQLの実行
    $stmt->execute();

    //bbs.phpに戻る
    header('location:bbs.php');
    exit();
} catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
}
