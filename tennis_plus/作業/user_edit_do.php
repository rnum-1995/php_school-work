<?php
require_once __DIR__ . '/func/functions.php';

//TODO: POST送信されているかチェック
if (!empty($_POST)) {

    //TODO:必須項目が入力されているかチェック
    if (!empty($_POST['name']) && !empty($_POST['role']) && !empty($_POST['id'])) {

        //TODO:$_POSTから値を取り出す']
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = (int)$_POST['role'];
        $id = (int)$_POST['id'];

        //TODO:ユーザー名の書式チェック(半角英数4文字以上)
        // var_dump(preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name));
        if (!preg_match('/^[a-zA-Z0-9_-]{4,}$/', $name)) {
            header('location:user_edit.php');
            exit();
        }

        //TODO:ユーザー名が重複していないかチェック
        try {
            $db = db_connect();
            $sql = 'SELECT COUNT(name) FROM users WHERE name=:name AND id!=:id';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_NUM); //キーが連番の配列で取り出す
            if ($result[0] !== 0) {
                header('location:user_edit.php');
                exit();
            }
            //TODO:パスワードをハッシュ化(password_hash())
            if (!empty($password)) {
                $password_h = password_hash($password, PASSWORD_DEFAULT);
            }
            // echo $password_h;
            //usersテーブルに登録
            if (!empty($password)) {
                //パスワードを変更する人
                $sql_2 = 'UPDATE users SET name=:name, password=:password ,role=:role WHERE id=:id';
            } else {
                //パスワード変更しない人
                $sql_2 = 'UPDATE users SET name=:name, role=:role WHERE id=:id';
            }

            $stmt_2 = $db->prepare($sql_2);
            $stmt_2->bindParam(':name', $name, PDO::PARAM_STR);
            if (!empty($password)) {
                $stmt_2->bindParam(':password', $password_h, PDO::PARAM_STR);
            }
            $stmt_2->bindParam(':role', $role, PDO::PARAM_INT);
            $stmt_2->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_2->execute();
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
}
header('location:user.php');
