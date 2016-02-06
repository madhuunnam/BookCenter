<html>
<body>
<center><U><h1  style="color:blue"> Book Title</h1></U></center>
<form name="f1" method="get" action="">
<?php
///////////////////////////
$con=mysqli_connect("localhost","root","","reviews");
if(!$con)
{
  die('unable to connect:'.mysql_error() );
}
//mysql_select_db("reviews");

$qry="select count(*) rcount from bookreviews";
$rs=mysqli_query($con,$qry);
$count=0;
if($r=mysqli_fetch_array($rs))
{
 $count=$r['rcount'];
}

if($count!=0)
{
	
//	mysql_select_db("reviews");
	$qry1="select sum(overallstars)/count(*) avg1 from bookreviews";
	$rs1=mysqli_query($con,$qry1);
	$avg1=0;
	if($r1=mysqli_fetch_array($rs1))
	{
		$avg1=$r1['avg1'];
	}
		for($i=1; $i<=$avg1; $i++)
		{
			echo "<font size='8' color='green'>*</font>";
		}
	
	
	
		echo "<font face='arial' size='8'>&nbsp;&nbsp;&nbsp;".$count." &nbsp;Reviews</font>";
	
		echo "<br><br><hr width='45%' align='left'>";
		$qry="select * from bookreviews";
		//echo "<h1>".$qry;
		$rs1=mysqli_query($con,$qry);
		while($r=mysqli_fetch_array($rs1))
		{
			echo "<h3 style='color:red'>Reviewed by <i>".$r['custName']."</i>  on ".$r['date1'];
			echo "<h4> Overall <big>";
			for($i=1; $i<=$r['overallstars']; $i++)
			{
				echo "<font size='8' color='green'>*</font>";
			}
		
			echo "</big><h4>comment : <I style='color:maroon'>".$r['comment']."</I></h4>";
			echo"<h5> Do you think this comment helpful? &nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<br>Click this button for <B>Yes</B> <input type='submit' name='yes' value='".$r["custName"]."'>";
		echo "<br>Click this button for <B>No</B><input type='submit' name='no' value='".$r["custName"]."'>";
		////////////
		echo "&nbsp;&nbsp;&nbsp;&nbsp;".$r['helpful']." out of ".($r['helpful']+$r['nohelp'])." helpful";
		echo "<br><div style='background-color:#7FFFD4;width:500px' align='left'>
		<h3 style='color:blue'>Previous feedbacks...</h3>".$r['feedback']."</div>";
			echo "<br><h3><A href='/stores/bookfeedback.php?cname=".$r["custName"]."'>Add feedback to this comment?</A>";
			echo "<br><br><hr width='45%' align='left'>";
			///////////////
		}	
	

		if(!empty($_GET['yes']))
		{
			
				
				$qry="update bookreviews set helpful=helpful+1 where custName='".$_GET['yes']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
				echo "<h1><Script language='javascript'>window.location='/stores/bookreview.php';</script></h1>";
			
			
		
		}		
		else if(!empty($_GET['no']))
		{
				$qry="update bookreviews set nohelp=nohelp+1 where custName='".$_GET['no']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
				echo "<h1><Script language='javascript'>window.location='/stores/bookreview.php';</script></h1>";
		}	
		
		

	}

///////////////////////////

if(!empty($_GET['submit2']))
{
//echo "<h1> cname=".$_GET['submit2'];
echo "<h1> executing...";


	if(!empty($_GET['isbn']) && !empty($_GET['cname']) && !empty($_GET['subject']) && !empty($_GET['overall']) && !empty($_GET['comment']) && is_numeric($_GET['isbn'])  && is_numeric($_GET['overall']))
	{

		$con=mysqli_connect("localhost","root","","reviews");
		if(!$con)
		{
			die('unable to connect:'.mysql_error() );
		}
		//mysql_select_db("reviews");
		$isbn=$_GET['isbn'];
		$cname=$_GET['cname'];
		$subject=$_GET['subject'];
		$overall=$_GET['overall'];
		$comment=$_GET['comment'];


		//echo "<h2> cname=".$cname." subject=".$subject." quality=".$quality." speed=".$speed." overall=".$overall." comment=".$comment;
		$qry="insert into bookreviews(isbn,custName,date1,revtitle,overallstars,comment,feedback,helpful,nohelp) values(".$isbn.",'".$cname."',curdate(),'".$subject."',".$overall.",'".$comment."',' ',0,0)";
		//echo "<h3>".$qry;
		if(!mysqli_query($con,$qry))
		{
			die('Error:'.mysql_error());
		} 
		echo "<h1><Script language='javascript'>window.alert('book review added.');window.location='/stores/bookreview.php';</script></h1>";
				//echo "<h2>one record added";
		mysqli_close($con);
	}	
	else
	{
		echo "<h1><Script language='javascript'>window.alert('fill all the fields and given numeric values properly.');</script></h1>";
	}

}

?>


<h3 style="color:blue"> Write your own review to the store </h3><h3>
<div style="border:thin solid black;width:400px;height:350;background-color:#FF7F50" align="left">
<br>
ISBN No&nbsp;&nbsp;&nbsp;&nbsp; :<input type="text" name="isbn" size="20"> <br>
Your Name :<input type="text" name="cname" size="20"> <br>
subject&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :<input type="text" name="subject" size="20">  <br>
Rating &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :<select name="overall">
<option>1.0</option>
<option>1.5</option>
<option>2.0</option>
<option>2.5</option>
<option>3.0</option>
<option>3.5</option>
<option>4.0</option>
<option>4.5</option>
<option>5.0</option>
</select> <br>

Comment: <br>&nbsp;&nbsp;&nbsp;&nbsp;<Textarea rows="10" cols="40" name="comment" ></Textarea><br>
  &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit2" value="Done">
</div>

</form>
</body>
</html>