<?php
	include_once 'database.php';
    // warning remover
	//error_reporting(E_ERROR);

	try {
		$conn = new PDO("mysql:host=$DB_HOST;port=$DB_PORT", $DB_USER, $DB_PASSWORD);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
		//echo("database '$DB_NAME' created!<br />");
		$conn->exec("use $DB_NAME");
		$conn->exec("CREATE TABLE IF NOT EXISTS users (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
														login VARCHAR(255) NOT NULL,
														passwd VARCHAR(255) NOT NULL,
														email VARCHAR(255) NOT NULL,
														notification BOOLEAN NOT NULL DEFAULT true,
														token VARCHAR(255) NOT NULL,
														verified BOOLEAN NOT NULL DEFAULT false)");
		//echo("Table 'users' created!<br />");
		$conn->exec("CREATE TABLE IF NOT EXISTS posts (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
															login VARCHAR(255) NOT NULL,
															img VARCHAR(255) NOT NULL,
															postdate DATETIME NOT NULL)");
		//echo("Table 'posts' created!<br />");
		$conn->exec("CREATE TABLE IF NOT EXISTS comments (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
															img_id INT(9) UNSIGNED,
															login VARCHAR(255) NOT NULL,
															comment VARCHAR(255) NOT NULL,
															FOREIGN KEY (img_id) REFERENCES posts (id)
																ON DELETE CASCADE
																ON UPDATE CASCADE)");
		//echo("Table 'comments' created!<br />");
		$conn->exec("CREATE TABLE IF NOT EXISTS likes (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
														img_id INT(9) UNSIGNED,
														login VARCHAR(255) NOT NULL,
														FOREIGN KEY (img_id) REFERENCES posts (id)
															ON DELETE CASCADE
															ON UPDATE CASCADE)");
		//echo("Table 'likes' created!<br />");
        $conn->exec("INSERT IGNORE INTO users (id, login, passwd, email, notification, token, verified) VALUES (1,'root','0a25f55d7308eca6b9567a7ed3bd1b46327f0f1ffdc804dd8bb5af40e88d78b88df0d002a89e2fdbd5876c523f1b67bc44e9f87047598e7548298ea1c81cfd73', 'root@camagru.teh', 0, 'token', 1)");
        // create default user
	} catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
?>
