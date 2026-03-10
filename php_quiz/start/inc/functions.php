<?php
require_once __DIR__ . '/config.php';

// DB接続関数
function db_connect()
{
    // ここにDB接続処理を記述する
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $db =  new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

// JSON出力関数
function output_json($data, $status_code = 200)
{
    // ここにJSON出力処理を記述する
    http_response_code($status_code); //HTTPレスポンスコードを取得または設定
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
}
