<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配列</title>
</head>

<body>
    <h1>配列</h1>

    <?php
    //配列の作成
    $friends = array('はるき', 'かおる', 'ひでと');

    echo $friends[0];
    //表示結果：はるき
    echo '<br>';

    //配列に値を追加（空箱ができない）
    $friends[] = 'まさとし';
    $friends[10] = 'たかのり';
    //表示結果：
    //[3]=>
    //string(12) "まさとし"
    //[10]=>
    //string(12) "たかのり"

    echo '<pre>'; //preで囲むと吐き出されたデータが改行された状態で表示される
    var_dump($friends);
    echo '</pre>';
    //表示結果：
    //array(3) {
    //  [0]=>
    //  string(9) "はるき"
    //  [1]=>
    //  string(9) "かおる"
    //  [2]=>
    //  string(9) "ひでと"
    // }

    ?>
</body>

</html>