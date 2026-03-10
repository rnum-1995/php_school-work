<?php
include './includes/includes_login.php';

$fp = fopen("info.txt", "r");
$line = array(); //空の配列(ファイル一行ずつ値を入れていく)
$body = ""; //本文用の変数

if ($fp) {
  // ファイルが開けたら
  while (!feof($fp)) {
    // ファイルポインタがEOFにない間繰り返す （ファイルを全て読み込むとループを終了する）
    $line[] = fgets($fp); //ファイルを一行ずつ配列へ挿入する
  }
  fclose($fp);
}
?>
<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>

  <?php include('navbar.php'); ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->

      <h1>お知らせ</h1>
      <?php
      // echo "<pre>";
      // var_dump($line);
      // echo "</pre>";
      ?>

      <?php if (count($line) > 0): //ファイルが空じゃなかったら
      ?>
        <?php foreach ($line as $i => $text): ?>
          <?php if ($i === 0): //一行目のみh2で表示
          ?>
            <h2><?php echo $text; ?></h2>
          <?php endif; ?>
          <?php $body .= $text; ?>
        <?php endforeach; ?>
      <?php else: $body = "お知らせはありません。"; ?>
      <?php endif; ?>
      <p><?php echo nl2br($body,false); ?></p>
      <!-- 本文ここまで -->
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>