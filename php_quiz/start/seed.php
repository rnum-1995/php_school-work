<?php
// 依存関係：inc/config.php のみ
require_once __DIR__ . '/inc/config.php';

// このファイル内で完結させるための簡易DB接続関数
function seed_db_connect() {
    try {
        $dsn = 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8mb4';
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    } catch (PDOException $e) {
        die("Database Connection Error: " . $e->getMessage());
    }
}

try {
    $pdo = seed_db_connect();

    // 1. Admins Table Initialization
    echo "Initializing admins table...<br>";
    // テーブルがない場合のエラーを避けるため、存在確認するか、単純にCREATE IF NOT EXISTSを使う
    // 今回はSchemaがインポート済み前提だが、念のためTRUNCATE前にテーブル作成SQLも流しておくと親切
    // しかしschema.sqlは別途配布されているので、ここではデータ投入に集中する
    
    // 単純なTRUNCATEはテーブルがないとエラーになる可能性があるので、DELETEを使うか、テーブル作成を含めるか。
    // ここでは授業用なのでシンプルに。エラーが出たらschema.sqlを入れてね、というスタンス。
    
    $stmt = $pdo->query("SHOW TABLES LIKE 'admins'");
    if ($stmt->rowCount() == 0) {
        throw new Exception("Table 'admins' not found. Please import data/schema.sql first.");
    }
    
    $pdo->exec("TRUNCATE TABLE admins");
    
    // 正しいハッシュ値を生成
    $password = 'admin123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
    $stmt->execute([
        ':username' => 'admin',
        ':password' => $hash
    ]);
    echo "Admin user created. (Username: admin / Password: $password)<br>";

    // 2. Questions Table Initialization
    echo "Initializing questions table...<br>";
    $stmt = $pdo->query("SHOW TABLES LIKE 'questions'");
    if ($stmt->rowCount() == 0) {
        throw new Exception("Table 'questions' not found. Please import data/schema.sql first.");
    }

    $pdo->exec("TRUNCATE TABLE questions");

    $questions = [
        [
            'PHPにおいて、変数の前に付ける記号は？',
            '@', '$', '#', '&',
            2,
            'PHPの変数はドル記号($)で始まります。'
        ],
        [
            'データベースとの接続によく使われるPHPの拡張モジュールは？',
            'PDO', 'DB Connect', 'MySQL_Link', 'SQL_Standard',
            1,
            'PDO (PHP Data Objects) は、様々なデータベースに統一的なインターフェースでアクセスするための拡張モジュールです。'
        ],
        [
            'HTTPメソッドのうち、主に「データの作成」に使われるのは？',
            'GET', 'DELETE', 'POST', 'HEAD',
            3,
            'POSTメソッドは、サーバーにデータを送信してリソースを作成または更新する場合に使用されます。'
        ],
        [
            '配列の要素数を取得するPHP関数は？',
            'length()', 'size()', 'count()', 'num()',
            3,
            'count() 関数は、配列またはCountableオブジェクトに含まれる要素の数を返します。'
        ],
        [
            'XSS（クロスサイトスクリプティング）を防ぐために使用すべき関数は？',
            'htmlspecialchars()', 'strip_tags()', 'urlencode()', 'base64_encode()',
            1,
            'htmlspecialchars() は、特殊文字をHTMLエンティティに変換し、スクリプトの実行を防ぐために重要です。'
        ]
    ];

    $sql = "INSERT INTO questions (question_text, choice1, choice2, choice3, choice4, correct_choice, explanation) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    foreach ($questions as $q) {
        $stmt->execute($q);
    }
    echo "Reference questions inserted (" . count($questions) . " items).<br>";

    echo "<hr><strong>Setup completed successfully!</strong>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
