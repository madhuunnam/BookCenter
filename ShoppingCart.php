<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>


<script language="javascript" type="text/javascript">

function deleteonclick(obj) 
{
	var custID = obj.value;
	var storeID = obj.name;
	var activity = obj.title;
	var isbn = obj.id;
	window.location.href="RemoveBookFromCart.php?custID=" + custID + "&storeID=" + storeID + "&activity=" + activity + "&isbn=" + isbn;
}

function checkoutonclick(obj) 
{
	var custID = obj.value;
	var storeID = obj.name;
	var activity = obj.title;
	var isbn = obj.id;
	window.location.href="CheckoutBook.php?custID=" + custID + "&storeID=" + storeID + "&activity=" + activity + "&isbn=" + isbn;
}

function bulkcheckoutonclick(obj) 
{
	var custID = obj.value;
	var storeID = obj.name;
	var activity = obj.title;
	window.location.href="CheckoutBook.php?customer=" + custID + "&storeID=" + storeID + "&activity=" + activity;
}

</script>



</head>

<?php 
if(!isset($_SESSION['custID']))
{
	header("location:Login.php");
}
?>

<?php include 'NavigationBar.php'; ?>


<body>


<div align="center">
<?php  
    ob_start(); 
	
	$custID = $_SESSION['custID'];
	
	$allgroups = "select distinct storeID, activity from shoppingcart where custID='".$custID."'";
	echo $allgroups;
	$db = new DataBase();
	$db->conn();
	$k= $db->indb($allgroups);
	
	
	
	
	while($group=mysql_fetch_row($k))
	{
		$storeID=$group[0];
		$activity = $group[1];
		$tempgroup = "select * from shoppingcart AS S, books AS B where S.isbn=B.isbn and S.storeID=B.storeID and S.custID='".$custID."' and S.storeID='".$storeID."' and S.activity='".$activity."'";
		
		$groupresult=$db->indb($tempgroup);
		echo '<div align="center" style="1px solid;border-color:#09F;margin:20px">';
		
		echo '<table align="center">';
			echo "<tr bgcolor=\"#6699FF\">
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;font-weight:bold;text-align:center\">ISBN</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;font-weight:bold;text-align:center\">Title</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;font-weight:bold;text-align:center\">Price</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;font-weight:bold;text-align:center\">Activity</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;font-weight:bold;text-align:center\">Action</label>
				</div>
			</td>
			</tr>";
			echo '</table>';
		
		
		while($book=mysql_fetch_row($groupresult))
		{
			$isbn=$book[2];
			$activity=$book[3];
			$title=$book[5];
			$price=$book[10];
			
			echo '<table align="center">';
			echo "<tr bgcolor=\"#6699FF\">
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;text-align:center\">$isbn</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;text-align:center\">$title</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;text-align:center\">\$ $price</label>
				</div>
			</td>
			<td width=\"150px\">
				<div align=\"center\" class=\"coverphoto\">
				<label style=\"font-size:14px;text-align:center\">$activity</label>
				</div>
			</td>
			<td width=\"150px\">
				<table>
				<td>
				<div class=\"addtocart\">
				<button type=\"button\" value=\"$custID\" name=\"$storeID\" title=\"$activity\" id=\"$isbn\" onclick=\"deleteonclick(this)\">Delete</button>
				</div>
				</td>
				
				<td>
				<div class=\"addtocart\">
				<button type=\"button\" value=\"$custID\" name=\"$storeID\" title=\"$activity\" id=\"$isbn\" onclick=\"checkoutonclick(this)\">Check Out</button>
				</div>
				</td>
				</table>
			</td>
			</tr>";
			echo '</table>';
		}
		echo "<button type=\"button\" value=\"$custID\" name=\"$storeID\" title=\"$activity\" onclick=\"bulkcheckoutonclick(this)\">Check Out</button>";
		echo '</div>';
	}
	
	
	
	
	
	class DataBase{  
        public $dbhost = "localhost";
        public $dbuser = "webclient";  
        public $dbpass = "12345678";  
        public $dbname = "bookstore";  
        function conn(){
            $dbconn = mysql_connect($this->dbhost,$this->dbuser,$this->dbpass) or die("database error!".mysql_error());  
            mysql_select_db($this->dbname) or die("can not connect database：".mysql_error());  
            return $dbconn;  
        }  
        function indb($in_sql){
            $result_indb = mysql_query($in_sql) or die("can not run the sql language:".mysql_error());  
            return $result_indb;  
        }  
    }  
	
	
	
?>



</div>


</body>
</html>