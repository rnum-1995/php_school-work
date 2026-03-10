<?php
//消費税計算関数
function get_price($price = 100)
{
    $total_price = '￥' . round($price * 1.1); //「round関数」：四捨五入する関数
    return $total_price;
}
