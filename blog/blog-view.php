<?php

use model\Comment;

require_once('../model/Comment.php');
require_once('../model/User.php');

/**
 * @var Comment $comments
 * @var Comment $comment
 *
 */

$comments = Comment::getAllComments();
require "../components/head.php";
require "../components/header.php";
?>

<div class="blog-view-wrapper">
    <div class="blog-main-left">
        <div class="blog-header">
            <div class="blog-main-image">
                <img src="<?php echo $GLOBALS['dir'] ?>/res/images/Sample-Picture.jpg" alt="blog-picture">
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
            if (isset($_COOKIE['user'])) { ?>
                <form action="<?php echo $GLOBALS['dir'] ?>/model/create.php" method="post">
                    <!--                TODO BLOG ID ZMENIT PODLA ID Z DATABAZY-->
                    <input type="hidden" value="1" name="blogId">
                    <input type="hidden" value="<?php echo $_COOKIE['user'] ?>" name="authorId">
                    <!--                TODO DAT STYLE-->
                    <textarea name="text" required maxlength="65535" style="resize: none"
                              placeholder="Start writing your comment..."></textarea>
                    <button type="submit">Post</button>
                </form>
            <?php
            }
            ?>
            <?php
            foreach ($comments as $comment) {
                $user = User::getUserById($comment->getAuthorId());
                ?>
                <div class="comment">
                    <div class="container-comment-text">
                        <div class="comment-left">
                            <img src="<?php echo $GLOBALS['dir'] ?>/res/images/sample-3.jpg" alt="profile picture">
                            <div class="comment-info">
                                <span class="blog-view-info-fill"> <?php echo $user->getLogin(); ?></span>
                                <span class="comment-date"><?php
                                    echo $comment->getTimestamp();
                                    ?></span>
                                <span class="comment-date"><?php
                                    if ($comment->getIsEdited()) {
                                        echo "edited";
                                    } ?></span>
                            </div>
                        </div>
                        <div class="comment-right" id="containerCommentText-<?php echo $comment->getCommentId() ?>">
                            <p class="long-text"><?php
                                echo $comment->getText();
                                ?></p>
                        </div>
                    </div>
                    <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] == $comment->getAuthorId()) { ?>
                        <div class="container-form">
                            <button type="button" class="comment-button"
                                    onclick='showEditComment("<?php echo $comment->getCommentId() ?>","<?php echo $comment->getBlogId() ?>","<?php echo $comment->getAuthorId() ?>","<?php echo $comment->getText() ?>")'>
                                edit
                            </button>
                            <button type="button" class="comment-button delete"
                                    onclick='confirmDeleteComment("<?php echo $comment->getCommentId() ?>")'>delete
                            </button>
                        </div>
                    <?php } ?>
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
                <a href=<?php echo $GLOBALS['dir'] ?>/login/login.php>User</a>
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

<script>
    function showEditComment(commentId, blogId, authorId, text) {
        let commentWrap = document.querySelector("div#containerCommentText-" + commentId);

        commentWrap.innerHTML = '' +
            '<form action="<?php echo $GLOBALS['dir']?>/model/update.php" method="post"> ' +
            '<input name="commentId" type="hidden" value="' + commentId + '">' +
            '<input name="blogId" type="hidden" value="' + blogId + '">' +
            '<input name="authorId" type="hidden" value="' + authorId + '">' +
            '<textarea name="text" style="resize: none" maxlength="65535">' + text + '</textarea>' +
            '<button type="submit">Post</button>' +
            '</form>';
    }

    function confirmDeleteComment(commentId) {
        let confirmAction = confirm("Are you sure you want to delete this comment?");
        if (confirmAction) {
            let commentWrap = document.querySelector("div#containerCommentText-" + commentId);

            commentWrap.innerHTML = '' +
                '<form id=toSubmit action="<?php echo $GLOBALS['dir']?>/model/delete.php" method="post"> ' +
                '<input name="commentId" type="hidden" value="' + commentId + '">' +
                '</form>';

            document.querySelector("form#toSubmit").submit();
        } else {
            alert("Action canceled");
        }
    }
</script>
</body>
</html>