<?php
session_start();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Admin Statistics</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <?php include 'NavigationBar.php';?>
    
    <body>
        <br> <br>
        <div> <h1> Store Statistics </h1> </div>
        <div style="text-align: left">
        <?php

	//connect to database 
                    $con = mysql_connect('localhost', 'webclient', '12345678');

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $db_selected = mysql_select_db("bookstore");

                    if (!$db_selected) {
                        die('Can\'t use the db :' . mysql_error());
                    }

        $res = mysql_query("SELECT COUNT(DISTINCT custID) AS cnt FROM transactions WHERE storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Distinct Customers: " . $row["cnt"];


        $res = mysql_query("SELECT COUNT(*) AS cnt FROM inventory WHERE storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Books on shelf: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM transactions WHERE storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Transactions: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM activeorders WHERE storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Active Orders: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM outitems WHERE storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Out Items: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM libmembers WHERE activate = true AND storeID = " .$_SESSION['storeID']);
        $row = mysql_fetch_array($res);
        echo "<br>#Active members: " . $row["cnt"];

        ?>
        </div>
    </body>
</html>
