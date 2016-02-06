<?php


$responseJSON = array();


$con = mysql_connect ( 'localhost', 'webclient', '12345678' );

if (! $con) {
	die ( 'Failed to conect to MySQL: ' . mysql_error () );
}

$db_selected = mysql_select_db ( "bookstore" );

if (! $db_selected) {
	die ( 'Can\'t use the db :' . mysql_error () );
}
	$motherStoreId = $_POST['storeID'];
	$motherStoreName = $_POST['storeName'];
	$childStoreId = $_POST['childStoreID'];
	
	$getChildStoreNameQuery = mysql_query("select storeName from stores where storeID = $childStoreId");
	while ($row = mysql_fetch_assoc($getChildStoreNameQuery)) {
		$childStoreName = $row['storeName'];
	}	

	$motherStoreResult = mysql_query("INSERT INTO storeAssociations (storeID, storeName, motherID, motherStore) values ('$childStoreId' , '$childStoreName' , '$motherStoreId' , '$motherStoreName' )");
	
	if (! $motherStoreResult) {
		$responseJSON = array('error' => 'Your Store is already associated with this store');
		
	} else {
		$sql2 = "select distinct * from storeassociations where motherID=" . $motherStoreId;
		$storeListResult = mysql_query ( $sql2 );
		$storenameArray = array();
		$storeIdArray = array();
		
		if (mysql_num_rows($storeListResult) > 0) {
			while($row = mysql_fetch_row($storeListResult)) {
			array_push($storeIdArray, "<a href=\"Storepage.php?name=$row[1]&storeId=$row[0]\">$row[1]</a>");	
			}	
		}
		$responseJSON = array('storeId' => $storeIdArray);
		

	}
echo json_encode($responseJSON);

?>