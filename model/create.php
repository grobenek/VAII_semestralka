<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

$authorId = null;
$blogId = null;
$text = null;

if (isset($_POST['author']) && isset($_POST['blog']) && isset($_POST['text'])) {
    $authorId = $_POST['author'];
    $blogId = $_POST['blog'];
    $text = $_POST['text'];
}

if (!empty($authorId) && !empty($blogId) && !empty($text)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/comment/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
        "authorId": '.$authorId.',
        "blogId": '.$blogId.',
        "text": '.$text.'
    }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}
header('Location:'.$GLOBALS['dir'].'/blog/blog-view.php');
