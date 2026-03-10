<?php
require_once __DIR__ . '/func/functions.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    //POST送信されたとき
    if (!empty($_POST['id'])) {
        //idのチェック（空の場合）
        $id = $_POST['id'];

        //DB接続
        try {
            $db = db_connect();
            //infoテーブルから１行削除するSQL
            $sql = 'DELETE FROM users WHERE id=:id';
            $stmt = $db->prepare($sql);
            //idをプレースホルダへバインド
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            //ユーザー登録へ画面遷移
            header('location:user.php');
            exit();
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
}
