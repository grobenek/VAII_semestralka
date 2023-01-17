<?php

use model\Blog;
use model\Comment;

require_once('../model/Comment.php');
require_once('../model/Blog.php');
require_once('../model/User.php');

if (isset($_GET['blogId'])) {
    $blogId = $_GET['blogId'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$comments = Comment::getAllCommentsOfBlogById($blogId);
echo '<div class="comments-wrap">';

if (isset($_COOKIE['user'])) {
    echo '<div>
        <form action="'.$GLOBALS['dir'].'/model/create_comment.php" method="post">
          <input type="hidden" value="'.$blogId.'" name="blogId">
          <input type="hidden" value="'.$_COOKIE['user'].'" name="authorId">
          <textarea name="text" required maxlength="65535" style="resize: none"
                    placeholder="Start writing your comment..."></textarea>
          <button type="submit">Post</button>
        </form>
    </div>';
}

foreach ($comments as $comment) {
    $user = User::getUserById($comment->getAuthorId());
    echo '<div class="comment">
        <div class="container-comment-text">
          <div class="comment-left">
            <img src="' . $GLOBALS['dir'] . '/res/images/sample-3.jpg"
                 alt="profile picture">
            <div class="comment-info">
              <span class="blog-view-info-fill"> ' . $user->getLogin() . '</span>
              <span class="comment-date">' . $comment->getTimestamp() . '</span>
              <span class="comment-date">';
    if ($comment->getIsEdited()) {
        echo "edited";
    }
    echo '</span>
            </div>
          </div>
          <div class="comment-right"
               id="containerCommentText-' . $comment->getCommentId() . '">
            <p class="long-text">' . $comment->getText() . '</p>
          </div>
        </div>';
    if (isset($_COOKIE['user']) && $_COOKIE['user'] == $comment->getAuthorId()) {
        echo '<div class="container-form">
              <button type="button" class="comment-button"
                      onclick=\'showEditComment("' . $comment->getCommentId() . '","' . $comment->getBlogId() . '","' . $comment->getAuthorId() . '","' . $comment->getText() . '")\'>
                edit
              </button>
              <button type="button" class="comment-button delete"
                      onclick=\'confirmDeleteComment("' . $comment->getCommentId() . '", ' . $blogId . ')\'>
                delete
              </button>
            </div>';
    }
    echo '</div>';
}