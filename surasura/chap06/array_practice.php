<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配列の練習</title>
</head>

<body>
    <h1>配列の練習</h1>
    <?php
    $team_a = [
        1 => [
            "name" => "江原",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "福永",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "村田",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "松永",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_b = [
        1 => [
            "name" => "梅崎",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "大古場",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "小池",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "小倉",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_c = [
        1 => [
            "name" => "兵藤",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "松原",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "松浦",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "永田",
            "role" => "フロントエンドエンジニア"
        ],
    ];
    $team_d = [
        1 => [
            "name" => "岸本",
            "role" => "ディレクター"
        ],
        2 => [
            "name" => "環",
            "role" => "デザイナー"
        ],
        3 => [
            "name" => "小松",
            "role" => "プログラマー"
        ],
        4 => [
            "name" => "横田",
            "role" => "フロントエンドエンジニア"
        ],
    ];

    $room_6c = [
        "A" => $team_a,
        "B" => $team_b,
        "C" => $team_c,
        "D" => $team_d,
    ];

    echo '<pre>';
    var_dump($room_6c);
    echo '</pre>';
    ?>

    <?php
    //----------------------------------------------------
    //1. $room_6cのみを使って「岸本」と段落で表示
    echo $room_6c["D"][1]["name"];
    // echo '<p>' . '岸本' . '</p>';
    ?>

    <?php
    //----------------------------------------------------
    //2. $room_6cのみを使ってAチームのメンバー情報を説明リストで表示
    ?>


    <?php
    //----------------------------------------------------
    //3. $room_6cのみを使ってAチームのメンバー情報を説明リストで表示
    ?>
    <dl>
        <?php
        // echo '<pre>';
        // var_dump($room_6c['A']);
        // echo '</pre>';

        foreach ($room_6c['A'] as $member): ?>
            <dt><?php echo $member['name']; ?></dt>
            <dd><?php echo $member['role']; ?></dd>
        <?php endforeach; ?>
    </dl>


    <?php
    //----------------------------------------------------
    //4. $room_6cのみを使って全チームの中からプログラマーの人の名前のみを箇条書きで表示
    ?>
    <ul>
        <?php
        foreach ($room_6c as $team):
            foreach ($team as $member):
                //もし役割が「プログラマー」だったらli要素と名前を表示する
                if ($member['role'] === 'プログラマー'):
        ?>
                    <li><?php echo $member['name']; ?></li>
        <?php
                endif;
            endforeach;
        endforeach;
        ?>
    </ul>

    <ul>
        <?php
        foreach ($room_6c as $team):
            foreach ($team as $member):
                echo ($member['role'] === 'プログラマー') ? '<li>' . $member['name'] . ':' . $member['role'] . '</li>' : '';
            endforeach;
        endforeach;
        ?>
    </ul>


    <?php
    //----------------------------------------------------
    //5. $room_6cのみを使って全員をテーブルで表示
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>チーム名</th>
                <th>名前</th>
                <th>役割</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($room_6c as $team_name => $team):
                foreach ($team as $member):
            ?>
                    <tr>
                        <td><?php echo $team_name; ?></td>
                        <td><?php echo $member['name']; ?></td>
                        <td><?php echo $member['role']; ?></td>
                    </tr>
            <?php
                endforeach;
            endforeach;
            ?>
        </tbody>
    </table>


    <!-- 1.と同様の書き方 -->
    <!-- <p><?php echo $room_6c['D'][1]['name'] ?></p> -->


</body>


</html>