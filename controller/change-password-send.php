<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";
require_once('../model/User.php');

if (isset($_COOKIE['user']) && isset($_POST['new-password'])) {
    $userId = $_COOKIE['user'];
    $password = $_POST['new-password'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$password = password_hash($password, PASSWORD_BCRYPT);

User::changeUserPassword($userId, $password);

header('Location:' . $GLOBALS['dir'] . '/');


