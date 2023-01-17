<?php

use model\Comment;

include_once $_SERVER["DOCUMENT_ROOT"] . "/semestralka/config/dir_global.php";
require_once('../model/Comment.php');

if (isset($_POST['commentId']) && isset($_POST['blogId'])) {
    $commentId = $_POST['commentId'];
    $blogId = $_POST['blogId'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

Comment::deleteComment($commentId);

$query = http_build_query(array('blogId' => $blogId));
header('Location:' . $GLOBALS['dir'] . '/blog/blog-view.php?'.$query);