<html>

<head>
  <meta charset="UTF-8">
  <title>アンケート送信テスト</title>
</head>

<body>
  <h1>アンケートフォーム</h1>
  <form action="confirm.php" method="post">
    <p>お名前：<input type="text" name="name"></p>
    <p>性別：
      <input type="radio" name="gender" value="man"> 男性
      <input type="radio" name="gender" value="woman"> 女性
    </p>
    <p>評価：
      <select name="star">
        <?php
        //for文でoptionタグを表示例のように作成
        //定数の定義
        define('MAX_STAR_LENGTH', 5);
        //1. optionタグの(value属性付)を5つ作成
        for ($i = 1; $i <= MAX_STAR_LENGTH; $i++) :
          $stars = '';
          //2. optionタグの中の★を描画
          for ($j = 1; $j <= $i; $j++) {
            $stars .= '★';
          }
          //3. optionタグの中の☆を描画
          for ($k = 1; $k <= (MAX_STAR_LENGTH - $i); $k++) {
            $stars .= '☆';
          }
        ?>
          <option value="<?php echo $i; ?>"><?php echo $stars ?></option>
        <?php endfor ?>

        <!--
        【表示例】 
        <option value="1">★☆☆☆☆</option>
        <option value="2">★★☆☆☆</option>
        <option value="3">★★★☆☆</option>
        <option value="4">★★★★☆</option>
        <option value="5">★★★★★</option>
        -->
      </select>
    </p>
    <p>ご意見</p>
    <p><textarea name="other"></textarea></p>
    <input type="submit" value="送信">
  </form>
</body>

</html>