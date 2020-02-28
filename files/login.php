<?php

	require_once("inc/config.php");

	session_start();

	if ($_SESSION["logged_in"])
		die(header("Location: /"));

	$response = "";
	$successful = false;

	// Check inputs
	if (isset($_POST["username"], $_POST["password"]))
	{
		$username = urlencode(filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING));
		$password = urlencode(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

		$result = $mysqli->query("SELECT `salt`, `password` FROM `users` WHERE `username`='{$username}' LIMIT 1;");

		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$salt = $row["salt"];
				$hash = md5(md5($password . $salt) . $salt);

				if ($hash === $row["password"])
				{
					$successful = true;

					$_SESSION["logged_in"] = true;
					$_SESSION["username"] = urldecode($username);

					$response = "You've successfully logged in, " . urldecode($username) . "!";
				}
				else
					$response = "Invalid username or password.";
			}
		}
		else
		{
			$response = "There is no user with that username.";
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

		<title>CIS233 - Final Project | Login</title>

		<link rel="stylesheet" type="text/css" href="/css/main.css">
	</head>
	<body>
		<div class="container">
			<div class="login">
				<div class="top"></div>
				<div class="card">
					<form method="POST" autocomplete="off">
						<div class="row">
							<input type="text" name="username" placeholder="Username" maxlength="32" required="yes">
						</div>
						<div class="row">
							<input type="password" name="password" placeholder="Password" required="yes">
						</div>
						<div class="row">
							<input type="submit" value="Login">
							<p class="acc">Don't have an account yet? <a href="register.php"><b>Sign up!</b></a></p>
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
