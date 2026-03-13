<?php
date_default_timezone_set('Asia/Tokyo');
$target_date = '2026-03-09 10:23:54';
// 1. strtotime関数で日付の文字列をUnixタイムスタンプに変換する
$timestamp = strtotime($target_date);
echo $timestamp;
echo '<br>';
// 2. date関数でタイムスタンプをフォーマットする
// echo date('Y年n月j日 H時i分s秒',$timestamp);
echo date('Y年n月j日 H時i分s秒', strtotime($target_date));
