<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員一覧画面</title>
</head>

<body>
  <h1>会員一覧</h1>
  <p>
    <a href="./form.php">新規会員登録</a>
  </p>

  <?php
  $filename = './data/members.csv';
  $fp = fopen($filename, 'r');
  if (flock($fp, LOCK_EX)):
    $header = fgetcsv($fp);
  ?>
    <table>
      <thead>
        <tr>
          <th><?php echo $header[0]; ?></th>
          <th><?php echo $header[1]; ?></th>
          <th><?php echo $header[7]; ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($record = fgetcsv($fp)):
        // 追記：削除済メンバーを非表示にする
          if ($record[8] == 'false'):
        ?>
            <tr>
              <td><?php echo $record[0]; ?></td>
              <td><a href="member.php?id=<?php echo $record[0]; ?>"><?php echo $record[1]; ?></a></td>
              <td><?php echo date('Y年n月j日', strtotime($record[7])); ?></td>
            </tr>
        <?php
          endif;
        endwhile; ?>
      </tbody>
    </table>
  <?php
    flock($fp, LOCK_UN);
  else:
    echo 'ファイルロックに失敗しました。';
  endif;
  fclose($fp);
  ?>
  <!-- 表示例 -->
  <!-- <table>
      <thead>
        <tr>
          <th>会員ID</th>
          <th>名前</th>
          <th>登録日</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><a href="member.php?id=1">山田</a></td>
          <td>2025年7月8日</td>
        </tr>
        <tr>
          <td>2</td>
          <td><a href="member.php?id=2">吉田</a></td>
          <td>2025年7月8日</td>
        </tr>
      </tbody>
    </table> -->
</body>

</html>