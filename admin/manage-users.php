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

<!--TODO NASTYLOVAT - FUNKCIE NA SPRAVENIE ADMINOM A ZMAZANIA-->

<div class="blog-view-wrapper">

    <?php foreach ($users as $user) {
        if ($user->getIsAdmin() == 1) {
            continue;
        }
        ?>
      <div class="profile-view-wrapper">
        <span><?php echo $user->getLogin(); ?></span>
        <span><?php echo $user->getEmail(); ?></span>
        <button onclick="removeUser(<?php echo $user->getUserId(); ?>)">Remove</button>
        <button>Make admin</button>
      </div>
    <?php } ?>

</div>

</body>
</html>

<script> //TODO spravit este make admin s ajaxom
  function removeUser(userId) {
    $.ajax({
      type: "POST",
      url: "<?php echo $GLOBALS['dir'] ?>/model/user_remove.php",
      data: {userId: userId},
      success: function () {
        $.ajax({
          type: "GET",
          url: "<?php echo $GLOBALS['dir'] ?>/model/user_list.php",
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
        <button>Make admin</button>
        </div>`;
              }
            }
            $('.blog-view-wrapper').html(html);
          }
        });
      }
    });
  }
</script>

