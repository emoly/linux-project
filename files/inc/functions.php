<?php

	function random_string($length)
	{
		$str = "";
		$chars = "abcdefghijklmnopqrstuvwxyz" .
				"ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789" .
				"!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";

		for ($i = 0; $i < $length; $i++)
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];

		return $str;
	}

?>
