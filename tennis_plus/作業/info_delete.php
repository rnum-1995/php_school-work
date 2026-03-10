<?php
//データの受け取り
require_once __DIR__ . '/func/functions.php';

// TODO: ID取得とバリデーション
$id = (int)$_POST['id']; //(int)で型変換

//DB接続
try {
  $db = db_connect();
  $sql = 'SELECT * FROM info WHERE id=:id';
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

      <h1 class="my-5">お知らせ - 削除確認</h1>
      <!-- TODO: 記事詳細を表示する -->
      <article class="info">
        <header class="info-header">
          <h2 class="info-title"><?php echo $target['title']; ?></h2>
          <div class="info-data">
            <time datetime="<?php echo $target['date']; ?>"><?php echo $target['date']; ?></time>
            <p class="m-0"><?php echo $target['author']; ?></p>
          </div>
        </header>

        <section class="info-body my-3">
          <p>
            <?php echo nl2br($target['body']); ?>
          </p>
        </section>
      </article>

      <p>以上の内容を削除してよろしいですか？</p>
      <a href="./index.php" class="btn btn-primary">トップページに戻る</a>
      <form action="info_del_do.php" method="post">
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