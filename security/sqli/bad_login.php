<?php
require_once '../common/db_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // 脆弱なSQL: ユーザー入力をそのまま結合
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

  // デバッグ用に実行されるSQLを表示（授業用）
  echo "<div style='background:#fdd; padding:10px; border:1px solid #f00;'>実行されるSQL: " . htmlspecialchars($sql) . "</div>";

  try {
    $stmt = $pdo->query($sql);
    $user = $stmt->fetch();

    if ($user) {
      $_SESSION['username'] = $user['username'];
      $message = "ログイン成功！ようこそ、" . htmlspecialchars($user['username']) . "さん。";
    } else {
      $message = "ログイン失敗：IDまたはパスワードが間違っています。";
    }
  } catch (PDOException $e) {
    $message = "SQLエラー: " . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>SQLインジェクション（脆弱）</title>
</head>

<body>
  <h1>ログイン画面（脆弱版）</h1>
  <p style="color:red; font-weight:bold;">※ここは脆弱性のあるページです。' OR '1'='1' # によるバイパスを試してください。</p>

  <?php if ($message): ?>
    <p><?= $message ?></p>
  <?php endif; ?>

  <form method="POST">
    <div>
      <label>ユーザー名:</label>
      <input type="text" name="username">
    </div>
    <div>
      <label>パスワード:</label>
      <input type="text" name="password">
    </div>
    <button type="submit">ログイン</button>
  </form>
</body>

</html>