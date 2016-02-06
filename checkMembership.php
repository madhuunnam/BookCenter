<?php
	session_start ();
	$responseJSON = array ();
	$sessionStoreID = $_SESSION ['storeID'];
	$isMember = false ;
	$customerID = '';
	$sessionCustID = $_SESSION['custID'];
	$con = mysql_connect('localhost', 'webclient', '12345678');
		
	if (!$con) {
		die('Failed to conect to MySQL: ' . mysql_error());
	}
		
	$db_selected = mysql_select_db("bookstore");
		
	if (!$db_selected) {
		die('Can\'t use the db :' . mysql_error());
	}
	
	$sql ="select custID from LibMembers where storeID = '" .$sessionStoreID. "';";
	$sqlResult = mysql_query($sql);
	
	if (! $sqlResult) {
		error_log("SQL error while retrieving libmembers in checkMembership");
		$responseJSON = array('error' => 'Error occured while checking customer membership');
	}
	else {
		while ( $row = mysql_fetch_assoc ( $sqlResult ) ) {
			$customerID = $row['custID'];
			if ($customerID == $sessionCustID){
				$isMember = true ;
			}
		}
		
		if (!$isMember){
			$responseJSON = array('NotAMember' => 'true');
		}
		
	}
		echo json_encode ( $responseJSON );
?>
