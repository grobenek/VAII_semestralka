<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

require_once('../model/User.php');

$email = null;
$password = null;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if (!empty($email) && !empty($password)) {

    $userInformation = User::verifyUser($email, $password);

    if (password_verify($password, $userInformation['password'])) {
        setcookie('user', $userInformation['userId'], time() + 60 * 60 * 24, "/");
        setcookie('userAdmin', $userInformation['isAdmin'], time() + 60 * 60 * 24, "/");
    } else {
        header('Location:' . $GLOBALS['dir'] . '/login/login.php?e=Invalid login!');
        return;
    }
} else {
    header('Location:' . $GLOBALS['dir'] . '/login/login.php?e=Email or password is empty!');
    return;
}
header('Location:' . $GLOBALS['dir'] . '/index.php');