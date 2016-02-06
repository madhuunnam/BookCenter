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
            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
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
      <th style="vertical-align: top;">Customer Name<br>
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

        $sql = 'SELECT * FROM outitems WHERE storeID='.$_SESSION['storeID'];
        $result = mysql_query($sql);
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {

    ?>
    <tr>
      <td style="vertical-align: top;"><?php echo $row['title']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['custFirstName']; ?> <?php echo $row['custLastName']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['type']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['outDate']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['dueDate']; ?></td>
      <td style="vertical-align: top;"><a href='TransactionInfo.php?tid=<?php echo $row['tid']; ?>'><?php echo $row['tid']; ?></a></td>
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
          <button name="Go" type="button" onclick="window.location.href='homepage.php';">Done</button><br>
        </td>
    </tr>
</tbody>
</table>
</form>

</body>
</html>