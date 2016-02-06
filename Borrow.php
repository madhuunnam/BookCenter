<?php
session_start();
?>
<html>
<head>
    <title>
        Borrow
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

        .borrowTable, .ui-widget , .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
            font-family: sans-serif !important ;
            font-size: 14px !important;
        }

    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">

        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                echo "$( document ).ready(function() { window.location.href='homepage.php';});";
            }

            $con = mysql_connect('localhost', 'webclient', '12345678');
                    
            if (!$con) {
                die('Failed to conect to MySQL: ' . mysql_error());
            }

             $db_selected = mysql_select_db("bookstore");

            if (!$db_selected) {
                die('Can\'t use the db :' . mysql_error());
            }

            $sql = "select count(*) as hasStores, storeName, storeID from stores group by storeName";
            $result = mysql_query($sql);
            echo 'var storeNames = new Array();';
            echo 'var storeMap = new Object();';
            while ($row = mysql_fetch_assoc($result)) {
                if ($row['hasStores'] != 0) {
                    echo 'storeNames.push("'.$row['storeName'].'");';
                    echo 'storeMap["'.$row['storeName'].'"] = "'.$row['storeID'].'";';
                }
            }
            $customerID = $_SESSION['custID'];
            $sql1 = "select homeLib from Customers where custID = $customerID";
            $result1 = mysql_query($sql1);
            while ($row1 = mysql_fetch_assoc($result1)) {
            	$homelib = $row1['homeLib'];
            }
            
            
        ?>

        $(document).ready(function () {
            $( "#libraryName" ).autocomplete({
              source: storeNames
            });
        });

    cartItems = new Array();
    removedCartItems = new Array();    
    function removeCartEntry(i) {
        price = parseFloat($('#remove' + i + 'Price').html());
        tax = parseFloat($('#cartTax').val());
        total = parseFloat($('#cartTotal').val()) - price;
        $('#cartSubTotal').val(total);
        $('#cartTotal').val(total * (1 + tax));
        console.log(price);
        console.log(tax);
        console.log(total);

        $('#cartEntry' + i).remove();
        removedCartItems.push(i);
    }

    function showcart() {
        $('.cartItemEntries').remove();
        i = 0;
        totalPrice = 0;
        $('#cartTable').empty();
        $('#cartTable').html('<tr><td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>'+
        '</tr><tr>'+ 
        '<th style="width:150px; text-align:left;" >Item</th>'+
        '<th style="width:50px;  text-align:center;">Quantity</th>'+
        '</tr>');
        for (itemNumber in cartItems) {
            itemJSON = cartItems[itemNumber];
            price = 0;
            if (itemJSON['type'] == 'buy') {
                price = itemJSON['qty'] * itemJSON['saleprice'];
            } else if (itemJSON['type'] == 'rent') {
                price =  itemJSON['qty'] * itemJSON['rentprice'];
            } 

            totalPrice = totalPrice + price;
            $('#cartTable tr:last').after('<tr id="cartEntry' + i + '" class="cartItemEntries">' + 
                '<td>' + itemJSON['item'] + '</td>' +
                '<td style="width:50px;  text-align:center;">' + itemJSON['qty'] + '</td>' + 
                '<td><a href="#" onclick="removeCartEntry('+ i + ');">Del</a></td>' +
                '</tr>');
            i = i + 1;
        }

        while (i < 10) {
            $('#cartTable tr:last').after('<tr><td colspan=5></td></tr>');
            i = i + 1;
        }

        $('#cartSubTotal').val(totalPrice);
        $('#cartTax').val(0);
        $('#cartTotal').val(totalPrice);
        $('#cartDialog').dialog({
            width: 300,
            heightStyle: 'content',
            modal: true,
            buttons: {
                    "Checkout": function() {
                        $( this ).dialog( "close" );
                        checkout();
                    }
                }
        });
    }

    function checkout() {
        $('#redirectUrl').val('summaryCart.php');
        storeName = $('#libraryName').val();
        $('#storeName').val(storeName);
        $('#storeID').val(storeMap[storeName]);
        i = 0;
        newCartItems = new Array();
        for (itemNumber in cartItems) {
            addItem = true;
            for ( index in removedCartItems) {
                if(removedCartItems[index] == i) {
                    addItem = false;
                }
            }
            
            if (addItem) {
                newCartItems.push(cartItems[itemNumber]);
            }

            i = i + 1;
        }
        $('#cartItems').val(JSON.stringify(newCartItems));
        $('#summaryCartForm').submit();
    }


        function validate() {
           
            Store = $('#libraryName').val();
            if (Store == "") {
                alert("Please enter a library name");
            } else if ($.inArray(Store, storeNames) == -1) {
                alert("No Library found with the name provided");
            } else {
                var bookRefArray = new Array();  
                var i = 0;
                $(".bookRef").each(function(){
                    var bookRef = $(this).val();
                    if( bookRef != '' && $.inArray(bookRef, bookRefArray) == -1 ){
                        bookRefArray[i++] = bookRef;
                    }
                });
              
                if (i == 0) {
                    alert("Please provide the information of books you want to borrow. ");
                } else {
                    data = {
                        'storeID' : storeMap[Store],
                        'field': $('#key').val(),
                        'values': bookRefArray
                    }

                    $.ajax({
                      method: "POST",
                      url: "bulkBorrow.php",
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

                            cartItems = responseJSON['cartItems'];
                            removedCartItems = new Array();

                            showcart();
                        }
                    });
                }
            }
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Borrow </h2>
<form id='borrowForm' method=post action="summaryCart.php">
    <table class="borrowTable">
        <tr>
            <td>  </td>
            <td style="text-align:center;" colspan=3> Borrow by : <Select id="key" name="key">
                    <option value="privateCallNum">Private Call Number</option>
                    <option value="isbn">ISBN</option>
                    <option value="callNum">Call Number</option>
                </Select> </td>
            <td>  </td>
            <td>  </td>
        </tr>
        <tr>
            <td>  </td>
            <td  style="text-align:center;" colspan=3> 
                <div class="ui-widget">
                    <label for="libraryName">From Library: </label>
                    <input type="text" style="padding-left:5px;" name="libraryName" id="libraryName" value="<?php echo $homelib;?>" placeholder="Default Library Name" > 
                </div>
            </td>
            <td>  </td>
        </tr>
        <tr>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
            <td> <input type="text" name="bookRef" class="bookRef" id="bookRef"> </td>
        </tr>
        <tr>
            <td colspan="5" class="submitBtnTd"> <input type="button" name="borrow" id="borrow" value="Borrow" onclick="javascript:validate();"> 
            <input type=hidden name="borrowed" value="borrowed"></td>

        </tr>
    </table>
</form>
<form method='post' action='addDataSession.php' id="summaryCartForm">
                    <input type="hidden" id="storeID" name="storeID" value="">
                    <input type="hidden" id="storeName" name="libraryName" value="">
                    <input type="hidden" id="cartItems" name="cartItems" value="">
                    <input type="hidden" id="redirectUrl" name="redirectUrl" value="">
                </form>
<div id='cartDialog' style='display:none;'> 
    <table id="cartTable">
        <tr> 
            <td colspan=5 align="center" style="text-align:center"><h3 style="text-align:center"> Your Cart </h3></td>
        </tr>
        <tr> 
            <th style="width:150px">Item</th>
            <th style="width:50px">Quantity</th>
        </tr>
    </table>
</div>
</body>
</html>
