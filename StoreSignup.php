<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Signup</title>

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
	  //alert("latitude: " + results[0].geometry.location.lat() + ", longtitude" + results[0].geometry.location.lng());
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



</head>

<body>


<div class="container-gateway" id="singup" style="margin:auto" align="center">

<form id="basic_information_form" name="basic_information_form" action="storesignupchecking.php" method="POST" onsubmit="return check()">

<p>
<div id="storename-fields" class="firstname">
<label for="storename-txt"><span class="required">*</span>Store Name</label>
<input id="storename-txt" maxlength="40" name="TxtStoreName" value="" type="text" onblur="checkname()">
<div id="divStoreName" style="display:inline"></div>
<input name="_D:TxtStoreName" value=" " type="hidden">
</div>
</p>

<p>
<div class="street-fields">
<label for="TxtStreetId"><span class="required">*</span>Street Address</label>
<input id="TxtStreetId" maxlength="50" name="TxtStreet" value="" type="text" onblur="checkaddress()">
<div id="divStreetAddress" style="display:inline"></div>
<input name="_D:TxtStreet" value=" " type="hidden">
</div>
</p>

<p>
<div class="Apartment-fields">
<label for="TxtApartmentId">Apartment/Building</label>
<input id="TxtApartmentId" maxlength="50" name="TxtApartment" value="" type="text">
<input name="_D:TxtApartment" value=" " type="hidden">
</div>
</p>

<p>
<div class="City-fields">
<label for="TxtCityId"><span class="required">*</span>City</label>
<input id="TxtCityId" maxlength="50" name="TxtCity" value="" type="text" onblur="checkaddress()">
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
            <option value="AL"
        >AL - Alabama</option>
            <option value="AK"
        >AK - Alaska</option>
            <option value="AS"
        >AS - American Samoa</option>
            <option value="AZ"
        >AZ - Arizona</option>
            <option value="AR"
        >AR - Arkansas</option>
            <option value="CA"
        >CA - California</option>
            <option value="CO"
        >CO - Colorado</option>
            <option value="CT"
        >CT - Connecticut</option>
            <option value="DE"
        >DE - Delaware</option>
            <option value="DC"
        >DC - District of Columbia</option>
            <option value="FM"
        >FM - Federated States of Micronesia</option>
            <option value="FL"
        >FL - Florida</option>
            <option value="GA"
        >GA - Georgia</option>
            <option value="GU"
        >GU - Guam</option>
            <option value="HI"
        >HI - Hawaii</option>
            <option value="ID"
        >ID - Idaho</option>
            <option value="IL"
        >IL - Illinois</option>
            <option value="IN"
        >IN - Indiana</option>
            <option value="IA"
        >IA - Iowa</option>
            <option value="KS"
        >KS - Kansas</option>
            <option value="KY"
        >KY - Kentucky</option>
            <option value="LA"
        >LA - Louisiana</option>
            <option value="ME"
        >ME - Maine</option>
            <option value="MH"
        >MH - Marshall Islands</option>
            <option value="MD"
        >MD - Maryland</option>
            <option value="MA"
        >MA - Massachusetts</option>
            <option value="MI"
        >MI - Michigan</option>
            <option value="MN"
        >MN - Minnesota</option>
            <option value="MS"
        >MS - Mississippi</option>
            <option value="MO"
        >MO - Missouri</option>
            <option value="MT"
        >MT - Montana</option>
            <option value="NE"
        >NE - Nebraska</option>
            <option value="NV"
        >NV - Nevada</option>
            <option value="NH"
        >NH - New Hampshire</option>
            <option value="NJ"
        >NJ - New Jersey</option>
            <option value="NM"
        >NM - New Mexico</option>
            <option value="NY"
        >NY - New York</option>
            <option value="NC"
        >NC - North Carolina</option>
            <option value="ND"
        >ND - North Dakota</option>
            <option value="MP"
        >MP - Northern Mariana Islands</option>
            <option value="OH"
        >OH - Ohio</option>
            <option value="OK"
        >OK - Oklahoma</option>
            <option value="OR"
        >OR - Oregon</option>
            <option value="PW"
        >PW - Palau</option>
            <option value="PA"
        >PA - Pennsylvania</option>
            <option value="PR"
        >PR - Puerto Rico</option>
            <option value="RI"
        >RI - Rhode Island</option>
            <option value="SC"
        >SC - South Carolina</option>
            <option value="SD"
        >SD - South Dakota</option>
            <option value="TN"
        >TN - Tennessee</option>
            <option value="TX"
        >TX - Texas</option>
            <option value="UT"
        >UT - Utah</option>
            <option value="VT"
        >VT - Vermont</option>
            <option value="VI"
        >VI - Virgin Islands</option>
            <option value="VA"
        >VA - Virginia</option>
            <option value="WA"
        >WA - Washington</option>
            <option value="WV"
        >WV - West Virginia</option>
            <option value="WI"
        >WI - Wisconsin</option>
            <option value="WY"
        >WY - Wyoming</option>
        </select>
	</div>
