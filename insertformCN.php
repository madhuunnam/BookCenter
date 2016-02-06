<html>
<head>
</head>
<?php include 'NavigationBarCN.php'; ?>
<div style="text-align:left; margin:20px">
<body>
<br>
<h1>聯絡表</h1>
<br>
<h4>客服: 三三六　 四零二 　九六零一 (可留言)</h4>
<br>
<h4>電郵: si2013gou AT yahoo 點 com</h4>
<br>
<h4>為了提高網站和服務質量， 使之更準確更易用更美觀更多功能，敬請您指正錯誤并提供寶貴改進意見，或與此有關的任何問題，<br><br>都歡迎您通過下面表格與版主聯絡，非常感謝！ </h4> <br>
<!--<p><span class="error">* required field.</span></p>-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   您的姓名<span style="color:red">*</span>: <input type="text" name="Name"><br><br>
   電郵<span style="color:red">*</span>: <input type="text" name="Email"> (仅用于回复您这里的留言) <br><br>
   電話: <input type="text" name="Phone"><br><br>
   標題<span style="color:red">*</span>: <input type="text" name="Subject"><br><br>
   內容<span style="color:red">*</span>: <textarea name="Message" rows="10" cols="60"></textarea><br><br>
   <input style="font-size: 1.5em" type="submit" name="Submit" value="提交"> 
   <input style="font-size: 1.5em" type="button" onclick="document.location.href='homepage.php'" value="完成">
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
