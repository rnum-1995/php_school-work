<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>04_loops: 繰り返し処理の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>04_loops: 繰り返し処理の練習</h1>
    <section>
      <h2>for文の練習</h2>
      <section>
        <h3>変数<code>$i</code>を利用して1から10までの数値を1行ずつ表示してください</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          // http://localhost:8888/php_basic/04_loops/
          // p.87参照
          for ($i = 1; $i <= 10; $i++) {
            echo $i . '<br>';
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>1から100までの数値のうち、3の倍数のみを1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          // まずは1から100までを1行ずつ表示する。
          for ($i = 1; $i <= 100; $i++) {
            // 3の倍数 -> 3で割り切れる数 -> 3で割った余りが0
            if ($i % 3 === 0) {
              echo $i . '<br>';
            }
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
    <section>
      <h2>while文の練習</h2>
      <section>
        <h3>変数<code>$i</code>を利用して1から10までの数値を1行ずつ表示してください(無限ループに注意！)</h3>
        <div class="answer">
          <?php
          $i = 1;
          ?>
          <!-- ここからPHPを書く -->
          <?php
          // p.91参照
          while ($i <= 10) {
            echo $i . '<br>';
            $i++;
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3><code>random_int()</code>関数を使って1〜7の乱数を繰り返し生成し変数<code>$num</code>へ代入して、**「7が出たら終了」**という条件で、出た数字をすべて表示してください。</h3>
        <div class="answer">
          <?php
          $num = 1;
          ?>
          <!-- ここからPHPを書く -->
          <?php
          while ($num !== 7) {
            $num = random_int(1, 7);
            echo $num . '<br>';
          }
          echo '<p>7が出たので終了</p>';
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>

    </section>
    <section>
      <h2>FizzBuzzの練習</h2>
      <section>
        <h3>1から100までの数字を順番に出力してください。ただし、以下のルールに従って出力を変えてください。</h3>
        <ul>
          <li>3の倍数のときは「Fizz」と表示する</li>
          <li>5の倍数のときは「Buzz」と表示する</li>
          <li>3と5の両方の倍数のときは「FizzBuzz」と表示する</li>
          <li>上記のいずれにも当てはまらないときは数字をそのまま表示する</li>
        </ul>
        <p>※for文、while文どちらで書いてもOKです</p>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          for ($i = 1; $i <= 100; $i++) {
            if ($i % 15 === 0) {
              echo 'FizzBuzz<br>';
            } elseif ($i % 5 === 0) {
              echo 'Buzz<br>';
            } elseif ($i % 3 === 0) {
              echo 'Fizz<br>';
            } else {
              echo $i . '<br>';
            }
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
  </article>

</body>

</html>