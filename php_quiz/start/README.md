# Server-Side Learning (PHP/DB)

このフォルダは、**サーバーサイド（PHPとデータベース）** の実装を中心に学習するためのキットです。
フロントエンド（HTML/JavaScript）は既に完成しており、APIのレスポンスが正しければ動作するように作られています。

## 学習のゴール
1. **データベース接続**: PHPからMySQLデータベースに接続する（PDO）。
2. **Web API構築**: データベースからデータを取得し、JSON形式で出力する。
3. **データ処理**: クライアントから送られてきたデータを適切に処理・保存する。

## フォルダ構成

### フォルダ構成

```
server_side_learning/
├── index.html
├── admin.html
├── js/                 (完成済みのフロントエンド: 変更不要)
│   ├── quiz/
│   │   ├── main.js, api.js, view.js (ES Modules構成)
│   │   └── script.js (リファクタリング前)
│   └── admin/
│       ├── main.js, api.js, view.js (ES Modules構成)
│       └── script.js (リファクタリング前)
├── api/                  (★実装対象: PHPスクリプト)
│   ├── quiz/
│   │   ├── fetch.php
│   │   └── check.php
│   └── admin/
│       ├── login.php
│       ├── fetch_all.php
│       └── ...
└── inc/
    ├── config.php        (★実装対象: DB設定)
    └── functions.php     (★実装対象: 共通DB接続関数)
```

## セットアップ手順
1. MAMPを起動し、このフォルダをドキュメントルート（例: `htdocs/php_quiz/server_side_learning`）に配置します。
2. `inc/config.php` を開き、データベース接続情報（ホスト名、ユーザー名、パスワード）を自分の環境に合わせて設定します。
3. ブラウザで `seed.php` にアクセスし、データベースを初期化します（"Setup completed successfully!" と表示されればOK）。

## 実装ステップ
1. **DB接続**: `inc/functions.php` 内の `db_connect()` 関数を実装し、DBに接続できるようにします。
2. **出題API**: `api/quiz/fetch.php` を実装し、データベースから問題データを取得してJSONで返せるようにします。
    - 確認方法: ブラウザで直接 `api/quiz/fetch.php` にアクセスする。
3. **回答API**: `api/quiz/check.php` を実装し、送られてきた回答の正誤判定を行えるようにします。
    - 確認方法: `html/index.html`（クイズ画面）を開いて、実際にクイズが動作するか確認する。

## 発展課題
- 管理者ログイン機能 (`api/admin/login.php`) とセッション管理
- 問題作成・編集・削除機能 (CRUD) のAPI実装
