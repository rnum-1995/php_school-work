<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST送信</title>
</head>

<body>
    <h1>POST送信</h1>
    <form action="receive.php" method="post"> <!-- 「method」が省略された場合は「get」になる -->
        <p>
            <input type="text" name="user_name" id="user_name" placeholder="お名前">
        </p>
        <p>
            <input type="radio" name="age" id="age1" value="20">20代
            <input type="radio" name="age" id="age2" value="30">30代
            <input type="radio" name="age" id="age3" value="40">40代
            <input type="radio" name="age" id="age4" value="50">50代
        </p>
        <p>
            <textarea name="message" id="message" placeholder="メッセージ"></textarea>
        </p>
        <p>
            <textarea name="message" id="message" placeholder="メッセージ"></textarea>
        </p>
        <p>
            <input type="submit" value="送信する">
        </p>
    </form>
</body>

</html>