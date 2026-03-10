<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>03_conditions: 条件分岐の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>03_conditions: 条件分岐の練習</h1>
    <section>
      <h2>課題内容</h2>
      <p>条件分岐の練習をしましょう。 </p>
      <section>
        <h3>変数<code>$age</code>には15から80までの年齢の数値がランダムに代入されます。年齢に応じて以下の条件でメッセージを出力してください</h3>
        <dl>
          <div class="desc-item">
            <dt>20歳未満</dt>
            <dd>「未成年です」</dd>
          </div>
          <div class="desc-item">
            <dt>20歳以上65歳未満</dt>
            <dd>「成人です」</dd>
          </div>
          <div class="desc-item">
            <dt>65歳以上</dt>
            <dd>「シニア世代です」</dd>
          </div>
        </dl>
        <?php
        $age = random_int(15, 80);
        ?>
        <div class="answer">
          <?php
          echo '<p>変数$ageの中身は' . $age . 'です。</p>';
          ?>
          <!-- ここからPHPを書く -->
          <?php
          if ($age < 20) {
            echo '未成年です';
          } elseif ($age >= 20 && $age < 65) {
            echo '成人です';
          } else {
            echo 'シニア世代です';
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
  </article>

</body>

</html>