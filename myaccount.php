<?php
	session_start();
	if (!isset($_SESSION["logged_user"])) {
		header ('Location: login.php');
		exit();
	}
?>
<html>
	<head>
		<?php require_once('template/head_includes.php'); ?>
		<title>Camagru - My Account Page</title>
	</head>
	<body>
		<div class="whole_body">
			<?php require_once ('template/menu_bar.php'); ?>

			<div class="my_account_wrapper wrapper">
				<div class="sidebar">
					<div class="side_menu">
						<a href="myaccount.php?id=default">
							<i class="fas fa-user"></i>Account Info
                        </a>
					</div>
					<div class="side_menu">
						<a href="myaccount.php?id=Account_Privacy">
							<i class="fas fa-lock"></i>Account Privacy
                        </a>
					</div>
					<div class="side_menu">
						<a href="myaccount.php?id=notification">
							<i class="fas fa-bell"></i>Notification Setting
                        </a>
					</div>
					<div class="side_menu">
						<a href="myaccount.php?id=remove_user">
							<i class="fas fa-user-slash"></i>Delete Account
                        </a>
					</div>
				</div>

				<div class="content">
					<?php
						$page_name = basename($_GET['id']);
						require_once("pages/$page_name.php");
					?>
				</div>
			</div>
		</div>

        <?php require_once ('template/footer.php')?>
	</body>
</html>