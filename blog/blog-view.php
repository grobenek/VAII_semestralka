<?php

require_once('../model/Comment.php');

/**
 * @var Comment $response
 * @var Comment $comment
 *
 */

$response = Comment::getAllComments();
if (!$response) {
    $decodedComments = "CHYBA";
    return;
}
$decodedComments = json_decode($response, true);

$comments = [];

foreach ($decodedComments as $comment) {
    $commentToAdd = new Comment();
    $commentToAdd->setAtributes($comment["commentId"], $comment["authorId"], $comment["timestamp"], $comment["blogId"], $comment["text"]);
    $comments[] = $commentToAdd;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>NameOfBlog</title>
</head>

<body>
<?php require "../components/header.php" ?>

<div class="blog-view-wrapper">
    <div class="blog-main-left">
        <div class="blog-header">
            <div class="blog-main-image">
                <img src="../res/images/Sample-Picture.jpg" alt="blog-picture">
            </div>

            <div class="blog-main-h1">
                <h1>
                    For a More Creative Brain Follow These 5 Steps
                </h1>
                <span class="blog-main-h1-info">Written by:</span>
                <span class="blog-view-info-fill">User</span>
                <span> | </span>
                <span class="blog-main-h1-info">Date:</span>
                <span class="blog-view-info-fill">09.10.2022</span>
            </div>
        </div>
        <div class="blog-view-main-text">
            <p class="long-text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque excepturi quibusdam voluptatibus. Ad
                alias, atque illum magnam non nostrum nulla repellendus. Delectus nulla officia officiis provident
                reiciendis tempora tempore, veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque
                excepturi quibusdam voluptatibus. Ad alias, atque illum magnam non nostrum nulla repellendus. Delectus
                nulla officia officiis provident reiciendis tempora tempore, veniam. Lorem ipsum dolor sit amet,
                consectetur adipisicing elit. Cumque excepturi quibusdam voluptatibus. Ad alias, atque illum magnam non
                nostrum nulla repellendus. Delectus nulla officia officiis provident reiciendis tempora tempore, veniam.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque excepturi quibusdam voluptatibus. Ad
                alias, atque illum magnam non nostrum nulla repellendus. Delectus nulla officia officiis provident
                reiciendis tempora tempore, veniam. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque
                excepturi quibusdam voluptatibus. Ad alias, atque illum magnam non nostrum nulla repellendus. Delectus
                nulla officia officiis provident reiciendis tempora tempore, veniam.
            </p>
        </div>
        <div class="comments-wrap">
            <?php
            foreach ($comments as $comment) {
                ?>
                <div class="comment">
                    <div class="comment-left">
                        <img src="../res/images/sample-3.jpg" alt="profile picture">
                        <div class="comment-info">
                            <span class="blog-view-info-fill">Sample user</span>
                            <span class="comment-date">22.10.2022</div>
                    </div>
                    <div class="comment-right">
                        <p class="long-text"><?php
                            echo $comment->getText();
                            ?></p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="sidebar">
        <div class="sidebar-autor-section">
            <div class="about-author-container">
                <span class="blog-info">
            About the author
                </span>
            </div>
            <div class="about-author-text">
                <span>
                <a href="../login/login.html">User</a>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam dolores et laborum laudantium omnis, possimus provident qui rerum sed totam vitae voluptate? Dolorum hic impedit ipsa officia sequi tenetur ut?
            </span>
            </div>
            <div class="blogs-from-author about-author-container">
                <span>
                    More blogs from author
                </span>
                <span><a href="blog-view.html">Blog</a></span>
                <span><a href="blog-view.html">Blog</a></span>
                <span><a href="blog-view.html">Blog</a></span>
                <span><a href="blog-view.html">Blog</a></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>