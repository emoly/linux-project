<?php

	$mysqli = new mysqli(
		"127.0.0.1",         // Hostname
		"emily",             // Username
		"/6:7VX84?3\"26~eD", // Password
		"emily"              // Database
	);

	if ($mysqli->connect_error)
		die("MySQL connection error: " . $mysqli->connect_error);

?>
