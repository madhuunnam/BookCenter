<?php

// array for JSON response
$response = array();

if(isset($_POST['isbn'])){

    $book = $_POST['isbn'];

require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();

	$result = mysql_query("SELECT custFirstName,custLastName,reviewTime,comment FROM bookreviews where isbn = '$book'");

$booklist = array();

if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
			//$response["vganji"] = 1;
            //$result = mysql_fetch_array($result);

		while( $row =  mysql_fetch_array($result) ){
			
			$bookinfo=array();
			$bookinfo["name"] = $row["custFirstName"]." ".$row["custLastName"];
			$bookinfo["reviewTime"] = $row["reviewTime"];
			$bookinfo["comment"] = $row["comment"];
			
			array_push($booklist, $bookinfo);
			}

			$response["success"] = 1;
			$response["bookreview"] = array();
			array_push($response["bookreview"], $booklist);
            // echoing JSON response
            echo json_encode($response);


    } else {
 
	$response["result"] = "SELECT firstName,lastName,reviewTime,comment FROM BookReviews,Books,Customers where Bookreviews.isbn = Books.isbn and customers.custID = BookReviews.custID and BookTitle='$book'";
	$response["message1"] = "Opps! An error occurred.";
	echo json_encode($response);
    }
}else{
	$response["result"] = 1;
	$response["message"] = "Opps! An error occurred.";
	echo json_encode($response);
}

}else{
	$response["result"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>

