<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

$commentId=null;

if (isset($_POST['commentId'])) {
    $commentId = $_POST['commentId'];
}

if (!empty($commentId)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/comment/'.$commentId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    header('Location:'.$GLOBALS['dir'].'/blog/blog-view.php');
}