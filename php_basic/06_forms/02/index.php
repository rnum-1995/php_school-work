<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>06_forms: フォームの練習2</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <article>
    <h1>06_forms: フォームの練習2</h1>
    <section>
      <h2>POST送信</h2>
      <section>
        <h3>送信ボタンをクリックしたら、recive.phpに「[入力した名前]さんの年齢は[入力した年齢]歳です」と表示されるように、受信したデータを使用して表示してください。</h3>
        <form action="#" method="post">
          <p>
            名前: <input type="text" name="name" id="name">
          </p>
          <p>
            年齢: <input type="number" name="age" id="age">
          </p>
          <p>
            <input type="submit" value="送信ボタン">
          </p>
        </form>
      </section>
    </section>
  </article>

</body>

</html>