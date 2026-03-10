<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>06_forms: フォームの練習1</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <article>
    <h1>06_forms: フォームの練習1</h1>
    <section>
      <h2>GET送信</h2>
      <section>
        <?php
        // ここからPHPを書く
        // 送信されたデータを受け取り
        // var_dump($_GET);
        $name = $_GET['name'];
        $age = $_GET['age'];
        echo '<p>'.$name.'さんの年齢は'.$age.'歳です</p>';
        ?>
      </section>
    </section>
  </article>
</body>


</html>