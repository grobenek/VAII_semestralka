<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

$email = null;
$password = null;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
//    hash password
//    $password = password_hash($password, PASSWORD_BCRYPT);
}

if (!empty($email) && !empty($password)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/user/verify/email/' . $email,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $userInformation = json_decode(curl_exec($curl), true);

    curl_close($curl);

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