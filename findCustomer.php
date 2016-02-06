<?php

	$con = mysql_connect('localhost', 'webclient', '12345678');
	                    
	if (!$con) {
	    die('Failed to conect to MySQL: ' . mysql_error());
	}

	$db_selected = mysql_select_db("bookstore");

	if (!$db_selected) {
	    die('Can\'t use the db :' . mysql_error());
	}

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];

	$sql = 'SELECT custID, firstName, lastName, emailAddress FROM customers where firstName LIKE "'.$firstName.'" AND lastName LIKE "'.$lastName.'"';
	$result = mysql_query($sql);

	$responseJSON = array();
	$customers = array();

	if (mysql_num_rows($result) > 0) {
		while($row = mysql_fetch_assoc($result)) {
			$customers[] = array(
				'custID' => $row['custID'],
				'firstName' => $row['firstName'],
				'lastName' => $row['lastName'],
				'emailAddress' => $row['emailAddress']
			);	
		}

		$responseJSON['customers'] = $customers;
	} else {
		$responseJSON = array('error' => 'found no customers');
	}

echo json_encode($responseJSON);
?>