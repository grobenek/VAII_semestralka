<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/semestralka/config/dir_global.php";

$authorId = null;
$blogId = null;
$text = null;

if (isset($_POST['authorId']) && isset($_POST['blogId']) && isset($_POST['text'])) {
    $authorId = $_POST['authorId'];
    $blogId = $_POST['blogId'];
    $text = $_POST['text'];
}
header('Location:'.$GLOBALS['dir'].'/blog/blog-view.php');
