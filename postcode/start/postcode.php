<?php
$fp = fopen('csv/utf_ken_all.csv', 'r');

while ($row = fgetcsv($fp)) {
    if ($_GET['zipcode'] === $row[2]) {
        $data = $row;
        break;
    }
}
// echo json_encode($data, JSON_UNESCAPED_UNICODE);
if (!empty($data)) {
    $json = [
        'status' => 200,
        'message' => null,
        'results' => [
            [
                'zipcode' => $data[2],
                'address1' => $data[6],
                'address2' => $data[7],
                'address3' => $data[8],
                'kana1' => $data[3],
                'kana2' => $data[4],
                'kana3' => $data[5],
                'prefcode' => mb_substr($data[0], 0, 2),
            ],
        ],
    ];
    // var_dump($json)
} else {
    $json = [
        'status' => 400,
        'message' => '住所の取得に失敗しました。',
        'results' => null,
    ];
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
