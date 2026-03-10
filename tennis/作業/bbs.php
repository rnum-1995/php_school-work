<?php
include './includes/includes_login.php';

// htmlspecialcharsの代替え関数
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//クッキーの読み込み
if (isset($_COOKIE['name'])) {
  $name = $_COOKIE['name'];
} else {
  $name = '';
}

//1ページに表示される書き込みの数
$num = 10;

//DBへ接続
$dsn = 'mysql: host=localhost;dbname=tennis;charset=utf8';
$user = 'tennisuser';
$password = 'password';

$page = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
  $page = intval($_GET['page']);
}

//例外をtryしてcatchする例外処理のための構文
try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  //仮のSQLにプリペアードステートメントの作成
  $sql = 'SELECT * FROM bbs ORDER BY date DESC LIMIT :page,:num';
  $stmt = $db->prepare($sql);
  $page = ($page - 1) * $num;
  $stmt->bindParam(':page', $page, PDO::PARAM_INT);
  $stmt->bindParam(':num', $num, PDO::PARAM_INT);
  //$stmt->bindParam('プレースホルダー',プレースホルダーに埋め込みたい値,データ型 )
  // $stmt->bindParam(':name', $name, PDO::PARAM_STR);
  // $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  // $stmt->bindParam(':body', $body, PDO::PARAM_STR);
  // $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

  //SQLの実行
  $stmt->execute();

  //取得したレコードを連想配列の形で受け取る
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // echo '<pre>';
  // var_dump($result);
  // echo '</pre>';
} catch (PDOException $e) {
  exit('エラー：' . $e->getMessage());
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

      <h1>掲示板</h1>
      <form action="write.php" method="post">
        <div class="form-group">
          <label>タイトル</label>
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
          <label>名前</label>
          <input type="text" name="name" class="form-control" value="<?php echo h($name); ?>">
        </div>
        <div class="form-group">
          <textarea name="body" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label>削除パスワード（数字４桁）</label>
          <input type="text" name="pass" class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" value="書き込む">
      </form>

      <hr>
      <?php foreach ($result as $row): ?>
        <div class="card">
          <div class="card-header"><?php echo $row['title'] ? h($row['title']) : '(無題)'; ?></div>
          <div class="card-body">
            <p class="card-text">
              <?php echo nl2br(h($row['body'])); ?>
            </p>
          </div>
          <div class="card-footer">
            <form action="delete.php" method="post" class="form-inline">
              <?php echo h($row['name']); ?>(<?php echo $row['date']; ?>)
            </form>
            <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
            <input type="text" name="pass" id="pass" class="form-control" placeholder="削除パスワード">
            <input type="submit" value="削除" class="btn-secondary">
          </div>
        </div>
        <hr>
      <?php endforeach; ?>

      <?php
      try {
        $sql = 'SELECT COUNT(*) FROM bbs';
        $stmt = $db->prepare($sql);
        $stmt->execute();
      } catch (PDOException $e) {
        exit('エラー：' . $e->getMessage());
      }
      ?>

      <?php
      //書き込み件数を取得
      $comments = $stmt->fetchColumn();
      // echo $comments;

      //ページ数を計算(データ数 / 10件)
      $max_page = ceil($comments / $num); //ceil(切り上げ)
      if ($max_page >= 1):
      ?>
        <nav>
          <ul class="pagination">
            <?php for ($i = 1; $i <= $max_page; $i++): ?>
              <li class="page-item">
                <a href="bbs.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
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