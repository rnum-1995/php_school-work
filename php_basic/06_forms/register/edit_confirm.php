<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';

require 'list/gendar_list.php';
require 'list/interest_list.php';

// タイムゾーンを設定する関数
date_default_timezone_set('Asia/Tokyo');

$id = $_POST['id'];
$user_name = $_POST['user-name'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$password = $_POST['password'];
$gendar = $_POST['gendar'];
$interest = $_POST['interest'];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta gendar="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員情報編集確認画面</title>
</head>

<body>
  <h1>会員情報編集確認画面</h1>

  <p>
    名前<br>
    <?php echo $user_name; ?>
  </p>
  <p>
    メールアドレス<br>
    <?php echo $email; ?>
  </p>
  <p>
    生年月日<br>
    <?php
    // strtotime(日時の文字列)...日時の文字列をUnixタイムスタンプに変換する
    // date(フォーマット文字列,タイムスタンプ)...タイムスタンプをフォーマットされた文字列に変換する
    echo $birthday . '<br>' . strtotime($birthday) . '<br>' . date('Y年n月j日', strtotime($birthday));
    ?>
  </p>
  <p>
    パスワード<br>
    <?php
    // mb_strlen(長さを知りたい文字列)...マルチバイト文字列の長さを得る関数
    for ($i = 0; $i < mb_strlen($password); $i++) {
      echo '⭐️';
    }
    ?>
  </p>
  <p>
    性別<br>
    <?php echo $gendar_list[$gendar]; ?>
  </p>
  <p>
    興味のある分野<br>
    <?php echo $interest_list[$interest]; ?>
  </p>
  <form action="./edit_complete.php" method="post">
    <!-- 隠しフォーム -->
    <input type="hidden" name="user-name" id="user-name" value="<?php echo $user_name; ?>">
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
    <input type="hidden" name="birthday" id="birthday" value="<?php echo $birthday; ?>">
    <input type="hidden" name="password" id="password" value="<?php echo $password; ?>">
    <input type="hidden" name="gendar" id="gendar" value="<?php echo $gendar; ?>">
    <input type="hidden" name="interest" id="interest" value="<?php echo $interest; ?>">
    <!-- ID情報を隠しフォームにセット -->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>
      <input type="button" value="前の画面に戻る" onclick="history.back()">
      <input type="submit" value="会員情報を編集">
    </p>
  </form>

</body>

</html>