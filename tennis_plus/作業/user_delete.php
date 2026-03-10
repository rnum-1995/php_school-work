<?php
//データの受け取り
require_once __DIR__ . '/func/functions.php';

// TODO: ID取得とバリデーション
$id = (int)$_POST['id']; //(int)で型変換

//DB接続
try {
  $db = db_connect();
  $sql = 'SELECT * FROM users WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  //１つの結果セットを連想配列の形で取得
  $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit('エラー：' . $e->getMessage());
}
?>

<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php include('navbar.php');  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">ユーザー - 削除確認</h1>
      <!-- TODO: 削除ユーザーを表示する -->
      <p>ユーザー「<?php echo $target['name']; ?>」を削除してもよろしいですか？</p>
      <a href="./user.php" class="btn btn-primary">ユーザー一覧に戻る</a>
      <form action="user_del_do.php" method="post">
        <input type="hidden" name="id" value="<?php echo $target['id']; ?>">
        <input type="submit" value="削除" class="btn btn-danger">
      </form>

      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
</body>

</html>