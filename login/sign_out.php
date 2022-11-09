<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

if (isset($_COOKIE['user'])) {
    unset($_COOKIE['user']);
    setcookie('user', "", time()-3600, '/');
}
header('Location:'.$GLOBALS['dir'].'/index.php');