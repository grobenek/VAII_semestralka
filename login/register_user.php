<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

$email = null;
$password = null;
$login = null;
$aboutUser = null;

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login']) && isset($_POST['aboutUser'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $_POST['login'];
    $aboutUser = $_POST['aboutUser'];
//    hash password
    $password = password_hash($password, PASSWORD_BCRYPT);

//    var_dump($email);
//    echo("\n");
//    var_dump($password);
//    echo("\n");
//    var_dump($login);
//    echo("\n");
//    var_dump($aboutUser);
//    echo("\n");
}

if (!empty($email) && !empty($password) && !empty($login) && !empty($aboutUser)) {
    $curl = curl_init();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/user',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
    "login": "'.$login.'",
    "isAdmin": false,
    "password": "'.$password.'",
    "email": "'.$email.'",
    "aboutUser": "'.$aboutUser.'"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $createdUser = curl_exec($curl);

    curl_close($curl);

    $returnedUser = json_decode($createdUser, true);

    curl_close($curl);

    $userId = $returnedUser['userId'];

    if (is_numeric($userId)) {
        setcookie('user', $userId, time() + 60 * 60 * 24, "/");
    } else {
        header('Location:' . $GLOBALS['dir'] . '/login/register.php?e=Register could not be completed! ' . $userId);
    }
}
header('Location:' . $GLOBALS['dir'] . '/index.php');