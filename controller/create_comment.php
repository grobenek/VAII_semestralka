<?php

use model\Comment;
require_once('../model/Comment.php');

include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

$authorId = null;
$blogId = null;
$text = null;

if (isset($_POST['authorId']) && isset($_POST['blogId']) && isset($_POST['text'])) {
    $authorId = $_POST['authorId'];
    $blogId = $_POST['blogId'];
    $text = $_POST['text'];
    $text = rtrim($text, " \n\r\t\v\x00");

    Comment::createComment($authorId, $blogId, $text);
}
$query = http_build_query(array('blogId' => $blogId));
header('Location:'.$GLOBALS['dir'].'/blog/blog-view.php?'.$query);
