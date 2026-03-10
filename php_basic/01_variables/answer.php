<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>01_variables: PHPの変数とデータ型</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <!-- http://localhost:8888/php_basic/01_variables/ -->
  <article>
    <h1>01_variables: PHPの変数とデータ型</h1>
    <section>
      <h2>課題内容</h2>
      <p>自己紹介をPHPで作成しましょう。以下の要素をすべて含めてください。</p>
      <section>
        <h3>以下の情報を変数に格納してください。</h3>
        <ul>
          <li>名前(文字列)</li>
          <li>年齢(数値)</li>
          <li>出身地(文字列)</li>
          <li>趣味(文字列)</li>
        </ul>
        <!-- ここからPHPを書く -->
        <?php
        $name = "山田太郎";
        $age = 20;
        $place = "福岡県";
        $hobby = "映画鑑賞";
        ?>
        <!-- ここまでPHPを書く -->
      </section>
      <section>
        <h3>1問目で定義した変数を用いて出力例にあるような文章を出力してください。</h3>
        <!--
        ※出力例
        <p>こんにちは、山田太郎です。</p>
        <p>年齢は20歳です。</p>
        <p>出身地は福岡県です。</p>
        <p>趣味は映画鑑賞です。</p>
        -->
        <div class="answer">
          <!-- ここから2問目のPHPを書く -->
          <?php
          echo '<p class="name">こんにちは、' . $name . 'です。</p>';
          echo '<p>年齢は' . $age . '歳です。</p>';
          echo '<p>出身地は' . $place . 'です。</p>';
          echo '<p>趣味は' . $hobby . 'です。</p>';
          ?>
          <!-- ここまで2問目のPHPを書く -->
        </div>
      </section>
    </section>
  </article>

</body>

</html>