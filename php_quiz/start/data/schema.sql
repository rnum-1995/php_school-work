-- データベース作成
DROP DATABASE IF EXISTS quiz_app;
CREATE DATABASE quiz_app DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE quiz_app;

-- 管理者テーブル
DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 初期管理者 (PW: admin123)
-- password_hash('admin123', PASSWORD_BCRYPT) の結果をINSERT
INSERT INTO admins (username, password) VALUES 
('admin', '$2y$10$DKJLYZ6kuOkq7ooTyENx.OffoKvKAFnrDKlFXE4R3oK39qn4m1WcG');

-- クイズ問題テーブル
DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    choice1 VARCHAR(255) NOT NULL,
    choice2 VARCHAR(255) NOT NULL,
    choice3 VARCHAR(255) NOT NULL,
    choice4 VARCHAR(255) NOT NULL,
    correct_choice INT NOT NULL COMMENT '1~4の正解番号',
    explanation TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 初期問題データ（5問）
INSERT INTO questions (question_text, choice1, choice2, choice3, choice4, correct_choice, explanation) VALUES
('PHPにおいて、変数の前に付ける記号は？', '@', '$', '#', '&', 2, 'PHPの変数はドル記号($)で始まります。'),
('データベースとの接続によく使われるPHPの拡張モジュールは？', 'PDO', 'DB Connect', 'MySQL_Link', 'SQL_Standard', 1, 'PDO (PHP Data Objects) は、様々なデータベースに統一的なインターフェースでアクセスするための拡張モジュールです。'),
('HTTPメソッドのうち、主に「データの作成」に使われるのは？', 'GET', 'DELETE', 'POST', 'HEAD', 3, 'POSTメソッドは、サーバーにデータを送信してリソースを作成または更新する場合に使用されます。'),
('配列の要素数を取得するPHP関数は？', 'length()', 'size()', 'count()', 'num()', 3, 'count() 関数は、配列またはCountableオブジェクトに含まれる要素の数を返します。'),
('XSS（クロスサイトスクリプティング）を防ぐために使用すべき関数は？', 'htmlspecialchars()', 'strip_tags()', 'urlencode()', 'base64_encode()', 1, 'htmlspecialchars() は、特殊文字をHTMLエンティティに変換し、スクリプトの実行を防ぐために重要です。');
