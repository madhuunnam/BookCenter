<?php
session_start();
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Manage Messages from the Public</title>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#FromDatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
	$( "#ToDatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
  });
  </script>


<style type="text/css">
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
        <td style="width:100px">
</style>


</head>

<?php include 'NavigationBar.php'; ?>



<body>
<p style="text-align: center;">
    <span style="font-size:36px;"><strong><span style="font-family: trebuchet ms,helvetica,sans-serif;"><span style="color: rgb(0, 128, 128);">Messages</span></span></strong></span></p>
<p style="text-align: center;">&nbsp;</p>


<form action="searchMessage.php" method="post">
    <table>
    <tr>
    <td>From Date: </td> <td> <input type="text" id="FromDatepicker" name = "fromDate"></td>
    <td>To Date: </td> <td> <input type="text" id="ToDatepicker" name = "toDate"></td>
    <td> Or Choose Most Recent &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <select name="duration" id="duration">
          <option value="ALL">All</option>
          <option value="Quarter">Quarter</option>
          <option value="Month">Month</option>
          <option value="Year">Year</option>
          <option value="Week">Week</option>
          </select>
          </td>
    </tr> <tr>

    <td>Limit to: </td>
    <td> <select name='LimitTo_dropdown'>
        <option value='All'>All</option> 
        <option value='Unread'>Unread</option>
        <option value='Read'>Read</option>
        <option value='Del'>Del</option>
        <option value='Ok'>Ok</option>
        <option value='Not Replied'>Not Replied</option>
        <option value='Replied'>Replied</option>
    </select></td>
    <td><input type="Submit" name = 'Go' value="Go"></td> 
    </tr>

    </table>
</form>


<br><br> <hr> <br><br>


<?php
if( isset($_POST['Go']))
{
	//print all the selected filter values
	
        $date = date_create(); //this returns the current date time
	$fDate = ($_POST['fromDate'] !="") ? $_POST['fromDate'] : "2000-01-01";
        //echo date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));	
	$tDate = ($_POST['toDate'] != "") ? $_POST['toDate'] : date("Y-m-d");
	

        if ( $_POST['duration'] == "Quarter" ) { date_sub($date,date_interval_create_from_date_string("3 months")); $fDate = $date->format('Y-m-d');}
        else if ( $_POST['duration'] == "Month" )  { date_sub($date,date_interval_create_from_date_string("1 month")); $fDate = $date->format('Y-m-d');}
        else if ( $_POST['duration'] == "Year" ) { date_sub($date,date_interval_create_from_date_string("12 months")); $fDate = $date->format('Y-m-d');}
        else if ( $_POST['duration'] == "Week" ) { date_sub($date,date_interval_create_from_date_string("1 week")); $fDate = $date->format('Y-m-d');}

        echo $fDate; echo "  to  "; echo $tDate; echo "<br><br><br>";


	$ddSelec = $_POST['LimitTo_dropdown'];             
        //echo $ddSelec;
	//END - print all the selected filter values
	
	//connect to database
	require_once('MySQLConnect.php');

	//execute query based on filter values
	if ($ddSelec == 'All') {
		$sql = "SELECT * FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."'";
	}
        
        else if ($ddSelec == 'Not Replied') {
            $sql = "SELECT * FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."' AND replied = 0 ";
        }   

        else if ($ddSelec == 'Replied') {
            $sql = "SELECT * FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."' AND replied = 1 ";
        } 

	else {
            $sql = "SELECT * FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."' AND status = '".$ddSelec."'";    
	}	
	//$sql = "SELECT msgTime, Name, status, Replied, Subject, msgText, replyTime, replyText FROM customerservice.messages WHERE status = '".$ddSelec."'";
	$result = mysqli_query($conn, $sql);
	if (!$sql) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}
	echo "<center>";
	echo "<table>
        <tr>
                <th>msgID</th>
                <th>msgTime</th>
		<th>subject</th>
		<th>msgText</th>
		<th>replyText</th>
		<th>status</th>
		</tr><tr>";
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
	
                echo "<td><a href='showMsgForm.php?mid=" .$row['msgID'] ."'>"  .$row['msgID']  ."</a></td>";  
                //echo "<td>" . $row['msgID'] . "</td>";
                $a1 = $row['msgID'];
                echo "<td>" . $row['msgTime'] . "</td>";
                echo "<td>" . $row['subject'] . "</td>";
		echo "<td style='width:500px'>" . $row['msgText'] . "</td>";
                echo "<td style='width:500px'>" . $row['replyText'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";

            echo "</tr>" ;
            $i++;
	}
	echo "</table>";
        echo "</center>";
	
        // Free result set
        mysqli_free_result($result);
        mysqli_close($conn);
}
?>


</body>
</html>