<html>
<body>
<form name="f1" method="get" action="">

<?php
$con=mysqli_connect("localhost","root","","reviews");
if(!$con)
{
  die('unable to connect:'.mysql_error() );
}

$cname="";
if(!empty($_GET["cname"]))
{
	//echo "ok";
	$cname=$_GET["cname"];
	echo "<input type='hidden'  name='cname' value='".$cname."'>";
}
		if(!empty($_GET['submit1']))
		{
			
			if(!empty($_GET['feedback']) && !empty($_GET['cname'])  && !empty($_GET['name']))
			{
				$feedback=$_GET['feedback'];
				$name=$_GET['name'];
				$qry="update bookreviews set feedback=concat(feedback,' <br><br><big>Commented By </big> ".$name." on date: ".date("Y-m-d")."<br><big>Feedback :</Big> ".$feedback."') where custName='".$cname."'";
				//echo "<h2>".$qry;
		//		echo "<h1> qry=".$qry;
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}
				else
					echo "<h1><Script language='javascript'>window.alert('Feedback added.');window.location='/stores/bookreview.php';</script></h1>";
			}
			else
				echo "<h1><Script language='javascript'>window.alert('fill all fields');</script></h1>";	
				
		}	

?>

<div style="border:thin solid black;width:300px;height:350;background-color:#FF7F50" align="left">
<br>
<h3 style="color:blue"> Add Feedback! </h3>
<h3>
  Name: <input type="text" name="name" size="20"><br>
  Feedback: &nbsp;&nbsp;&nbsp;&nbsp;<Textarea rows="10" cols="30" name="feedback" ></Textarea><br>
&nbsp;&nbsp;&nbsp;&nbsp;  <input type="submit" name="submit1" value="postfeedback">
</div>
</form>
</body>

</html>
