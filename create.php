<?php
	session_start();
	if (isset($_SESSION['logged_user'])) {
		header('Location: /');
	}
?>
<html>
	<head>
		<?php require_once('template/head_includes.php'); ?>
		<title>Camagru - Create a new account!</title>
		<script type="text/javascript" src="js/cookies.js"></script>
	</head>
	<body>
		<div class="whole_body">
			<?php require_once ('template/menu_bar.php'); ?>

			<div class="login-page">
				<div class="form">
					<form id="test" action="/functions/create.php" method="POST" onsubmit="setCookie()">
						<div class="login_form">
							<input id="login" type="text" name="login" value="" required placeholder="Login">
							<input type="password" name="passwd" value="" required placeholder="Password">
							<input type="password" name="passwd_conf" value="" required placeholder="Confirm Password">
							<input id="email" type="email" name="email" value="" required placeholder="E-mail address">
                            <label class="form-check-label">
                                <input type="checkbox" name="notice" class="form-check-input" checked>
                                Receive notification
                            </label>
							<?php
								if(isset($_SESSION["error"])){
									$error = $_SESSION["error"];
									echo "<span class='error'>$error</span>";
									unset($_SESSION["error"]);
								}
							?>
						<input type="submit" name="submit" value="submit">
						<p class="message">Already registered? <a href="login.php">Sign In</a></p>
						</div>
					</form>
				</div>
			</div>
		</div>

        <?php require_once ('template/footer.php')?>
	</body>
</html>

<script>
	callFromCookie();
</script>