<?php

require "../components/head.php";
?>
<form action="./register_user.php" method="post" class="login-wrapper">
    <div class="login-logo">
        <h1>Welcome!</h1>
        <img src="<?php echo $GLOBALS['dir'] ?>/res/images/logo.png" alt="logo">
    </div>

    <div class="input-wrapper">
        <div class="email-wrapper">
            <!--            @TODO zmenit ak bude validator ukazovat label chybu
                                pridat label a dat ho ako visibility hidden-->
            <input required type="email" name="email" id="email" placeholder="Email">
            <input required type="text" name="login" style="margin-top: 5px" placeholder="Username">
        </div>

        <div class="password-wrapper">
            <input required type="password" name="password" placeholder="Password">
          <input required type="text" name="aboutUser" style="margin-top: 5px" placeholder="About you">
        </div>
    </div>

    <button type="submit" class="login-button">
        Register
    </button>
</form>
</body>
</html>