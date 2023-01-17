<?php

use model\Blog;
require_once('./Blog.php');

use model\Picture;
require_once('./Picture.php');

if (isset($_POST['imageData']) && isset($_POST['fileName']) && isset($_POST['html-content']) && isset($_COOKIE['user']) && isset($_POST['title'])) {
    $imageData = $_POST['imageData'];
    $fileName = $_POST['fileName'];
    $htmlContent = $_POST['html-content'];
    $userId = $_COOKIE['user'];
    $title = $_POST['title'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die("No data were POSTed when created blog");
}

$pictureId = Picture::createPicture($imageData, $fileName);
$timestamp = Date('c');

if ($pictureId) {

    $createdBlog = Blog::createBlog($userId, $pictureId, $title, $htmlContent, $timestamp);

    if ($createdBlog == true) {
        header('Location:' . $GLOBALS['dir'] . '/index.php');
    } else {
        http_response_code(404);
        include('../error_page/my_404.php');
        die("Error occured when creating blog!");
    }
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die("Error occured when creating blog!");
}

