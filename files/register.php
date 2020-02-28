<?php

	require_once("inc/config.php");
	require_once("inc/functions.php");

	session_start();

	if ($_SESSION["logged_in"])
		die(header("Location: /"));

	$response = "";
	$successful = false;

	if (isset($_POST["username"], $_POST["password"], $_POST["confirm"]))
	{
		$username = urlencode(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
		$password = urlencode(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
		$password_conf = urlencode(filter_input(INPUT_POST, "confirm", FILTER_SANITIZE_STRING));

		if ($password !== $password_conf)
			$response = "Passwords do not match";
		else
		{
			$salt = random_string(10);
			$hash = md5(md5($password . $salt) . $salt);

			$sql = "INSERT INTO `users` (`username`, `password`, `salt`) VALUES ('{$username}', '{$hash}', '{$salt}');";

			if ($mysqli->query($sql) === TRUE)
			{
				$successful = true;

				$_SESSION["logged_in"] = true;
				$_SESSION["username"] = urldecode($username);

				$response = "You've successfully registered, " . urldecode($username) . "!";
			}
			else
				$response = "Sorry, an error occured while trying to register your account.";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php

			if ($successful)
				echo "<meta http-equiv=\"refresh\" content=\"0; url=/\" />\n";

		?>

		<title>CIS233 - Final Project | Register</title>

		<link rel="stylesheet" type="text/css" href="/css/main.css">
	</head>
	<body>
		<div class="container">
			<div class="login">
				<div class="reg"></div>
				<div class="card">
					<form method="POST" autocomplete="off">
						<div class="row">
							<input type="text" name="username" placeholder="Username" maxlength="32" required="yes">
						</div>
						<div class="row">
							<input type="password" name="password" placeholder="Password" required="yes">
						</div>
						<div class="row">
							<input type="password" name="confirm" placeholder="Confirm Password" required="yes">
						</div>
						<div class="row">
							<input type="submit" value="Register">
							<p class="acc">Already have an account? <a href="login.php"><b>Login!</b></a></p>
						</div>
					</form>
				</div>
			</div>
		</div>

		<?php

			if (!empty($response))
				echo("<script>alert(\"{$response}\");</script>\n");

		?>
	</body>
</html>
