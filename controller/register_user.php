<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

require_once('../model/User.php');

$email = null;
$password = null;
$login = null;
$aboutUser = null;

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login']) && isset($_POST['aboutUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $_POST['login'];
    $aboutUser = $_POST['aboutUser'];

    $password = password_hash($password, PASSWORD_BCRYPT);
}

if (!empty($email) && !empty($password) && !empty($login) && !empty($aboutUser)) {

    $returnedUser = User::registerUser($login, $password, $email, $aboutUser);

    $userId = $returnedUser['userId'];

    if (is_numeric($userId)) {
        setcookie('user', $userId, time() + 60 * 60 * 24, "/");
    } else {
        header('Location:' . $GLOBALS['dir'] . '/login/register.php?e=Register could not be completed! ' . $userId);
    }
}
header('Location:' . $GLOBALS['dir'] . '/index.php');