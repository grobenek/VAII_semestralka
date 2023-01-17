<header>
  <div class="header-left">
    <div class="logo">
      <a href="<?php echo $GLOBALS['dir'] ?>/index.php"><img
            src="<?php echo $GLOBALS['dir'] ?>/res/images/logo.png" alt="logo"></a>
    </div>
    <nav class="main-navigation">
      <ul>
        <li>
          <a href="">Home</a>
        </li>
        <li>
          <a href="<?php echo $GLOBALS['dir'] ?>/profile/profile.php">My profile</a>
        </li>
          <?php if (isset($_COOKIE['userAdmin'])) {
              if ($_COOKIE['userAdmin']) {
                  ?>
                <li onclick="location.href='<?php echo $GLOBALS['dir'] ?>/admin/manage-users.php'">
                  <a href="<?php echo $GLOBALS['dir'] ?>/admin/manage-users.php">Manage users</a>
                </li>
                <li onclick="location.href='<?php echo $GLOBALS['dir'] ?>/admin/manage-categories.php'">
                  <a href="<?php echo $GLOBALS['dir'] ?>/admin/manage-categories.php">Manage
                    categories</a>
                </li>
              <?php }
          } ?>
      </ul>
    </nav>
  </div>
  <div class="header-right">
      <?php if (!isset($_COOKIE['user'])) { ?>
        <button onclick="window.location.href= '<?php echo $GLOBALS['dir'] ?>/login/login.php';">
          Create blog
        </button>
        <button
            onclick="window.location.href= '<?php echo $GLOBALS['dir'] ?>/login/login.php';">
          My blogs
        </button>
        <button onclick="window.location.href= '<?php echo $GLOBALS['dir'] ?>/login/login.php';">
          Sign in
        </button>
      <?php } else {
          $query = http_build_query(array('userId' => $_COOKIE['user']));
          ?>
        <button
            onclick="window.location.href= '<?php echo $GLOBALS['dir'] ?>/blog_creation/blog-creation.php';">
          Create blog
        </button>
        <button
            onclick='window.location.href="<?php echo $GLOBALS['dir'] ?>/my_blogs/my-blogs.php?<?php echo $query; ?>"'>
          My blogs
        </button>
        <button onclick="window.location.href= '<?php echo $GLOBALS['dir'] ?>/controller/sign_out.php';">
          Sign out
        </button>
      <?php } ?>
  </div>
</header>