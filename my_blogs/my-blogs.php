<?php

require "../components/head.php";
require "../components/header.php";


use model\Blog;
use model\Picture;

include_once "../config/dir_global.php";
include_once "../model/Blog.php";
include_once "../model/Picture.php";

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$blogs = Blog::getBlogsByUserId($userId);
?>

<span>You have created <?php echo count($blogs) ?> blogs!</span>

<div class="blog-wrapper">
    <?php
    if (count($blogs) == 0) {
        echo "<span class='no-blogs'> You don't have any blogs yet! </span>";
        die();
    }

    foreach ($blogs as $blog) {
        $picture = Picture::getPictureById($blog->getPictureId());
        $query = http_build_query(array('blogId' => $blog->getBlogId()));
        ?>
      <div class="blog-area"
           onclick='location.href="<?php echo $GLOBALS['dir'] ?>/blog/blog-view.php?<?php echo $query; ?>"'>

        <div class="blog-main-picture">
          <a style="background-image: url('data:image/jpg;base64,<?php echo $picture->getData(); ?>');">
          </a>
        </div>
        <div class="blog-main-h2">
          <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A est expedita facere hic
            inventore ipsum
            laborum laudantium maiores maxime, nobis numquam pariatur quod quos repellat sunt,
            tempora tenetur
            totam
            vitae?</h2>
        </div>
        <div class="blog-main-text">
          <p><span><?php $text = $blog->getText();
                  $text = preg_replace("/style='.*?'/", "", $text);
                  echo $text; ?></span> ?></span>
          </p>
        </div>
      </div>
    <?php } ?>

</div>


</body>
</html>

