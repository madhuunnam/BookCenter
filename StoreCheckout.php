<?php
session_start();

$tid = "";
if(isset($_GET['tid'])) {
  $tid = $_GET['tid']; 
} 
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
            border:0px;
        }

        td, th {
            padding: 5px;
            border:0px;
        }

        #lineItemsTable th {
            border:1px solid #eee;
            background-color: #eee;
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

        .ui-dialog input {
            font-size:62.5% !important;
            padding:5px !important;
        }

    </style>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">

        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
                echo "$( document ).ready(function() { window.location.href='homepage.php';});";
            } 
        ?>

        function goBack() {
            window.history.back();
        }

        reportItems = {};
        function report(index) {
            $('#reportTitle').html($('#cartEntry' + index + 'Title').html());

            if (reportItems[index] != undefined) {
                reportItem = reportItems[index];

                $('#damageCheck').prop('checked', reportItem['damageCheck']);
                $('#lostUnpaidCheck').prop('checked', reportItem['lostUnpaidCheck']);
                $('#lostPaidCheck').prop('checked', reportItem['lostPaidCheck']);
                $('#fineCheck').prop('checked', reportItem['fineCheck']);
                $('#damageFee').val(reportItem['damageFee']);
                $('#damageDesc').val(reportItem['damageDesc']);
                $('#lostFee').val(reportItem['lostFee']);
                $('#fineFee').val(reportItem['fineFee']);
            } else {
                $('#damageCheck').prop('checked', false);
                $('#lostUnpaidCheck').prop('checked', false);
                $('#lostPaidCheck').prop('checked', false);
                $('#fineCheck').prop('checked', false);
                $('#damageFee').val('');
                $('#damageDesc').val('');
                $('#lostFee').val('');
                $('#fineFee').val('');
            }

            $('#reportDialog').dialog({
                modal: true,
                width: 450,
                buttons: {
                    "Submit": function() {
                        reportItem = {};
                        reportItem['damageCheck'] = $('#damageCheck').prop('checked');
                        reportItem['lostUnpaidCheck'] = $('#lostUnpaidCheck').prop('checked');
                        reportItem['lostPaidCheck'] = $('#lostPaidCheck').prop('checked');
                        reportItem['fineCheck'] = $('#fineCheck').prop('checked');
                        reportItem['damageFee'] = $('#damageFee').val();
                        reportItem['damageDesc'] = $('#damageDesc').val();
                        reportItem['lostFee'] = $('#lostFee').val();
                        reportItem['fineFee'] = $('#fineFee').val();

                        reportItems[index] = reportItem;
                        updateTotals();
                        $( this ).dialog( "close" );
                    }
                }
            });
        }
        
        function updateTotals() {
            var totalDamage = 0;
            var totalLost = 0;
            var totalFine = 0;

            $.each(reportItems, function(i, item) {
                if (item['damageCheck']) {
                    totalDamage = totalDamage + parseInt(item['damageFee']);
                }

                if (item['lostPaidCheck']) {
                    totalLost = totalLost + parseInt(item['lostFee']);
                }

                if (item['fineCheck']) {
                    totalFine = totalFine + parseInt(item['fineFee']);
                }
            });

            $('#damageTotal').val(totalDamage);
            $('#lostTotal').val(totalLost);
            $('#fineTotal').val(totalFine);
            $('#cartTotal').val(totalDamage + totalLost + totalFine + parseInt($('#cartSubTotal').val()));
            var totalPrice = (totalDamage + totalLost + totalFine + parseInt($('#cartSubTotal').val()) + parseFloat($('#cartShipping').val())) * (1 + parseFloat($('#cartTax').val()));
            $('#htotal').val(totalPrice);
            $('#hdamageTotal').val(totalDamage);
            $('#hlostTotal').val(totalLost);
            $('#hfineTotal').val(totalFine);
            $('#hcartTotal').val(totalDamage + totalLost + totalFine + parseInt($('#cartSubTotal').val()));
            $('#htotal').val(totalPrice);
        }


        function submit() {
            if ($('#custID').val() == "") {
                alert("Please enter customer first name and last name");
            } else {
                $('#redirectUrl').val('storeOnsitePayment.php');
                if ($("#borrowForm input[type='radio']:checked").val() == 'borrow') {
                    $('#redirectUrl').val('createStoreTransaction.php');
                }
                $('#cartItems').val(JSON.stringify(cartItems));
                $('#reportItems').val(JSON.stringify(reportItems));
                $('#orderType').val($("#borrowForm input[type='radio']:checked").val());
                $('#summaryCartForm').submit();
            }
        }

    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Store Online Checkout </h2>
