<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員情報編集画面</title>
</head>

<body>
  <!-- http://localhost:8888/php_basic/06_forms/register/edit.php -->
  <h1>会員情報編集画面</h1>
  <?php
  require 'list/gendar_list.php';
  require 'list/interest_list.php';

  $id = $_GET['id'];
  $filename = './data/members.csv';

  $fp = fopen($filename,'r');
  $member_data = array();
  while($record = fgetcsv($fp)){
    if($record[0] == $id){
      $member_data = $record;
    }
  }

  echo '<pre>';
  var_dump($member_data);
    echo '</pre>';
  ?>
  <form action="edit_confirm.php" method="post">
    <p>
      <label for="user-name">名前</label><br>
      <input type="text" name="user-name" id="user-name" value="<?php echo $member_data[1]; ?>">
    </p>
    <p>
      <label for="email">メールアドレス</label><br>
      <input type="email" name="email" id="email" value="<?php echo $member_data[2]; ?>">
    </p>
    <p>
      <label for="birthday">生年月日</label><br>
      <input type="date" name="birthday" id="birthday" value="<?php echo $member_data[3]; ?>">
    </p>
    <p>
      <label for="password">パスワード</label><br>
      <input type="password" name="password" id="password" value="<?php echo $member_data[4]; ?>">
    </p>
    <p>
      性別<br>
      <?php foreach ($gendar_list as $key => $value): ?>
        <input type="radio" name="gendar" id="gendar_<?php echo $key; ?>" value="<?php echo $key; ?>" 
        <?php
          if($key == $member_data[5]){
            echo 'checked';
          }
        ?>
        >
        
        <label for="gendar_<?php echo $key; ?>"><?php echo $value; ?></label>
      <?php endforeach; ?>
    </p>
    <p>
      <label for="interest">興味のある分野</label><br>
      <select name="interest" id="interest">
        <option hidden>選択してください</option>
        <?php foreach ($interest_list as $key => $value): ?>
          <option value="<?php echo $key; ?>" 
          <?php
            if($key == $member_data[6]){
              echo 'selected';
            }
          ?>
          ><?php echo $value; ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <!-- 隠しフォームでIDをセット -->
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="button" value="前の画面に戻る" onclick="history.back()">
      <input type="submit" value="確認">
    </p>

  </form>
</body>

</html>