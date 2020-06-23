<?php
// protection from direct access
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}
?>
<nav class="top-nav">
    <div class="wrapper top-nav-container">

        <div class="left-side">
            <a class="nav-logo" href="/">
                <span class="nav-logo-text">CAMAGRU</span>
            </a>
        </div>

        <div class="right-side">
            <?php
            if (isset($_SESSION["logged_user"])) {
                ?>
                <a href="upload.php" class="top-nav-icon">
                    <img src="../assets/camera_alt-24px.svg" alt="camera">
                </a>

                <a href="myaccount.php?id=default" class="top-nav-icon">
                    <img src="../assets/person-24px.svg" alt="person">
                </a>

                <a href="functions/logout.php" class="top-nav-icon">
                    <img src="../assets/exit_to_app-24px.svg" alt="logout">
                </a>

                <?php
            } else {
                ?>
                <a href="login.php" class="login-button">Login</a>
                <?php
            }
            ?>
        </div>

    </div>
</nav>