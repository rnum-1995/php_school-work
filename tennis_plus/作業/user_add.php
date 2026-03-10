<?php
//データの受け取り
require_once __DIR__ . '/func/functions.php';

//DBに接続
$roles = get_roles_list();

//役割配列
// $roles = [
//   1 => '管理者',
//   2 => '一般',
// ];

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
      <h1 class="my-5">新規ユーザー登録</h1>
      <form action="user_add_do.php" method="post">
        <div class="row">
          <div class="mb-3 col">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>

          <div class="mb-3 col">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
        </div>

        <div class="mb-3">
          <p class="form-label">役割</p>

          <?php
          //$roles(役割配列)を使ってラジオボタンを表示
          ?>
          <?php foreach ($roles as $key => $name):  ?>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="role" id="role<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo $key === 2 ? 'checked' : '' ?>>
              <label class="form-check-label" for="role<?php echo $key; ?>"><?php echo $name; ?></label>
            </div>
          <?php endforeach; ?>

          <!-- <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role1" value="1">
            <label class="form-check-label" for="role1">管理者</label>
          </div>

          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="role" id="role2" value="2" checked>
            <label class="form-check-label" for="role2">一般</label>
          </div> -->
        </div>

        <div class="mb-3">
          <input type="submit" value="登録する" class="btn btn-primary">
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