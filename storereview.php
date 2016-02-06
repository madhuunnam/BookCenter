<?php
session_start();

$storeID=-1;
if(isset($_GET['storeID']))
   $storeID = $_GET['storeID'];

$storename = "";
if(isset($_GET['name']))
   $storename = $_GET['name'];
/*
$sessionStoreID = "";
if (isset($_SESSION['storeID'])) {
	$sessionStoreID = $_SESSION['storeID'];
}

$sessionLibraryName = "";
if (isset($_SESSION['libraryName'])) {
	$sessionStoreID = $_SESSION['libraryName'];
}
*/

?>


<html>
<body>
<center><h1  style="color:blue"> Rating and Reviews for <?php echo $storename; ?> </h1></center>
<form name="f1" method="get" action="">
<?php
///////////////////////////
	$con=mysqli_connect("localhost","webclient","12345678","bookstore");
	if(!$con)
	{
		die('unable to connect:'.mysql_error() );
	}
//mysql_select_db("reviews");

$qry="select count(*) rcount from storereviews where storeID = " .$storeID ;

$rs=mysqli_query($con,$qry);
$count=0;
if($r=mysqli_fetch_array($rs))
{
 $count=$r['rcount'];
}
//echo " <h1>count=".$count;

if($count!=0)
{
//mysql_select_db("reviews");
$qry1="select sum(quality)/count(*) avg1 from storereviews";
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
	
	
	
	echo "<font face='arial' size='4'>&nbsp;&nbsp;&nbsp;".$count." &nbsp;Reviews</font>";
	echo "<br><br><hr width='45%' align='left'>";
	$qry="select * from storereviews where storeID = " .$storeID ;
	//echo "<h1>".$qry;
	$rs1=mysqli_query($con,$qry);
	while($r=mysqli_fetch_array($rs1))
	{
    	echo "<h3 style='color:red'>Reviewed by <i>".$r['custID']."</i>  on ".$r['reviewTime'];
		echo "<h4> Overall <big>";
		for($i=1; $i<=$r['overallStars']; $i++)
		{
			echo "<font size='8' color='green'>*</font>";
		}
		echo "</big> &nbsp;&nbsp;&nbsp;&nbsp; Service Quality  <big>";
		for($i=1; $i<=$r['quality']; $i++)
		{
				echo "<font size='8' color='green'>*</font>";
		}
		echo "</big>   &nbsp;&nbsp;&nbsp;&nbsp;Service Speed <big>";
		for($i=1; $i<=$r['speed']; $i++)
		{
				echo "<font size='8' color='green'>*</font>";
		}
		echo "</big><h4>Comment : <I style='color:maroon'>".$r['comment']."</I></h4>";
		echo"<h5> Do you think this comment helpful? &nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<br>Click this button for <B>Yes</B> <input type='submit' name='yes' value='".$r["custID"]."'>";
		echo "<br>Click this button for <B>No</B><input type='submit' name='no' value='".$r["custID"]."'>";
		////////////
		echo "&nbsp;&nbsp;&nbsp;&nbsp;".$r['helpful']." out of ".($r['helpful']+$r['noHelp'])." helpful";
		echo "<br><div style='background-color:#7FFFD4;width:500px' align='left'>
		<h3 style='color:blue'>Previous feedbacks...</h3>".$r['feedback']."</div>";
			
		echo "<br><h3><A href='/stores/storefeedback.php?cname=".$r["custID"]."'>feedback to this comment?</A>";
		echo "<br><br><hr width='45%' align='left'>";
		
		///////////////
	}	

		if(!empty($_GET['yes']))
		{
			
				$qry="update storereviews set helpful=helpful+1 where  custName='".$_GET['yes']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
			
				echo "<h1><Script language='javascript'>window.location='/stores/storereview.php';</script></h1>";
				
		}		
		else if(!empty($_GET['no']))
		{
				$qry="update storereviews set noHelp=noHelp+1 where  custName='".$_GET['no']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
				echo "<h1><Script language='javascript'>window.location='/stores/storereview.php';</script></h1>";
			
		}	
		

	
}


///////////////////////////







if(!empty($_GET['submit2']))
{

if(!empty($_GET['storeid']) && !empty($_GET['cname']) && !empty($_GET['subject']) && !empty($_GET['quality']) && !empty($_GET['speed']) && !empty($_GET['overall']) && !empty($_GET['comment']) && is_numeric($_GET['storeid']) && is_numeric($_GET['quality']) &&is_numeric($_GET['speed']) && is_numeric($_GET['overall']))
{
$con=mysqli_connect("localhost","webclient","12345678","bookstore");
if(!$con)
{
  die('unable to connect:'.mysql_error() );
}
//mysql_select_db("reviews");
$storeid=$_GET['storeid'];
$cname=$_GET['cname'];
$subject=$_GET['subject'];
$quality=$_GET['quality'];

$speed=$_GET['speed'];
$overall=$_GET['overall'];
$comment=$_GET['comment'];


//echo "<h2> cname=".$cname." subject=".$subject." quality=".$quality." speed=".$speed." overall=".$overall." comment=".$comment;
$qry="insert into storereviews(storeId,custName,date1,revTitle,quality,speed,overallStars,comment,feedback,noHelp,helpful) values(".$storeid.",'".$cname."',curdate(),'".$subject."',".$quality.",".$speed.",".$overall.",'".$comment."',' ',0,0)";
//echo "<h3>".$qry;
if(!mysqli_query($con,$qry))
{
  die('Error:'.mysql_error());
} 
echo "<h1><Script language='javascript'>window.alert('store review added.');window.location='/stores/storereview.php';</script></h1>";
	
//echo "<h2>one record added";
mysqli_close($con);

}
else
{
  echo "<h1><Script language='javascript'>window.alert('fill all the fields.');</script></h1>"; 
}
}

?>

<br>
<h3 style="color:blue"> Write your own review to the store </h3><h3>

<div style="border:thin solid black;width:400px;height:400;background-color:#FF7F50" align="left">
<br>
StoreId &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="storeid" size="20"> <br>
 Your Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <input type="text" name="cname" size="20"> <br>
  subject &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <input type="text" name="subject" size="20">  <br>
Service Quality : <select name="quality">
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
Service Speed &nbsp;&nbsp;: <select name="speed">
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
Overall &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
 <select name="overall">
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
Comment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <Textarea rows="10" cols="40" name="comment" ></Textarea><br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="submit2" value="Done">
</div>
<br>
<br><r>

</form>
</body>
</html>