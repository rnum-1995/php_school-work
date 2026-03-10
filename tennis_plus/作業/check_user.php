<?php
//セッションの開始
session_start();
//データの受け取り
require_once __DIR__ . '/func/functions.php';

if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        //ユーザー認証処理
        $name = $_POST['name'];
        $password = $_POST['password'];

        try {
            $db = db_connect();
            $sql = 'SELECT * FROM users WHERE name=:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            //結果セットを連想配列の形で取得
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                //パスワードの検証
                //「password_verify()」パスワードがマッチするか調べる
                if (password_verify($password, $result['password'])) {
                    $_SESSION['id'] = $result['id'];
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['role'] = $result['role'];
                    header('location:index.php');
                    exit();
                }
            }
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
}
// header('location:login.php');
// exit();
