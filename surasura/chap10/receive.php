<?php
//データを受け取るファイル
echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>

<p>お名前：<?php echo $_POST['user_name']; ?></p>
<p>年代：<?php echo $_POST['age']; ?>代</p>
<p>メッセージ：<?php echo nl2br($_POST['message']); ?></p>