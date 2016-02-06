<?php
session_start();
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
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Customer') {
                echo " window.location.href='homepage.php';";
            } else if (!empty($_POST)) {
                echo '$("#fromDate").val("'.$_POST['fromDate'].'");';
                echo '$("#toDate").val("'.$_POST['toDate'].'");';
                echo '$("#duration").val("'.$_POST['duration'].'");';
            }
        ?>
        });

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
    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Customer Order History </h2>
<form method=post action="customerOrderHistory.php">
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

      $sql = 'select * from transactions where custID=' . $_SESSION['custID'];
      
      if (!empty($_POST)) {
          if ($_POST['fromDate'] != '' || $_POST['toDate'] != '') {
            if ($_POST['fromDate'] != '') {
              $sql .= ' and transTime >= "'.$_POST['fromDate'].'" ';
            } 
            if ($_POST['toDate'] != '') {
                $sql .= ' and transTime <= "'.$_POST['toDate'].'" ';
            } 
          } else if ($_POST['duration'] != 'ALL') {
              $date = new DateTime();
              $currDate = explode('-', $date->format('Y-m-d'));
              
              if ($_POST['duration'] == 'Month') {
                $sql .= ' and transTime > "'.$currDate[0].'-'.$currDate[1].'-01" ';
              } else if ($_POST['duration'] == 'Year') {
                $sql .= ' and transTime > "'.$currDate[0].'-01-01" ';
              } else {
                $quarter = '10';
                if (intval($currDate[1]) < 10 && intval($currDate[1]) >= 7) {
                  $quarter = '07';
                } else if (intval($currDate[1]) < 7 && intval($currDate[1]) >= 4) {
                  $quarter = '04';
                } else if (intval($currDate[1]) < 4 ) {
                  $quarter = '01';
                }

                $sql .= ' and transTime >  "'.$currDate[0].'-'.$quarter. '-01" ';
              }
          }
      }

      $sql .= ' order by tid desc';
      $result = mysql_query($sql);

      $index = 0;
      while ($row = mysql_fetch_assoc($result)) {
        if ($index == 0) {
          ?>
          <tr>
            <th style="vertical-align: top;">Date<br>
            </th>
            <th style="vertical-align: top;">Tid<br>
            </th>
            <th style="vertical-align: top;">StoreName<br>
            </th>
<!--
            <th style="vertical-align: top;">Total Price<br>
            </th>
-->
            <th style="vertical-align: top;"># Books<br>
            </th>
            <th style="vertical-align: top;">Title<br>
            </th>
            <th style="vertical-align: top;">Type<br>
            </th>
          </tr>
          <?php
        }
          $index = $index + 1;
          echo "<tr>";

          echo "<td>" . explode(" ", $row['transTime'])[0] . "</td>";
          echo "<td><a href='TransactionInfo.php?tid=" . $row['tid'] . "'>" . $row['tid'] . "</a></td>";
          echo "<td>" . $row['storeName'] . "</td>";
//          echo "<td>" . $row['totPrice'] . "</td>";
          echo "<td>" . $row['numberOfLines'] . "</td>";
          echo "<td>" . $row['title'] . "</td>";
          echo "<td>" . $row['type'] . "</td>";
          echo "</tr>";
      }

      if ($index == 0) {
        echo '<tr><td> No results found for selection </td></tr>';
      }
    ?>
  </tbody>
</table>
</body>
</html>