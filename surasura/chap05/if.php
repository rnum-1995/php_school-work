<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>条件分岐</title>
</head>

<body>
    <h1>条件分岐</h1>

    <?php
    $budget = 2000;
    if ($budget >= 1500) {
        echo "ピザを注文する";
    } else if ($budget >= 500) {
        echo "ポテトを注文する";
    } else {
        echo "節約する";
    }
    ?>

</body>

</html>