<html>
<body>
<center><U><h1  style="color:blue"> Customer Review</h1></U></center>
<form name="f1" method="get" action="">
<?php
///////////////////////////
$con=mysqli_connect("localhost","root","","reviews");
if(!$con)
{
  die('unable to connect:'.mysql_error() );
}
//mysql_select_db("reviews");


if(!empty($_GET['add']))
{

if(!empty($_GET['cid']) && !empty($_GET['customername']) && !empty($_GET['overdue']) && !empty($_GET['avgstars']) && !empty($_GET['lost']) && !empty($_GET['fines']) && !empty($_GET['damage']) && is_numeric($_GET['cid']) && is_numeric($_GET['overdue']) &&is_numeric($_GET['avgstars']) && is_numeric($_GET['lost']) && is_numeric($_GET['fines']) && is_numeric($_GET['damage']))
{
		$qry="insert into customerviews(custId,custName,numOverDue,overAllStars,numLost,numFines,numAbuse,feedBack,helpFul,noHelp) values('".$_GET['cid']."','".$_GET['customername']."',".$_GET['overdue'].",".$_GET['avgstars'].",".$_GET['lost'].",".$_GET['fines'].",".$_GET['damage'].",' ',0,0)";
		if(!mysqli_query($con,$qry))
		{
			die('Error:'.mysqli_error($con));
		}
echo "<h1><Script language='javascript'>window.alert('customer details added.');window.location='/stores/customerview.php';</script></h1>";		
		
		
}
else
  echo "<h1>fill all the fields and given numeric values properly<h1>";
}

if(!empty($_GET['cid'])  && is_numeric($_GET['cid']))
{

	if(!empty($_GET['get']))
	{
		$qry="select * from customerviews where custId=".$_GET['cid'];
		$rs=mysqli_query($con,$qry);
		if($r=mysqli_fetch_array($rs))
		{
		$table1="<table width='80%'> 
<tr><td>CustID :<input type='text' name='cid' value=".$r['custId']." size='10'><input type='submit' name='get' value='Get'>
</td> <td>#OverDues :<input type='text' name='overdue' value=".$r['numOverDue']."  size='10'></td> 
<td>#Fines :<input type='text' name='fines' value=".$r['numFines']."  size='10'></td> </tr> 
 <tr><td>CName :<input type='text' name='customername' value=".$r['custName']."  size='10'></td>
 <td>#Lost :<input type='text' name='lost' value=".$r['numLost']."  size='10'></td>
 <td>#Fine Amount :<input type='text' name='fineamount' value=".$r['numFines']."  size='10'></td> </tr>
 <tr><td>Stars :<input type='text' name='avgstars' value=".$r['overAllStars']." size='10'></td>
 <td>#Damages :<input type='text' name='damage' value=".$r['numAbuse']."  size='10'></td> 
<td></td> </tr> <tr><td><input type='submit' name='add' value='add' size='10'></td>
</tr></table>";
	
		echo "<h4>".$table1."</h4>";
		}
	}
}
else
{
$table1="<table width='80%'> <tr><td>CustID :<input type='text' name='cid' size='10'><input type='submit' name='get' value='Get'></td> <td>#OverDues :<input type='text' name='overdue' size='10'></td> <td>#Fines :<input type='text' name='fines' size='10'></td> </tr>  <tr><td>CName:<input type='text' name='customername' size='10'></td> <td>#Lost :<input type='text' name='lost' size='10'></td> <td>#Fine Amount :<input type='text' name='fineamount' size='10'></td> </tr> <tr><td>Stars :<input type='text' name='avgstars' size='10'></td> <td>#Damages :<input type='text' name='damage' size='10'></td> <td></td> </tr> <tr><td><input type='submit' name='add' value='add' size='10'></td></tr></table>";
	
	echo "<h4>".$table1."</h4>";

}

///////////////////////////////////

$qry="select count(*) rcount from customerviews";
$rs=mysqli_query($con,$qry);
$count=0;
if($r=mysqli_fetch_array($rs))
{
 $count=$r['rcount'];
}

