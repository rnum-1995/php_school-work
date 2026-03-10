<?php
//データを受け取るファイル
echo '<pre>';
var_dump($_POST);
echo '</pre>';

$gender_array = [
    'man' => '男性',
    'woman' => '女性'
];

//$_POSTからデータを取り出す
$name = $_POST['name'];
// $gender = $_POST['gender'];
// if ($gender === 'man') {
//     $gender = '男性';
// } else if ($gender === 'woman') {
//     $gender = '女性';
// }else{
// $gender = '不正な値です';
// header('location:enquete.php);
// }
$gender = $gender_array[$_POST['gender']];
$star_num = $_POST['star'];
$star = '';
for ($i = 0; $i < $star_num; $i++) {
    $star .= '★';
}
for (; $i < 5; $i++) {
    $star .= '☆';
}
$other = $_POST['other'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アンケート結果</title>
</head>

<body>
    <h1>アンケート結果</h1>
    <p>お名前：<?php echo $name; ?></p>
    <p>性別：<?php echo $gender; ?></p>
    <p>評価：<?php echo $star; ?></p>
    <p>ご意見：<?php echo nl2br($other); ?></p>
    <p>
        <a href="enquete.php">アンケートページへ戻る</a>
    </p>
</body>

</html>