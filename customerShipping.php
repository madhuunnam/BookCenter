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
            border:1px solid #fff;
            border-radius: 5px;
            padding:10px;
            background-color: #fff;
        }

        .priceChart th {
            border:1px solid #fff;
            background-color: #fff;
            color:#222;
            text-align: left;
            border-radius: 5px;
            padding:10px;
        }

        .priceChart td {
            border-left:1px solid #fff;
            border-right:1px solid #fff;
            background-color: #fff;
            text-align: left;
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

        function checkAndSubmit() {
            if ($('#receiverName').val() == '') {
                alert('Please enter a receiver name');
            } else if ($('#shippingAddress').val() == '') {
                alert('Please enter a Street');
            } else if ($('#city').val() == '') {
                alert('Please enter a Cite');
            } else if ($('#state').val() == '') {
                alert('Please select a State');
            } else if ($('#zip').val() == '') {
                alert('Please enter a Zi[');
            } else if ($('#shippingMethod').val() == '') {
                alert('Please select a Shipping method');
            } else {
                $('#shippingConfirmationForm').submit();
            }
        }

        $(document).ready(function() {
            $('#sameAddress').click(function() {
                <?php 
                    $sql="select * from customers where custID=". $_SESSION["custID"];
                    $con = mysql_connect('localhost', 'webclient', '12345678');                   
                    if (!$con) {
                        die('Failed to conect to MySQL: ' . mysql_error());
                    }
                    $db_selected = mysql_select_db("bookstore");
                    if (!$db_selected) {
                        die('Can\'t use the db :' . mysql_error());
                    }

                    $result = mysql_query($sql);
                    while ( $row = mysql_fetch_assoc($result)) {
                        echo '$("#city").val("'.$row['city'].'");';
                        echo '$("#state").val("'.$row['state'].'");';
                        echo '$("#zip").val("'.$row['zip'].'");';
                        echo '$("#shippingAddress").val("'.$row['addrStNum'].'");';
                        echo '$("#shippingAddress2").val("'.$row['addrL2'].'");';
                    }

                ?>
                    $('#otherAddress').removeAttr('checked');
                    $('#updateAddress').val('');
            });
            $('#otherAddress').click(function() {
                $('#sameAddress').removeAttr('checked');
                if ($('#otherAddress').is(':checked')) {
                    $('#updateAddress').val('Y');
                } else {
                    $('#updateAddress').val('');
                }   
            });
        });
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Shipping </h2>
<form method=post action="customerShippingConfirmation.php" id="shippingConfirmationForm">
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
            <td>  <?php echo $_SESSION['libraryName']; ?> </td>
        </tr>
    </table>
    
    <table class="priceChart">
        <tr>
            <td colspan=2> <h3>Shipping Info:</h3>
                <hr></td>
        </tr>
        <tr>
            <th> Receiver Name<sup>*</sup>: </th>
            <td> <input type='text' name='receiverName' id='receiverName' value=""></td>
        </tr>
        <tr>
            <td colspan=2> <input class='radio'  name='sameAddress' id='sameAddress' value='same'  type="checkbox" onclick=""/>  Use customer home address as shipping address</td>
        </tr>
        <tr>
            <th> Shipping Address<sup>*</sup>: </th>
            <th> Street : <input type='text' name='shippingAddress' id='shippingAddress' style="width:250px;" value=""></th>
        </tr>
        <tr>
            <th> &nbsp; </th>
            <th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <input type='text' name='shippingAddress2' id='shippingAddress2' style="width:250px;" value=""></th>
        </tr>
        <tr>
            <th> &nbsp; </th>
            <th> City : <input type='text' name='city' id='city' style="width:100px;" value="">
                 &nbsp;&nbsp;&nbsp;State : <select id="state" name="state" tabindex="30" >
                            <option value="">Select</option>
                            <option value="AL">AL - Alabama</option>
                            <option value="AK">AK - Alaska</option>
                            <option value="AS">AS - American Samoa</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District of Columbia</option>
                            <option value="FM">FM - Federated States of Micronesia</option>
                            <option value="FL">FL - Florida</option>
                            <option value="GA">GA - Georgia</option>
                            <option value="GU">GU - Guam</option>
                            <option value="HI">HI - Hawaii</option>
                            <option value="ID">ID - Idaho</option>
                            <option value="IL">IL - Illinois</option>
                            <option value="IN">IN - Indiana</option>
                            <option value="IA">IA - Iowa</option>
                            <option value="KS">KS - Kansas</option>
                            <option value="KY">KY - Kentucky</option>
                            <option value="LA">LA - Louisiana</option>
                            <option value="ME">ME - Maine</option>
                            <option value="MH">MH - Marshall Islands</option>
                            <option value="MD">MD - Maryland</option>
                            <option value="MA">MA - Massachusetts</option>
                            <option value="MI">MI - Michigan</option>
                            <option value="MN">MN - Minnesota</option>
                            <option value="MS">MS - Mississippi</option>
                            <option value="MO">MO - Missouri</option>
                            <option value="MT">MT - Montana</option>
                            <option value="NE">NE - Nebraska</option>
                            <option value="NV">NV - Nevada</option>
                            <option value="NH">NH - New Hampshire</option>
                            <option value="NJ">NJ - New Jersey</option>
                            <option value="NM">NM - New Mexico</option>
                            <option value="NY">NY - New York</option>
                            <option value="NC">NC - North Carolina</option>
                            <option value="ND">ND - North Dakota</option>
                            <option value="MP">MP - Northern Mariana Islands</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PW">PW - Palau</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="PR">PR - Puerto Rico</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT">UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VI">VI - Virgin Islands</option>
                            <option value="VA">VA - Virginia</option>
                            <option value="WA">WA - Washington</option>
                            <option value="WV">WV - West Virginia</option>
                            <option value="WI">WI - Wisconsin</option>
                            <option value="WY">WY - Wyoming</option>
                        </select>
                 </th>
        </tr>
        <tr>
            <th> &nbsp; </th>
            <th> Zip : <input type='text' name='zip' id='zip' style="width:75px;" value=""></th>
        </tr>
        <tr>
            <td colspan=2> <input class='radio' name='otherAddress' id='otherAddress' value='update' type="checkbox" onclick=""/>  Also use this shipping address as my home address in my profile
                <input type='hidden' name='updateAddress' id='updateAddress' value="">
            </td>
        </tr>
        <tr>
            <th> Shipping Method<sup>*</sup>: </th>
            <td> <Select name="shippingMethod" id="shippingMethod">
                    <option value="">Select</option>
                    <option value="fedex-12.00">Fedex overnight - $12</option>
                    <option value="regular-3.90">Regular Mail - $3.90<br> &nbsp; (allow 3-6 business days)</option>
                    </Select>
            </td>
        </tr>
        <tr>
            <th> Carrier Name:</th>
            <td> <input type='text' name='carrierName' id='carrierName' value=""></td>
        </tr>
        <tr>
            <th>  Delivery Notes:</th>
            <td>  <input rows=4 type='text' name='deliveryNotes' id='deliveryNotes' value=""></td>
            <td>  &nbsp;</td>
        </tr>
        <tr>
            <th> </th>
            <td colspan=2> <input type='button' name='submitBtn' id='submitBtn' value="Continue" onclick="checkAndSubmit();"></td>
        </tr>
    </table>
</form>
</body>
</html>
