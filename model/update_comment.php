<?php

use model\Comment;

include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";
require_once('../model/Comment.php');

$authorId = null;
$blogId = null;
$text = null;
$commentId = null;

if (isset($_POST['authorId']) && isset($_POST['blogId']) && isset($_POST['text']) && isset($_POST['commentId'])) {

    $authorId = $_POST['authorId'];
    $blogId = $_POST['blogId'];
    $text = $_POST['text'];
    $text = rtrim($text, " \n\r\t\v\x00");
    $commentId = $_POST['commentId'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

if (!empty($authorId) && !empty($blogId) && !empty($text) && !empty($commentId)) {

    Comment::updateComment($commentId, $authorId, $blogId, $text);

    $query = http_build_query(array('blogId' => $blogId));
    header('Location:' . $GLOBALS['dir'] . '/blog/blog-view.php?'.$query);
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}


