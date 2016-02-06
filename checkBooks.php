<?php
	$con = mysql_connect('localhost', 'webclient', '12345678');

	if (!$con) {
		die("Failed to conect to MySQL: " . mysqli_error());
	}

	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
		die('Can\'t use the db :' . mysql_error());
	}

	$isbn = $_GET['isbn'];
	if ($isbn == "" || $isbn == null) {
		echo 'false';
	} else {
		$count = mysql_query("select count(isbn) as bookCount from books where isbn = '$isbn'");
		while ( $row = mysql_fetch_assoc($count)) {
			if (0 == $row['bookCount']) {
				echo 'false';
			} else {
				echo 'true';
			}
		}
	}

	mysql_close($con);
?>