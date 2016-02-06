<?php 

$con = mysql_connect('localhost', 'webclient', '12345678');

$DB_CONNECTED = false;

if (!$con) {
	$DB_CONNECTED = false;
} else {
	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
    	$DB_CONNECTED = false;
	} else {
		$DB_CONNECTED = true;
	}
}



?>