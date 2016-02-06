<?php
session_start();
?>
<html>
<head>
    <title>
         Store Ledger
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

        table#header th {
          border-radius: 6px;
          background-color: #fff;
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

        $( document ).ready(function() {
        <?php 
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
                echo " window.location.href='homepage.php';";
            } else if (!empty($_POST)) {
                echo '$("#fromDate").val("'.$_POST['fromDate'].'");';
                echo '$("#toDate").val("'.$_POST['toDate'].'");';
                echo '$("#duration").val("'.$_POST['duration'].'");';
            }
        ?>
        });

        function show(index, name) {
          $('#custName').html(name);
          $('#accountActivitiesDiv').show();
          $('#accountActivitiesDiv tr').hide();
          $('#accountActivitiesDiv tr.header').show();
          $('.rowFor'+index).show();
        }
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Store Ledger </h2>
<form method=post action="storeAccount.php">
    <table style="text-align: left; " border="1" cellpadding="2" cellspacing="2" id='header'>
    <tbody>
    <tr>
      <td style="vertical-align: top;">
      <select name="duration" id="duration">
      <option value="ALL">All</option>
      <option value="Quarter">Quarterly</option>
      <option value="Month">Monthly</option>
      <option value="Year">Annually</option>
      </select>
      <br>
      </td>
      <th style="vertical-align: top;">Histroy<br>
      </th>
      <td style="vertical-align: top;">or<br>
      </td>
      <th style="vertical-align: top;">From<br>
      </th>
      <td style="vertical-align: top;"><input type="text" name="fromDate" id="fromDate" value="" placeholder='YYYY-MM-DD'><br>
      </td>
      <th style="vertical-align: top;">To<br>
      </th>
      <td style="vertical-align: top;"><input type="text" name="toDate" id="toDate" value="" placeholder='YYYY-MM-DD'><br>
      </td>
    </tr>
    <tr>
        <td colspan=5>
        &nbsp;<br>
        </td>
        <td colspan=2>
          <input type='submit' name="Go" value="Go" type="button"><br>
        </td>
    </tr>