if($count!=0)
{
	echo "<font face='arial' size='7'>&nbsp;&nbsp;&nbsp;".$count." &nbsp;Reviews</font>";
	echo "<br><br><hr width='45%' align='left'>";
	$qry="select * from customerviews";
	//echo "<h1>".$qry;
	$rs1=mysqli_query($con,$qry);
	while($r=mysqli_fetch_array($rs1))
	{
    	echo "<h3 style='color:red'>Reviewed by <i>".$r['storeName']."</i>  on ".$r['date1']." subject: ".$r['revTitle'];
		
		echo "</big><h4>Review Text : <I style='color:maroon'>".$r['comment']."</I></h4>";
		echo"<h5> Do you think this comment helpful? &nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<br>Click this button for <B>Yes</B> <input type='submit' name='yes' value='".$r["custName"]."'>";
		echo "<br>Click this button for <B>No</B><input type='submit' name='no' value='".$r["custName"]."'>";
		////////////
		echo "&nbsp;&nbsp;&nbsp;&nbsp;".$r['helpFul']." out of ".($r['helpFul']+$r['noHelp'])." helpful";
		echo "<br><div style='background-color:#7FFFD4;width:500px' align='left'>
		<h3 style='color:blue'>Previous feedbacks...</h3>".$r['feedBack']."</div>";
		
			echo "<br><h3><A href='/stores/customerfeedback.php?cname=".$r["custName"]."'>feedback to this comment?</A>";
			echo "<br><br><hr width='45%' align='left'>";
			
		///////////////
	}	

		if(!empty($_GET['yes']))
		{
				$qry="update customerviews set helpful=helpful+1 where custName='".$_GET['yes']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
				echo "<h1><Script language='javascript'>window.location='/stores/customerview.php';</script></h1>";
			
		}		
		else if(!empty($_GET['no']))
		{
			
				$qry="update customerviews set noHelp=noHelp+1 where custName='".$_GET['no']."'";
				if(!mysqli_query($con,$qry))
				{
					die('Error:'.mysql_error());
				}	
				echo "<h1><Script language='javascript'>window.location='/stores/customerview.php';</script></h1>";
			
		
		
		}	
		

	
}


///////////////////////////







if(!empty($_GET['submit2']))
{
//echo "<h1> cname=".$_GET['submit2'];
if(!empty($_GET['storeid']) && !empty($_GET['storename']) && !empty($_GET['subject']) && !empty($_GET['comment']) && is_numeric($_GET['storeid']) )
{
$con=mysqli_connect("localhost","root","","reviews");
if(!$con)
{
  die('unable to connect:'.mysql_error() );
}

$storeid=$_GET['storeid'];
$storename=$_GET['storename'];
$subject=$_GET['subject'];
$comment=$_GET['comment'];


//echo "<h2> cname=".$cname." subject=".$subject." quality=".$quality." speed=".$speed." overall=".$overall." comment=".$comment;
$qry="insert into customerviews(storeId,storeName,date1,revTitle,comment,feedBack,helpFul,noHelp) values(".$storeid.",'".$storename."',curdate(),'".$subject."','".$comment."',' ',0,0)";
//echo "<h3>".$qry;
if(!mysqli_query($con,$qry))
{
  die('Error:'.mysql_error());
} 
echo "<h1><Script language='javascript'>window.alert('customer review added.');window.location='/stores/customerview.php';</script></h1>";
//echo "<h2>one record added";
mysqli_close($con);
}
else
	echo "<h1><Script language='javascript'>window.alert('fill all the fields.');</script></h1>"; 

}

?>

<br><br>
<h3 style="color:blue"> Write your own review to the store </h3><h3>

<div style="border:thin solid black;width:400px;height:350;background-color:#FF7F50" align="left">
<br>
StoreId&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: <input type="text" name="storeid" size="20"> <br>
StoreName: <input type="text" name="storename" size="20"> <br>
Subject &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <input type="text" name="subject" size="20">  <br>
Comment&nbsp;&nbsp;&nbsp;: <br><Textarea rows="10" cols="40" name="comment" ></Textarea><br>
  <input type="submit" name="submit2" value="Done">
</div>

</form>
</body>
</html>