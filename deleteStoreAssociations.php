<?php
    session_start();
	$con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

    if (!$con) {
        die("Failed to conect to MySQL: " . mysqli_error());
    }

    $sql = '';
    if (isset($_GET['associationType']) && $_GET['associationType'] == 'mother') {
        $sql = 'delete from storeAssociations where storeID = ' . $_SESSION['storeID'] . ' and motherID = ' . $_GET['motherID'];
        
    } else {
        $sql = 'delete from storeAssociations where storeID = '. $_GET['childID'] . ' and motherID = ' . $_SESSION['storeID'];
        
    }
    $result = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) > 0) {
        echo "";
    } else {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
    }
?>