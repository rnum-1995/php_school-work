<?php
require_once __DIR__ . '/func/functions.php';
// DBに接続
try {
  $db = db_connect();
  // usersテーブルから全レコードを、連想配列の形で取得
  $sql = 'SELECT * FROM users';
  $stmt = $db->prepare($sql);
  $stmt->execute();

  $users_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit('エラー: ' . $e->getMessage());
}

$roles = get_roles_list();
?>
<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php include('navbar.php');
  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">ユーザー</h1>
      <a href="user_add.php">ユーザー新規登録</a>
      <?php
      // もしユーザーが登録されていなかったら、テーブルの代わりに「<p>ユーザーは登録されていません。</p>」を表示する
      // debug_check_array($roles);
      if (count($users_array) > 0):
      ?>
        <table class="table table-user">
          <thead>
            <tr>
              <th>ID</th>
              <th>ユーザー名</th>
              <th>役割</th>
              <th>操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users_array as $user): ?>
              <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $roles[$user['role']] ; ?></td>
                <td>
                  <form action="user_edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="submit" value="編集" class="btn btn-primary">
                  </form>
                  <form action="user_del.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="submit" value="削除" class="btn btn-danger">
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>ユーザーは登録されていません。</p>
      <?php endif; ?>
      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>