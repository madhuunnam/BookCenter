<?php


// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_POST["title"])) {
    $title = $_POST['title'];

	// get a product from books table
    $result = mysql_query("SELECT * FROM books WHERE title = '$title'");

	if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 			
			$result1 = mysql_query("SELECT * FROM bookreviews WHERE isbn = '".$result["isbn"]."' ");
			$num = mysql_num_rows($result1);
	$bookinfo = array();
            $bookinfo["title"] = $result["title"];
            $bookinfo["isbn"] = $result["isbn"];
			$bookinfo["author"] = $result["author"];
			$bookinfo["author"] = $result["author"];
            $bookinfo["callNum"] = $result["callNum"];
            $bookinfo["author"] = $result["author"];
            $bookinfo["language"] = $result["language"];
			$bookinfo["reviews"] = $num;

	// success
            $response["success"] = 1;
 
            // user node
            $response["bookinfo"] = array();
 
            array_push($response["bookinfo"], $bookinfo);
 
            // echoing JSON response
            echo json_encode($response);
	} else {
            // no product found
            $response["success"] = "SELECT * FROM books,bookreviews WHERE title = '$title'";
            $response["message"] = "No product found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = "SELECT * FROM books WHERE title = $title";
        $response["message"] = "No product found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>
	