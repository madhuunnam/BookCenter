
<?php

	$responseJSON = array();
	
	$con = mysql_connect ( 'localhost', 'webclient', '12345678' );
	
	if (! $con) {
		die ( 'Failed to conect to MySQL: ' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$db_selected = mysql_select_db ( "bookstore" );

	if (! $db_selected) {
		die ( 'Can\'t use the db :' . mysql_error () );
		$responseJSON = array('error' => 'Query failed');
	}
	
	$s = $_POST['SID'];
	
	$labelquery = "select privateCallNum, isbn, idx  from inventory  where storeID = '$s'";
	$label = mysql_query ( $labelquery );
	if (! $label) {
		die('lid query:' . mysql_error());
		$responseJSON = array('error' => 'Query failed');
	}
	$labels = array();
	while ( $row = mysql_fetch_assoc ( $label ) ) {
		
		$printLabel = "\n".$row['privateCallNum']."\n".$row['isbn']."\n".$row['idx']."\n";
		array_push($labels, $printLabel);
		$responseJSON = array('label' => $labels);
	}
	
	echo json_encode($responseJSON);
	
?>