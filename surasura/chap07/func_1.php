<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自作関数</title>
</head>

<body>
    <?php require './header.php'
    //「require」:これが処理されないと次の処理が実行されない
    ?>
    <?php
    include './function.php';
    echo get_price();
    //出力結果：デフォルト引数110
    echo '<br>';
    echo get_price(500);
    //出力結果：550
    ?>

</body>

</html>