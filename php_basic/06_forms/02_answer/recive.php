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
        <?php
        // ここからPHPを書く
        // var_dump($_POST);
        var_dump($_POST);
        $name = $_POST['name'];
        $age = $_POST['age'];
        echo '<p>'.$name.'さんの年齢は'.$age.'歳です。</p>';
        ?>
      </section>
    </section>
  </article>
</body>


</html>