</div>
</p>

<p>
<div class="zip other-fields">
<label for="zip-txt"><span class="required">*</span>ZIP Code</label>
<input id="zip-txt" maxlength="10" name="TxtPostalCode" value="" type="text" size="25" onblur="checkaddress()">
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
<input id="phone-txt" maxlength="50" name="TxtPhoneNumber" value="" type="text" size="25" onblur="checkphone()">
<div id="divPhone" style="display:inline"></div>
<input name="_D:TxtPhoneNumber" value=" " type="hidden">
</div>
</p>

<p>
<div class="website-fields">
<label for="website-txt">Website</label>
<input id="website-txt" maxlength="50" name="TxtWebsite" value="" type="text" size="25">
<div id="divWebsite" style="display:inline"></div>
<input name="_D:TxtWebsite" value=" " type="hidden">
</div>
</p>

<p>
<div class="managername-fields">
<label for="managername-txt">Manager Name</label>
<input id="managername-txt" maxlength="50" name="TxtManagername" value="" type="text" size="25">
<div id="divManagername" style="display:inline"></div>
<input name="_D:TxtManagername" value=" " type="hidden">
</div>
</p>

<p>
<div class="managerphone-fields">
<label for="managerphone-txt">Manager Phone</label>
<input id="managerphone-txt" maxlength="50" name="TxtManagerphone" value="" type="text" size="25">
<div id="divManagerphone" style="display:inline"></div>
<input name="_D:TxtManagerphone" value=" " type="hidden">
</div>
</p>

<p>
<div class="manageremail-fields">
<label for="manageremail-txt">Manager Email</label>
<input id="manageremail-txt" maxlength="50" name="TxtManageremail" value="" type="email" size="25">
<div id="divManageremail" style="display:inline"></div>
<input name="_D:TxtManageremail" value=" " type="hidden">
</div>
</p>

<p>
  <div>
      <label>Type: </label>
      <select id="cc-type" name="type">
          <option value="Library">Library</option>
          <option value="BookStore">Book Store</option>
      </select>
  </div>
</p>

<!---<p>
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
          <option value="1">What is the color of your eyes?</option>
          <option value="2">What is your favorite sport?</option>
          <option value="3">What is your mother's middle name?</option>
          <option value="4">What was your maternal grandfather's first name?</option>
          <option value="5">What is the country of your ultimate dream vacation?</option>
      </select>
  </div>
  <div>
  		<label><span class="required">*</span>Answer: </label>
        <input id="TxtAns1" maxlength="50" name="TxtAns1" value="" type="text" onblur="checkans1()">
        <div id="divAns1" style="display:inline"></div>
        <input name="_D:TxtAns1" value=" " type="hidden">
  </div>
</p>

<p>
  <div>
      <label><span class="required">*</span>Security Question 2: </label>
      <select id="sq-type2" name="type2">
          <option value="1">What is the first name of the person you first kissed?</option>
          <option value="2">What is the name of the first beach you visited?</option>
          <option value="3">What was the make and model of your first car?</option>
          <option value="4">What was the name of your elementary school?</option>
          <option value="5">What is your pet's name?</option>
      </select>
  </div>
  <div>
  		<label>Answer: </label>
        <input id="TxtAns2" maxlength="50" name="TxtAns2" value="" type="text" onblur="checkans2()">
        <div id="divAns2" style="display:inline"></div>
        <input name="_D:TxtAns2" value=" " type="hidden">
  </div>
</p>

<p>
<div class="email other-fields">
<label for="TxtEmailId"><span class="required">*</span>E-Mail Address</label>
<input id="TxtEmailId" maxlength="50" name="TxtEmail" value="" type="email" autocomplete="off" onblur="checkemail()">
<div id="divEmail" style="display:inline"></div>
<input name="_D:TxtEmail" value=" " type="hidden">
</div>
</p>

<p>
<div class="password other-fields">
<label for="PwdPasswordId"><span class="required">*</span>Password</label>
<input id="PwdPasswordId" maxlength="100" data-strength-meter="true" name="PwdPassword" value="" data-showable="true" class="password " type="password" autocomplete="off" onblur="checkpassword()">
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