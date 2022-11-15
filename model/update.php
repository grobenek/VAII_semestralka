<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";

$authorId = null;
$blogId = null;
$text = null;
$commentId = null;

if (isset($_POST['authorId']) && isset($_POST['blogId']) && isset($_POST['text']) && isset($_POST['commentId'])) {

    $authorId = $_POST['authorId'];
    $blogId = $_POST['blogId'];
    $text = $_POST['text'];
    $commentId = $_POST['commentId'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

if (!empty($authorId) && !empty($blogId) && !empty($text) && !empty($commentId)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/api/comment/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => '{
        "commentId": ' . $commentId . ',
        "authorId": ' . $authorId . ',
        "blogId": ' . $blogId . ',
        "text": "' . $text . '"
}',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    header('Location:' . $GLOBALS['dir'] . '/blog/blog-view.php');
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}


