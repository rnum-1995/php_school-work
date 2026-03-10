<?php
require_once '../common/db_connect.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // 安全なSQL: プリペアドステートメントを使用
  $sql = "SELECT * FROM users WHERE username = :username AND password = :password";

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user) {
      $_SESSION['username'] = $user['username'];
      $message = "ログイン成功！ようこそ、" . htmlspecialchars($user['username']) . "さん。";
    } else {
      $message = "ログイン失敗：IDまたはパスワードが間違っています。";
    }
  } catch (PDOException $e) {
    $message = "エラー: " . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>SQLインジェクション対策済み</title>
</head>

<body>
  <h1>ログイン画面（対策済み）</h1>
  <p>プリペアドステートメントを使用しているため、SQLインジェクションは成功しません。</p>

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