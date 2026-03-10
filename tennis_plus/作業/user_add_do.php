<?php
require_once __DIR__ . '/func/functions.php';

//TODO: POST送信されているかチェック
if (!empty($_POST)) {

    //TODO:必須項目が入力されているかチェック
    if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['role'])) {

        //TODO:$_POSTから値を取り出す']
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        //TODO:ユーザー名の書式チェック(半角英数4文字以上)
        // var_dump(preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name));
        if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
            header('location:user_add.php');
            exit();
        }

        //TODO:ユーザー名が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(name) FROM users WHERE name=:name ';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す
            if ($result[0] !== 0) {
                header('location:user_add.php');
                exit();
            }
            //TODO:パスワードをハッシュ化(password_hash())
            $password_h = password_hash($password, PASSWORD_DEFAULT);
            // echo $password_h;
            //usersテーブルに登録
            $sql_2 = 'INSERT INTO users(name,password,role,date) VALUES(:name, :password, :role, now())';
            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_2->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt_2->bindParam(':role', $role, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
}
header('location:user.php');
