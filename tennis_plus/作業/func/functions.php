<?php
//「__DIR__ 」：マジック定数
require_once __DIR__ . '/../inc/db_info.php';

//DBへ接続する関数
function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

//配列の内容を確認する関数
function debug_check_array($array)
{
    echo '<pre>';
    var_dump($array);
    echo '</pre>';
};

//役割リストを返す関数
function get_roles_list()
{
    //DBに接続
    $roles = array();
    try {
        //rolesテーブルから全レコードを取得
        $db = db_connect();
        $sql = 'SELECT * FROM roles';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //$resultを使って$roles配列を作成
        foreach ($result as $row) {
            $roles[$row['id']] = $row['name'];
        }
        return $roles;
    } catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
    }
}
