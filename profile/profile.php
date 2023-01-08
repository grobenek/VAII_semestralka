<?php

require_once('../model/User.php');

if (isset($_COOKIE['user'])) {
    $userId = $_COOKIE['user'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$user = User::getUserById($userId);

require "../components/head.php";
require "../components/header.php";
?>

<div class="blog-view-wrapper">
  <span>Username: <?php echo $user->getLogin()?> </span>
  <span>Email: <?php echo $user->getEmail()?> </span>
  <span>About user: <?php echo $user->getAboutUser() ?> </span>
</div>
