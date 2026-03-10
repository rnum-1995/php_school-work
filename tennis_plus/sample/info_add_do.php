<?php
require_once __DIR__ .'/func/functions.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    // POST送信されたとき
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['body'])) {
        // TODO: 必須項目チェック（空の場合）
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        // 日付けが空文字だったら当日のデータ、空文字じゃなかったら送信されたデータを代入
        $date = empty($_POST['date']) ? date('Y-m-d') : $_POST['date'];

        // DBに接続
        try {
            $db = db_connect();
            // infoテーブルに1行挿入するSQL
            $sql = 'INSERT INTO info (author,title,body,date) VALUES (:author,:title,:body,:date)';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->execute();

            // トップページへ画面遷移
            header('location:index.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー: '.$e->getMessage());
        }
    }
}


