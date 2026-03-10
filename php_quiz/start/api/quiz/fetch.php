<?php
// ここに出題APIを実装します
// 1. DB接続
// 2. データ取得 (SELECT)
// 3. JSON出力

require_once '../../inc/functions.php';

try {
    $db = db_connect();
    $sql = 'SELECT id,question_text,choice1,choice2,choice3,choice4 FROM questions';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($questions);
    output_json($questions);
} catch (PDOException $e) {
    //レスポンスコードを設定
    http_response_code(500);
    //タイムゾーンを設定する関数
    date_default_timezone_set('Asia/Tokyo');
    //エラー文をログファイルに書き込み
    $err_msg = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . '\n';
    file_put_contents('../../log/error.txt', $err_msg, FILE_APPEND);
}