</tbody>
</table>
</form>
<br>
<hr>
<br>
<table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
  <tbody>
    
    <?php
      $con = mysql_connect('localhost', 'webclient', '12345678');
                          
      if (!$con) {
          die('Failed to conect to MySQL: ' . mysql_error());
      }

       $db_selected = mysql_select_db("bookstore");

      if (!$db_selected) {
          die('Can\'t use the db :' . mysql_error());
      }

      $sql = 'SELECT A.accNum, L.tid,L.ledgerNum, L.ledgerDate, L.custFirstName, L.custLastName, L.description, L.chargeToCustAmt, L.custPayAmt, T.title as ttitle, T.type as ttype, AO.title as aotitle, AO.type as aotype, L.bal
              FROM ledgers L JOIN accounts A ON A.storeID = L.storeID AND A.custID = L.custID AND A.storeID=' . $_SESSION['storeID'];
      $sql .= ' LEFT JOIN transactions T ON T.tid = L.tid';
      $sql .= ' LEFT JOIN activeorders AO ON AO.tid = L.tid WHERE A.storeID=' . $_SESSION['storeID'];
      
      if (!empty($_POST)) {
          if ($_POST['fromDate'] != '' || $_POST['toDate'] != '') {
            if ($_POST['fromDate'] != '') {
              $sql .= ' and L.ledgerDate >= "'.$_POST['fromDate'].'" ';
            } 
            if ($_POST['toDate'] != '') {
                $sql .= ' and L.ledgerDate <= "'.$_POST['toDate'].'" ';
            } 
          } else if ($_POST['duration'] != 'ALL') {
              $date = new DateTime();
              $currDate = explode('-', $date->format('Y-m-d'));
              
              if ($_POST['duration'] == 'Month') {
                $sql .= ' and L.ledgerDate > "'.$currDate[0].'-'.$currDate[1].'-01" ';
              } else if ($_POST['duration'] == 'Year') {
                $sql .= ' and L.ledgerDate > "'.$currDate[0].'-01-01" ';
              } else {
                $quarter = '10';
                if (intval($currDate[1]) < 10 && intval($currDate[1]) >= 7) {
                  $quarter = '07';
                } else if (intval($currDate[1]) < 7 && intval($currDate[1]) >= 4) {
                  $quarter = '04';
                } else if (intval($currDate[1]) < 4 ) {
                  $quarter = '01';
                }

                $sql .= ' and L.ledgerDate >  "'.$currDate[0].'-'.$quarter. '-01" ';
              }
          }
      }

      $sql .= ' order by L.custFirstName, L.custLastName, A.accNum, L.ledgerNum';
      //echo $sql;
      $result = mysql_query($sql);
      $index = 0;
      $tableData = '';
      $individualTableData = '';
      $prevAcc = '';
      $prevBal = 0;
      $prevName = '';
      $rowCount = !$result ? 0: mysql_num_rows($result);
      $rowIndex = 0;
      while ($rowCount != 0 && $row = mysql_fetch_assoc($result)) {
        if ($rowIndex == 0) {
          echo '<tr>';
          echo '<th style="vertical-align: top;">Customer Name</th>';
          echo '<th style="vertical-align: top;">Account</th>';
          echo '<th style="vertical-align: top;">Balance</th>';
          echo '</tr>';
        }

        $rowIndex = $rowIndex + 1;
        $individualTableData .= "<tr class='rowFor".$row['accNum']."'>";
        $individualTableData .= "<td>" . $row['ledgerNum'] . "</td>";
        $individualTableData .= "<td>" . $row['ledgerDate'] . "</td>";
        $individualTableData .= "<td>" . $row['tid'] . "</td>";
        $individualTableData .= "<td>" . $row['description'] . "</td>";
        $individualTableData .= "<td>" . $row['chargeToCustAmt'] . "</td>";
        $individualTableData .= "<td>" . $row['custPayAmt'] . "</td>";

        if( $row['ttitle'] == '') {
          $individualTableData .= "<td>" . $row['aotitle'] . "</td>";
          $individualTableData .= "<td>" . $row['aotype'] . "</td>";
        } else {
          $individualTableData .= "<td>" . $row['ttitle'] . "</td>";
          $individualTableData .= "<td>" . $row['ttype'] . "</td>";
        }
        $individualTableData .= "<td>" . $row['bal'] . "</td>";
        $individualTableData .= "</tr>";

        if (($prevAcc != '' || ($prevAcc == '' && $rowIndex == $rowCount)) && ($prevAcc != $row['accNum'] || $rowIndex == $rowCount)) {
          if ($prevAcc != $row['accNum'] && $prevAcc != '') {
            echo "<tr>";
            echo "<td><a href='#' onclick='show(" . $prevAcc . ");' >"  . $prevName . '(' . $index . ')'. "</a></td>";
            echo "<td>" . $prevAcc . "</a></td>";
            echo "<td>" . $prevBal . "</td>";
            echo "</tr>";
            $index = 0;
            $prevBal = 0;
          } 

          $prevAcc = $row['accNum'];
          $index = $index + 1;
          $prevBal = $prevBal + $row['bal'];
          $prevName = $row['custFirstName'] . ' ' . $row['custLastName'];

          if ($rowIndex == $rowCount) {
            echo "<tr>";
            $customerName =  $row['custFirstName'] . ' ' . $row['custLastName'];
            $customerDisplay =  $customerName . '(' . $index . ')';
            echo "<td><a href='#' onclick='show(" . $row['accNum'] . ", ".'"'.$customerName.'"'.");' >"  . $customerDisplay . "</a></td>";
            echo "<td>" . $row['accNum']  . "</a></td>";
            echo "<td>" . ($prevBal) . "</td>";
            echo "</tr>";
          }
        } else {
          $prevAcc = $row['accNum'];
          $index = $index + 1;
          $prevBal = $prevBal + $row['bal'];
          $prevName = $row['custFirstName'] . ' ' . $row['custLastName'];
        }
      }

      if ($rowIndex == 0) {
        echo '<tr><td> No results found for selection </td></tr>';
      }
    ?>
     
  </tbody>
</table>
<div id='accountActivitiesDiv' style='display:none;'>
<hr><br>
<h3>Account Activities for <span id='custName'></span></h3>
<br>
<table>
  <tr class='header'>
    <th>Ledger Number</th>
    <th>Date</th>
    <th>Tid</th>
    <th>Description</th>
    <th>Charge Amount</th>
    <th>Paid Amount</th>
    <th>Title</th>
    <th>Type</th>
    <th>Balance</th>
  </tr>
  <?php
    if ($rowIndex == 0) {
        echo '<tr><td> No results found for selection </td></tr>';
    } else {
        echo $individualTableData;
    }
  ?>
</table>
</div>
</body>
</html>