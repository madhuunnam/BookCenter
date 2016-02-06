<?php

$isPIDSet = isset($PID);
$PID = $isPIDSet ? $PID : '';
if (!$isPIDSet) {
	session_start();
	?>
<html>
<head>
    <title>
        Procure Info
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
            if(!isset($_SESSION['type']) || $_SESSION['type'] == 'Customer') {
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
        $PID = $_GET['PID']; 
    } else {
        echo '<div id="procure'.$PID.'Dialog" >';
    }

    $con = mysql_connect('localhost', 'webclient', '12345678');
                    
    if (!$con) {
        die('Failed to conect to MySQL: ' . mysql_error());
    }

     $db_selected = mysql_select_db("bookstore");

    if (!$db_selected) {
        die('Can\'t use the db :' . mysql_error());
    }

   	$sql = "";
    $sql .= ' SELECT * FROM procures WHERE PID='.$PID ;
	
    $result = mysql_query($sql);
    $resultRow = null;
    while($row = mysql_fetch_assoc($result))
        $resultRow = $row;

    if ($resultRow == null) {
        echo '<h2> Couldn\'t find Procure Info for Procure id provided </h2>';
    } else {
?>
<h2> Procure Info </h2>
    <table id='procureInfo'>
        <tr>
            <th> PID:</th>
            <td> <?php echo $resultRow['PID'] ?> </td>
            
            <th> Store Name:</th>
            <td> <?php echo $resultRow['StoreName'] ?></td>
        </tr>
        <tr>
            <th> Supplier Name: </th>
            <td> <?php echo $resultRow['SupplierName'] ?></td>
		 
            <th> Total Price</th>
            <td> <?php echo $resultRow['TotalPrice'] ?></td> 
        </tr> 
        <tr>
            <th> Number Of Lines:</th>
            <td> <?php echo $resultRow['NumberOfLines'] ?></td>

            <th> Agent Name:</th>
            <td> <?php echo $resultRow['AgentName'] ?></td>  
        </tr>
        <tr>
        	<th> Procure Time:</th>
            <td> <?php echo $resultRow['ProcureTime'] ?></td>
            
            <th> Units Procured:</th>
            <td> <?php echo $resultRow['UnitsProcured'] ?></td>
        </tr>
          <tr>
            <th> Title:</th>
            <td> <?php echo $resultRow['Title'] ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table class="priceChart">
        <tr>
            <th> # </th>
            <th> Title </th>
            <th> ISBN </th>
            <th> Description </th>
            <th> Qty </th>
            <th> Price </th>
        </tr>
    <?php
        $lineItemsSQL = 'SELECT * from ProcurelineItems WHERE PID='.$PID.' ORDER BY LineNum';
        $lineItemsResult = mysql_query($lineItemsSQL);
        $countLineItems = 0;
        while($row = mysql_fetch_assoc($lineItemsResult)) {
            $countLineItems = $countLineItems + 1;
            echo "<tr>";
            echo '<td>'.$row["LineNum"].'</td>';
            echo '<td>'.$row["title"].'</td>';
            echo '<td>'.$row["isbn"].'</td>';
            echo '<td>'.$row["description"].'</td>';
            echo '<td>'.$row["Quantity"].'</td>';
            echo '<td>'.$row["price"].'</td>';
            echo '</tr>';
        }

        if ($countLineItems == 0) {
            echo '<tr><td colspan=7> No items found for the provided procure id</td></tr>';
        }
    ?>
    </table>
<?php 
    }

    if ($isPIDSet) {
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

