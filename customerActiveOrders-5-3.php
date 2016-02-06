<?php
session_start();

$TID = '';
$alertMessage = "";
if (isset($_POST['tid']) ){
    $con = mysql_connect('localhost', 'webclient', '12345678');
                            
    if (!$con) {
        die('Failed to conect to MySQL: ' . mysql_error());
    }

    $db_selected = mysql_select_db("bookstore");

    if (!$db_selected) {
        die('Can\'t use the db :' . mysql_error());
    }

    if ($_POST['action'] == 'received') {
        
        $updateSQL = 'update activeorders set orderStatus="Received" where tid=' . $_POST['tid'];
        $insertSql = 'insert into transactions select * from activeorders where tid=' . $_POST['tid'];
        $deleteSQL = 'delete from activeorders where tid=' . $_POST['tid'];

        $updateResult = mysql_query($updateSQL);
        if (!$updateResult) {
            $alertMessage = 'Unable to move record from active orders to transactions';
        } else {
            $insertResult = mysql_query($insertSql);
            if (!$insertResult) {
                $alertMessage = 'Unable to update the transaction as received';
            } else {
                $deleteResult = mysql_query($deleteSQL);
                if (!$deleteResult) {
                    $alertMessage = 'Unable to delete the active order';
                } else {
                    $insertToOutItems = "INSERT INTO outitems SELECT S.storeID, S.storeName, C.custID, C.firstName, C.lastName, L.isbn, L.title, L.tid, L.orderQuantity, L.type, CURRENT_DATE, L.dueDate FROM lineitems L 
                        JOIN transactions t ON T.tid = L.tid AND T.tid = '".$_POST['tid']."' 
                        JOIN stores S ON s.storeID = T.storeID 
                        JOIN customers C ON c.custID = T.custID
                        WHERE l.type IN ('rent', 'borrow')";

                    $insertOutItemsResult = mysql_query($insertToOutItems);
                    if (!$insertOutItemsResult) {
                        $alertMessage = ' There was a problem in registering the books you received. Please contact library regarding this. Go to Orders History to view this transaction';
                    } else {
                        $alertMessage = 'Successfully update the transaction. Go to Orders History to view this transaction'; 
                    }
                }
            }
        }
    } else if ($_POST['action'] == 'newMessage') {
        
        $selectSQL = 'select msgToStore from activeorders where tid=' . $_POST['tid'];

        $success = false;
        $selectResult = mysql_query($selectSQL);
        while ($row = mysql_fetch_assoc($selectResult)) {
            $msgToStoreJSON = json_decode($row['msgToStore'], true);
            $msgToStoreJSON[date('Y-m-d H:i:s')] = $_POST['msgToStore'];

            $updateSQL = "update activeorders set msgToStore='".json_encode($msgToStoreJSON)."' where tid=" . $_POST['tid'];
            $updateResult = mysql_query($updateSQL);

            if (!$updateResult) {
                echo $updateSQL;
                $success=false;
            } else {
                $success=true;
            }
        }

        if ($success) {
            $alertMessage = 'Sent message to the store';
        } else {
            $alertMessage = "Unable to send message to store, please try again";
        }

        $TID =  $_POST['tid'];
    }
}
?>
<html>
<head>
    <title>
         Customer Order History
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

        td {
          text-align: left !important;
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

        .priceChart {
            border:1px solid #fff;
            border-radius: 5px;
            padding:10px;
            background-color: #fff;
        }

        th {
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

        .selected {
            text-decoration: none;
            font-weight: bold;
            padding: 5px !important;
            border: 1px solid #aaa;
            border-radius: 5px;
        }



    </style>
    <script type="text/javascript" src='jquery-1.4.1.js'></script>
    <script type="text/javascript">

        $( document ).ready(function() {
        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                echo " window.location.href='homepage.php';";
            } else if ($alertMessage !="") {
                echo 'alert("'.$alertMessage.'");';
            }
        ?>
        });

        function showTable(index) {
          $('.transaction').each(function() {
              $(this).hide();
          });

          $('#displayDiv' + index).show();

          $('.selected').each(function() {
              $(this).removeClass('selected');
          });

          $('#span' + index).addClass('selected');
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Customer Active Orders </h2>
<?php

  
  $con = mysql_connect('localhost', 'webclient', '12345678');
                      
  if (!$con) {
      die('Failed to conect to MySQL: ' . mysql_error());
  }

   $db_selected = mysql_select_db("bookstore");

  if (!$db_selected) {
      die('Can\'t use the db :' . mysql_error());
  }

  $sql = 'select ao.*, s.phone as storePhone from activeorders ao join stores s on s.storeID=ao.storeID where custID=' . $_SESSION['custID']. ' order by tid desc';
  $result = mysql_query($sql);

  $index = 0;
  while ($row = mysql_fetch_assoc($result)) {
      $index = $index + 1;
      echo '<span id="span'.$row['tid'].'" class="" style="margin:10px;padding:10px;"><a href="#"  onclick="showTable('.$row['tid'].');">'.$row['tid'].'</a></span>';
  }

  if ($index == 0) {
      echo '<SPAN> No active orders found. Please go to <a href="CustomerOrderHistory.php">order history</a></SPAN>';
  }
?>
<br>
<br>
<hr>
<br>
<?php
  $divIndex = 0;
  $newResult = mysql_query($sql);

  while ($row = mysql_fetch_assoc($newResult)) {
      $divIndex = $divIndex + 1;
      if ($TID == '') {
            $TID = $row['tid'];
      }

      $storeMsg = '';
      $myMsg = '';

      if ($row['msgToCust'] != null) {
          $storeMsgJSON = json_decode($row['msgToCust'], true);
          foreach($storeMsgJSON as $key => $value) {
              $storeMsg = $value;
          }
      }

      if ($row['msgToStore'] != null) {
          $myMsgJSON = json_decode($row['msgToStore'], true);
          foreach($myMsgJSON as $key => $value) {
             $myMsg = $value;
          }
      }

?>
    <div id="displayDiv<?php echo $row['tid'] ?>" class='transaction' style="display:None">
      <table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
        <tbody>
          <tr>
            <th style="vertical-align: top;">Transaction ID:</th>
            <td><a href='TransactionInfo.php?tid=<?php echo $row['tid']; ?>'><?php echo $row['tid']; ?></a></td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Date:</th>
            <td><?php echo $row['transTime']; ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Store Name:</th>
            <td><?php echo $row['storeName']; ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Store Phone:</th>
            <td><?php echo $row['storePhone']; ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Order Status:</th>
            <td><?php 
              $disabled = 'disabled';
              if ($row['orderStatus'] == 'Shipped') {
                $disabled = '';
              }
              echo $row['orderStatus']; 

            ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Message from store:</th>
            <td><?php echo $storeMsg; ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Your previous message to store:</th>
            <td><?php echo $myMsg; ?> </td>
          </tr>
          <tr>
            <th style="vertical-align: top;">Your new message to store:</th>
            <td> <form method='post' action='customerActiveOrders.php'>
                <textarea name='msgToStore' rows=3> </textarea>
                <input type='hidden' name='tid' value='<?php echo $row['tid']; ?> '>
                <input type='hidden' name='action' value='newMessage'>
                <input type='submit' name='Submit' class='submit' value='Submit'>
                </form></td>
          </tr>
          <tr>
            <td style="font-size:1em !important; text-align: center !important;" colspan=2>When you receive your books, please click<br>
            <form method='post' action='customerActiveOrders.php'>
                <input type='hidden' name='tid' value='<?php echo $row['tid']; ?> '>
                <input type='hidden' name='action' value='received'>
                <input type='submit' name='Submit' <?php echo $disabled; ?> class='submit' value='I Received Books'>
                </form></td>
          </tr>
          <tr>
              <td>
                  <form method='get' action='storeReview.php'>
                      <input type='hidden' name='storeID' value='<?php echo $row['storeID'] ?>'>
                      <input type='submit' name='Submit' class='submit' value='Your store review'>
                  </form>
              </td>
              <td>
                  <form method='get' action='bookReview.php'>
                      <input type='text' name='isbn' value='' placeholder='ISBN'>
                      <input type='submit' name='Submit' class='submit' value='Your book review'>
                  </form>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
<?php
  }
  
  if ($divIndex > 0) {
    ?>
        <script type="text/javascript">
            $(document).ready(function() {
              <?php 
                if ($TID != '') {
                    echo 'showTable('.$TID.');';
                } else {
                    echo 'showTable(1);';
                }
              ?>
            });
        </script>
    <?php
  }
?>
<table>
  
  <tr>
      <form method='get' action='CustomerOrderHistory.php'>
            <input type='submit' name='Submit' class='submit' value='Done'>
       </form></td>
  </tr>
</table>
</body>
</html>