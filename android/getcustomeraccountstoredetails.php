<?php

// array for JSON response
$response = array();


if(isset($_POST['customerid'])&&isset($_POST['store'])&&isset($_POST['quartely'])&&isset($_POST['datefrom'])&&isset($_POST['dateto'])&&isset($_POST['checked'])){

    $quartely = $_POST['quartely'];
	$datefrom = $_POST['datefrom'];
	$dateto = $_POST['dateto'];
	$checked = $_POST['checked'];
	$store = $_POST['store'];
	$customerid = $_POST['customerid'];
require_once __DIR__ . '/db_connect.php';
	$query = "";
    // connecting to db
    $db = new DB_CONNECT();
	if(strlen($datefrom) > 0 ){
		$query = "select ledgerNum,ledgerDate,activeorders.tid,description,title,type,totPrice from activeorders,ledgers where transTime > STR_TO_DATE('$datefrom', '%m/%d/%Y') and transTime < STR_TO_DATE('$dateto', '%m/%d/%Y') and activeorders.custID = ledgers.custID and activeorders.custID='$customerid'";
	}else{
		if(strcmp($quartely,"Quarterly") == 0 ){
			$query = "select ledgerNum,ledgerDate,activeorders.tid,description,title,type,totPrice from activeorders,ledgers where transTime > NOW() - INTERVAL 4 MONTH and activeorders.custID = ledgers.custID and activeorders.custID='$customerid'";
		}else if(strcmp($quartely,"Half Yearly") == 0 ){
			$query = "select ledgerNum,ledgerDate,activeorders.tid,description,title,type,totPrice from activeorders,ledgers where transTime > NOW() - INTERVAL 6 MONTH and activeorders.custID = ledgers.custID and activeorders.custID='$customerid'";
		}else if(strcmp($quartely,"Anually") == 0 ){
			$query = "select ledgerNum,ledgerDate,activeorders.tid,description,title,type,totPrice from activeorders,ledgers where transTime > NOW() - INTERVAL 12 MONTH and activeorders.custID = ledgers.custID and activeorders.custID='$customerid'";
		}
	}

	if( strcmp($checked,"true") != 0 ){
		$query = $query." and totPrice > 0";
	}


	$result = mysql_query($query);
	//	$result = mysql_query("SELECT * FROM organizations WHERE '$cname' = '$cnamevalue'");
			$storeinfo = array();		
if (!empty($result)) {
        // check for empty result
		
        if (mysql_num_rows($result) > 0) {

	
        	$city = "";
			while( $row =  mysql_fetch_array($result) ){

			$store = array();
			$store["ledgerNum"] = $row["ledgerNum"];
			$store["ledgerDate"] = $row["ledgerDate"];
			$store["tid"] = $row["tid"];
			$store["description"] = $row["description"];
			$store["title"] = $row["title"];
			$store["type"] = $row["type"];
			if($row["totprice"] != null)
				$store["totprice"] = $row["totPrice"];
			else
				$store["totprice"] = 0;

		
            array_push($storeinfo, $store);
			}

			//$storeinfo = array();

			$response["success"] = 1;
			$response["storeinfo"] = array();
			array_push($response["storeinfo"], $storeinfo);
            // echoing JSON response
            echo json_encode($response);


    } else {
	$response["success"] = $query;
	$response["result"] = 0;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
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