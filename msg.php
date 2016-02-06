<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Manage Messages from the Public</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#FromDatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
	$( "#ToDatepicker" ).datepicker({dateFormat: "yy-mm-dd"});
  });
  </script>
</head>
<body>
<p style="text-align: center;">
    <span style="font-size:36px;"><strong><span style="font-family: trebuchet ms,helvetica,sans-serif;"><span style="color: rgb(0, 128, 128);">Messages</span></span></strong></span></p>
<p style="text-align: center;">&nbsp;</p>
<!-- Dialogbox code -->
<div id="Dialogbox" title="Send Mail">
<form action="mail.php" method="post">
<label>Email:</label>
<input id="modalEmail" name="email" type="text"><br><br>
<label>Message:</label>
<textarea name="modalMessage" rows="5" cols="40"></textarea><br><br>
<input id="submit" type="submit" value="Send Mail">
</form>
</div>
<div id="Dialogbox2" title="Display Message">
<div id="DialogMsg">

</div>
</div>


<script>
$(document).ready(function(){
	$("#Dialogbox").dialog({
		title:'Reply Message',
		width:450,
		height : 350,
		modal:true,
		autoOpen: false
		});
	$("#Dialogbox2").dialog({
		title:'Display Message',
		width:450,
		height : 350,
		modal:true,
		autoOpen: false
		});
	//$("body").on("click", "replyBtnClass", function() {
    //alert($(this).attr("contentID"));
	//$("#Dialogbox").dialog ("open");
	//});
	//
	
	$( ".replyBtnClass" ).click(function() {
	//alert( "Handler for .click() called." );
	//if ($("#Dialogbox").dialog ("open")) alert ("Already open !");
		var $row = $(this).closest('tr').find('input[name="hiddenEmail"]');
		//alert($row.attr("value"));
		$("#modalEmail").val($row.attr("value"));
		$("#Dialogbox").dialog ("open");
		//alert($(this).attr("id"));
	});
	$( ".displayLinkClass" ).click(function() {
		var $msgRow = $(this).closest('tr').find('input[name = "moremessage"]');
		$("#DialogMsg").text($msgRow.attr("value"));
		$("#Dialogbox2").dialog ("open");
		//alert($msgRow.attr("value"));
		//alert("1");
	});
});
</script>

<!-- END Dialogbox code -->
<style>
li {
	
    display: inline;
}
</style>
<form action="msg.php" method="post">
<center>
<ul>
<li>From Date: <input type="text" id="FromDatepicker" name = "fromDate"></li>
<li>To Date: <input type="text" id="ToDatepicker" name = "toDate"></li>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<li>Limit to: <select name='LimitTo_dropdown'><option value='All'>All</option><option value='Not Replied'>Not Replied</option><option value='Read'>Read</option> <option value='Unread'>Unread</option><option value='Replied'>Replied</option><option value='Del'>Del</option><option value='Ok'>Ok</option></select></li>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<li><input type="Submit" name = 'Go' value="Go"></li> 
</ul>
</form>

<head>
<style type="text/css">
table, td, th
{
border:1px solid #666;
font-style:Calibri;
}
th
{
background-color:#666;
color:white;
font-style:Calibri;
}
</style>
</head>

