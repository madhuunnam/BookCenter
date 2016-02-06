<?php
	$con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

    if (!$con) {
        die("Failed to conect to MySQL: " . mysqli_error());
    }

    $result = mysqli_query($con, 'select storeID, storeName from stores where lower(storeName) = lower("'.$_GET['storeName'].'")');
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($store = mysqli_fetch_assoc($result)) {
            echo $store['storeID'] .','.$store['storeName'];
            return "";
        }
    } else {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
?>