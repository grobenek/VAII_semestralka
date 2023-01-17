<?php
require_once('../model/User.php');

if (isset($_COOKIE['user'])) {
    $userId = $_COOKIE['user'];
} else {
    http_response_code(404);
    include('../error_page/my_404.php');
    die();
}

$users = User::getAllUsers();

require "../components/head.php";
require "../components/header.php";
?>

<div class="blog-view-wrapper">

    <div class="profiles-wrapper">
    <?php foreach ($users as $user) {
        if ($user->getIsAdmin() == 1) {
            continue;
        }
        ?>
      <div class="profile-view-wrapper">
        <div class="profile-view-left">
          <span><?php echo $user->getLogin(); ?></span>
          <span><?php echo $user->getEmail(); ?></span>
        </div>
        <div>
          <button onclick="removeUser(<?php echo $user->getUserId(); ?>)">Remove</button>
          <button onclick="makeAdmin(<?php echo $user->getUserId(); ?>)">Make admin</button>
        </div>
      </div>
    <?php } ?>

</div>
</div>

<script>
  function removeUser(userId) {
    $.ajax({
      type: "POST",
      url: "<?php echo $GLOBALS['dir'] ?>/controller/user_remove.php",
      data: {userId: userId},
      success: function () {
        $.ajax({
          type: "GET",
          url: "<?php echo $GLOBALS['dir'] ?>/controller/user_list.php",
          success: function (response) {
            var users = JSON.parse(response)
            console.log(users)
            var html = "";
            for (var userId in users) {
              var user = users[userId];
              if (user["isAdmin"] != 1) {
                html += `<div class="profile-view-wrapper">
        <span>${user.login}</span>
        <span>${user.email}</span>
        <button onclick="removeUser(${user.userId})">Remove</button>
        <button onclick="makeAdmin(${user.userId})">Make admin</button>
        </div>`;
              }
            }
            $('.blog-view-wrapper').html(html);
          }
        });
      }
    });
  }

  function makeAdmin(userId) {
    $.ajax({
      type: "POST",
      url: "<?php echo $GLOBALS['dir'] ?>/controller/user_make_admin.php",
      data: {userId: userId},
      success: function () {
        $.ajax({
          type: "GET",
          url: "<?php echo $GLOBALS['dir'] ?>/controller/user_list.php",
          success: function (response) {
            var users = JSON.parse(response)
            console.log(users)
            var html = "";
            for (var userId in users) {
              var user = users[userId];
              if (user["isAdmin"] != 1) {
                html += `<div class="profile-view-wrapper">
        <span>${user.login}</span>
        <span>${user.email}</span>
        <button onclick="removeUser(${user.userId})">Remove</button>
        <button onclick="makeAdmin(${user.userId})">Make admin</button>
        </div>`;
              }
            }
            $('.blog-view-wrapper').html(html);
          }
        });
      }
    })
  }
</script>

</body>
</html>

