<?php
// データベース接続情報
$host = '127.0.0.1';
$dbname = 'security_lesson_db';
$username = 'root';
$password = '';
$port = '3306';

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // プリペアドステートメントのエミュレーションを無効化（セキュリティ向上のため推奨）
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
