<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>05_arrays: 配列の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>05_arrays: 配列の練習</h1>
    <section>
      <h2>一次元配列の練習</h2>
      <section>
        <h3>「りんご」「みかん」「バナナ」の3つの値が入っている配列<code>$fruits</code>を作成してください。</h3>
        <!-- ここからPHPを書く -->
        <?php
        $fruits = ['りんご', 'みかん', 'バナナ'];
        ?>
        <!-- ここまでPHPを書く -->
      </section>

      <section>
        <h3><code>$fruits</code>を使用して<code>echo</code>で「みかん」だけを表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          echo $fruits[1];
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>

      <section>
        <h3><code>$fruits</code>に「もも」と「ぶどう」を追加して、<code>echo</code>で「ぶどう」だけを表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          $fruits = ['りんご', 'みかん', 'バナナ'];
          $fruits[] = 'もも';
          array_push($fruits, 'ぶどう');
          echo $fruits[4];
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>for文を使って<code>$fruits</code>に含まれる全ての果物を1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          for ($i = 0; $i < count($fruits); $i++) {
            echo $fruits[$i] . '<br>';
          }
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
    <section>
      <h2>多次元配列の練習</h2>
      <section>
        <h3>配列<code>$exam_scores</code>は3人の生徒の試験結果のデータが格納された多次元配列です。井川さんの数学の点数を表示してください。</h3>
        <?php
        $exam_scores = array(
          '阿部' => array('国語' => 90, '数学' => 65, '英語' => 84,),
          '井川' => array('国語' => 78, '数学' => 98, '英語' => 67,),
          '浦野' => array('国語' => 76, '数学' => 48, '英語' => 92,),
        );
        ?>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          echo $exam_scores['井川']['数学'] . '点';
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>配列<code>$exam_scores</code>から浦野さんの各教科の点数を以下のように表示させてください。</h3>
        <p>国語: 76点 | 数学: 48点 | 英語: 92点</p>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          // 繰り返し使用パターン
          foreach ($exam_scores['浦野'] as $subject => $score) {
            echo $subject . ':' . $score . '|' . '点';
          }
          ?>
          <!-- 繰り返ししないパターン-->
          <p>
            国語: <?php echo $exam_scores['浦野']['国語'] . '点' ?> |
            数学: <?php echo $exam_scores['浦野']['数学'] . '点' ?> |
            英語: <?php echo $exam_scores['浦野']['英語'] . '点' ?>
          </p>
          <!-- ここまでPHPを書く -->
        </div>
      </section>

      <section>
        <h3>配列<code>$exam_scores</code>から全員の点数を以下のテーブルのように表示してください。</h3>
        <table>
          <thead>
            <tr>
              <th>名前</th>
              <th>国語</th>
              <th>数学</th>
              <th>英語</th>
              <th>合計</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($exam_scores as $name => $row):
              $total_score = 0;
            ?>
              <tr>
                <td><?php echo $name; ?></td>
                <?php
                foreach ($row as $score):
                  $total_score += $score;
                ?>
                  <td><?php echo $score; ?></td>
                <?php endforeach ?>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <div class="answer">
          <!-- ここからPHPを書く -->

          <!-- ここまでPHPを書く -->
        </div>
      </section>

    </section>
  </article>

</body>

</html>