<?php
	$con = mysql_connect('localhost', 'webclient', '12345678');

	if (!$con) {
		die("Failed to conect to MySQL: " . mysqli_error());
	}

	$db_selected = mysql_select_db("apartments");

	if (!$db_selected) {
		die('Can\'t use the db :' . mysql_error());
	}
	$price = str_replace('$', '', $_POST[price]);
	$price = intval($price);
	$result = mysql_query("INSERT INTO listings (url, title, price, date_posted, location, pictures) " .
	" VALUES('$_POST[url]', '$_POST[title]', $price, '$_POST[date_posted]', '$_POST[location]', '$_POST[pictures]')");

	if (!$result) {
		die('lid query:' . mysql_error());
	}

	mysql_close($con);
?>