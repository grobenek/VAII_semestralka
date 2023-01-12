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

<div class="profile-wrapper">
  <div class="user-info-wrapper">
    <span>Username: <?php echo $user->getLogin()?> </span>
    <span>Email: <?php echo $user->getEmail()?> </span>
    <span>About user: <?php echo $user->getAboutUser() ?> </span>
  </div>
  <div>
    <button class="reset-password-button" onclick="location.href='./change-password.php'">Change password</button>
  </div>
</div>

</body>
</html>