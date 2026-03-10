<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員情報詳細画面</title>
</head>

<body>
  <h1>会員詳細</h1>
  <?php
  // 外部ファイルの読み込み
  require 'list/gendar_list.php';
  require 'list/interest_list.php';

  $id = $_GET['id'];
  // echo $id;
  $filename = './data/members.csv';
  $fp = fopen($filename, 'r');

  if (flock($fp, LOCK_EX)):
    $header = fgetcsv($fp);
    // 画面に表示する一行分のデータを格納する変数
    $line;
    while ($record = fgetcsv($fp)):
      // 受け取ったIDのレコードを$lineに代入
      if ($record[0] === $id) {
        $line = $record;
      }
    endwhile;
    // echo '<pre>';
    // var_dump($line);
    // echo '</pre>';
  ?>
    <dl>
      <!-- 反復処理で書いたらどうなりますか？ -->
      <?php
      foreach ($header as $key => $value):
      ?>
        <dt><?php echo $value; ?></dt>
        <dd>
          <?php
          if ($key == 3 || $key == 7) {
            echo date('Y年n月j日', strtotime($line[$key]));
          } elseif ($key == 4) {
            for ($i = 0; $i < mb_strlen($line[$key]); $i++) {
              echo '*';
            }
          } elseif ($key == 5) {
            echo $gendar_list[$line[$key]];
          } elseif ($key == 6) {
            echo $interest_list[$line[$key]];
          } else {
            echo $line[$key];
          }
          ?>
        </dd>
      <?php endforeach; ?>
      <a href="edit.php?id=<?php echo $id; ?>">編集</a>
      <a href="delete.php?id=<?php echo $id; ?>">削除</a>
      <a href="index.php">会員一覧に戻る</a>
      <!-- <dt><?php echo $header[0] ?></dt>
      <dd><?php echo $line[0] ?></dd>
      <dt><?php echo $header[1] ?></dt>
      <dd><?php echo $line[1] ?></dd>
      <dt><?php echo $header[2] ?></dt>
      <dd><?php echo $line[2] ?></dd>
      <dt><?php echo $header[3] ?></dt>
      <dd><?php echo $line[3] ?></dd>
      <dt><?php echo $header[4] ?></dt>
      <dd><?php echo $line[4] ?></dd>
      <dt><?php echo $header[5] ?></dt>
      <dd><?php echo $line[5] ?></dd>
      <dt><?php echo $header[6] ?></dt>
      <dd><?php echo $line[6] ?></dd>
      <dt><?php echo $header[7] ?></dt>
      <dd><?php echo $line[7] ?></dd> -->
    </dl>

  <?php
  // ファイルロック解除
  else:
    echo 'ファイルロックに失敗しました。';
  endif;
  // ファイルクローズ
  ?>

  <!-- <dl>
    <dt>id</dt>
    <dd>1</dd>
    <dt>名前</dt>
    <dd>山田</dd>
    <dt>メールアドレス</dt>
    <dd>yamada@mail.com</dd>
    <dt>生年月日</dt>
    <dd>1999年1月1日</dd>
  </dl> -->
</body>

</html>