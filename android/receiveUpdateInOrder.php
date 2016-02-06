<?php

// array for JSON response
$response = array();


if(isset($_POST['tid'])){

    $tid = $_POST['tid'];
	
require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
	
	 $result = mysql_query("update activeorders set orderStatus='RECEIVED' where tid = '$tid'");
		 $result = mysql_query("insert into transactions select * from activeorders where tid = '$tid'");
		 	 $result = mysql_query("delete from activeorders where tid = '$tid'");
				

	
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