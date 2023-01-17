<?php
require "./components/head.php";
require "./components/header.php";

use model\Blog;
use model\Picture;

include_once "./config/dir_global.php";
include_once "./model/Blog.php";
include_once "./model/Picture.php";

$blogs = Blog::getAllBlogs();
?>

<div class="blog-wrapper">
    <?php
    foreach ($blogs as $blog) {
        $picture = Picture::getPictureById($blog->getPictureId());
        $query = http_build_query(array('blogId' => $blog->getBlogId()));
        ?>
      <div class="blog-area"
           onclick='location.href="<?php echo $GLOBALS['dir'] ?>/blog/blog-view.php?<?php echo $query; ?>"'>

        <div class="blog-main-picture">
          <a style="background-image: url('data:image/png;base64,<?php echo $picture->getData(); ?>');">
          </a>
        </div>
        <div class="blog-main-h2">
          <h2><?php echo $blog->getTitle(); ?></h2>
        </div>
        <div class="blog-main-text">
          <p><span><?php
                  $text = $blog->getText();
                 $text = preg_replace("/style='.*?'/", "", $text);
                  echo $text; ?></span>
          </p>
        </div>
      </div>
    <?php } ?>

</div>


</body>
</html>
