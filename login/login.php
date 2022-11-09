<?php
$error = null;
if (isset($_GET['e'])) {
    $error = $_GET["e"];
}
require "../components/head.php";
require "../components/header.php";
?>
<form action="./log_in.php" method="post" class="login-wrapper">
    <div class="login-logo">
        <h1>Welcome!</h1>
        <img src="<?php echo $GLOBALS['dir']?>/res/images/logo.png" alt="logo">
    </div>

    <div class="input-wrapper">
        <?php
        if (isset($error)) {
            echo "<span>" . $error . "</span>";
        }
        ?>
        <div class="email-wrapper">
            <!--            @TODO zmenit ak bude validator ukazovat label chybu
                                pridat label a dat ho ako visibility hidden-->
            <input required type="text" name="email" id="email" placeholder="Email">
        </div>

        <div class="password-wrapper">
            <input required type="password" name="password" placeholder="Password">
        </div>
    </div>

    <button type="submit" class="login-button">
        Sign in
    </button>
</form>
</body>
</html>