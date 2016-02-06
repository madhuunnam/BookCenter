<?php
session_start();
?>
<html>
<head>
    <title>
         Customer Out Items/Return
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
            padding: 10px;
            border:0px;
        }

        th {
          border-radius: 6px;
          background-color: #ddd;
        }

        button {
          padding:10px;
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

        var returnItems = {};
        
        function returnBooks() {
            returnItemsCount = 0;
            $('.returnCheck').each(function () {
                if (this.checked) {
                    refVal = $(this).val();
                    tid = $('#tid'+ refVal).val();
                    storeID = $('#storeID'+ refVal).val();
                    isbn = $('#isbn'+ refVal).val();
                    type = $('#type'+ refVal).val();

                    if (returnItems[storeID] == undefined) {
                        returnItems[storeID] = new Array();
                    }

                    returnData = {
                        'isbn': isbn,
                        'storeID': storeID,
                        'tid': tid,
                        'type': type
                    }

                    returnItems[storeID].push(returnData);
                    returnItemsCount++;
                }
            });

            if (returnItemsCount > 0) {
                $.ajax({
                    url: 'createCustomerReturns.php', // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'returnItems' : JSON.stringify(returnItems) }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(data) {
                       alert('Successfully registered a return order. Please return your books before due date');
                       alert(data);
                       window.location.href='homepage.php';
                    },
                    error: function(data) {
                        alert('Unable to register your returns, Please try again or return books at the library');
                    }
                });
            } else {
                window.location.href='homepage.php';
            }
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Customer Out Items/Returns </h2>
<form method=post action="customerOrderHistory.php">
    <table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
    <tbody>
    <tr>
      <th style="vertical-align: top;">Title<br>
      </th>
      <th style="vertical-align: top;">Store Name<br>
      </th>
      <th style="vertical-align: top;">Type<br>
      </th>
      <th style="vertical-align: top;">OutDate<br>
      </th>
      <th style="vertical-align: top;">Due Date<br>
      </th>
      <th style="vertical-align: top;">Tid<br>
      </th>
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

        $sql = 'SELECT * FROM outitems WHERE type IN ("rent", "borrow") AND custID='.$_SESSION['custID'] ;
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            $count = 0;
            while($row = mysql_fetch_assoc($result)) {
                $count = $count + 1;
    ?>
    <tr>
      <td style="vertical-align: top;"><?php echo $row['title']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['storeName']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['type']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['outDate']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['dueDate']; ?></td>
      <td style="vertical-align: top;"><a href='TransactionInfo.php?tid=<?php echo $row['tid']; ?>'><?php echo $row['tid']; ?></a></td>
      <td style="vertical-align: top;">
            <input type='checkbox' class='returnCheck' value='<?php echo $count; ?>'>
            <input type='hidden' id='storeID<?php echo $count; ?>' value='<?php echo $row['storeID']; ?>' >
            <input type='hidden' id='isbn<?php echo $count; ?>' value='<?php echo $row['isbn']; ?>' >
            <input type='hidden' id='tid<?php echo $count; ?>' value='<?php echo $row['tid']; ?>' >
            <input type='hidden' id='type<?php echo $count; ?>' value='<?php echo $row['type']; ?>' >
      </td>
    </tr>
    <?php 
             }
        } else {
            echo '<tr><td colspan=6>No Out Items found</td></tr>';
        }
    ?>
    <tr>
        <td colspan=2>
        &nbsp;<br>
        </td>
        <td colspan=2>
          Just return your books! <button name="Go" type="button" onclick="returnBooks();">Done</button><br>
        </td>
    </tr>
</tbody>
</table>
</form>

</body>
</html>