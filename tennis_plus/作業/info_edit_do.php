<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    //POST送信されたとき
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['body']) && !empty($_POST['id'])) {
        //必須項目チェック（空の場合）
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        //日付が空文字だったら当日のデータ、空文字ではなかったら送信されたデータを代入
        $date = empty($_POST['date']) ? date('Y-m-d') : $_POST['date'];
        $id = (int)$_POST['id'];

        //DB接続
        try {
            $db = db_connect();
            //infoテーブルに編集した1行挿入するSQL
            $sql = 'UPDATE info SET author=:author, title=:title, body=:body, date=:date WHERE id=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            //トップページへ画面遷移
            header('location:index.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
}