<?php
if( isset($_POST['Go']))
{
	//print all the selected filter values
	//echo "Go clicked";
	$fDate = isset($_POST['fromDate']) ? $_POST['fromDate'] : '';
	//echo $fDate;
	$tDate = isset($_POST['toDate']) ? $_POST['toDate'] : '';
	//echo $tDate;
	$ddSelec = $_POST['LimitTo_dropdown'];             
    //echo $ddSelec;
	//END - print all the selected filter values
	
	//connect to database
	require_once('MySQLConnect.php');
	//execute query based on filter values
	if ($ddSelec == 'All') {
		$sql = "SELECT msgTime, Name, Email, status, Replied, Subject, msgText, replyTime, replyText FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."'";
	}
	else {
		$sql = "SELECT msgTime, Name, Email, status, Replied, Subject, msgText, replyTime, replyText FROM bookstore.messages WHERE msgTime BETWEEN '".$fDate."' AND '".$tDate."' AND status = '".$ddSelec."'";
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
		<th>Date</th>
		<th>Sender</th>
		<th>Status</th>
		<th>Replied</th>
		<th>Subject</th>
		<th>Message</th>
		<th>ReplyMsg</th>
		<th>RepliedTime</th>
		<th>RepliedTxt</th>
		<th>Update</th>
		</tr>";
	$i = 0;
	$msgStatus = array("Read", "Unread", "Replied");
	while($row = mysqli_fetch_assoc($result))
	{
	?>
		<tr>
		<!-- //$data = serialize($row['msgText']); 
		//$encoded = 
		//echo '<input type="hidden" name="order" value="'.$encoded.'">'; -->
		<td><input type="hidden" name="hiddenEmail" value="<?php echo $row['Email']; ?>">
		<input type="hidden" name="moremessage" value="<?php echo $row['msgText']; ?>"> <?php echo $row['msgTime']; ?> </td>
		<?php
		echo "<td>" . $row['Name'] . "</td>";
		//original echo "<td> <select name='Status_dropdown'><option value='Read'>Read</option> <option value='Unread' selected=\"selected\">Unread</option><option value='Replied'>Replied</option></select> </td>";
		//-------------display message status drop down--------------------------------------
		echo "<td><select name = 'Status_dropdown'>";
              if($row['status']  == "Read")
              echo "<option value = 'Read' selected=\"selected\">Read</option><option value='Unread'>Unread</option><option value='Replied'>Replied</option>";
              if($row['status']  == "Unread")
              echo "<option value = 'Unread' selected=\"selected\">Unread</option><option value='Read'>Read</option><option value='Replied'>Replied</option>";
              if($row['status']  == "Replied")
              echo "<option value = 'Replied' selected=\"selected\">Replied</option><option value='Read'>Read</option><option value='Unread'>Unread</option>";
        echo" </select></td>";
		//-------------display message status drop down ends here----------------------------
		echo "<td>" . $row['Replied'] . "</td>";
		echo "<td>" . $row['Subject'] . "</td>";
		//------- display text with read more link ------------
		// original --------- echo "<td>" . $row['msgText'] . "</td>";
		$string = $row['msgText'];
		if (strlen($string) > 10) {
			// truncate string
			$stringCut = substr($string, 0, 10);
			// make sure it ends in a word...
			$string = substr($stringCut, 0, strrpos($stringCut, ' '))."... <a class = 'displayLinkClass' href = '#'>More</a>"; 
		}
		echo "<td>" . $string . "</td>";
		//------- display text with read more link ends here------------
		echo "<td> <input type=\"button\" name=\"reply\" class =\"replyBtnClass\" id=\"replyBtn".$i."\" value=\"Reply\"/></td>";
		//echo "<td><form action='msg.php' method='POST'><input type='hidden' name='reply'/><input type='submit' name='reply' value='Reply' /><form></td>";
		if($row['replyText'] == "NULL")
			echo "<td>" . ' ' . "</td>";
		else
			echo "<td>" . $row['replyText'] . "</td>";
		if($row['replyTime'] == "NULL")
			echo "<td>" . ' ' . "</td>";
		else
			echo "<td>" . $row['replyTime'] . "</td>";
		echo "<td><form action='msg.php' method='POST'><input type='hidden' name='tempId'/><input type='submit' name='submit-btn' value='Update' /><form></td>";
		echo "</tr>" ;
		$i++;
	}
	echo "</table>";
    echo "</center>";
	//display dialogbox on clicking reply button

	//END --display dialogbox on clicking reply button
	
// Free result set
mysqli_free_result($result);
mysqli_close($conn);
}
?>


</body>
</html>