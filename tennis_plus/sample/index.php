<?php
require_once __DIR__ . '/inc/includes-login.php';
require_once __DIR__ . '/func/functions.php';
// DBに接続
try {
  $db = db_connect();
  // infoテーブルのすべてのレコードを日付の降順で取得するSQL
  $sql = 'SELECT id,title,date FROM info ORDER BY date DESC';
  $stmt = $db->prepare($sql);

  $stmt->execute();

  // 結果セットを連想配列の形で取得
  $info_array = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // echo '<pre>';
  // var_dump($info_array);
  // echo '</pre>';

  // トップページへ画面遷移
} catch (PDOException $e) {
  exit('エラー: ' . $e->getMessage());
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

  <?php include('navbar.php');
  ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1 class="my-5">お知らせ</h1>
      <?php if ($_SESSION['role'] === 1):  ?>
        <p><a href="info_add.php">お知らせ新規登録</a></p>
        <p><a href="user.php">ユーザー一覧</a></p>
      <?php endif; ?>
      <?php if (count($info_array) > 0): ?>
        <ul class="list-group my-3">
          <!-- TODO: 記事一覧を表示する -->
          <?php foreach ($info_array as $row): ?>
            <li class="list-group-item py-3">
              <a class="post-link" href="info.php?id=<?php echo $row['id']; ?>">
                <time class="post-date" datetime="<?php echo $row['date']; ?>"><?php echo $row['date']; ?></time>
                <span class="post-title"><?php echo $row['title']; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>お知らせはありません。</p>
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