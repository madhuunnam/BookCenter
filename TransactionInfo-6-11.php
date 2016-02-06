<?php

$isTIDSet = isset($tid);
$tid = $isTIDSet ? $tid : '';
if (!$isTIDSet) {
    session_start();
?>
<html>
<head>
    <title>
        Transaction Info
    </title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
        }

        td {
            padding: 10px;
        }

        .submitBtnTd {
            text-align: center;
            vertical-align: center;
        }

        input {
            height: 2em;
        }

        input[type=submit] {
            -webkit-appearance: none;
            height: 2em;
            width: 12em;
            font-size: 1em;
            border-radius: 5px;
        }

        
        .priceChart {
            border:1px solid #ddd;
            border-radius: 5px;
            padding:10px;
            background-color: #ddd;
        }

        .priceChart th {
            border:1px solid #ddd;
            background-color: #ddd;
            color:#222;
            text-align: center;
            border-radius: 5px;
            padding:10px;
        }

        .priceChart td {
            border-left:1px solid #ddd;
            border-right:1px solid #ddd;
            background-color: #fff;
        }

        .last {
            background-color: #ddd;
        }

        .btnTable {
            margin-top:20px;
            width:300px;
        }

        .btnTable th {
            margin-top:20px;
            padding:10px;
            text-align: center;
        }


        .radio {
            margin-right:15px;
            margin-left:15px;
        }



    </style>
    <script type="text/javascript" src='jquery-1.4.1.js'></script>
    <script type="text/javascript">

        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] == 'Admin') {
                echo "$( document ).ready(function() { window.location.href='homepage.php';});";
            }
        ?>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<?php
        $tid = $_GET['tid']; 
    } else {
        echo '<div id="transaction'.$tid.'Dialog" >';
    }

    $con = mysql_connect('localhost', 'webclient', '12345678');
                    
    if (!$con) {
        die('Failed to conect to MySQL: ' . mysql_error());
    }

     $db_selected = mysql_select_db("bookstore");

    if (!$db_selected) {
        die('Can\'t use the db :' . mysql_error());
    }

    $andClause = "";
    if ($_SESSION['type'] == 'Customer') {
        $andClause = ' AND custID='.$_SESSION['custID'];
    } else if ($_SESSION['type'] == 'Store') {
        $andClause = ' AND storeID='.$_SESSION['storeID'];
    }
    $sql  = ' SELECT *, "active" AS state FROM activeorders WHERE tid='.$tid.$andClause;
    $sql .= ' UNION ALL';
    $sql .= ' SELECT *, "old" AS  state FROM transactions WHERE tid='.$tid.$andClause;

    $result = mysql_query($sql);
    $resultRow = null;
    while($row = mysql_fetch_assoc($result))
        $resultRow = $row;

    if ($resultRow == null) {
        echo '<h2> Couldn\'t find Transaction Info for transaction id provided </h2>';
    } else {
?>
<h2> Transaction Info </h2>
    <table id='transInfo'>
        <tr>
            <th> Tid</th>
            <td> <?php echo $resultRow['tid'] ?> </td>
        </tr>
        <?php 
            if($_SESSION['type'] == 'Customer') {
        ?>
        <tr>
            <th> Store ID </th>
            <td> <?php echo $resultRow['storeID'] ?></td>
        </tr>
        <tr>
            <th> Store Name</th>
            <td> <?php echo $resultRow['storeName'] ?></td>
        </tr>
        <?php 
            } else {
        ?>
        <tr>
            <th> Customer ID </th>
            <td> <?php echo $resultRow['custID'] ?></td>
        </tr>
        <tr>
            <th> Customer Name</th>
            <td> <?php echo $resultRow['custFirstName'] ?> <?php echo $resultRow['custLastName'] ?></td>
        </tr>
        <?php 
            } 
        ?> 
        <tr>
            <th> Line Items </th>
            <td> <?php echo $resultRow['numberOfLines'] ?></td>
        </tr>
        <!-- <tr>
            <th> Total Price</th>
            <td> <?php echo $resultRow['totPrice'] ?></td> -->
        </tr>
        <tr>
            <th> Order Status</th>
            <td> <?php echo $resultRow['orderStatus'] ?></td>
        </tr>
        <tr>
            <th> Notes</th>
            <td> <?php echo $resultRow['notes'] ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="priceChart">
        <tr>
            <th> # </th>
            <th> Title </th>
            <th> Description </th>
            <th> Qty. </th>
           <!-- <th> Price </th>  -->
            <th> Type </th>
            <th> Due Date </th>
        </tr>
    <?php
        $lineItemsSQL = 'SELECT * from lineitems WHERE tid='.$tid.' ORDER BY lineNumber';
        $lineItemsResult = mysql_query($lineItemsSQL);
        $countLineItems = 0;
        while($row = mysql_fetch_assoc($lineItemsResult)) {
            $countLineItems = $countLineItems + 1;
            echo "<tr>";
            echo '<td>'.$row["lineNumber"].'</td>';
            echo '<td>'.$row["title"].'</td>';
            echo '<td>'.$row["description"].'</td>';
            echo '<td>'.$row["orderQuantity"].'</td>';
           // echo '<td>'.$row["priceAmount"].'</td>';
            echo '<td>'.$row["type"].'</td>';
            echo '<td>'.$row["dueDate"].'</td>';
            echo '</tr>';
        }

        if ($countLineItems == 0) {
            echo '<tr><td colspan=7> No items found for the provided transaction id</td></tr>';
        }
    ?>
    </table>
<?php 
    }

    if ($isTIDSet) {
        echo '</div>';
    } else {
    ?>
    <table class="btnTable">
        <tr>
            <th> <input type="button" name="Back" value="Back" onclick="goBack()"></th>
        </tr>
    </table>
</body>
</html>
    <?php
    }
?>

