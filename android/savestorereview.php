<?php

// array for JSON response
$response = array();


if(isset($_POST['custid'])&&isset($_POST['rev'])&&isset($_POST['revsub'])&&isset($_POST['storeid'])){

    $custid = $_POST['custid'];
	$rev = $_POST['rev'];
	$revsub = $_POST['revsub'];
	$storeid = $_POST['storeid'];
	

require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
	
		$query = "insert into storereviews (storeID,custID,revTitle,comment,reviewTime) values ( '$storeid','$custid','$revsub','$rev',now())";
	

	


	$result = mysql_query($query);
	//	$result = mysql_query("SELECT * FROM organizations WHERE '$cname' = '$cnamevalue'");
			$storeinfo = array();		
if (!empty($result)) {
        // check for empty result
		
        

			//$storeinfo = array();

			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storeinfo);
            // echoing JSON response
            echo json_encode($response);


    

    
}else{
		$response["success"] = 0;
	$response["result"] = "1";
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
		$response["success"] = 0;
	$response["result"] = 2;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>