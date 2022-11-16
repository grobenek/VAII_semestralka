<header>
    <div class="header-left">
        <div class="logo">
            <a href="<?php echo $GLOBALS['dir']?>/index.php"><img src="<?php echo $GLOBALS['dir']?>/res/images/logo.png" alt="logo"></a>
        </div>
        <nav class="main-navigation">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li>
                    <a href="">Home</a>
                </li>
                <li>
                    <a href="">About us</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="header-right">
        <button onclick="window.location.href= '<?php echo $GLOBALS['dir']?>/login/login.php';">
            My blogs
        </button>
        <?php if (!isset($_COOKIE['user'])) { ?>
            <button onclick="window.location.href= '<?php echo $GLOBALS['dir']?>/login/login.php';">
                Sign in
            </button>
        <?php } else { ?>
            <button onclick="window.location.href= '<?php echo $GLOBALS['dir']?>/login/sign_out.php';">
                Sign out
            </button>
        <?php } ?>
    </div>
</header>
