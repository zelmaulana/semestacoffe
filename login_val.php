<?php
session_start();
$admin = md5('admin');
$user = md5('user');
switch ($_GET['lv']) {
    case "1":
        header ("Location: $admin/?i=");
        break;
    case "2":
        header ("Location: $user/?i=");
        break;
    default:
        header ("Location: ");
}
?>