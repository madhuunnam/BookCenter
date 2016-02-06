<?php

// array for JSON response
$response = array();


if(isset($_POST['cname'])&&isset($_POST['dircity'])&&isset($_POST['dirstate'])&&isset($_POST['org'])&&isset($_POST['cnamevalue'])){

    $cname = $_POST['cname'];
	$dircity = $_POST['dircity'];
	$dirstate = $_POST['dirstate'];
	$org = $_POST['org'];
	$cnamevalue = $_POST['cnamevalue'];
require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	
	$result = mysql_query("SELECT name,telephoneNumber,pastor FROM organizations WHERE $cname = '$cnamevalue' and city = '$dircity' and state = '$dirstate' and type = '$org'");
	//	$result = mysql_query("SELECT * FROM organizations WHERE '$cname' = '$cnamevalue'");
			$storeinfo = array();		
if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {

	
        	$city = "";
			while( $row =  mysql_fetch_array($result) ){

			$store = array();
			$store["name"] = $row["name"];
			$store["phone"] = $row["telephoneNumber"];
			$store["pastor"] = $row["pastor"];

		
            array_push($storeinfo, $store);
			}

			//$storeinfo = array();

			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storeinfo);
            // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = "SELECT name,telephoneNumber,pastor FROM organizations WHERE $cname = '$cnamevalue' and city = '$dircity' and state = '$dirstate' and type = '$org'";
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
	$response["result"] = 2;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>