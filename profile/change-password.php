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
?>
<form action="../controller/change-password-send.php" method="post" class="login-wrapper">
  <div class="input-wrapper">
    <div class="password-wrapper">
      <input required type="password" minlength="4" name="new-password" placeholder="New password">
    </div>
      <?php
      if (isset($error)) {
          echo "<span>" . $error . "</span>";
      }
      ?>
  </div>

  <button type="submit" class="login-button">
    Change password
  </button>
</form>
</body>
</html>
