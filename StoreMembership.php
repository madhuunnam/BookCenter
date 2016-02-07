<?php
session_start();

if (isset($_SESSION['storeID']) && isset($_SESSION['type']) && $_SESSION['type'] == 'Store') {
?>
<html>
<head>
    <title>
         Members For 
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

        button.updateBtn {
            padding-top: 2px;
            padding-bottom: 2px;
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

            if(!isset($_SESSION['type']) || $_SESSION['type'] != 'Store') {
                echo "$( document ).ready(function() { window.location.href='Login.php';});";
            } else if (isset($_POST['custID']) && isset($_POST['activeStatus'])) {
				$newStatus = $_POST['status'];
            	$activeValue = 'TRUE';
                if ($_POST['activeStatus'] == 'No') {
                    $activeValue = 'FALSE';
                }
                $updateSQL = 'UPDATE libmembers SET joinDate = CURRENT_DATE, status="'.$newStatus.'", activate='.$activeValue.' WHERE storeID='.$_SESSION['storeID'].' AND custID='.$_POST['custID'];
                $updateResult = mysql_query($updateSQL);
                echo '// '.$updateSQL;
                if (!$updateResult) {
                    echo "$( document ).ready(function() { alert('Unable to update active status, please try again');});";
                }
            }

        ?>

        function update(index) {
            $('#updateCustID').val($('#custID'+index).val());
            $('#updateActiveStatus').val($('#activeStatus'+index).val());
            $('#updateStatus').val($('#status'+index).val());
            $('#updateMembershipForm').submit();
        }

    </script>
</head>
<?php include 'NavigationBar.php'; ?>
<body>
<h2> Members for: <?php echo $_SESSION['name']; ?> </h2>
<table style="text-align: left; " border="1" cellpadding="2" cellspacing="2">
    <tbody>
    <tr>
      <th style="vertical-align: top;">Customer Name<br>
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


        $sql = 'SELECT * FROM libmembers WHERE storeID='.$_SESSION['storeID'];
        $result = mysql_query($sql);
        $count = 0;
        if (mysql_num_rows($result) > 0) {
            while($row = mysql_fetch_assoc($result)) {
                $count++;
                $status = $row['status'];
                $active = 'No';
                if ($row['activate']) {
                    $active = 'Yes';
                }

    ?>
    <tr class="<?php echo $active;?>Row">
      <td style="vertical-align: top;"><?php echo $row['custFirstName']; ?> <?php echo $row['custLastName']; ?>
      <input type='hidden' id='custID<?php echo $count; ?>' value='<?php echo $row['custID']; ?>'></td>
      <td style="vertical-align: top;"><?php echo explode(' ', $row['joinDate'])[0]; ?></td>
      <td style="vertical-align: top;"><?php echo $row['barcode']; ?></td>
      <td style="vertical-align: top;"><?php echo $row['pin']; ?></td>
      <td style="vertical-align: top;">
      	<Select id='status<?php echo $count; ?>'>
      		<option value='Ok' <?php echo $status == 'Ok' ? 'selected' : ''; ?>> Ok </option>
     		<option value='Created' <?php echo $status == 'created' ? 'selected' : ''; ?>> Created </option>
            <option value='Suspended' <?php echo $status == 'Suspended' ? 'selected' : ''; ?>> Suspended </option>
            <option value='Requested' <?php echo $status == 'Requested' ? 'selected' : ''; ?>> Requested </option>
            <option value='Deleted' <?php echo $status == 'Deleted' ? 'selected' : ''; ?>> Deleted </option>
        </Select>
      </td>
      <td style="vertical-align: top;">
        <Select id='activeStatus<?php echo $count; ?>'>
            <option value='Yes' <?php echo $active == 'Yes' ? 'selected' : ''; ?>> Yes </option>
            <option value='No' <?php echo $active == 'No' ? 'selected' : ''; ?>> No </option>
        </Select>
      </td>
      <td>
        <button name="Update" class='UpdateBtn' type="button" onclick="update(<?php echo $count; ?>);">Update</button>
      </td>
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
    <tr>
        <td >
          <button name="Go" type="button" onclick="window.location.href='homepage.php';">Done</button><br>
        </td>
    </tr>
</tbody>
</table>
<form method='post' action='StoreMembership.php' id='updateMembershipForm'>
<input type='hidden' id='updateCustID' name='custID' value=''>
<input type='hidden' id='updateActiveStatus' name='activeStatus' value=''>
<input type='hidden' id='updateStatus' name='status' value=''>
</form>
</body>
</html>
<?php
} else {
    header("Location: Login.php");
    die();
}
?>