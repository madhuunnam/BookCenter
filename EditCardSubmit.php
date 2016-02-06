<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UpdateCard</title>
</head>

<body>

<?php 
if(!isset($_SESSION['custID']))
{
	header("location:Login.php");
}
?>

<?php  
    ob_start(); 
	
	$custID = $_SESSION['custID'];
	$cardnumber = "";
	$nameoncard = "";
	$cvc = "";
	$expmonth = "";
	$expyear = "";
	$TxtStreet = "";
	$TxtApartment = "";
	$TxtCity = "";
	$TxtState = "";
	$TxtPostalCode = "";
	
	$messages = "";
	
	if(isset($_POST['cardnumber']))
	{
		$cardnumber = $_POST['cardnumber'];
	}
	if(isset($_POST['nameoncard']))
	{
		$nameoncard = $_POST['nameoncard'];
	}
	if(isset($_POST['cvc']))
	{
		$cvc = $_POST['cvc'];
	}
	if(isset($_POST['expmonth']))
	{
		$expmonth = $_POST['expmonth'];
	}
	if(isset($_POST['expyear']))
	{
		$expyear = $_POST['expyear'];
	}
	if(isset($_POST['TxtStreet']))
	{
		$TxtStreet = $_POST['TxtStreet'];
	}
	if(isset($_POST['TxtApartment']))
	{
		$TxtApartment = $_POST['TxtApartment'];
	}
	if(isset($_POST['TxtCity']))
	{
		$TxtCity = $_POST['TxtCity'];
	}
	if(isset($_POST['TxtState']))
	{
		$TxtState = $_POST['TxtState'];
	}
	if(isset($_POST['TxtPostalCode']))
	{
		$TxtPostalCode = $_POST['TxtPostalCode'];
	}
	
	if($custID==null||$cardnumber==null)
	{
        header("location:login.php");
    }
	else 
	{  
		$checkingduplicate = "select * from creditcards where custID='".$custID."' and cardnumber='".$cardnumber."'";
		$sql="UPDATE `creditcards` SET `name`='".$nameoncard."',`expiremonth`='".$expmonth."',`expireyear`='".$expyear."',`securitycode`='".$cvc."',`address`='".$TxtStreet."',`city`='".$TxtCity."',`state`='".$TxtState."',`zip`='".$TxtPostalCode."' WHERE custID='".$custID."' and cardnumber='".$cardnumber."'";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($checkingduplicate);
		  
		if(mysql_fetch_row($k))
		{
			$db->indb($sql);
			$messages = "Update card successfully.";
			header("location:ManagePayment.php");
		}
		else
		{  
			$messages = "Card not found.";
			header("location:ManagePayment.php");
		}  
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



</body>
</html>