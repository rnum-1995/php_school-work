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
        $fruits = ['りんご', 'みかん', 'バナナ',];
        echo '<pre>';
        var_dump($fruits);
        echo '</pre>';
        ?>
        <!-- ここまでPHPを書く -->
      </section>
      <section>
        <h3><code>$fruits</code>を使用して<code>echo</code>で「みかん」だけを表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          echo $fruits[1]
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3><code>$fruits</code>に「もも」と「ぶどう」を追加して、<code>echo</code>で「ぶどう」だけを表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          // 配列にデータを追加する方法３選
          $fruits[] = 'もも';
          // $fruits[4] = 'ぶどう';
          array_push($fruits, 'グレープフルーツ');
          echo $fruits[4];
          echo '<pre>';
          var_dump($fruits);
          echo '</pre>';
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>for文を使って<code>$fruits</code>に含まれる全ての果物を1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          // count()関数...配列のデータの数を返す関数
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

        echo '<pre>';
        var_dump($exam_scores);
        echo '</pre>';
        ?>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          echo $exam_scores['井川']['数学'];
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
          // 繰り返し使わないパターン
          echo '<p>国語：' . $exam_scores['浦野']['国語'] . '点 | ' . '数学：' . $exam_scores['浦野']['数学'] . '点 | ' . '英語：' . $exam_scores['浦野']['英語'] . '点</p>';

          // foreachのパターン
          echo '<p>';
          foreach ($exam_scores['浦野'] as $key => $score) {
            echo $key . '：' . $score . '点';
            // あんまり良くないパターン
            // if($key !== '英語'){
            //   echo ' | ';
            // }

            // array_key_last()...配列の最後の要素のキーを返す関数
            if ($key !== array_key_last($exam_scores['浦野'])) {
              echo ' | ';
            }
          }
          echo '</p>';
          ?>
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
            <tr>
              <td>阿部</td>
              <td>90</td>
              <td>65</td>
              <td>84</td>
              <td>239</td>
            </tr>
            <tr>
              <td>井川</td>
              <td>78</td>
              <td>98</td>
              <td>67</td>
              <td>243</td>
            </tr>
            <tr>
              <td>浦野</td>
              <td>76</td>
              <td>48</td>
              <td>92</td>
              <td>216</td>
            </tr>
          </tbody>
        </table>
        <div class="answer">
          <!-- ここからPHPを書く -->
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
              <?php foreach ($exam_scores as $name => $row): ?>
                <tr>
                  <td><?php echo $name; ?></td>
                  <?php
                  // 合計点数を入れる変数
                  $total_score = 0;
                  foreach ($row as $score):
                    // 合計点数を足しこむ
                    $total_score += $score;
                    // echo $total_score;
                  ?>
                    <td><?php echo $score; ?></td>
                  <?php endforeach; ?>
                  <td><?php echo $total_score; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- ここまでPHPを書く -->
        </div>
      </section>

    </section>
  </article>

</body>

</html>