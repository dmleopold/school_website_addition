<?php
	$time = 3600 * 24;
	if (isset($_COOKIE['name'])) {
		setcookie('name', "", time() - $time, "/");
	}
	if (isset($_COOKIE['surname'])) {
		setcookie('surname', "", time() - $time, "/");
	}
	if (isset($_COOKIE['subjects'])) {
		setcookie('subjects', "", time() - $time, "/");
	}
	if (isset($_COOKIE['type'])) {
		setcookie('type', "", time() - $time, "/");
	}
	if (isset($_COOKIE['class'])) {
		setcookie('class', "", time() - $time, "/");
	}
	if (isset($_COOKIE['id'])) {
		setcookie('id', "", time() - $time, "/");
	}

	header("Location: /");
?>