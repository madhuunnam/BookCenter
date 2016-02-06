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
<h2> Store Out Items </h2>
<form method=post action="StoreOutItems.php">
    <table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
    <tbody>
    <tr>
      <th style="vertical-align: top;">Title<br>
      </th>
      <th style="vertical-align: top;">StoreName<br>
      </th>
      <th style="vertical-align: top;">Type<br>
      </th>
      <th style="vertical-align: top;">OutDate<br>
      </th>
      <th style="vertical-align: top;">due Date<br>
      </th>
      <th style="vertical-align: top;">Tid<br>
      </th>
    </tr>
    <tr>
      <td style="vertical-align: top;">Intro</td>
      <td style="vertical-align: top;">UNCG Library</td>
      <td style="vertical-align: top;">Borrow</td>
      <td style="vertical-align: top;">04/11/14</td>
      <td style="vertical-align: top;">07/11/14</td>
      <td style="vertical-align: top;">603</td>
    </tr>
    <tr>
        <td colspan=2>
        &nbsp;<br>
        </td>
        <td colspan=2>
          <button name="Go" type="button">Done</button><br>
        </td>
    </tr>
</tbody>
</table>
</form>

</body>
</html>