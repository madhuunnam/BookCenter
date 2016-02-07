
<?php

	$responseJSON = array();
	$pin = 0000;
	$con = mysql_connect ( 'localhost', 'webclient', '12345678' );

	if (! $con) {
		die ( 'Failed to conect to MySQL: ' . mysql_error () );
	}

	$db_selected = mysql_select_db ( "bookstore" );

	if (! $db_selected) {
		die ( 'Can\'t use the db :' . mysql_error () );
	}

	$maxBarcodeSQL = 'SELECT max(barcode) as maxBarcode FROM libmembers';

	$maxBarcodeResult = mysql_query ( $maxBarcodeSQL );
	$maxBarcode = 0;
	while ( $row = mysql_fetch_assoc ( $maxBarcodeResult ) ) {
		$maxBarcode = intval ( $row ['maxBarcode'] ) + 1;
	}

	if ($maxBarcode < 10000) {
		$maxBarcode = 10001;
	}

	$insertLibmember = "INSERT INTO libmembers SELECT  C.custID, C.firstName, C.lastName, S.storeID, S.storeName, CURRENT_DATE,
                '" . $maxBarcode . "', '" . $pin . "', FALSE, 'created' FROM stores S, customers C WHERE S.storeName='" .$_POST['storename'] . "' AND C.custID=" . $_POST['custId'];

	
	$insertResult = mysql_query ( $insertLibmember );
	if (! $insertResult) {
		$responseJSON = array('error' => 'You are member here already');
	}
	else {
		$responseJSON = array('success' => 'Your membership request is sent to the librarian successfully. Please check LibMembership tab later');
	}
	
echo json_encode($responseJSON);
?>