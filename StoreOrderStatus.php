      <?php
      session_start();
      if (isset($_SESSION['storeID'])) {
            $storeID = $_SESSION['storeID'];
            $con = mysql_connect('localhost', 'webclient', '12345678');
                                        
            if (!$con) {
                  die('Failed to conect to MySQL: ' . mysql_error());
            }

            $db_selected = mysql_select_db("bookstore");

            if (!$db_selected) {
                  die('Can\'t use the db :' . mysql_error());
            }

            $alertMessage = "";
            $newMessageAlert = "";

            if (isset($_POST['newMessage']) && $_POST['newMessage'] != '') {
              $selectSQL = 'select msgToCust from activeorders where tid=' . $_POST['tid'];
              $selectResult = mysql_query($selectSQL);
              $success = false;
              while ($row = mysql_fetch_assoc($selectResult)) {
                  $msgToStoreJSON = json_decode($row['msgToCust'], true);
                  $msgToStoreJSON[date('Y-m-d H:i:s')] = $_POST['newMessage'];

                  $updateSQL = "update activeorders set msgToCust='".json_encode($msgToStoreJSON)."' where tid=" . $_POST['tid'];
                  $updateResult = mysql_query($updateSQL);

                  if (!$updateResult) {
                      echo $updateSQL;
                      $success=false;
                  } else {
                      $success=true;
                  }
              }

              if ($success) {
                  $newMessageAlert = 'Sent message to the store';
              } else {
                  $newMessageAlert = "Unable to send message to Customer, please try again";
              }

              $TID =  $_POST['tid'];
            }

            if (isset($_POST['tid']) && isset($_POST['orderStatus']))  {
                  $TID = $_POST['tid'];

                  $updateSQL = 'update activeorders set orderStatus="'.$_POST['orderStatus'].'" where tid=' . $_POST['tid'];
                  $updateResult = mysql_query($updateSQL);
                  if (!$updateResult) {
                        $alertMessage = 'Unable to move record from active orders to transactions';
                  } else {
                        if ($_POST['orderStatus'] == 'Cancelled') {
                              $deleteSQL = 'DELETE FROM lineitems WHERE tid=' . $_POST['tid'];
                              $deleteResult = $deleteResult = mysql_query($deleteSQL);
                              if (!$deleteResult) {
                                    $alertMessage = 'Unable to delete the line items for tid:' . $_POST['tid'];
                              } else {
                                    $deleteActiveOrderSQL = 'delete from activeorders where tid=' . $_POST['tid'];
                                    $deleteActiveOrderResult = mysql_query($deleteActiveOrderSQL);
                                    if (!$deleteActiveOrderResult) {
                                          $alertMessage = 'Unable to delete the active orders for tid:' . $_POST['tid'];
                                    } else {
                                          $alertMessage = 'Successfully Cancelled the transaction';
                                    }
                              }
                        } else if ($_POST['orderStatus'] == 'Received' ) {
                              $insertSql = 'insert into transactions select * from activeorders where tid=' . $_POST['tid'];
                              $deleteSQL = 'delete from activeorders where tid=' . $_POST['tid'];

                              $insertResult = mysql_query($insertSql);
                              if (!$insertResult) {
                                    $alertMessage = 'Unable to update the transaction as received';
                              } else {
                                    $deleteResult = mysql_query($deleteSQL);
                                    if (!$deleteResult) {
                                           $alertMessage = 'Unable to delete the active order';
                                    } else {

                                          $ledgerTotal = 0;
                                          $lineItemsSQL = "SELECT * FROM lineitems WHERE tid=". $_POST['tid'];
                                          $lineItemsResult = mysql_query($lineItemsSQL);
                                          if (mysql_num_rows($lineItemsResult) > 0) {
                                            while ($row = mysql_fetch_assoc($lineItemsResult)) {
                                                $buying = $row['type'] == 'buy' ? true : false; 
                                                $failedOutItemInsert = false;
                                                if (!$buying) {
                                                      $outItemQuery = 'INSERT INTO outitems 
                                                      SELECT S.storeID, S.storeName, C.custID, C.firstName, C.lastName, I.isbn, T.title, T.tid, '.$row['orderQuantity'].', "'.$row["type"].'",
                                                             CURRENT_DATE, 
                                                             CASE 
                                                                WHEN S.lentLimit IS NOT NULL THEN DATE_ADD(CURRENT_DATE, INTERVAL S.lentLimit DAY) 
                                                                WHEN S.lentLimit IS NULL THEN  DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY) 
                                                             END, S.maxRenew
                                                        FROM stores AS S 
                                                        JOIN inventory AS I ON I.storeID = S.storeID AND I.isbn = "'.$row["isbn"].'"
                                                        JOIN transactions AS T ON S.storeID = T.storeID AND T.tid='.$_POST['tid'].'
                                                        JOIN customers AS C ON C.custID = T.custID';
                                                      $outItemResult = mysql_query($outItemQuery); 

                                                      if (!$outItemResult) {
                                                          $failedOutItemInsert = true; 
                                                      }
                                                } 
                                                $ledgerTotal = $ledgerTotal + intval($row['priceAmount']);
                                                

                                                if (!$buying && $failedOutItemInsert ) {
                                                //$alertMessage .= $outItemQuery;
                                                      $alertMessage = '<BR> Unable to insert Out Item for tid '.$TID;
                                                } else {
                                                      $inventorySQL = 'SELECT * FROM inventory WHERE ((quantity > 0 AND holderID IS NULL) OR quantity > 1) 
                                                      AND isbn="'.$row['isbn'].'" AND storeID = '.$storeID;

                                                      $totalQuantityCount = 0;

                                                      $inventoryQtyResult = mysql_query($inventorySQL);
                                                      while($totalQuantityCount < $row['orderQuantity'] && $inventoryRow = mysql_fetch_assoc($inventoryQtyResult)) {
                                                            
                                                            $reduceQuantity = 1;
                                                            if ($inventoryRow['holderID'] == '') {
                                                                  if ($inventoryRow['quantity'] >= ($row['orderQuantity'] - $totalQuantityCount)) {
                                                                        $reduceQuantity = $row['orderQuantity']  - $totalQuantityCount;
                                                                  } else {
                                                                         $reduceQuantity = $inventoryRow['quantity'];
                                                                  }
                                                            } else {
                                                                 if (($inventoryRow['quantity'] - 1) >= ($row['orderQuantity'] - $totalQuantityCount)) {
                                                                        $reduceQuantity = $row['orderQuantity']  - $totalQuantityCount;
                                                                  } else {
                                                                         $reduceQuantity = $inventoryRow['quantity'] - 1;
                                                                  } 
                                                            }

                                                            $reduceInventoryQuantity = 'UPDATE inventory SET quantity = quantity - '.$reduceQuantity.' 
                                                            WHERE storeID = '.$storeID.' AND idx='.$inventoryRow["idx"].' AND isbn="'.$row["isbn"].'"';

                                                            $reduceQuantityResult = mysql_query($reduceInventoryQuantity);

                                                            if (!$reduceQuantityResult) {
                                                                  //$alertMessage .= $reduceInventoryQuantity;
                                                                  $alertMessage .= ' Unable to reduce quantity in inventory for isbn: '.$row["isbn"].', idx:'.$inventoryRow["idx"].' and storeID:'.$storeID;
                                                            } else {
                                                                  $totalQuantityCount = $totalQuantityCount + $reduceQuantity;
                                                            }
                                                      }

                                                      if ($totalQuantityCount < $row['orderQuantity']) {
                                                            $alertMessage = 'Unable to provide the quantity requested.';
                                                      }
                                                }


                                            } 
                                          }
                                          $paymentSuccessful = true;
                                          if ($ledgerTotal > 0) {
                                              $maxLedgerNumSQL = 'SELECT MAX(L.ledgerNum) AS maxLedgerNumber FROM ledgers as L JOIN transactions T ON T.custID=L.custID AND T.storeID=L.storeID and T.tid='.$TID;
                                              $maxLedgerNum = 1;
                                              $maxRowResult = mysql_query($maxLedgerNumSQL);

                                              while ( $maxRow = mysql_fetch_assoc($maxRowResult)) {
                                                $maxLedgerNum = $maxRow['maxLedgerNumber'] + 1;
                                              }

                                              $custPayBal = 0;
                                              $note = 'Paid in Full';
                                              
                                              $insertLedgerSQL = ' INSERT INTO ledgers 
                                                SELECT custID, storeID, '.$maxLedgerNum.', '.$TID.', custFirstName, custLastName, storeName,"'.date('Y-m-d').'", 
                                                "Processed payment", '.$ledgerTotal.', '.$ledgerTotal.',  "Online", 0, "" FROM transactions WHERE tid='.$TID;
                                              $insertLedgerResult = mysql_query($insertLedgerSQL);
                                              //echo $insertLedgerSQL;
                                              if (!$insertLedgerResult) {
                                                $paymentSuccessful = false;
                                                $alertMessage = ' Unable to register payment information ';
                                              } else {
                                                $accountSQL = 'SELECT A.accNum FROM accounts A JOIN transactions T on T.storeID=A.storeID AND T.custID=A.custID AND T.tid='.$TID;
                                                $accountResult = mysql_query($accountSQL);

                                                $accountNum = 0;
                                                $hasAccount = true;
                                                if (!$accountResult || mysql_num_rows($accountResult) == 0) {
                                                  $getMaxAccountNumSQL = 'SELECT max(accNum) as maxAccNum from accounts';
                                                  $getMaxAccNumResult = mysql_query($getMaxAccountNumSQL);
                                                  $accountNum = 1;
                                                  while($row = mysql_fetch_assoc($getMaxAccNumResult)) {
                                                    $accountNum = $row['maxAccNum'] + 1;
                                                  }

                                                  $insertAccount = 'INSERT INTO accounts SELECT '.$accountNum.', storeID, custID, 0 FROM transactions WHERE tid='.$TID;
                                                  $insertAccResult = mysql_query($insertAccount);

                                                  if (!$insertAccResult) {
                                                    $hasAccount = false;
                                                  }
                                                } else {
                                                  while($row = mysql_fetch_assoc($accountResult)) {
                                                    $accountNum = $row['accNum'] + 1;
                                                  }       
                                                }

                                                if ($hasAccount) {
                                                  $udpadeAccSQL = 'UPDATE accounts A 
                                                    JOIN (SELECT LE.custID, LE.storeID, SUM(LE.bal) AS bal FROM ledgers LE JOIN transactions T ON  
                                                      T.custID=LE.custID AND T.storeID=LE.storeID and T.tid='.$TID.' GROUP BY LE.custID, LE.storeID
                                                          ) AS L ON L.custID = A.custID AND L.storeID = A.storeID
                                                    SET A.bal = L.bal
                                                    WHERE A.accNum='.$accountNum;
                                                  $updateAccResult = mysql_query($udpadeAccSQL);
                                                  if (!$updateAccResult) {
                                                    $paymentSuccessful = false;
                                                    echo $udpadeAccSQL;
                                                    $alertMessage = 'Unable to update user account with balance';
                                                  }

                                                } else {
                                                  $paymentSuccessful = false;
                                                  $alertMessage = 'Unable to create account for User';
                                                }
                                              }
                                          }
                                          
                                          if ($paymentSuccessful)
                                              $alertMessage = 'Successfully update the transaction. Go to Orders History to view this transaction'; 
                                    }
                              }
                        }
                  }
            } 
            ?><html>
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

                    th {
                        text-align: center;
                        border:1px solid #eee;
                        background-color: #eee;
                        border-radius: 5px;
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
                  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
                  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                  <script type="text/javascript">

                    $( document ).ready(function() {
                    <?php 
                        if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
                            echo " window.location.href='homepage.php';";
                        } else if ($alertMessage !="") {
                            echo 'alert("'.$alertMessage.'");';
                        }
                    ?>
                    });

                    $(function() {
                      $( document ).tooltip();
                    });

                    function updateForm(index, tid) {
                        $('#updateOrderStatus').val($('#orderStatus' + index).val());
                        $('#updateNewMessage').val($('#messageFor' + index).val());
                        $('#updateTid').val(tid);
                        $('#updateForm').submit();
                    }
                </script>
            </head>
            <?php include 'NavigationBar.php'; ?>
            <body>
            <h2 style="text-align: center;">Store Order Status<br>
            </h2>

              
            <table style="text-align: left; width: 653px; height: 178px;" border="1" cellpadding="2" cellspacing="2">
              <tbody>
                <tr>
                  <th style="vertical-align: top;">Tid</th>
                  <th style="vertical-align: top;">Date<br>
                  </th>
                  <th style="vertical-align: top;">CustName<br>
                  </th>
                  <th style="vertical-align: top;">Title<br>
                  </th>
                  <th style="vertical-align: top;">Type<br>
                  </th>
                  <th style="vertical-align: top;">Status<br>
                  </th>
                  <th style="vertical-align: top;">Message from Customer<br>
                  </th>
                  <th style="vertical-align: top;">Prev. Message to Customer<br>
                  </th>
                  <th style="vertical-align: top;">New Message to Customer<br>
                  </th>
                  <td style="vertical-align: top;"><br>
                  </td>
                  <td style="vertical-align: top;"><br>
                  </td>
                  <td style="vertical-align: top;"><br>
                  </td>
                </tr>
                <?php 
                  $activeRecordsSQL = 'SELECT * from activeorders WHERE storeID='.$storeID;
                  $activeRecords = mysql_query($activeRecordsSQL);

                  $activeRecordCount=0;
                  while($activeRecord = mysql_fetch_assoc($activeRecords)) {
                        $activeRecordCount = $activeRecordCount + 1;

                              $storeMsg = '';
                              $custMsg = '';

                              if ($activeRecord['msgToCust'] != null) {
                                  $storeMsgJSON = json_decode($activeRecord['msgToCust'], true);
                                  foreach($storeMsgJSON as $key => $value) {
                                      $storeMsg = $value;
                                  }
                              }

                              if ($activeRecord['msgToStore'] != null) {
                                  $custMsgJSON = json_decode($activeRecord['msgToStore'], true);
                                  foreach($custMsgJSON as $key => $value) {
                                     $custMsg = $value;
                                  }
                              }

                              $custShowMsg = $custMsg; 
                              if (strlen($custShowMsg) > 5) {
                                    $custShowMsg = substr($custShowMsg, 0, 5) . '...';
                              }

                              $storeShowMsg = $storeMsg; 
                              if (strlen($storeShowMsg) > 5) {
                                    $storeShowMsg = substr($storeShowMsg, 0, 5) . '...';
                              }
                  ?>

                <tr>
                  <td style="vertical-align: top;">
                  <a href='TransactionInfo.php?tid=<?php echo $activeRecord['tid']; ?>'><?php echo $activeRecord['tid']; ?></a></td>
                  <td style="vertical-align: top;"><?php echo $activeRecord['transTime']; ?></td>
                  <td style="vertical-align: top;"><?php echo $activeRecord['custFirstName'].' '.$activeRecord['custLastName']; ?></td>
                  <td style="vertical-align: top;"><?php echo $activeRecord['title']; ?></td>
                  <td style="vertical-align: top;"><?php echo $activeRecord['type']; ?></td>
                  <td style="vertical-align: top;">
                  <select name="orderStatus" id='orderStatus<?php echo $activeRecordCount; ?>'>
                  <option value="Confirmed" <?php echo strcasecmp($activeRecord['orderStatus'], 'Confirmed')==0? 'Selected' : "";?> >Confirmed</option>
                  <option value="Ordered" <?php echo strcasecmp($activeRecord['orderStatus'], 'Ordered')==0? 'Selected' : "";?> >Ordered</option>
                  <option value="Paid" <?php echo strcasecmp($activeRecord['orderStatus'], 'Paid')==0? 'Selected' : "";?> >Paid</option>
                  <option value="Shipped" <?php echo strcasecmp($activeRecord['orderStatus'], 'Shipped')==0? 'Selected' : "";?> >Shipped</option>
                  <option value="Received" <?php echo strcasecmp($activeRecord['orderStatus'], 'Received')==0? 'Selected' : "";?> >Received</option>
                  <option value="Cancelled" <?php echo strcasecmp($activeRecord['orderStatus'], 'Cancelled')==0? 'Selected' : "";?> >Cancelled</option>
                  </select>
                  <br>
                  </td>
                  <td style="vertical-align: top;">
                  <input title='<?php echo $custMsg; ?>' value='<?php echo $custShowMsg; ?>'></td>
                  <td style="vertical-align: top;"><input title='<?php echo $storeMsg; ?>' value='<?php echo $storeShowMsg; ?>'></td>
                  <td style="vertical-align: top;">   
                  <input type='text' id='messageFor<?php echo $activeRecordCount; ?>' value=''></td>
                  <td style="vertical-align: top;">
                        <button name="Update" type="button" onclick="updateForm(<?php echo $activeRecordCount; ?>, <?php echo $activeRecord['tid']; ?>);">Update</button>
                        </td>
                  <td style="vertical-align: top;"><button name="Checkout" onclick="window.location.href='storeCheckout.php?tid=<?php echo $activeRecord['tid'];?>'" type="button">Checkout</button></td>
                </tr>
                <?php } 

                if ($activeRecordCount == 0) {
                  echo '<tr><td colspan="11" style="text-align:center;"> No Active Orders found</td></tr>';
                } ?>
              </tbody>
            </table>
            <form method='post'action='StoreOrderStatus.php' id='updateForm'>
                  <input type='hidden' id='updateOrderStatus' name='orderStatus' value=''>
                  <input type='hidden' id='updateNewMessage' name='newMessage' value=''>
                  <input type='hidden' id='updateTid'  name='tid' value=''>
            </form>
            <br>
            <div style="text-align: center;"><button name="Refresh" onclick="window.location.href='StoreOrderStatus.php';" type="button">Refresh</button><br>
            </div>


            </body>
            </html>
      <?php 
      } else {
            header("Location: Login.php");
            die();
      }
      ?>