<?php

	session_start();

	if (!$_SESSION["logged_in"])
		die(header("Location: /login.php"));

?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>CIS233 - Final Project | Home</title>
		<link rel="stylesheet" type="text/css" href="/css/main.css">
	</head>
	<body>
		
	</body>
</html>
