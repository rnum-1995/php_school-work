<?php
// 都道府県リスト(inc/pref_list.php)を読み込み
require_once './inc/pref_list.php';
// var_dump($pref_list);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>住所検索API</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container-sm py-5">
    <h1 class="text-center mb-5">住所検索API</h1>
    <form action="#" method="post">
      <div class="row">
        <div class="mb-3 col-lg">
          <label for="name" class="form-label">お名前</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3 col-lg">
          <label for="email" class="form-label">メールアドレス</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
      </div>
      <div class="row align-items-end">
        <div class="mb-3 col col-md-3">
          <label for="postcode" class="form-label">郵便番号(ハイフン無し)</label>
          <input type="text" name="postcode" id="postcode" class="form-control" maxlength="7">
        </div>
        <div class="mb-3 col col-md-3">
          <button type="button" class="btn btn-primary" id="btn-postcode">住所検索</button>
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-6 col-sm-6">
          <label for="pref" class="form-label">都道府県</label>
          <select class="form-select" name="pref" id="pref">
            <option hidden>都道府県を選択</option>
            <!-- 都道府県のオプション -->
            <?php foreach ($pref_list as $key => $pref): ?>
              <!-- <option value="1">北海道</option> -->
              <option value="<?php echo $key ?>"><?php echo $pref ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label for="address1" class="form-label">住所1</label>
        <input type="text" name="address1" id="address1" class="form-control">
      </div>
      <div class="mb-3">
        <label for="address2" class="form-label">住所2</label>
        <input type="text" name="address2" id="address2" class="form-control">
      </div>
      <div class="mb-3">
        <input type="submit" value="送信する" class="btn btn-primary">
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>

</html>