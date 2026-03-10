<?php
include './includes/includes_login.php';

$msg = null;
$alert = null;

if (isset($_FILES["image"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
  // テンポラリファイルの名前
  $old_name = $_FILES["image"]["tmp_name"];
  // 移動後の新しい名前
  // $new_name = $_FILES["image"]["name"];
  $new_name = date("YmdHis");
  $new_name .= mt_rand();
  // echo "<pre>";
  // var_dump(getimagesize($_FILES["image"]["tmp_name"]));
  // echo "</pre>";
  $size = getimagesize($_FILES["image"]["tmp_name"]);
  switch ($size[2]) {
    case IMAGETYPE_JPEG:
      $new_name .= ".jpg";
      break;
    case IMAGETYPE_GIF:
      $new_name .= ".gif";
      break;
    case IMAGETYPE_PNG:
      $new_name .= ".png";
      break;
    case IMAGETYPE_WEBP:
      $new_name .= ".webp";
      break;
    default:
      header("location: upload.php");
      exit();
  }

  if (move_uploaded_file($old_name, "album/" . $new_name)) {
    $msg = "アップロードしました。";
    $alert = "success";
  } else {
    $msg = "アップロードできませんでした。";
    $alert = "danger";
  }
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
      <?php
      // echo "<pre>";
      // var_dump($_FILES);
      // $_FILES["image"]["name"];
      // echo "</pre>";
      ?>

      <h1>画像アップロード</h1>
      <?php if ($msg): ?>
        <div class="alert alert-<?php echo $alert ?>" role="alert"><?php echo $msg; ?></div>
      <?php endif; ?>

      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>アップロードファイル</label>
          <input type="file" name="image" class="form-control-file">
        </div>
        <input type="submit" value="アップロードする" class="btn btn-primary">
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