<html>
<head>
</head>
<?php include 'NavigationBar.php'; ?>

<body>
<h1>Contact Form</h1>
<div style ="text-align:left">
<br>
<h4>Mail: si2013gouATyahooDOTcom</h4> <br>
<h4>You can call me or leave me a message at: (three three six ) four zero two nine six zero one </h4>
<br>
<h4>Your comment, error report, incorrect data report, suggestions to improve the website
design and usability, <br> or just anything you want us to know
are warmly welcomed and greatly appreciated! </h4> <br>
<!--<p><span class="error">* required field.</span></p>-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name<span style="color:red">*</span>: <input type="text" name="Name"><br><br>
   E-mail<span style="color:red">*</span>: <input type="text" name="Email"> (Your email is only used for replying your message here) <br><br>
   Phone: <input type="text" name="Phone"><br><br>
   Subject<span style="color:red">*</span>: <input type="text" name="Subject"><br><br>
   Message<span style="color:red">*</span>: <textarea name="Message" rows="10" cols="60"></textarea><br><br>
   <input type="submit" name="Submit" value="Submit"> 
   <input type="button" onclick="document.location.href='homepage.php'" value="Done">
</form>

<?php
if(isset($_POST['Submit'])){
require_once('MySQLConnect.php');

$sql = "INSERT INTO Messages(Name, Email, Phone, msgTime, Subject, msgText,  replyTime, replyText, replied, status) 
		VALUES ('$_POST[Name]', '$_POST[Email]', '$_POST[Phone]', now(),'$_POST[Subject]',  '$_POST[Message]', NULL, NULL, 'false', 'Unread')";

// added check required fields on 7-22-15!!
if ($_POST['Name'] == "" || $_POST['Email']== "" || $_POST['Subject']=="" || $_POST['Message']=="") 
    echo 'Please fill all required fields';

else if($conn->query($sql) == TRUE) {
	echo "New record successfully created";
	} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
}
?>
</div>
</body>
</html>
