<?php
session_start();
if (isset($_SESSION['id'])) {
    //変数の削除
    unset($_SESSION['id']);
}
header('location:login.php');
