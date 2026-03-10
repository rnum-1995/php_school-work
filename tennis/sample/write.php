<?php
include './includes/includes_login.php';

// データの受け取り
$name = $_POST['name'];
$title = $_POST['title'];
$body = $_POST['body'];
$pass = $_POST['pass'];

// 必須項目のチェック(名前・本文)
if ($name === '' || $body === '') {
    header('location: bbs.php'); // 空だったら入力ページへ戻す
    exit();
}

// 必須項目のチェック(削除用パスワード) 正規表現
// preg_match('パターン文字列','チェックする文字列')
if (!preg_match('/^[0-9]{4}$/', $pass)) {
    header('location: bbs.php'); // 書式が違うとき入力ページへ戻す
    exit();
}

// クッキーに値をセット
setcookie('name', $name, time() + 60 * 60 * 24 * 30);

// DBへ接続
$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
$user = 'tennisuser';
$password = 'password';

try {
    // PDOインスタンス作成
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアードステートメントの作成
    $sql = 'INSERT INTO bbs (name,title,body,date,pass) VALUES (:name,:title,:body,now(),:pass)';
    $stmt = $db->prepare($sql);
    // $stmt->bindParam('プレースホルダ',プレースホルダに埋め込みたい値,データ型)
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

    // SQLの実行
    $stmt->execute();

    // bbs.phpに戻る
    header('location:bbs.php');
    exit();
} catch (PDOException $e) {
    exit('エラー:' . $e->getMessage());
}
