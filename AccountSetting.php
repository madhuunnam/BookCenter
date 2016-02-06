<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Setting</title>


<script language="javascript">

function check()
{
  if (checkname() && checkstreet() && checkcity() && checkzip() && checkphone() &&checkemail() && checkpassword()) 
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
  var divFirstName = document.getElementById("divFirstName");
  divFirstName.innerHTML = "";
  var firstName = document.basic_information_form.TxtFirstName.value;
  if (firstName == "") 
  {
	divFirstName.innerHTML = "First name cannot be null!";
	document.basic_information_form.TxtFirstName.focus();
	return false;
  }
  
  var divLastName = document.getElementById("divLastName");
  divLastName.innerHTML = "";
  var lastName = document.basic_information_form.TxtLastName.value;
  if (lastName == "") 
  {
	divLastName.innerHTML = "Last name cannot be null!";
	document.basic_information_form.TxtLastName.focus();
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
        border:1px solid;border-color:#09F;width:400px
   }
   
</style>

<?php  
    ob_start(); 
	
	if(!isset($_SESSION['custID']))
	{
		header("location:Login.php");
	}
	
	$custID = $_SESSION['custID'];
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
	
	$sql="SELECT * FROM `customers` WHERE custID = '".$custID."'";

	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);
	  
	if($user = mysql_fetch_row($k))
	{
		$firstname = $user[1];
		$lastname = $user[2];
		$street = $user[4];
		$city = $user[5];
		$state = $user[6];
		$zip = $user[7];
		$phone = $user[3];
		$email = $user[8];
		$password = $user[9];
	}
	else
	{  
		header("location:Login.php");
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

<?php include 'NavigationBar.php'; ?>

<body>

<div class="container-gateway" id="singup" style="margin:auto" align="center">

<form id="basic_information_form" name="basic_information_form" action="AccountSettingUpdate.php" method="POST" onsubmit="return check()">

<p>
<h4>Basic Information</h4>
</p>

<p>
<div style="margin:5px" id="firstname-fields" class="firstname">
<label for="firstname-txt"><span class="required">*</span>First Name</label>
<input id="firstname-txt" maxlength="40" name="TxtFirstName" value="<?php echo $firstname;?>" tabindex="1" type="text" onblur="checkname()">
<div id="divFirstName" style="display:inline"></div>
<input name="_D:TxtFirstName" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" id="lastname-fields" class="lastname client-error-lastname-fields">
<label for="lastname-txt"><span class="required">*</span>Last Name</label>
<input id="lastname-txt" maxlength="40" name="TxtLastName" value="<?php echo $lastname;?>" tabindex="2" type="text" onblur="checkname()">
<div id="divLastName" style="display:inline"></div>
<input name="_D:TxtLastName" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="street-fields">
<label for="TxtStreetId"><span class="required">*</span>Street Address</label>
<input id="TxtStreetId" maxlength="50" name="TxtStreet" value="<?php echo $street;?>" tabindex="3" type="text" onblur="checkstreet()">
<div id="divStreetAddress" style="display:inline"></div>
<input name="_D:TxtStreet" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="Apartment-fields">
<label for="TxtApartmentId">Apartment/Building</label>
<input id="TxtApartmentId" maxlength="50" name="TxtApartment" value="<?php echo $apartment;?>" tabindex="4" type="text">
<input name="_D:TxtApartment" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="City-fields">
<label for="TxtCityId"><span class="required">*</span>City</label>
<input id="TxtCityId" maxlength="50" name="TxtCity" value="<?php echo $city;?>" tabindex="5" type="text" onblur="checkcity()">
<div id="divCity" style="display:inline"></div>
<input name="_D:TxtCity" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" id="stateZipFind">
	<div id="stateHolder">
		<label id="for-sState" for="sState">State</label>
		 <select name="sstate" tabindex="60" id="sState" class="state-required" rel="addressResult">
            <option value=""
            selected="selected"
            >Select</option>
            <option value="AL" <?php if($state=="AL") echo("selected");?>
        >AL - Alabama</option>
            <option value="AK" <?php if($state=="AK") echo("selected");?>
        >AK - Alaska</option>
            <option value="AS" <?php if($state=="AS") echo("selected");?>
        >AS - American Samoa</option>
            <option value="AZ" <?php if($state=="AZ") echo("selected");?>
        >AZ - Arizona</option>
            <option value="AR" <?php if($state=="AR") echo("selected");?>
        >AR - Arkansas</option>
            <option value="CA" <?php if($state=="CA") echo("selected");?>
        >CA - California</option>
            <option value="CO" <?php if($state=="CO") echo("selected");?>
        >CO - Colorado</option>
            <option value="CT" <?php if($state=="CT") echo("selected");?>
        >CT - Connecticut</option>
            <option value="DE" <?php if($state=="DE") echo("selected");?>
        >DE - Delaware</option>
            <option value="DC" <?php if($state=="DC") echo("selected");?>
        >DC - District of Columbia</option>
            <option value="FM" <?php if($state=="FM") echo("selected");?>
        >FM - Federated States of Micronesia</option>
            <option value="FL" <?php if($state=="FL") echo("selected");?>
        >FL - Florida</option>
            <option value="GA" <?php if($state=="GA") echo("selected");?>
        >GA - Georgia</option>
            <option value="GU" <?php if($state=="GU") echo("selected");?>
        >GU - Guam</option>
            <option value="HI" <?php if($state=="HI") echo("selected");?>
        >HI - Hawaii</option>
            <option value="ID" <?php if($state=="ID") echo("selected");?>
        >ID - Idaho</option>
            <option value="IL" <?php if($state=="IL") echo("selected");?>
        >IL - Illinois</option>
            <option value="IN" <?php if($state=="IN") echo("selected");?>
        >IN - Indiana</option>
            <option value="IA" <?php if($state=="IA") echo("selected");?>
        >IA - Iowa</option>
            <option value="KS" <?php if($state=="KS") echo("selected");?>
        >KS - Kansas</option>
            <option value="KY" <?php if($state=="KY") echo("selected");?>
        >KY - Kentucky</option>
            <option value="LA" <?php if($state=="LA") echo("selected");?>
        >LA - Louisiana</option>
            <option value="ME" <?php if($state=="ME") echo("selected");?>
        >ME - Maine</option>
            <option value="MH" <?php if($state=="MH") echo("selected");?>
        >MH - Marshall Islands</option>
            <option value="MD" <?php if($state=="MD") echo("selected");?>
        >MD - Maryland</option>
            <option value="MA" <?php if($state=="MA") echo("selected");?>
        >MA - Massachusetts</option>
            <option value="MI" <?php if($state=="MI") echo("selected");?>
        >MI - Michigan</option>
            <option value="MN" <?php if($state=="MN") echo("selected");?>
        >MN - Minnesota</option>
            <option value="MS" <?php if($state=="MS") echo("selected");?>
        >MS - Mississippi</option>
            <option value="MO" <?php if($state=="MO") echo("selected");?>
        >MO - Missouri</option>
            <option value="MT" <?php if($state=="MT") echo("selected");?>
        >MT - Montana</option>
            <option value="NE" <?php if($state=="NE") echo("selected");?>
        >NE - Nebraska</option>
            <option value="NV" <?php if($state=="NV") echo("selected");?>
        >NV - Nevada</option>
            <option value="NH" <?php if($state=="NH") echo("selected");?>
        >NH - New Hampshire</option>
            <option value="NJ" <?php if($state=="NJ") echo("selected");?>
        >NJ - New Jersey</option>
            <option value="NM" <?php if($state=="NM") echo("selected");?>
        >NM - New Mexico</option>
            <option value="NY" <?php if($state=="NY") echo("selected");?>
        >NY - New York</option>
            <option value="NC" <?php if($state=="NC") echo("selected");?>
        >NC - North Carolina</option>
            <option value="ND" <?php if($state=="ND") echo("selected");?>
        >ND - North Dakota</option>
            <option value="MP" <?php if($state=="MP") echo("selected");?>
        >MP - Northern Mariana Islands</option>
            <option value="OH" <?php if($state=="OH") echo("selected");?>
        >OH - Ohio</option>
            <option value="OK" <?php if($state=="OK") echo("selected");?>
        >OK - Oklahoma</option>
            <option value="OR" <?php if($state=="OR") echo("selected");?>
        >OR - Oregon</option>
            <option value="PW" <?php if($state=="PW") echo("selected");?>
        >PW - Palau</option>
            <option value="PA" <?php if($state=="PA") echo("selected");?>
        >PA - Pennsylvania</option>
            <option value="PR" <?php if($state=="PR") echo("selected");?>
        >PR - Puerto Rico</option>
            <option value="RI" <?php if($state=="RI") echo("selected");?>
        >RI - Rhode Island</option>
            <option value="SC" <?php if($state=="SC") echo("selected");?>
        >SC - South Carolina</option>
            <option value="SD" <?php if($state=="SD") echo("selected");?>
        >SD - South Dakota</option>
            <option value="TN" <?php if($state=="TN") echo("selected");?>
        >TN - Tennessee</option>
            <option value="TX" <?php if($state=="TX") echo("selected");?>
        >TX - Texas</option>
            <option value="UT" <?php if($state=="UT") echo("selected");?>
        >UT - Utah</option>
            <option value="VT" <?php if($state=="VT") echo("selected");?>
        >VT - Vermont</option>
            <option value="VI" <?php if($state=="VI") echo("selected");?>
        >VI - Virgin Islands</option>
            <option value="VA" <?php if($state=="VA") echo("selected");?>
        >VA - Virginia</option>
            <option value="WA" <?php if($state=="WA") echo("selected");?>
        >WA - Washington</option>
            <option value="WV" <?php if($state=="WV") echo("selected");?>
        >WV - West Virginia</option>
            <option value="WI" <?php if($state=="WI") echo("selected");?>
        >WI - Wisconsin</option>
            <option value="WY" <?php if($state=="WY") echo("selected");?>
        >WY - Wyoming</option>
        </select>
	</div>
</div>
</p>

<p>
<div style="margin:5px" class="zip other-fields">
<label for="zip-txt"><span class="required">*</span>ZIP Code</label>
<input id="zip-txt" maxlength="10" name="TxtPostalCode" value="<?php echo $zip;?>" tabindex="6" type="text" size="25" onblur="checkzip()">
<div id="divZip" style="display:inline"></div>
<input name="_D:TxtPostalCode" value=" " type="hidden">
<input name="TxtShipPostalCode" value="" type="hidden">
<input name="_D:TxtShipPostalCode" value=" " type="hidden">
<input name="TxtBillPostalCode" value="" type="hidden"><input name="_D:TxtBillPostalCode" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="phone other-fields">
<label for="phone-txt"><span class="required">*</span>Phone</label>
<input id="phone-txt" maxlength="50" name="TxtPhoneNumber" value="<?php echo $phone;?>" tabindex="7" type="text" size="25" onblur="checkphone()">
<div id="divPhone" style="display:inline"></div>
<input name="_D:TxtPhoneNumber" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="email other-fields">
<label for="TxtEmailId"><span class="required">*</span>E-Mail Address</label>
<input id="TxtEmailId" maxlength="50" name="TxtEmail" readonly="true" value="<?php echo $email;?>" tabindex="8" type="email" autocomplete="off" onblur="checkemail()">
<div id="divEmail" style="display:inline"></div>
<input name="_D:TxtEmail" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="password other-fields">
<label for="PwdPasswordId"><span class="required">*</span>Password</label>
<input id="PwdPasswordId" maxlength="100" data-strength-meter="true" name="PwdPassword" value="<?php echo $password;?>" tabindex="9" data-showable="true" class="password " type="password" autocomplete="off" onblur="checkpassword()">
<div id="divPassword" style="display:inline"></div>
<input name="_D:PwdPassword" value=" " type="hidden">
</div>
</p>

<p>
<div style="margin:5px" class="form-radialGradient_line"></div>
<div id="btnContainer">
<div style="margin:5px" class="btnholder">
<button id="caSubmitBtn" type="submit" tabindex="10" name="CmdCreate" alt="Continue" class="large-secondary-action-button">Submit</button>
</p>
</form>

</div>


</body>
</html>