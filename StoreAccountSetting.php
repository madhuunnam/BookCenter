<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Account Setting</title>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script language="javascript">

function getlatlng()
{
	var geocoder = new google.maps.Geocoder();
	
	var street = document.getElementById('TxtStreetId').value;
	var city = document.getElementById('TxtCityId').value;
	var state = document.getElementById('sState').value;
	
  geocoder.geocode( { 'address': street+" ,"+city+" ,"+state}, function(results, status) 
  {
    if (status == google.maps.GeocoderStatus.OK) 
	{
		document.getElementById('lat').value=results[0].geometry.location.lat();
		document.getElementById('lng').value=results[0].geometry.location.lng();
    } 
	else 
	{
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function checkaddress()
{
	if(checkstreet() && checkcity() && checkzip())
	{
		getlatlng()
		return true;
	}
	else
	{
		return false;
	}
}

function check()
{
  if (checkname() && checkaddress() && checkphone() &&checkemail() && checkpassword() && checkans1() && checkans2()) 
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

<?php
	if(!isset($_SESSION['storeID']))
	{
		header("location:StoreLogin.php");
	}
?>

<?php  
    ob_start(); 
	
	$storeID = $_SESSION['storeID'];
	
	$name = "";
	$street = "";
	$apartment = "";
	$city = "";
	$state = "";
	$zip = "";
	$officephone = "";
	$cellphone = "";
	$email = "";
	$websiteaddress = "";
	$managername = "";
	$managerphone = "";
	$manageremail = "";
	$storetype = "";
	$password = "";
	$type1 = "";
	$type2 = "";
	$answer1 = "";
	$answer2 = "";
	
	$sql="SELECT * FROM `stores` WHERE storeID = '".$storeID."'";

	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);
	  
	if($store = mysql_fetch_row($k))
	{
		$name = $store[1];
		$street = $store[3];
		$apartment = $store[4];
		$city = $store[5];
		$state = $store[6];
		$zip = $store[7];
		$officephone = $store[8];
		$cellphone = $store[9];
		$email = $store[10];
		$password = $store[17];
		$websiteaddress = $store[11];
		$managername = $store[12];
		$managerphone = $store[13];
		$manageremail = $store[14];
		$storetype = $store[15];
		$type1 = $store[22];
		$type2 = $store[24];
		$answer1 = $store[23];
		$answer2 = $store[25];
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

<form id="basic_information_form" name="basic_information_form" action="StoreAccountSettingUpdate.php" method="POST" onsubmit="return check()">

<p>
<div id="storename-fields" class="firstname">
<label for="storename-txt"><span class="required">*</span>Store Name</label>
<input id="storename-txt" maxlength="40" name="TxtStoreName" value="<?php echo $name;?>" type="text" onblur="checkname()">
<div id="divStoreName" style="display:inline"></div>
<input name="_D:TxtStoreName" value=" " type="hidden">
</div>
</p>

<p>
<div class="street-fields">
<label for="TxtStreetId"><span class="required">*</span>Street Address</label>
<input id="TxtStreetId" maxlength="50" name="TxtStreet" value="<?php echo $street;?>" type="text" onblur="checkaddress()">
<div id="divStreetAddress" style="display:inline"></div>
<input name="_D:TxtStreet" value=" " type="hidden">
</div>
</p>

<p>
<div class="Apartment-fields">
<label for="TxtApartmentId">Apartment/Building</label>
<input id="TxtApartmentId" maxlength="50" name="TxtApartment" value="<?php echo $apartment;?>" type="text">
<input name="_D:TxtApartment" value=" " type="hidden">
</div>
</p>

<p>
<div class="City-fields">
<label for="TxtCityId"><span class="required">*</span>City</label>
<input id="TxtCityId" maxlength="50" name="TxtCity" value="<?php echo $city;?>" type="text" onblur="checkaddress()">
<div id="divCity" style="display:inline"></div>
<input name="_D:TxtCity" value=" " type="hidden">
</div>
</p>

<p>
<div id="stateZipFind">
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
<div class="zip other-fields">
<label for="zip-txt"><span class="required">*</span>ZIP Code</label>
<input id="zip-txt" maxlength="10" name="TxtPostalCode" value="<?php echo $zip;?>" type="text" size="25" onblur="checkaddress()">
<div id="divZip" style="display:inline"></div>
<input name="_D:TxtPostalCode" value=" " type="hidden">
<input name="TxtShipPostalCode" value="" type="hidden">
<input name="_D:TxtShipPostalCode" value=" " type="hidden">
<input name="TxtBillPostalCode" value="" type="hidden"><input name="_D:TxtBillPostalCode" value=" " type="hidden">
</div>
</p>

<p>
<div class="phone other-fields">
<label for="phone-txt"><span class="required">*</span>Phone</label>
<input id="phone-txt" maxlength="50" name="TxtPhoneNumber" value="<?php echo $officephone;?>" type="text" size="25" onblur="checkphone()">
<div id="divPhone" style="display:inline"></div>
<input name="_D:TxtPhoneNumber" value=" " type="hidden">
</div>
</p>

<p>
<div class="website-fields">
<label for="website-txt">Website</label>
<input id="website-txt" maxlength="50" name="TxtWebsite" value="<?php echo $websiteaddress;?>" type="text" size="25">
<div id="divWebsite" style="display:inline"></div>
<input name="_D:TxtWebsite" value=" " type="hidden">
</div>
</p>

<p>
<div class="managername-fields">
<label for="managername-txt">Manager Name</label>
<input id="managername-txt" maxlength="50" name="TxtManagername" value="<?php echo $managername;?>" type="text" size="25">
<div id="divManagername" style="display:inline"></div>
<input name="_D:TxtManagername" value=" " type="hidden">
</div>
</p>

<p>
<div class="managerphone-fields">
<label for="managerphone-txt">Manager Phone</label>
<input id="managerphone-txt" maxlength="50" name="TxtManagerphone" value="<?php echo $managerphone;?>" type="text" size="25">
<div id="divManagerphone" style="display:inline"></div>
<input name="_D:TxtManagerphone" value=" " type="hidden">
</div>
</p>

<p>
<div class="manageremail-fields">
<label for="manageremail-txt">Manager Name</label>
<input id="manageremail-txt" maxlength="50" name="TxtManageremail" value="<?php echo $manageremail;?>" type="email" size="25">
<div id="divManageremail" style="display:inline"></div>
<input name="_D:TxtManageremail" value=" " type="hidden">
</div>
</p>

<p>
  <div>
      <label>Type: </label>
      <select id="cc-type" name="type">
          <option value="Library" <?php if($storetype=="Library") echo("selected");?>>Library</option>
          <option value="BookStore" <?php if($storetype=="BookStore") echo("selected");?>>Book Store</option>
      </select>
  </div>
</p>
<!--
<p>
	<table>
    <td valign="top">

	<div>
    	<label>Open Hours: </label>
    </div>
    </td>
    <td>
    <div>
    	<label>Mon </label>
        <input id="mondayhour-txt" maxlength="50" name="TxtMondayhour" value="" type="text" size="25">
        <br />
        <label>Tue </label>
        <input id="tuesdayhour-txt" maxlength="50" name="TxtTuesdayhour" value="" type="text" size="25">
        <br />
        <label>Wed </label>
        <input id="wednesdayhour-txt" maxlength="50" name="TxtWednesdayhour" value="" type="text" size="25">
        <br />
        <label>Thu </label>
        <input id="thursdayhour-txt" maxlength="50" name="TxtThursdayhour" value="" type="text" size="25">
        <br />
        <label>Fri </label>
        <input id="fridayhour-txt" maxlength="50" name="TxtFridayhour" value="" type="text" size="25">
        <br />
        <label>Sat </label>
        <input id="saturdayhour-txt" maxlength="50" name="TxtSaturdayhour" value="" type="text" size="25">
        <br />
        <label>Sun </label>
        <input id="sundayhour-txt" maxlength="50" name="TxtSundayhour" value="" type="text" size="25">
        <br />
    </div>
    </td>
    </table>
</p>
-->
<p>
  <div>
      <label>Security Question 1: </label>
      <select id="sq-type1" name="type1">
          <option value="1" <?php if($type1==1) echo("selected");?>>What is the color of your eyes?</option>
          <option value="2" <?php if($type1==2) echo("selected");?>>What is your favorite sport?</option>
          <option value="3" <?php if($type1==3) echo("selected");?>>What is your mother's middle name?</option>
          <option value="4" <?php if($type1==4) echo("selected");?>>What was your maternal grandfather's first name?</option>
          <option value="5" <?php if($type1==5) echo("selected");?>>What is the country of your ultimate dream vacation?</option>
      </select>
  </div>
  <div>
  		<label><span class="required">*</span>Answer: </label>
        <input id="TxtAns1" maxlength="50" name="TxtAns1" value="<?php echo $answer1;?>" type="text" onblur="checkans1()">
        <div id="divAns1" style="display:inline"></div>
        <input name="_D:TxtAns1" value=" " type="hidden">
  </div>
</p>

<p>
  <div>
      <label><span class="required">*</span>Security Question 2: </label>
      <select id="sq-type2" name="type2">
          <option value="1" <?php if($type2==1) echo("selected");?>>What is the first name of the person you first kissed?</option>
          <option value="2" <?php if($type2==2) echo("selected");?>>What is the name of the first beach you visited?</option>
          <option value="3" <?php if($type2==3) echo("selected");?>>What was the make and model of your first car?</option>
          <option value="4" <?php if($type2==4) echo("selected");?>>What was the name of your elementary school?</option>
          <option value="5" <?php if($type2==5) echo("selected");?>>What is your pet's name?</option>
      </select>
  </div>
  <div>
  		<label>Answer: </label>
        <input id="TxtAns2" maxlength="50" name="TxtAns2" value="<?php echo $answer2;?>" type="text" onblur="checkans2()">
        <div id="divAns2" style="display:inline"></div>
        <input name="_D:TxtAns2" value=" " type="hidden">
  </div>
</p>

<p>
<div class="email other-fields">
<label for="TxtEmailId"><span class="required">*</span>E-Mail Address</label>
<input id="TxtEmailId" maxlength="50" name="TxtEmail" readonly="true" value="<?php echo $email;?>" type="email" autocomplete="off" onblur="checkemail()">
<div id="divEmail" style="display:inline"></div>
<input name="_D:TxtEmail" value=" " type="hidden">
</div>
</p>

<p>
<div class="password other-fields">
<label for="PwdPasswordId"><span class="required">*</span>Password</label>
<input id="PwdPasswordId" maxlength="100" data-strength-meter="true" name="PwdPassword" value="<?php echo $password;?>" data-showable="true" class="password " type="password" autocomplete="off" onblur="checkpassword()">
<div id="divPassword" style="display:inline"></div>
<input name="_D:PwdPassword" value=" " type="hidden">
</div>
</p>

<p>
<input id="lat" maxlength="100" name="lat" value="" type="hidden">
<input id="lng" maxlength="100" name="lng" value="" type="hidden">
</p>

<p>
<div class="form-radialGradient_line"></div>
<div id="btnContainer">
<div class="btnholder">
<button id="caSubmitBtn" type="submit" tabindex="10" name="CmdCreate" alt="Continue" class="large-secondary-action-button">Submit</button>
</p>
</form>

</div>


</body>
</html>