<?php
// $fp = fopen("drinks.csv", "r");

// while ($row = fgetcsv($fp)) {
//     echo "<pre>";
//     var_dump($row);
//     echo "</pre>";
// }

// fclose($fp);
$fp = fopen("drinks.csv", "r");
$drinksArray = array();
while ($row = fgetcsv($fp)) {
    $drinksArray[] = $row;
}
fclose($fp);
$drinksArray[4] = ["レモンティー", 300, 20];
echo "<pre>";
var_dump($drinksArray);
echo "</pre>";

$fp = fopen("drinks.csv", "w");
foreach ($drinksArray as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSVファイルの取り扱い</title>
</head>

<body>
    <h1>CSVファイルの取り扱い</h1>
    <?php
    // 0. drinks.csvを読み込みモードで開く
    $fp = fopen("drinks.csv", "r");
    // 1. 1行目のみを変数($table_header)に代入
    $table_header = fgetcsv($fp);
    // echo "<pre>";
    // var_dump($table_header);
    // echo "</pre>";
    // 2. <thead>...</thead>を作る
    ?>
    <table>
        <thead>
            <tr>
                <?php foreach ($table_header as $text): ?>
                    <th><?php echo $text; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // 3.二行目以降を読み込んで<tr>...</tr>を作る
            while ($row = fgetcsv($fp)):
                // echo "<pre>";
                // var_dump($row);
                // echo "</pre>";
            ?>
                <tr>
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?>円</td>
                    <td><?php echo $row[2]; ?>個</td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>