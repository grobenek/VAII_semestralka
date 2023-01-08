<?php

use model\Blog;
require_once('./Blog.php');

use model\Picture;
require_once('./Picture.php');

if (isset($_POST['imageData']) && isset($_POST['fileName']) && isset($_POST['html-content']) && isset($_COOKIE['user'])) {
    $imageData = $_POST['imageData'];
    $fileName = $_POST['fileName'];
    $htmlContent = $_POST['html-content'];
    $userId = $_COOKIE['user'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$pictureId = Picture::createPicture($imageData, $fileName);
$timestamp = Date('c');

if ($pictureId) {
    Blog::createBlog($userId, $pictureId, "STATIC TITLE", $htmlContent, $timestamp);
} else {
    echo "PICTURE WAS NOT UPLOADED!";
}