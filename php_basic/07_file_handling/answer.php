<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>07_file_handling: ファイル操作の練習</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <article>
    <h1>07_file_handling: ファイル操作の練習</h1>
    <section>
      <h2>ファイルの作成</h2>
      <section>
        <h3>PHPを使い<code>message.txt</code>というファイルを作成し「ファイル書き込み」という文字列を書き込んでください。</h3>
        <!-- ここからPHPを書く -->
        <?php
        // $fp = fopen('message.txt', 'w');
        // fwrite($fp, 'ファイル書き込み');
        // fclose($fp);
        file_put_contents('message.txt', 'ファイル書き込み');
        ?>
        <!-- ここまでPHPを書く -->
      </section>
    </section>
    <section>
      <h2>ファイルの読み込み</h2>
      <section>
        <h3>PHPを使い<code>data.txt</code>を読み込んで内容を全て<em>1行ずつ</em>表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          $fp = fopen('data.txt', 'r');
          while ($text = fgets($fp)) {
            echo "<p>$text</p>";
          }
          fclose($fp);
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
    <section>
      <h2>CSVファイルの取り扱い</h2>
      <section>
        <h3>PHPを使い<code>products.csv</code>を1行目だけ読み込んで表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          $fp = fopen('products.csv', 'r');
          $record = fgetcsv($fp);
          fclose($fp);
          foreach ($record as $data) {
            echo $data;
          }

          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>PHPを使い<code>products.csv</code>を読み込んで全ての内容を1行ずつ表示してください。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          $fp = fopen('products.csv', 'r');
          while ($record = fgetcsv($fp)): ?>
            <p>
              <?php
              foreach ($record as $data) {
                echo $data;
              }
              ?>
            </p>
          <?php
          endwhile;
          fclose($fp);
          ?>
          <!-- ここまでPHPを書く -->
        </div>
      </section>
      <section>
        <h3>PHPを使い<code>products.csv</code>を読み込んでテーブルで表示してください。ただし、CSVファイルの1行目はテーブルの見出し行とすること。</h3>
        <div class="answer">
          <!-- ここからPHPを書く -->
          <?php
          $fp = fopen('products.csv', 'r');
          if ($fp) :
            $header = fgetcsv($fp);
            if (!feof($fp)) :
              $record_array = array();
          ?>
              <table>
                <thead>
                  <tr>
                    <?php foreach ($header as $value): ?>
                      <th><?php echo $value; ?></th>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($record = fgetcsv($fp)) {
                    $record_array[] = $record;
                  }
                  fclose($fp);
                  ?>
                  <?php foreach ($record_array as $record): ?>
                    <tr>
                      <?php foreach ($record as $field): ?>
                        <td><?php echo $field; ?></td>
                      <?php endforeach; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

            <?php else: ?>
              <p>データがありません。</p>
            <?php endif; ?>
          <?php else: ?>
            <p>ファイルがありません。</p>
          <?php endif; ?>

          <!-- ここまでPHPを書く -->
        </div>
      </section>
    </section>
  </article>

</body>

</html>