<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AccountSettingUpdate</title>



<?php  
    ob_start(); 
	
	$firstname = "";
	$lastname = "";
	$street = "";
	$apartment = "";
	$city = "";
	$state = "";
	$zip = "";
	$phone = "";
	$email = "";
	$password = "";
	
	if(isset($_POST['TxtFirstName']))
	{
		$firstname = $_POST['TxtFirstName'];
	}
	if(isset($_POST['TxtLastName']))
	{
		$lastname = $_POST['TxtLastName'];
	}
	if(isset($_POST['TxtStreet']))
	{
		$street = $_POST['TxtStreet'];
	}
	if(isset($_POST['TxtApartment']))
	{
		$apartment = $_POST['TxtApartment'];
	}
	if(isset($_POST['TxtCity']))
	{
		$city = $_POST['TxtCity'];
	}
	if(isset($_POST['sstate']))
	{
		$state = $_POST['sstate'];
	}
	if(isset($_POST['TxtPostalCode']))
	{
		$zip = $_POST['TxtPostalCode'];
	}
	if(isset($_POST['TxtPhoneNumber']))
	{
		$phone = $_POST['TxtPhoneNumber'];
	}
	if(isset($_POST['TxtEmail']))
	{
		$email = $_POST['TxtEmail'];
	}
	if(isset($_POST['PwdPassword']))
	{
		$password = $_POST['PwdPassword'];
	}
	
	if($email==null||$password==null)
	{
        //header("location:Signup.php");
        //echo "Please fill name and password fields.";
    }
	else 
	{  
		$checkingduplicate = "select * from customers where custID='".$email."'";
		$sql="UPDATE `customers` SET `firstname`='".$firstname."',`lastname`='".$lastname."',`phone`='".$phone."',`address`='".$street."',`city`='".$city."',`state`='".$state."',`zip`='".$zip."',`password`='".$password."' WHERE custID='".$email."'";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($checkingduplicate);
		  
		if(mysql_fetch_row($k))
		{
        	$db->indb($sql);
			header("location:AccountSetting.php");
		}
		else
		{  
			header("location:Login.php");
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


</head>

<body>
</body>
</html>