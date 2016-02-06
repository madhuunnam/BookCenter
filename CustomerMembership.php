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

        
        button, input[type=submit] {
          padding:10px;
        }

        .submitBtnTd {
            text-align: center;
            vertical-align: center;
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">

        <?php 
            $con = mysql_connect('localhost', 'webclient', '12345678');
        
            if (!$con) {
                die('Failed to conect to MySQL: ' . mysql_error());
            }

            $db_selected = mysql_select_db("bookstore");

            if (!$db_selected) {
                die('Can\'t use the db :' . mysql_error());
            }

            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                echo "$( document ).ready(function() { window.location.href='homepage.php';});";
            } else if(isset($_POST) && !empty($_POST)) {
                $maxBarcodeSQL = 'SELECT max(barcode) as maxBarcode FROM libmembers';

                $maxBarcodeResult = mysql_query($maxBarcodeSQL);
                $maxBarcode = 0;
                while($row = mysql_fetch_assoc($maxBarcodeResult)) {
                    $maxBarcode = intval($row['maxBarcode']) + 1;
                }

                if ($maxBarcode < 10000) {
                    $maxBarcode = 10001;
                }

                $insertLibmember = "INSERT INTO libmembers SELECT  C.custID, C.firstName, C.lastName, S.storeID, S.storeName, CURRENT_DATE, 
                '".$maxBarcode."', '".$_POST['pin']."', FALSE, 'created' FROM stores S, customers C WHERE S.storeName='".$_POST['libraryName']."' AND C.custID=".$_SESSION['custID'];
            
                $insertResult = mysql_query($insertLibmember);
                if (!$insertResult) {
                     echo "$( document ).ready(function() {alert('Unable to create membership with store, please try agian');});";
                }

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
        ?>

        $(document).ready(function () {
            $( "#libraryName" ).autocomplete({
              source: storeNames
            });
        });

    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Library Membership for: <?php echo $_SESSION['name']; ?> </h2>
<table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
    <tbody>
    <tr>
      <th style="vertical-align: top;">Library Name<br>
      </th>
      <th style="vertical-align: top;">Join Date<br>
      </th>
      <th style="vertical-align: top;">Barcode<br>
      </th>
      <th style="vertical-align: top;">Pin<br>
      </th>
      <th style="vertical-align: top;">Status<br>
      </th>
      <th style="vertical-align: top;">Active<br>
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

        $sql = 'SELECT * FROM libmembers WHERE custID='.$_SESSION['custID'];
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $active = 'No';
                if ($row['activate']) {
                    $active = 'Yes';
                }

    ?>
    <tr class="<?php echo $active;?>Row">
      <td style="vertical-align: top;"><?php echo $row['storeName']; ?></td>
      <td style="vertical-align: top;"><?php echo explode(' ', $row['joinDate'])[0]; ?></td>
      <td style="vertical-align: top;"><?php echo $row['barcode']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['pin']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['status']; ?></td>
      <td style="vertical-align: top;"><?php echo $active; ?></a></td>
    </tr>
    <?php 
             }
        } else {
            echo '<tr><td colspan=6>No Memberships found</td></tr>';
        }
    ?>
    </tbody>
</table>
<br>
<hr>
<br>
<table>
    <form method='post' action='CustomerMembership.php'>    
    <tr>
        <td> <b>Library to Join</b> </td>
        <td> 
            <div class="ui-widget">
                <input type="text" style=" font-size:12px;padding-left:5px;" name="libraryName" id="libraryName" value="" placeholder="Library Name" > 
            </div>
        </td>
        <td> <B>Pin</B> <sup>(4 Digits)</sup></td>
        <td><input type="text" style=" font-size:12px;padding-left:5px;" name="pin" value="" placeholder='0000' maxlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
    </tr>
    <tr>
        <td> &nbsp; </td>
        <td><input type='submit' name='Join' value='Join'></td>
    </form>
        <td >
          <button name="Go" type="button" onclick="window.location.href='homepage.php';">Done</button><br>
        </td>
    </tr>
</tbody>
</table>

</body>
</html>