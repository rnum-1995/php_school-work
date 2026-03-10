<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>多次元配列</title>
</head>

<body>
    <h1>多次元配列</h1>

    <?php
    $class1 = ['はるき', 'かおる', 'ひでと'];
    $class2 = ['ゆきこ', 'ゆか', 'まなみ'];

    $students = [$class1, $class2];

    echo '<pre>';
    var_dump($students);
    echo '</pre>';

    echo $students[0][1];
    ?>
</body>

</html>