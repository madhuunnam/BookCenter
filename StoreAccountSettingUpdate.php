<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StoreAccountSettingUpdate</title>

<script language="javascript">

function check()
{
  if (checkname() && checkstreet() && checkcity() && checkzip() && checkphone() &&checkemail() && checkpassword() && checkans1() && checkans2()) 
  {
	return true;
  }
  else 
  {
	return false;
  }
}

function checkname()
{
  var divStoreName = document.getElementById("divStoreName");
  divStoreName.innerHTML = "";
  var storeName = document.basic_information_form.TxtStoreName.value;
  if (storeName == "") 
  {
	divStoreName.innerHTML = "Store name cannot be null!";
	document.basic_information_form.TxtStoreName.focus();
	return false;
  }
  
  return true;
}

function checkstreet()
{
  var divStreetAddress = document.getElementById("divStreetAddress");
  divStreetAddress.innerHTML = "";
  var streetAddress = document.basic_information_form.TxtStreet.value;
  if (streetAddress == "") 
  {
	divStreetAddress.innerHTML = "Address cannot be null!";
	document.basic_information_form.TxtStreet.focus();
	return false;
  }
  return true;
}

function checkcity()
{
  var divCity = document.getElementById("divCity");
  divCity.innerHTML = "";
  var city = document.basic_information_form.TxtCity.value;
  if (city == "") 
  {
	divCity.innerHTML = "City cannot be null!";
	document.basic_information_form.TxtCity.focus();
	return false;
  }
  return true;
}

function checkzip()
{
  var divZip = document.getElementById("divZip");
  divZip.innerHTML = "";
  var zip = document.basic_information_form.TxtPostalCode.value;
  if (zip == "") 
  {
	divZip.innerHTML = "Zip cannot be null!";
	document.basic_information_form.TxtPostalCode.focus();
	return false;
  }
  return true;
}

function checkphone()
{
  var divPhone = document.getElementById("divPhone");
  divPhone.innerHTML = "";
  var phone = document.basic_information_form.TxtPhoneNumber.value;
  if (phone == "") 
  {
	divPhone.innerHTML = "Phone number cannot be null!";
	document.basic_information_form.TxtPhoneNumber.focus();
	return false;
  }
  return true;
}

function checkemail()
{
  var divEmail = document.getElementById("divEmail");
  divEmail.innerHTML = "";
  var email = document.basic_information_form.TxtEmail.value;
  if (email == "") 
  {
	divEmail.innerHTML = "Email cannot be null!";
	document.basic_information_form.TxtEmail.focus();
	return false;
  }
  return true;
}

function checkans1()
{
  var divAns1 = document.getElementById("divAns1");
  divAns1.innerHTML = "";
  var ans1 = document.basic_information_form.TxtAns1.value;
  if (ans1 == "") 
  {
	divAns1.innerHTML = "Answer cannot be null!";
	document.basic_information_form.TxtAns1.focus();
	return false;
  }
  return true;
}

function checkans2()
{
  var divAns2 = document.getElementById("divAns2");
  divAns2.innerHTML = "";
  var ans2 = document.basic_information_form.TxtAns2.value;
  if (ans2 == "") 
  {
	divAns2.innerHTML = "Answer cannot be null!";
	document.basic_information_form.TxtAns2.focus();
	return false;
  }
  return true;
}

function checkpassword()
{
  var divPassword = document.getElementById("divPassword");
  divPassword.innerHTML = "";
  var password = document.basic_information_form.PwdPassword.value;
  if (password == "") 
  {
	divPassword.innerHTML = "Password cannot be null!";
	document.basic_information_form.PwdPassword.focus();
	return false;
  }
  return true;
}
</script>


<style>

  .container-gateway{
        border:1px solid;border-color:#09F;width:500px
   }
   
</style>





</head>

<body>


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
		$sql="UPDATE `stores` SET `name`='".$name."',`address1`='".$street."',`address2`='".$apartment."',`city`='".$city."',`state`='".$state."',`zip`='".$zip."',`officephone`='".$officephone."',`websiteaddress`='".$websites."',`managername`='".$managername."',`managephone`='".$managerphone."',`manageremail`='".$manageremail."',`storetype`='".$type."',`password`='".$password."',`questnum1`='".$type1."',`questans1`='".$answer1."',`questnum2`='".$type2."',`questans2`='".$answer2."', `lat`='".$lat."', `lng`='".$lng."' WHERE storeID='".$email."'";
		
		$db = new DataBase();
		$db->conn();
		$k= $db->indb($checkingduplicate);
		  
		if(mysql_fetch_row($k))
		{
        	$db->indb($sql);
			header("location:StoreAccountSetting.php");
		}
		else
		{  
			header("location:StoreLogin.php");
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