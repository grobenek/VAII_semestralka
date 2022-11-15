<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

$email = null;
$password = null;
$login = null;

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login = $_POST['login'];
//    hash password
    $password = password_hash($password, PASSWORD_BCRYPT);
}

if (!empty($email) && !empty($password) && !empty($login)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/user/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "login": "'.$login.'",
        "password": "'.$password.'",
        "is_admin": 0,
        "email": "'.$email.'"
    }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $userId = json_decode(curl_exec($curl), true); //TODO premapovat na usera a vratit jeho id - v databaze vyriesit error
    $userId = $userId[0]->getUserId();

    curl_close($curl);

    if (is_numeric($userId)) {
        setcookie('user', $userId, time() + 60 * 60 * 24, "/");
    } else {
        header('Location:' . $GLOBALS['dir'] . '/login/register.php?e=Register could not be completed! '.$userId);
    }
}
header('Location:' . $GLOBALS['dir'] . '/index.php');