<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

$email = null;
$password = null;

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:8080/api/user/verify/login/'.$email.'/password/'.$password,
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

$userId = json_decode(curl_exec($curl), true);

curl_close($curl);
if (is_numeric($userId)) {
    setcookie('user', $userId, time()+60*60*24, "/");
    header('Location:'.$GLOBALS['dir'].'/index.php');
} else {
    header('Location:'.$GLOBALS['dir'].'/login/login.php?e=Invalid login!');
}