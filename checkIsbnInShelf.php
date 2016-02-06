<?php
		$con = mysql_connect('localhost', 'root', 'root');

		if (!$con) {
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'CONNECTION_ERROR')));
		}

		$db_selected = mysql_select_db("bookstore");

		if (!$db_selected) {
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'DATABASE_ERROR')));
		} 

		$storeID = $_SESSION['storeID'];
		if ($storeID == null) {
			$max = mysql_query("select min(storeID) as storeID from stores");
			while ( $row = mysql_fetch_assoc($max)) {
				$storeID = $row['storeID'];
			}
		}

		$isbn = $_POST['isbn'];
		$idx = $_POST['idx'];

		if ($isbn == null || $isbn == '') {
			header('HTTP/1.1 500 Internal Server Booboo');
        	header('Content-Type: application/json; charset=UTF-8');
        	die(json_encode(array('message' => 'RECORD_NOT_FOUND_ERROR'))); 
		} else {
			$sql = "SELECT * from inventory where storeID = '$storeID' and isbn = '$isbn' and idx = '$idx'";
	
			$result = mysql_query($sql);
			if (0 == mysql_num_rows($result)) {
				header('HTTP/1.1 500 Internal Server Booboo');
        		header('Content-Type: application/json; charset=UTF-8');
        		die(json_encode(array('message' => 'RECORD_NOT_FOUND_ERROR')));
			} else {
				header('Content-Type: application/json');
				$rows = array();
        		while($r = mysql_fetch_assoc($result)) {
    				$rows = $r;
				}
				print json_encode($rows);
			}
		}
?> 