<div id="transactionInfo" >
<table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
  <?php 
        $con = mysql_connect('localhost', 'webclient', '12345678');
                    
        if (!$con) {
            die('Failed to conect to MySQL: ' . mysql_error());
        }

        $db_selected = mysql_select_db("bookstore");

        if (!$db_selected) {
            die('Can\'t use the db :' . mysql_error());
        }

        $resultRow = null;
        if ($tid == "") {
            echo "<script type='text/javascript'>$( document ).ready(function() { ". 
                'alert("Please Checkout a Transaction from the Order status page");';
            echo 'window.location.href="StoreOrderStatus.php";});</script>';
        } else {
            $sql  = ' SELECT *, "active" AS state FROM activeorders WHERE tid='.$tid.' AND storeID='.$_SESSION['storeID'];

            $result = mysql_query($sql);
            while($row = mysql_fetch_assoc($result))
                $resultRow = $row;

            if ($resultRow == null) {
                echo "<script type='text/javascript'>$( document ).ready(function() { ". 
                  'alert("Couldn\'t find Transaction Info for transaction id provided");';
                echo 'window.location.href="StoreOrderStatus.php";});</script>';
            } 
        }

        if($resultRow != null) {

  ?>
  <tbody>
    <tr>
      <th style="vertical-align: middle;">Date:<br>
      </th>
      <td style="vertical-align: top;"><?php echo explode(" ", $resultRow['transTime'])[0]; ?>
      </td>
      <th style="vertical-align: middle;">Tid:<br>
      </th>
      <td style="vertical-align: top;"><?php echo $resultRow['tid']; ?></td>
    </tr>
    <tr>
      <th style="vertical-align: middle;">Store:<br>
      </th>
      <td style="vertical-align: top;"><?php echo $resultRow['storeName']; ?></td>
      <th style="vertical-align: middle;">StoreID:<br>
      </th>
      <td style="vertical-align: top;"><?php echo $resultRow['storeID']; ?></td>
    </tr>
    <tr>
      <th style="vertical-align: middle;">Customer:<br>
      </th>
      <td style="vertical-align: top;"><?php echo $resultRow['custFirstName']; ?> <?php echo $resultRow['custLastName']; ?></td>
      <th style="vertical-align: middle;">CustID:<br>
      </th>
      <td style="vertical-align: top;"> <?php echo $resultRow['custID']; ?></td>
    </tr>
  </tbody>
</table>
<br>
<hr>
<br>
<table id="lineItemsTable" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <th style="vertical-align: top;">Line #</th>
      <th style="vertical-align: top;">Title</th>
      <th style="vertical-align: top;">Qty</th>
      <th style="vertical-align: top;">Price</th>
      <th style="vertical-align: top;">Type</th>
      <th style="vertical-align: top;"></th>
    </tr>
    <?php
        $lineItemsSQL = 'SELECT * from lineitems WHERE tid='.$tid.' ORDER BY lineNumber';
        $lineItemsResult = mysql_query($lineItemsSQL);
        $countLineItems = 0;
        while($row = mysql_fetch_assoc($lineItemsResult)) {
            $countLineItems = $countLineItems + 1;
            echo "<tr>";
            echo '<td>'.$row["lineNumber"].'</td>';
            echo '<td id="cartEntry'.$countLineItems.'Title">'.$row["title"].'</td>';
            echo '<td>'.$row["orderQuantity"].'</td>';
            echo '<td>'.$row["priceAmount"].'</td>';
            echo '<td>'.$row["type"].'</td>';
            if ($row["type"] == 'borrowReturn' || $row["type"] == 'rentReturn') {
                echo  '<td><button onclick="report('.$countLineItems.');">Report</button></td>'; 
            } else {
                echo '<td> No Report</td>';
            }
            echo '</tr>';
        }


        if ($countLineItems == 0) {
            echo '<tr><td colspan=7> No items found for the provided transaction id</td></tr>';
        }

        $subTotal = $resultRow['subTot'] == '' ? 0 : $resultRow['subTot'] ;
        $tax = $resultRow['taxRatePercent'] == '' ? 0 : $resultRow['taxRatePercent'];
        $shipping = $resultRow['shipFee']  == '' ? 0 : $resultRow['shipFee'];
        $total = ($subTotal + $shipping) * ( 1 + $tax);
    ?>
  </tbody>
</table>
<br>
<hr>
<br>
<form method='post' action='processStorePayments.php'>
<table style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <th style="vertical-align: top;">Subtotal:</th>
      <td style="vertical-align: top;"><input type="text" disabled  id="cartSubTotal" name='subTotal' value="<?php echo $subTotal; ?>"> 
      <input type="hidden"   id="hcartSubTotal" name='subTotal' value="<?php echo $subTotal; ?>"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Tax:</th>
      <td style="vertical-align: top;"><input type="text" disabled  id="cartTax" name='tax' value="<?php echo $tax; ?>">
      <input type="hidden"   id="hcartTax" name='tax' value="<?php echo $tax; ?>"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Shipping:</th>
      <td style="vertical-align: top;"><input type="text" disabled  id="cartShipping" name='shipping' value="<?php echo $shipping; ?>">
      <input type="hidden"   id="hcartShipping" name='shipping' value="<?php echo $shipping; ?>"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Total Lost Fee:</th>
      <td style="vertical-align: top;"> <input type="text" disabled  id="lostTotal" name='totalLost' value="0">
      <input type="hidden"id="hlostTotal" name='totalLost' value="0"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Total Fee:</th>
      <td style="vertical-align: top;"> <input type="text" disabled  id="fineTotal" value="0">
      <input type="hidden"   id="hfineTotal" name='totalFine' value="0"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Total Damage Fee:</th>
      <td style="vertical-align: top;"> <input type="text" disabled  id="damageTotal" value="0">
      <input type="hidden"   id="hdamageTotal" name='totalDamage' value="0"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Total Charge:</th>
      <td style="vertical-align: top;"> <input type="text" disabled  id="cartTotal" value="<?php echo $total; ?>">
      <input type="hidden"   id="hcartTotal" name='total' value="<?php echo $total; ?>"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Payment:</th>
      <td style="vertical-align: top;"><input type="text" value="0" name="payment"></td>
    </tr>
    <tr>
      <th style="vertical-align: top;">Agent Name:</th>
      <td style="vertical-align: top;"><input type="text" value="" name="agentName">
      <input type='hidden' name='tid' value="<?php echo $resultRow['tid']; ?>" id='submittedTID'>
      <input type='hidden' name='custID' value="<?php echo $resultRow['custID']; ?>" id='submittedCustID'></td>
    </tr>
    <tr>
        <td><input type='submit' name='Submit' value='Submit' ></td>
    </tr>
  </tbody>
</table>
</form>
<br>

  <?php } ?>
<div id='reportDialog' style="display:none;"> 
        <h2>Report<br>
        <span id='reportTitle'> </span></h2>
        <table>
            <tr>
                <td><input  type='checkbox' id='damageCheck'> Damaged</td>
                <td><input type='text' id='damageFee' name='damageFee' value=''></td>
            </tr>
            <tr>
                <td> Damage Desc</td>
                <td><input type='text' id='damageDesc' name='damageDesc' value=''></td>
            </tr>
            <tr>
                <td><input type='checkbox' id='lostUnpaidCheck'> Lost Unpaid</td>
            </tr>
            <tr>
                <td><input type='checkbox' id='lostPaidCheck'> Lost Paid</td>
                <td><input type='text' id='lostFee' name='lostFee' value=''></td>
            </tr>
            <tr>
                <td><input type='checkbox' id='fineCheck'> Fine</td>
                <td><input type='text' id='fineFee' name='fineFee' value=''></td>
            </tr>
        </table>
    </div>
</body></html>