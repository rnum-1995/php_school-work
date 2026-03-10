<?php
//データの受け取り
require_once __DIR__ . '/inc/includes-login.php';
require_once __DIR__ . '/func/functions.php';

//DBに接続
try {
  $db = db_connect();
  //infoテーブルの全てのレコードを取得するSQL
  $sql = 'SELECT id,title,date FROM info ORDER BY date DESC';
  $stmt = $db->prepare($sql);

  $stmt->execute();

  //すべての結果セットを連想配列の形で取得
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  exit('エラー：' . $e->getMessage());
}


// TODO: CSV読み込み処理
// $filename = 'info/info.csv';
// $fp = fopen($filename, 'r');

// $info_array = array();
// if ($fp) {
//   while ($row = fgetcsv($fp)) {
//     $info_array[] = [$row[0], $row[1], $row[2]];
//   }
//   fclose($fp);
// }

// TODO: ソート処理
//投稿日の降順(日付が新しい順)
// if (!empty($info_array)) {
//   //ソートの基準となる要素を抜き出す
//   $dates = array_column($info_array, 2);

//   //array_multisort(並べ替える配列,ソートオプション(昇順・降順に並び替える),連動してソートする配列);
//   //SORT_DESC(降順)、SORT_ASC(昇順)
//   array_multisort($dates, SORT_DESC, $info_array);
// }
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

      <h1 class="my-5">お知らせ</h1>
      <?php if ($_SESSION['role'] === 1): ?>
        <p><a href="info_add.php">お知らせ新規登録</a></p>
        <p><a href="user.php">ユーザー一覧</a></p>
      <?php endif; ?>
      <ul class="list-group my-3">
        <!-- TODO: 記事一覧を表示する -->
        <?php
        // echo '<pre>';
        // var_dump($info_array);
        // echo '</pre>';
        ?>
        <!-- 
          【このようにする】
        <li class="list-group-item py-3">
          <a class="post-link" href="info.php?id=698d61fe32dc7">
            <time class="post-date" datetime="2026-02-03">2026-02-03</time>
            <span class="post-title">投稿テスト</span>
          </a>
        </li> 
        -->
        <?php foreach ($result as $row): ?>
          <li class="list-group-item py-3">
            <a class="post-link" href="info.php?id=<?php echo $row['id'] ?>">
              <time class="post-date" datetime="<?php echo $row['date'] ?>"><?php echo $row['date'] ?></time>
              <span class="post-title"><?php echo $row['title'] ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
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