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
        <div> <h1> Book Center Statistics </h1> </div>
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

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM books");
        if (false === $res) {
            echo mysql_error();
        }
        $row = mysql_fetch_array($res);
        echo "#Books registered: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM customers");
        $row = mysql_fetch_array($res);
        echo "<br>#Customers: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM stores");
        $row = mysql_fetch_array($res);
        echo "<br>#Stores: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM inventory");
        $row = mysql_fetch_array($res);
        echo "<br>#Books in inventory: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM transactions");
        $row = mysql_fetch_array($res);
        echo "<br>#Transactions: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM activeorders");
        $row = mysql_fetch_array($res);
        echo "<br>#Active Orders: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM outitems");
        $row = mysql_fetch_array($res);
        echo "<br>#Out Items: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM organizations");
        $row = mysql_fetch_array($res);
        echo "<br>#Organizations: " . $row["cnt"];

        $res = mysql_query("SELECT COUNT(*) AS cnt FROM messages");
        $row = mysql_fetch_array($res);
        echo "<br>#Messages: " . $row["cnt"];

        ?>
        </div>
    </body>
</html>
