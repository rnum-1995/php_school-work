<?php
// セッションの開始
session_start();

require_once __DIR__ . '/func/functions.php';

// debug_check_array($_POST);
if (!empty($_POST)) {
    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        // ユーザー認証処理
        $name = $_POST['name'];
        $password = $_POST['password'];

        try {
            $db = db_connect();
            $sql = 'SELECT * FROM users WHERE name=:name';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->execute();

            // 結果セットを連想配列の形で取得
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // debug_check_array($result);
            if($result){
                // パスワードの検証
                if(password_verify($password,$result['password'])){
                    $_SESSION['id'] = session_id();
                    $_SESSION['name'] = $result['name'];
                    $_SESSION['role'] = $result['role'];
                    // echo $_SESSION['name'];
                    header('location:index.php');
                    exit();
                }
            }

        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}
header('location:login.php');
exit();