<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員情報入力画面</title>
</head>

<body>
  <!-- http://localhost:8888/php_basic/06_forms/register/form.php -->
  <h1>会員情報入力画面</h1>
  <form action="confirm.php" method="post">
    <p>
      <label for="user-name">名前</label><br>
      <input type="text" name="user-name" id="user-name">
    </p>
    <p>
      <label for="email">メールアドレス</label><br>
      <input type="email" name="email" id="email">
    </p>
    <p>
      <label for="birthday">生年月日</label><br>
      <input type="date" name="birthday" id="birthday">
    </p>
    <p>
      <label for="password">パスワード</label><br>
      <input type="password" name="password" id="password">
    </p>
    <?php
    // 性別の項目を管理する連想配列を作る
    $gendar_list = [
      1 => '男性',
      2 => '女性',
      3 => 'ノンバイナリー',
      4 => '未回答',
    ];
    ?>
    <p>
      性別<br>
      <?php foreach ($gendar_list as $key => $value): ?>
        <!-- 男性のラジオボタンだけにchecked属性を付けるには？ -->
        <input type="radio" name="gendar" id="gendar_<?php echo $key; ?>" value="<?php echo $key; ?>" 
        <?php
          if($key === 1){
            echo 'checked';
          }
        ?>
        >
        
        <label for="gendar_<?php echo $key; ?>"><?php echo $value; ?></label>
      <?php endforeach; ?>
    </p>
    <p>
      <?php
      $interest_list = [
        1 => 'デザイン',
        2 => 'プログラミング',
        3 => 'マーケティング',
        4 => '動画編集',
        5 => 'ライティング',
        6 => '写真撮影',
        7 => 'Web制作',
        8 => 'UI/UX',
        9 => 'データ分析',
        10 => '起業・ビジネス',
      ];
      ?>
      <label for="interest">興味のある分野</label><br>
      <select name="interest" id="interest">
        <option hidden>選択してください</option>
        <?php foreach ($interest_list as $key => $value): ?>
          <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <input type="submit" value="確認">
    </p>

  </form>
</body>

</html>