<?php
session_start();
?>
<html>
<head>
    <title>
        Store Editor
    </title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
            font-size:1em !important;
        }

        td {
            padding: 10px;
            text-align: left !important;
            font-size: 14px !important;
        }

        .above th {
            padding: 10px;
            text-align: right !important;
        }

        .submitBtnTd {
            text-align: center;
            vertical-align: center;
        }

        input {
            height: 2em;
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
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                echo "$( document ).ready(function() { window.location.href='homepage.php';});";
            } else if (!isset($_POST) || (isset($_POST) && empty($_POST))) {
                echo "$( document ).ready(function() { window.location.href='customerShipping.php';});";
            } 
        ?>
        function clearInput() {
            $( "input[id='bookRef']" ).val( "" );
        }

        function changeText() {
            if ($('#libraryName').val() == "Default Library Name") {
                $('#libraryName').val("");
                $('#libraryName').css('color', '#222');
            }
        }

        function changeOnBlur() {
            if ($('#libraryName').val() == "") {
                $('#libraryName').val("Default Library Name");
                $('#libraryName').css('color', '#aaa');
            }
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Shipping Confirmation </h2>
<form method=post action="updateActiveRecords.php" >
    <table class="above">
        <tr>
            <th>  Tid</th>
            <td>  <?php echo $_SESSION['TID']; ?> </td>
        </tr>
        <tr>
            <th>Customer </th>
            <td> <?php echo $_SESSION['name']; ?></td>
        </tr>
        <tr>
            <th>  Date</th>
            <td> <?php echo date("m/d/y"); ?> </td>
        </tr>
        <tr>
            <th>  Store</th>
            <td>  <?php echo $_SESSION['libraryName']; ?> </td>
        </tr>
        <tr>
            <th>  Receiver Name</th>
            <td>  <?php echo $_POST['receiverName']; ?> </td>
        </tr>
        <tr>
            <th>  Shipping Address</th>
            <td>  <?php echo $_POST['shippingAddress'] . ' ' . $_POST['shippingAddress2'] . '<br>' . $_POST['city']. ', ' . $_POST['state']. ', ' . $_POST['zip']; ?> </td>
        </tr>
        <tr>
            <th>  Shipping Method</th>
            <td>  <?php echo $_POST['shippingMethod']; ?> </td>
        </tr>
    </table>
    <br>
    <hr>
    <br>
    <table class="priceChart">
        <tr>
            <th> Title </th>
            <th> Qty. </th>
            <th> Price </th>
            <th> Desc. </th>
        </tr>

        <?php 
            $con = mysql_connect('localhost', 'webclient', '12345678');                   
            if (!$con) {
                die('Failed to conect to MySQL: ' . mysql_error());
            }
            $db_selected = mysql_select_db("bookstore");
            if (!$db_selected) {
                die('Can\'t use the db :' . mysql_error());
            }
        
            $lineItemsSQL = 'select * from lineitems where tid='.$_SESSION['TID'].' order by lineNumber';
            $result = mysql_query($lineItemsSQL);
            $total = 0;
            $tax = 0;
            while ($row = mysql_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td>'.$row['title'].'</td>';
                echo '<td>'.$row['orderQuantity'].'</td>';
                $total = $total + intval($row['priceAmount']);
                echo '<td>'.$row['priceAmount'].'</td>';
                echo '<td>'.$row['description'].'</td>';
                echo '<td>  &nbsp;</td>';
                echo '</tr>';
            }

            $shippingFee = (float) explode("-", $_POST['shippingMethod'])[1];

        ?>
        
        </tr>
        <tr>
            <td colspan=5> &nbsp;</td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Subtotal</th>
            <td colspan=2> <?php echo $total; ?></td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Tax</th>
            <td colspan=2> <?php echo $tax; ?></td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Shipping Fee</th>
            <td colspan=2> <?php echo $shippingFee; ?></td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Total</th>
            <td colspan=2> <?php echo $total + $total*$tax + $shippingFee; ?></td>
        </tr>
    </table>
    <input type='hidden' name='shippingAddress' value='<?php echo $_POST['shippingAddress']; ?>'>
    <input type='hidden' name='shippingMethod' value='<?php echo $_POST['shippingMethod']; ?>'>
    <input type='hidden' name='subTotal' value='<?php echo $total; ?>'>
    <input type='hidden' name='receiverName' value='<?php echo $_POST['receiverName']; ?>'>
    <input type='hidden' name='deliveryNotes' value='<?php echo $_POST['deliveryNotes']; ?>'>
    <input type='hidden' name='carrierName' value='<?php echo $_POST['carrierName']; ?>'>
    <input type='hidden' name='tax' value='<?php echo $tax; ?>'>
    <input type='hidden' name='updateAddress' value='<?php echo $_POST["updateAddress"]; ?>'>
    <input type='hidden' name='shippingFee' value='<?php echo $shippingFee; ?>'>
    <input type='hidden' name='total' value='<?php echo $total + $total*$tax + $shippingFee; ?>'>
    <input type='hidden' name='shippingAddress2' value='<?php echo $_POST['shippingAddress2']; ?>'>
    <input type='hidden' name='city' value='<?php echo $_POST['city']; ?>'>
    <input type='hidden' name='zip' value='<?php echo $_POST['zip']; ?>'>
    <input type='hidden' name='state' value='<?php echo $_POST['state']; ?>'>
    <table class="btnTable">
        <tr>
            <th> <input type="button" name="Back" value="< Back" onclick="window.location.href='customerShipping.php';"></th>
            <th> <input type="submit" name="Confirm" value="Confirm >" ></th>
        </tr>
    </table>
</form>
</body>
</html>
