<?php
require_once __DIR__ . '/func/functions.php';
// DBに接続
// TODO: ID取得とバリデーション
$id = (int)$_POST['id'];

// DB接続
try {
  $db = db_connect();
  $sql = 'SELECT id,name,role FROM users WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // 結果セットを連想配列の形で取得
  $target = $stmt->fetch(PDO::FETCH_ASSOC);
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

      <h1 class="my-5">ユーザー - 変更</h1>
      <form action="user_edit_do.php" method="post">
        <div class="row">
          <div class="mb-3 col">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $target['name']; ?>">
          </div>
          <div class="mb-3 col">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
        </div>
        <div class="mb-3">
          <p class="form-label">役割</p>
          <?php
          // $roles(役割配列)を使ってラジオボタンを表示
          foreach ($roles as $key => $name):
          ?>
            <div class="form-check form-check-inline">
              <input type="radio" name="role" id="role<?php echo $key; ?>" value="<?php echo $key; ?>" class="form-check-input" <?php echo $key === $target['role'] ? 'checked' : ''; ?>>
              <label for="role<?php echo $key; ?>" class="form-check-label"><?php echo $name; ?></label>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="mb-3">
          <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
          <input type="submit" value="変更する" class="btn btn-primary">
        </div>
      </form>

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