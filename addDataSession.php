<?php
	session_start();
	if ( isset($_POST)) {
		foreach($_POST as $name => $value) {
			unset($_SESSION[$name]);
			$_SESSION[$name] = $value;
		}
	} 

	if(isset($_SESSION['redirectUrl'])) {
		$redirectUrl = $_SESSION['redirectUrl'];
		$_SESSION['redirectUrl'] = null;
		header("Location: " . $redirectUrl);
		die();
	}
?>
