<?php

use model\Comment;

require_once('../model/Comment.php');
require_once('../model/User.php');

if (isset($_GET['blogId'])) {
    $blogId = $_GET['blogId'];
    $comments = Comment::getAllCommentsOfBlogById($blogId);
    ?>
    <div class="comments-wrap">
    <div>
        <?php if (isset($_COOKIE['user'])) { ?>
            <form action="<?php echo $GLOBALS['dir'] ?>/model/create.php" method="post">
                <input type="hidden" value="<?php echo $blogId ?>" name="blogId">
                <input type="hidden" value="<?php echo $_COOKIE['user'] ?>" name="authorId">
                <textarea name="text" required maxlength="65535" style="resize: none" placeholder="Start writing your comment..."></textarea>
                <button type="submit">Post</button>
            </form>
        <?php } ?>
    </div>
    <?php
    foreach ($comments as $comment) {
    $user = User::getUserById($comment->getAuthorId());
    ?>
    <div class="comment">
        <div class="container-comment-text">
            <div class="comment-left">
                <img src="<?php echo $GLOBALS['dir'] ?>/res/images/sample-3.jpg" alt="profile picture">
                <div class="comment-info">
                    <span class="blog-view-info-fill"><?php echo $user->getLogin() ?></span>
                    <span class="comment-date"><?php echo $comment->getTimestamp() ?></span>
                    <?php if ($comment->getIsEdited()) { ?>
                        <span class="comment-date">edited</span>
                    <?php } ?>
                </div>
            </div>
            <div class="comment-right" id="containerCommentText<?php echo $comment->getCommentId() ?>">
                <p class="long-text"><?php echo $comment->getText() ?></p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] == $comment->getAuthorId()) { ?>
                <div class="container-form">
                    <button type="button" class="comment-button" onclick="showEditComment('<?php echo $comment->getCommentId() ?>','<?php echo $comment->getBlogId() ?>','<?php echo $comment->getAuthorId() ?>','<?php echo $comment->getText() ?>')">edit</button>
                    <button type="button" class="comment-button delete" onclick="confirmDeleteComment('<?php echo $comment->getCommentId() ?>',<?php echo $blogId ?>)">delete</button>
                </div>
            <?php } else {
                http_response_code(404);
                include('error_page/my_404.php');
                die();
            } ?>
        </div>
        <?php } ?>
    </div>
    </div>
<?php } ?>
