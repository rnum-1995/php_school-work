<?php
include './includes/includes_login.php';

//セッションの開始
session_start();

//ログイン状態のチェック
if (isset($_SESSION['id'])) {
  //ログイン済み
  header('location:index.php');
  exit();
} else if (isset($_POST['name']) && isset($_POST['password'])) {
  //ログインしていない ＆ ユーザー名とパスワードを送信した
  //DBへ接続
  $dsn = 'mysql: host=localhost;dbname=tennis;charset=utf8';
  $user = 'tennisuser';
  $password = 'password';

  //例外をtryしてcatchする例外処理のための構文
  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //プリペアードステートメントの作成
    $sql = 'SELECT * FROM users WHERE name=:name AND password=:password';
    $stmt = $db->prepare($sql);
    //$stmt->bindParam('プレースホルダー',プレースホルダーに埋め込みたい値,データ型 )
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':password', hash('sha256', $_POST['password']), PDO::PARAM_STR); //hash化しないとマッチしない

    //SQLの実行
    $stmt->execute();

    if ($row = $stmt->fetch()) {
      //ユーザーが存在している場合
      $_SESSION['id'] = $row['id'];
      header('location:index.php');
    } else {
      //1レコードも取得できなかった。ユーザー名かパスワードが間違っている
      header('location:login.php');
      exit();
    }
  } catch (PDOException $e) {
    exit('エラー：' . $e->getMessage());
  }
}
?>

<!doctype html>
<html lang="ja">

<head>
  <title>サークルサイト</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    form {
      width: 100%;
      min-width: 330px;
      padding: 15px;
      margin: auto;
      text-align: center;
    }

    #name {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    #password {
      margin-bottom: 10px;
      border-top-right-radius: 0;
      border-top-left-radius: 0;
    }
  </style>
</head>

<body>

  <?php include('navbar.php'); ?>

  <main role="main" class="container" style="padding:60px 15px 0">
    <div>
      <!-- ここから「本文」-->
      <form action="login.php" method="post">
        <h1>サークルサイト</h1>
        <label for="name" class="sr-only">ユーザー名</label>
        <input type="text" name="name" id="name"
          class="form-control" placeholder="ユーザー名">

        <label for="name" class="sr-only">パスワード</label>
        <input type="password" name="password" id="password"
          class="form-control" placeholder="パスワード">
        <input type="submit" value="ログイン" class="btn btn-primary btn-block">
      </form>

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