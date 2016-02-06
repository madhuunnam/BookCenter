<?php
session_start();
?>
<html>
    <style type="text/css">
        h2 {
            text-align: center;
            margin:50px;
        }

        table {
            text-align: left;
            margin-left:auto; 
            margin-right:auto;
            margin-bottom:20px;
        }

        td {
            margin:20px;
        }

        input[type=submit], input[type=button] {
            -webkit-appearance: none;
            height: 2em;
            width: 12em;
            font-size: 1em;
            border-radius: 5px;
        }

        sup {
            color: RED;
        }

        .markRed {
            border: solid 2px RED;
        }
    </style>
    <script type="text/javascript" src='jquery-1.4.1.js'></script>
    <script type="text/javascript">
        <?php
            $custID = $_SESSION['custID'];
            if(isset($_POST['submitted']) && $_POST['submitted'] == '1') {
                $result = "";
                $message = "";
                $cardNum = $_POST['cardNum'];
                $cardType = $_POST['cardType'];
                $cardName = $_POST['cardName'];
                $expDate = $_POST['expYear'] . '-' . $_POST['expMonth'] . '-01';
                $secCode = $_POST['secCode'];
                $billingAddr = $_POST['billingAddr'];
                $paypalNum = $_POST['paypalNum'];
                $agentName = $_POST['agentName'];
                $payment = $_POST['payment'];

                if ($result != "") {
                    $message = 'Please fill all the required fields';
                } else {
                    $con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $sql="UPDATE `customers` SET `cardNumber`='".$cardNum."', `cardType`='".$cardType."', `cardName`='".$cardName."', `cardExp`='".$expDate."', `cardCode`='".$secCode."', `billingAddr`='".$billingAddr."', `paypalNum`='".$paypalNum."' WHERE `custID`=".$custID;
        
                    if (!mysqli_query($con, $sql)) {
                        $message="Unable to Update. Please try again " . $sql;
                    } else {
                        if ($cardNum != '' && $cardType != '' && $cardName != '' && 
                            $expDate != '' && $secCode != '' && $billingAddr != '') {
                            echo "$(document).ready(function() { \n";
                            echo "$('#submittedPayment').val('" . $_POST['payment'] .  "');\n"; 
                            echo "$('#submittedPaymentType').val('" . $cardType .  "');\n"; 
                            echo "$('#submittedAgent').val('" . $_POST['agentName'] .  "');\n"; 
                            echo "$('#transactionForm').submit();\n"; 
                            echo "});\n";
                        } else {
                            echo "$(document).ready(function() { \n";
                            echo "alert('Please provide all the user payment infromation and then click submit');"; 
                            echo "});\n";
                        }
                    }
                }

                if ($message != "") {
                    echo "$(document).ready(function() { \n";
                    echo "alert('" . $message . "');\n";
                    echo "$('#cardNum').val('" . $cardNum .  "');\n";
                    echo "$('#cardType').val('" . $cardType .  "');\n";
                    echo "$('#cardName').val('" . $cardName .  "');\n";
                    echo "$('#expYear').val('" . explode('-', $expDate)[0] .  "');\n";
                    echo "$('#expMonth').val('" . explode('-', $expDate)[1] .  "');\n";
                    echo "$('#secCode').val('" . $secCode .  "');\n";
                    echo "$('#billingAddr').val('" . $billingAddr .  "');\n"; 
                    echo "$('#paypalNum').val('" . $paypalNum .  "');\n"; 
                    echo "$('#agentName').val('" . $agentName .  "');\n"; 
                    echo "$('#payment').val('" . $payment .  "');\n"; 
                    echo "});\n";
                }
            } else {
                if ($custID == null) {
                     echo 'window.location.href = "storeOnsiteCheckIn.php";';
                } else {
                    $con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $sql = "SELECT * FROM customers WHERE custID='".$custID."'";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($user = mysqli_fetch_assoc($result)) {
                            echo "$(document).ready(function() { \n";
                            echo "$('#name').html('" . $user['firstName'] . " " . $user['lastName'] .  "');\n";
                            echo "$('#cardNum').val('" . $user['cardNumber'] .  "');\n";
                            echo "$('#cardType').val('" . $user['cardType'] .  "');\n";
                            echo "$('#cardName').val('" . $user['cardName'] .  "');\n";
                            echo "$('#expYear').val('" . explode('-', $user['cardExp'])[0] .  "');\n";
                            if ($user['cardExp'] != '')
                                echo "$('#expMonth').val('" . explode('-',  $user['cardExp'])[1] .  "');\n";
                            echo "$('#secCode').val('" . $user['cardCode'] .  "');\n";
                            echo "$('#billingAddr').val('" . $user['billingAddr'] .  "');\n";
                            echo "$('#paypalNum').val('" . $user['paypalNum'] .  "');\n"; 
                            // $reportItems = json_decode($_SESSION['reportItems'], true);
                            

                            // foreach($reportItems as $key) {
                            //     if ($key['damageCheck']) {
                            //         $totalValue = intval($key['damageFee']);
                            //     }
                            //     if ($key['lostPaidCheck']) {
                            //         $totalValue = intval($key['lostFee']);
                            //     }
                            //     if ($key['fineCheck']) {
                            //         $totalValue = intval($key['fineFee']);
                            //     }
                            // }

                            $totalValue = $_SESSION['total'];
                            echo "$('#total').val('".$totalValue ."');\n";
                            echo "});\n";
                        }
                    } else {
                        echo "alert('0 results');";
                    }
                    

                }
            }
        ?>
    </script>
    <?php include 'NavigationBar.php'; ?>
    <body>
        <h2> Store On-Site Checkout</h2>
        <div style="text-align:center;">
        <form method='post' action='storeOnsitePayment.php'>
            <input type="hidden" name="submitted" value="1"/>
            <table>
                <tr>
                    <th> Card #<sup>*</sup> </th>
                    <td > <input type=text id="cardNum" name="cardNum" /> </td>
                    <th> Type<sup>*</sup> </th>
                    <td > <Select  id="cardType" name="cardType">
                            <option value="Amex">Amex</option>
                            <option value="Discover">Discover</option>
                            <option value="Master">Master</option>
                            <option value="Visa">Visa</option>
                        </Select> 
                    </td>
                </tr>
                <tr>
                    <th> Name on Card<sup>*</sup> </th>
                    <td > <input type=text id="cardName" name="cardName" /> </td>
                    <th> Exp. Date<sup>*</sup> </th>
                    <td ><Select  id="expMonth" name="expMonth">
                            <option value="01">January</option>
                            <option value="02">Feburary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </Select>
                        <Select  id="expYear" name="expYear">
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </Select>
                    </td>
                    <th> CVV<sup>*</sup> </th>
                    <td > <input type=text id="secCode" name="secCode" /></td>
                </tr>
                <tr>
                    <th> Billing Address<sup>*</sup> </th>
                    <td colspan="3"> <input size=80 type=text id="billingAddr" name="billingAddr" /> </td>
                </tr>
                <tr>
                    <th> &nbsp; </th>
                    <th colspan=2> &nbsp; </th>
                    <td > Total Charge : <input type=text id="total" name="total" value=""/> </td>
                    <th> &nbsp; </th>
                </tr>
                <tr>
                    <th> Paypal # </th>
                    <td colspan="2"> <input size=50 type=text id="paypalNum" name="paypalNum" /> </td>
                    <td> Payment: <input type=text id="payment" name="payment" /> </td>
                    <th> &nbsp; </th>
                    
                </tr>
                <tr>
                    <th> &nbsp; </th>
                    <th colspan=2> &nbsp; </th>
                    <td > Agent Name : <input type=text id="agentName" name="agentName" /> </td>
                    <th> &nbsp; </th>
                    
                </tr>
            </table>
            <input type="submit" value="Submit">
        </form>
        </div>
        <form id='transactionForm' method='post' action='createPaidStoreTransaction.php'>
        <input type='hidden' id='submittedPaymentType' name='paymentType' value=''>
        <input type=hidden id="submittedPayment" name="payment" value=""/>
        <input type=hidden id="submittedAgent" name="agentName" value=""/>
        </form>
    </body>

</html>