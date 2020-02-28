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
		<section class="hero">
            <div class="background-image" style="background-image: url(main.png);"></div>
            <div class="hero-content-area">
                <h1>Hi, <?= $_SESSION["username"]; ?>!</h1>
                <h3>Thanks for being apart of my project.</h3>
                <a href="cis.php" class="btn">Click here to continue</a>
            </div>
        </section>
	</body>
</html>
