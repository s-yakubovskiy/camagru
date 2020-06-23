<?php
session_start();
if (isset($_SESSION['logged_user'])) {
    header('Location: /');
    exit();
}
?>

<html>
<head>
    <?php require_once('template/head_includes.php'); ?>
    <title>Camagru - Login</title>
    <script type="text/javascript" src="js/cookies.js"></script>
    <script>
        unsetCookie();
    </script>
</head>
<body>
    <div class="whole_body">
        <?php require_once('template/menu_bar.php'); ?>

        <div class="login-page">
            <div class="form">
                <form action="/functions/login.php" method="POST">
                    <div class="login_form">
                        <input id="log" type="text" name="login" value="" required placeholder="Login">
                        <input style="margin-top: 5px;" type="password" name="passwd" value="" required placeholder="Password">
                        <?php
                        if (isset($_SESSION["error"])) {
                            $error = $_SESSION["error"];
                            echo "<span class='error'>$error</span>";
                            unset($_SESSION["error"]);
                        }
                        ?>
                        <input type="submit" name="submit" value="Submit">
                        <p class="message">
                            Not registered? <a href="create.php">Create an account</a>
                        </p>
                        <p class="message">
                            Forgot password? <a href="forgot.php">Find password</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require_once ('template/footer.php')?>
</body>
</html>
