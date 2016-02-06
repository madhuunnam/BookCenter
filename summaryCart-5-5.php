<?php
session_start();

$con = mysql_connect('localhost', 'webclient', '12345678');
                    
if (!$con) {
    die('Failed to conect to MySQL: ' . mysql_error());
}

 $db_selected = mysql_select_db("bookstore");

if (!$db_selected) {
    die('Can\'t use the db :' . mysql_error());
}

$hasCardInfo = false;
if (isset($_SESSION['custID'])) {
    $customerSQL = 'select * from customers where custID=' . $_SESSION['custID'];
    $result = mysql_query($customerSQL);
    $row = mysql_fetch_assoc($result);
    if ($row['cardNumber'] != null &&
        $row['cardType'] != null &&
        $row['cardName'] != null &&
        $row['cardExp'] != null &&
        $row['cardCode'] != null &&
        $row['billingAddr'] != null) {
        $hasCardInfo = true;
    }

} else {
    $_SESSION['redirectUrl'] = 'summaryCart.php';
    header("location: login.php");
    die();
}

$disableSelfCheckout = "";
if (isset($_SESSION['storeID'])) {
    $storeSQL = 'select selfCheckout from stores where storeID="'.$_SESSION['storeID'].'"';
    $result = mysql_query($storeSQL);
    $row = mysql_fetch_assoc($result);
    if ($row['selfCheckout'] != '1') {
        $disableSelfCheckout = 'disabled';
    }
} else {
    $disableSelfCheckout = 'disabled';
}
$cartIsEmpty = '';
if (!isset($_SESSION['cartItems']) || empty($_SESSION['cartItems'])) {
    $cartIsEmpty = 'disabled';
}
?>
<html>
<head>
    <title>
        BookCenter: Summary Of Cart
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



    </style>
    <script type="text/javascript" src='jquery-1.4.1.js'></script>
    <script type="text/javascript">

        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                $_SESSION['redirectUrl'] = 'summaryCart.php';
                echo "$( document ).ready(function() {" .
                     " alert('Please Login. You will redirected back to this page after login');" .
                     " window.location.href='Login.php';" .
                "});";
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

        function pickUpItems(redirectURLValue) {
            $('#redirectURL').val(redirectURLValue);
            $('#activeRecordsForm').submit();
        }

        function addTransaction() {
            $('#activeRecordsForm').attr('action', 'createTransaction.php');
            $('#redirectURL').val('CustomerOrderHistory.php');
            $('#activeRecordsForm').submit();
        }

        function shipItems() {
            $('#redirectURL').val('customerShipping.php');
            $('#activeRecordsForm').submit();
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Summary of cart </h2>
<form method=post action="shoppingCart.php">
    <table>
        <tr>
            <td>Customer </td>
            <td> <?php echo $_SESSION['name']; ?></td>
        </tr>
        <tr>
            <td>  Date</td>
            <td> <?php echo date("m/d/y"); ?> </td>
        </tr>
        <tr>
            <td>  Store</td>
            <td>  <?php echo isset($_SESSION['libraryName']) ? $_SESSION['libraryName'] : 'No Library Selected'; ?> </td>
        </tr>
    </table>
    <table class="priceChart">
        <tr>
            <th> Title </th>
            <th> Qty. </th>
            <th> Call# </th>
            <th> Price </th>
            <th> Desc. </th>
        </tr>
        <?php
            $count = 0;
            $totalPrice = 0;
            $tax = 0;
            $onlyBorrow = true;
            if(isset($_SESSION['cartItems'])) {
                $itemsJSON = json_decode($_SESSION['cartItems']) ;
                $cartIsEmpty = 'disabled';
                foreach ( $itemsJSON as $item) {
                    $itemJSON = json_decode(json_encode($item), true);
                    echo "<tr><td>" . $itemJSON['item'] . "</td>";
                    echo "<td>" . $itemJSON['qty'] . "</td>";
                    echo "<td>" ."" . "</td>";
                    if ($itemJSON['type'] == 'buy') {
                        $totalPrice = $totalPrice +  $itemJSON['qty']*$itemJSON['saleprice'];
                        echo "<td>" .  $itemJSON['qty']*$itemJSON['saleprice'] . "</td>";
                        $onlyBorrow = false;
                    } else if ($itemJSON['type'] == 'rent') {
                        $totalPrice = $totalPrice +  $itemJSON['qty']*$itemJSON['rentprice'];
                        echo "<td>" .  $itemJSON['qty']*$itemJSON['rentprice'] . "</td>";
                        $onlyBorrow = false;
                    } else {
                        echo "<td>0</td>";
                    }
                    echo "<td>" . $itemJSON['desc'] . "</td></tr>";

                    $count = $count + 1;
                    $cartIsEmpty = '';
                }
            }

            while ($count < 4) {
                echo "<tr>";
                echo "<td> &nbsp;</td>";
                echo "<td>  &nbsp;</td>";
                echo "<td>  &nbsp;</td>";
                echo "<td>  &nbsp;</td>";
                echo "<td>  &nbsp;</td>";
                echo "</tr>";
                $count = $count + 1;
            } 
        ?>
        <tr>
            <td colspan=5> &nbsp;</td>
        </tr>
        <?php 
            if (!$onlyBorrow) {
                $disableSelfCheckout = 'disabled';
        ?>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Subtotal</th>
            <td colspan=2><?php echo $totalPrice; ?></td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Tax</th>
            <td colspan=2><?php echo $tax; ?></td>
        </tr>
        <tr class="last">
            <th colspan=2> &nbsp;</th>
            <th>  Total</th>
            <td colspan=2><?php echo $totalPrice * (1 + $tax); ?></td>
        </tr>
        <?php 
            }
        ?>
    </table>
    <table class="btnTable">
        <tr>
            <th> <input type="button" name="Self-Checkout" <?php echo $cartIsEmpty == 'disabled' ? $cartIsEmpty : $disableSelfCheckout; ?>
                        value="Self-Checkout" onclick="addTransaction();"></th>
                        <th> <input type="button" name="Pick-Up" <?php echo $cartIsEmpty; ?> onclick="pickUpItems('<?php 
            if ($totalPrice == 0 || $hasCardInfo) {
                echo 'CustomerActiveOrders.php';
            } else {
                echo 'payments.php';
            }
            ?>');" value="Pick-Up"></th>
        </tr>
        <tr>
            <th>  <input type="button" name="Shipping" <?php echo $cartIsEmpty; ?> value="Shipping" onclick="shipItems();"></th>
            <th>  <input type="button" name="Cancel" onclick="window.location.href='homepage.php';" value="Cancel"></th>
        </tr>
    </table>
</form>
<form action='createActiveRecords.php' id="activeRecordsForm" method='post'>
<input type='hidden' name='subtotal' value='<?php echo $totalPrice; ?>'>
<input type='hidden' name='tax' value='<?php echo $tax; ?>'>
<input type='hidden' name='total' value='<?php echo $totalPrice * (1 + $tax); ?>'>
<input type='hidden' name='redirectURL' id='redirectURL' value=''>
</form>
</body>
</html>
