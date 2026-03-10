<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>02_operators: 演算子の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>02_operators: 演算子の練習</h1>
    <section>
      <h2>課題内容</h2>
      <p>算術演算子の使い方を確認しましょう。 </p>
      <section>
        <h3>次の変数の値を使って出力例を参考に計算結果をブラウザに表示してください。</h3>
        <?php
        $num15 = 15;
        $num4 = 4;
        ?>
        <div class="answer">
          <!--
            ※出力例
            <p>15 + 4 = 19</p>
            <p>15 - 4 = 11</p>
            <p>15 × 4 = 60</p>
            <p>15 ÷ 4 = 3.75</p>
            <p>15を4で割った余りは3です</p>
          -->
          <!-- ここからPHPを書く -->
          <?php
          echo '<p>' . $num15 . ' + ' . $num4 . ' = ' . $num15 + $num4 . '</p>';
          echo '<p>' . $num15 . ' - ' . $num4 . ' = ' . $num15 - $num4 . '</p>';
          echo '<p>' . $num15 . ' × ' . $num4 . ' = ' . $num15 * $num4 . '</p>';
          echo '<p>' . $num15 . ' ÷ ' . $num4 . ' = ' . $num15 / $num4 . '</p>';
          echo '<p>'.$num15.'を'.$num4.'で割った余りは'.$num15 % $num4.'です</p>';
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
  </article>

</body>

</html>