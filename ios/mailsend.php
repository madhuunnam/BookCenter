<?php
/*$name=$_REQUEST['us_name'];
$from=$_REQUEST['email'];
$ph_number=$_REQUEST['ph_number'];
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];
if (($name=="")||($from=="")||($ph_number=="")||($subject=="")||($message==""))
{
	echo "All fields are required, please fill the form again.";
}
else
{
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= 'From: $name<$from>' . "\r\n";

//$subject="Message sent using your contact form";
mail("khuntdhams@gmail.com", $subject, $message, $headers);
echo "Email sent!";
}
/*
$to      = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$headers = 'From: lakhani_pradip20@yahoo.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
mail($to, $subject, $message, $headers);
*/
?>

<?php
$to = "khuntdhams@gmail.com";
$subject = "HTML email";
$from="maulikvora.ws@gmail.com";
$message = "<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <pradip.p911@gmail.com>' . "\r\n";


mail($to,$subject,$message,$headers);
?>