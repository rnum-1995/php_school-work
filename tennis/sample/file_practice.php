<?php
// ファイルを開く
/*  
 ファイルを開くモード
 r: 読み込み専用(read)
 r+: 読み書き(read)
 w: 書き込み専用(write)(新規作成)
 w+: 読み書き(write)
 a: 追記(append)
 a⁺: 読み書き(append)
*/
$fp = fopen("info.txt", "r");

// ファイルを1行読み込む
echo fgets($fp);
echo "<br>";
while($line = fgets($fp)){
    echo $line."<br>";
}

// ファイルを閉じる
fclose($fp);

// file_get_contents()の応用
// $text = file_get_contents("https://sozosha-rs.jp/");

// echo nl2br(htmlspecialchars($text,ENT_QUOTES,"utf-8"));

// ファイルへの書き込み
$filename = "test.txt";

// file_exists($filename)
// ファイルやディレクトリの存在確認
if(!file_exists($filename)){
    $fp = fopen($filename,"w");
}else{
    $fp = fopen($filename,"a");
}

if($fp){
    fwrite($fp,"書き込みテスト");
    fclose($fp);
}else{
    echo "ファイルが開けませんでした。";
}

// まとめて書きこむ
file_put_contents("test2.txt","書き込みテスト2",FILE_APPEND);
