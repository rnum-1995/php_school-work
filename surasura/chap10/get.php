<?php
$page = $_GET['page']; //スーパーグローバル変数
echo 'リクエストされたページは「' . $page . '」です。';


$name = $_GET['name'];
$age = $_GET['age'];

echo '<br>';
echo '私の名前は「' . $name . '」です。年齢は「' . $age . '」です。';
