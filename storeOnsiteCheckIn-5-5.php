<?php
session_start();
if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
    header("location: Login.php");
    die();
} else {
?>
<html>
<head>
    <title>
        Store Onsite Checkin
    </title>
    <style>
        html{
            font-size: 62.5%;
        }
        body {
            text-align: center;
        }

        table {
            margin: 0 auto; /* or margin: 0 auto 0 auto */
            text-align:left;
        }

        #cartTable th {
            padding:10px;
            background-color: #eee;
            border:1px solid #eee;
            text-align: Center;
        }
        td {
            padding: 10px;
            text-align: left;
        }

        .submitBtnTd {
            text-align: center;
            vertical-align: center;
        }

        .reportButton {
            padding:5px;
            text-decoration: none;
            border:1px solid #eee;
            background-color: #eee;
            border-radius: 5px;
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

            if (isset($_SESSION['orderType'])) {
            ?>
                $(document).ready(function() {
                     $("#borrowForm input:radio[value='<?php echo $_SESSION['orderType']; ?>']").attr('checked', true);
                });
            <?php
            } 
        ?>

        cartItems = <?php 
        if (isset($_SESSION['cartItems'])) {
                echo $_SESSION['cartItems'];
                echo ";";
            ?>
                $(document).ready(function() {
                    addToCart();
                });
            <?php
            } else {
                echo "new Array();";
            }
        ?>
        reportItems = <?php 
        if (isset($_SESSION['reportItems'])) {
                echo $_SESSION['reportItems'];
                echo ";";
            ?>
                $(document).ready(function() {
                    updateTotals();
                });
            <?php
            } else {
                echo "{};";
            }
        ?>
        
            
        
        $( document ).ready(function() { 
            if (cartItems.length == 0) {
                $('#cartTable').hide();
                $('.priceTable').hide();
                $('#cartSubmit').hide();
            }

            $('#custID').val(<?php 
                echo '';
                if (isset($_SESSION['custID'])) {
                    echo $_SESSION['custID'];
                }
                ?>);
            $('#firstName').val('<?php 
                echo '';
                if (isset($_SESSION['custFirstName'])) {
                    echo $_SESSION['custFirstName'];
                }
                ?>');
            $('#lastName').val('<?php 
                echo '';
                if (isset($_SESSION['custLastName'])) {
                    echo $_SESSION['custLastName'];
                }
                ?>');
        });

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
                    totalFine = totalFine + parseInt(['fineFee']);
                }
            });

            $('#damageTotal').val(totalDamage);
            $('#lostTotal').val(totalLost);
            $('#fineTotal').val(totalFine);
            $('#cartTotal').val(totalDamage + totalLost + totalFine + parseInt($('#cartSubTotal').val()));
            $('#total').val(totalDamage + totalLost + totalFine + parseInt($('#cartSubTotal').val()));
        }

        function addToCart() {
            $("#borrowForm input[type='radio']").each(function() {
                $(this).attr('disabled', 'disabled');
            });

            orderType = $("#borrowForm input[type='radio']:checked").val();

            $('#cartTable').empty();
            $('#cartTable').show();
            $('.priceTable').show();
            $('#cartSubmit').show();

            priceColumn = '<th style="width:150px">Price</th>'
            if (orderType == 'borrow') {
                priceColumn = "";
            }

            $('#cartTable').html('<tr><td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>'+
            '</tr><tr>'+ 
            '<th style="width:150px" >Title</th>'+
            '<th style="width:150px">Call Number</th>'+
            priceColumn +
            '</tr>');
            i = 0;
            totalPrice = 0;
            for (itemNumber in cartItems) {
                itemJSON = cartItems[itemNumber];
                price = 0;
                if (itemJSON['type'] == 'buy') {
                    price = itemJSON['qty'] * itemJSON['salePrice'];
                } else if (itemJSON['type'] == 'rent') {
                    price =  itemJSON['qty'] * itemJSON['rentPrice'];
                } 

                totalPrice = totalPrice + price;

                priceValue = '<td id="remove'+ i + 'Price">' + price + '</td>';
                if (orderType == 'borrow') {
                    priceValue = "";
                }
                
                if (orderType == 'borrowReturn' || orderType == 'rentReturn') {
                    priceValue +=  '<td><button class="reportButton" onclick="report('+ i + ');">Report</button></td>';
                }
                

                $('#cartTable tr:last').after('<tr id="cartEntry' + i + '" class="cartItemEntries">' + 
                    '<td id="cartEntry' + i + 'Title">' + itemJSON['item'] + '</td>' +
                    '<td id="cartEntry' + i + 'PrivateCallNum">' + itemJSON['privateCallNum'] + '</td>' +
                    priceValue +
                    '</tr>');
                i = i + 1;
            }

            if (orderType == 'borrow') {
                $('#priceTable').hide();
            }

            $('#cartSubTotal').val(totalPrice);
            $('#cartTax').val(0);
            $('#cartTotal').val(totalPrice);
            $('#total').val(totalPrice);
            $('#tax').val(0);
            $('#subtotal').val(totalPrice);

            $(".bookRef").each(function(){
                $(this).val("");
            });

        }

        function findCustomer() {
            firstName = $('#firstName').val();
            lastName = $('#lastName').val();

            if (firstName != "" && lastName != "") {
                data = {
                    'firstName' : firstName,
                    'lastName' : lastName
                }

                $.ajax({
                    method: "POST",
                    url: "findCustomer.php",
                    data: data
                }).done(function( response ) {
                    responseJSON = JSON.parse(response);
                    if (responseJSON['error'] != undefined) {
                        alert(responseJSON['error']);
                    } else {
                        $('#custID').val(responseJSON['customers'][0]['custID']);
                        $('#custFirstName').val(responseJSON['customers'][0]['firstName']);
                        $('#custLastName').val(responseJSON['customers'][0]['lastName']);
                    }
                });
            }
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

        function validate() {        
            Store = "<?php $_SESSION['name'] ?>";
            orderType = $("#borrowForm input[type='radio']:checked").val();
            if (orderType != undefined) {
                var bookRefArray = new Array();  
                var i = 0;
                $(".bookRef").each(function(){
                    var bookRef = $(this).val();
                    if( bookRef != '' && $.inArray(bookRef, bookRefArray) == -1 ){
                        bookRefArray[i++] = bookRef;
                    }
                });

                if (i == 0) {
                    alert("Please provide the information of books. ");
                } else if ((orderType == 'borrowReturn' || orderType == 'rentReturn') && $('#custID').val() == '') {
                    alert("For returns, customer information is required");
                } else {
                    data = {
                        'storeID' : <?php echo $_SESSION['storeID']; ?>,
                        'field': $('#key').val(),
                        'values': bookRefArray,
                        'type': $("#borrowForm input[type='radio']:checked").val(),
                        'custID': $('#custID').val()
                    }

                    $.ajax({
                      method: "POST",
                      url: "bulkCheckIn.php",
                      data: data
                    }).done(function( response ) {
                        responseJSON = JSON.parse(response);
                        if (responseJSON['error'] != undefined) {
                            alert(responseJSON['error']);
                        } else {
                            unfound = $(bookRefArray).not(responseJSON['found']).get();
                            if (unfound.length > 0) {
                                alert("Unable to borrow " + unfound.toString());
                            } 

                            responseJSON['cartItems'].forEach(function(entry) {
                                cartItems.push(entry);
                            });
                            addToCart();
                        }
                    });
                }
            } else {
                alert("Please select a service");
            }
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Online Store Check-In </h2>
<form id='borrowForm' method=post action="summaryCart.php">
    <table>
        <tr>
            <td>Service: </td>
            <td><input class='radio' name="type" type="radio" value='borrow' onclick=""/>  Lend </td>
            <td><input class='radio' name="type" type="radio" value='buy' onclick=""/>  Sell </td>
            <td><input class='radio' name="type" type="radio" value='rent' onclick=""/>  Rent  </td>
            <td><input class='radio' name="type" type="radio" value='rentReturn' onclick=""/>  Rent Return  </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan=2><input class='radio' name="type" type="radio" value='borrowReturn' onclick=""/>  Problematic Borrow Return  </td>
        </tr>
        <tr>
            <td> By : <Select id="key" name="key">
                    <option value="isbn">ISBN</option>
                    <option value="callNum">Call Number</option>
                    <option value="privateCallNum">Private Call Number</option>
                </Select> </td>
        </tr>
        <tr>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
            <td> <input type="text" class="bookRef" name="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td colspan="5" class="submitBtnTd"> <input type="button" name="more" id="more" value="More/Add to Cart" onclick="validate();"> 
            <input type=hidden name="borrowed" value="borrowed"></td>
        </tr>
        <tr>
            <td colspan="5" class="submitBtnTd"> <hr> </td>
        </tr>
         <tr>
            <td> &nbsp;</td>
            <td> <input type="text" name="firstName" id="firstName" onblur="findCustomer();" placeholder="First Name" value=""> </td>
            <td> <input type="text" name="lastName" id="lastName" onblur="findCustomer();" placeholder="Last Name"> </td>
            <td> &nbsp;</td>
            <td> &nbsp;</td>
        </tr>
        <tr>
            <td colspan="5" class="centerTb"> <hr> </td>
        </tr>
    </table>
</form>
    <table id="cartTable">
        <tr>
            <td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>
        </tr>
        <tr>
            <tH  style="width:150px">Title </tH>
            <tH  style="width:150px">Call #</tH>
            <tH  style="width:150px" id='priceColumn'>Price</tH>
        </tr>
    </table>
    <table id='priceTable' class='priceTable'>
        <tr>
            <td colspan="5" class="centerTb"> <hr> </td>
        </tr>
        <tr class="priceCart">
            <td> &nbsp;</td>
            <td> Subtotal:</td>
            <td>  <input type="text" disabled  id="cartSubTotal" value="0"> </td>
            <td> Total Damage: </td>
            <td> <input type="text" disabled  id="damageTotal" value="0"></td>
        </tr>
        <tr  class="priceCart">
            <td> &nbsp;</td>
            <td> Tax:  </td>
            <td> <input type="text" disabled  id="cartTax" value="0"> </td>
            <td> Total Lost: </td>
            <td> <input type="text" disabled  id="lostTotal" value="0"></td>
        </tr>
        <tr  class="priceCart">
            <td> &nbsp;</td>
            <td>Total: </td>
            <td> <input type="text" disabled  id="cartTotal" value="0">   </td>
            <td> Total Fine: </td>
            <td> <input type="text" disabled  id="fineTotal" value="0"> </td>
        </tr>
    </table>
    <form method='post' action='addDataSession.php' id="summaryCartForm">
        <input type="hidden" id="cartItems" name="cartItems" value="">
        <input type="hidden" id="reportItems" name="reportItems" value="">
        <input type="hidden" id="redirectUrl" name="redirectUrl" value="">
        <input type="hidden" id="orderType" name="orderType" value="">
        <input type="hidden" id="custID" name='custID' value="">
        <input type="hidden" id="custFirstName" name='custFirstName' value="">
        <input type="hidden" id="custLastName" name='custLastName' value="">
        <input type="hidden" id="total" name='total' value=""> 
        <input type="hidden" id="tax" name='tax' value=""> 
        <input type="hidden" id="subtotal" name='subtotal' value=""> 
        
    </form>
    <button style="margin-bottom:20px;" id='cartSubmit' name="submit" value="Submit" onclick="submit();">Submit</button>
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
</body>
</html>
<?php } ?>