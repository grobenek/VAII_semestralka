<?php

use model\Category;

require_once('../model/Category.php');

$categories = Category::getAllCategoryNames();

require "../components/head.php";
require "../components/header.php";
?>

<div class="blog-view-wrapper">

    <?php foreach ($categories as $category) { ?>
      <div>
        <span><?php echo $category->getCategoryName(); ?></span>
        <button
            onclick="removeCategory(<?php echo $category->getCategoryId() ?>)">
          Remove
        </button>
      </div>
    <?php } ?>

</div>

<script>
  function removeCategory(categoryId) {
    $.ajax({
      type: "POST",
      url: "<?php echo $GLOBALS['dir']; ?>/controller/category_remove.php",
      data: { categoryId: categoryId },
      success: function() {
        location.reload();
      }
    });
  }
</script>

</body>
</html>