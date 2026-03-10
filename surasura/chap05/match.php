<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>繰り返し（match式）</title>
</head>

<body>
    <h1>繰り返し（match式）</h1>

    <?php
    $season = 'spring';
    $message = $season . 'は、日本語で';

    //
    $message .= match ($season) {
        'spring' => '「春」です。',
        'summer' => '「夏」です。',
        'autumn' => '「秋」です。',
        'winter' => '「冬」です。'
    };

    echo $message;
    ?>

</body>

</html>