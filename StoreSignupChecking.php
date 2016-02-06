<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StoreSignupChecking</title>
</head>

<?php
    ob_start(); 
	
	$name = "";
	$street = "";
	$apartment = "";
	$city = "";
	$state = "";
	$zip = "";
	$officephone = "";
	$wetsites = "";
	$managername = "";
	$managerphone = "";
	$manageremail = "";
	$type = "";
	$email = "";
	$password = "";
	$type1 = "";
	$type2 = "";
	$answer1 = "";
	$answer2 = "";
	$lat="";
	$lng="";
	
	if(isset($_POST['TxtStoreName']))
	{
		$name = $_POST['TxtStoreName'];
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
		$officephone = $_POST['TxtPhoneNumber'];
	}
	if(isset($_POST['TxtEmail']))
	{
		$email = $_POST['TxtEmail'];
	}
	if(isset($_POST['PwdPassword']))
	{
		$password = $_POST['PwdPassword'];
	}
	if(isset($_POST['TxtWebsite']))
	{
		$websites = $_POST['TxtWebsite'];
	}
	if(isset($_POST['TxtManagerName']))
	{
		$managername = $_POST['TxtManagerName'];
	}
	if(isset($_POST['TxtManagerPhone']))
	{
		$managerphone = $_POST['TxtManagerPhone'];
	}
	if(isset($_POST['TxtManagerEmail']))
	{
		$manageremail = $_POST['TxtManagerEmail'];
	}
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	if(isset($_POST['type1']))
	{
		$type1 = $_POST['type1'];
	}
	if(isset($_POST['type2']))
	{
		$type2 = $_POST['type2'];
	}
	if(isset($_POST['TxtAns1']))
	{
		$answer1 = $_POST['TxtAns1'];
	}
	if(isset($_POST['TxtAns2']))
	{
		$answer2 = $_POST['TxtAns2'];
	}
	if(isset($_POST['lat']))
	{
		$lat = $_POST['lat'];
	}
	if(isset($_POST['lng']))
	{
		$lng = $_POST['lng'];
	}
	
	if($email==null||$password==null)
	{
        //header("location:Signup.php");
        //echo "Please fill name and password fields.";
    }
	else 
	{  
		$checkingduplicate = "select * from stores where storeID='".$email."'";
		$sql="INSERT INTO `stores`(`storeID`, `name`, `logo`, `address1`, `address2`, `city`, `state`, `zip`, `officephone`, `cellphone`, `email`, `websiteaddress`, `managername`, `managephone`, `manageremail`, `storetype`, `username`, `password`, `securityquestion`, `securityanswer`, `openhour`, `serviceavail`, `questnum1`, `questans1`, `questnum2`, `questans2`, `lat`, `lng`) VALUES ('".$email."','".$name."',NULL,'".$street."','".$apartment."','".$city."','".$state."','".$zip."','".$officephone."','".$officephone."','".$email."','".$websites."','".$managername."','".$managerphone."','".$manageremail."','".$type."',NULL,'".$password."',NULL,NULL,NULL,NULL,'".$type1."','".$answer1."','".$type2."','".$answer2."','".$lat."','".$lng."')";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($checkingduplicate);
		  
		if(mysql_fetch_row($k))
		{
        	echo "Email is already used.";
			header("location:StoreSignup.php");
		}
		else
		{
			$db->indb($sql);
			$_SESSION['storeID']=$email;
			header("location:MyStoreAccount.php");
			exit();
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


<body>
</body>
</html>