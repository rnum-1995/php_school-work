<?php
require_once  '../../inc/functions.php';
// ここに回答判定APIを実装します
// 1. JSON入力受け取り
$raw_input = file_get_contents('php://input');
//json_decode()の第二引数をtrueにすると連想配列にパースされる
$inout = json_decode($raw_input, true);

//問題のID
$question_id = $input['question_id'] ?? null;
//??...Null合体演算子
//ユーザーが選択した選択肢の番号
$user_choice = $input['user_choice'] ?? null;

//問題IDと選択肢のデータがなかったら
if (!$question_id || !$user_choice) {
    output_json(['error' => '入力値エラー'], 400);
}

try {
    // 2. DB照合
    $db = db_connect();
    $sql = 'SELECT correct_choice,explanation FROM questions WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $question_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //結果判定
    $is_correct = $result['correct_choice'] === $user_choice;

    // 3. 結果返却
    output_json([
        'result' => $is_correct,
        'correct_choice' => $result['correct_choice'],
        'explanation' => $result['explanation']
    ]);
} catch (PDOException $e) {
    //レスポンスコードを設定
    http_response_code(500);
    //タイムゾーンを設定する関数
    date_default_timezone_set('Asia/Tokyo');
    //エラー文をログファイルに書き込み
    $err_msg = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . '\n';
    file_put_contents('../../log/error.txt', $err_msg, FILE_APPEND);
}
