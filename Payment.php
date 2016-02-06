<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Information</title>

<script language="javascript" type="text/javascript">
function billingonclick(obj) 
{
	if (obj.checked == true) 
	{
		//set all value as the home address
		document.getElementById("TxtStreetId").value = document.getElementById("TxtHomeStreetId").value;
		document.getElementById("TxtApartmentId").value = document.getElementById("TxtHomeApartmentId").value;
		document.getElementById("TxtCityId").value = document.getElementById("TxtHomeCityId").value;
		document.getElementById("TxtStateId").value = document.getElementById("TxtHomeStateId").value;
		document.getElementById("zip-txt").value = document.getElementById("homezip-txt").value;
	}
	else
	{
		//set all value as empty
		document.getElementById("TxtStreetId").value = "";
		document.getElementById("TxtApartmentId").value = "";
		document.getElementById("TxtCityId").value = "";
		document.getElementById("TxtStateId").value = "";
		document.getElementById("zip-txt").value = "";
	}
}

function shippingonclick(obj) 
{
	if (obj.checked == true) 
	{
		//set all value as the home address
		document.getElementById("STxtStreetId").value = document.getElementById("TxtHomeStreetId").value;
		document.getElementById("STxtApartmentId").value = document.getElementById("TxtHomeApartmentId").value;
		document.getElementById("STxtCityId").value = document.getElementById("TxtHomeCityId").value;
		document.getElementById("STxtStateId").value = document.getElementById("TxtHomeStateId").value;
		document.getElementById("Szip-txt").value = document.getElementById("homezip-txt").value;
	}
	else
	{
		//set all value as empty
		document.getElementById("STxtStreetId").value = "";
		document.getElementById("STxtApartmentId").value = "";
		document.getElementById("STxtCityId").value = "";
		document.getElementById("STxtStateId").value = "";
		document.getElementById("Szip-txt").value = "";
	}
}
</script>

</head>

<style>

  .column-out{
        border:1px solid;border-color:#09F;width:400px
   }
   .column-middle{
        border:1px solid;border-color:#09F;border-left:none;border-right:none;width:400px
   }
   
</style>

<?php 
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
?>

<body>
<div class="column-out" id="payment" style="margin:auto" align="center">

    <form id="simplify_payment_form" name="simplify_payment_form" action="" method="POST">
    <div class="column-top" id="credit" style="margin:auto" align="center">
    <p>
    	<h4>Credit Card Information</h4>
    </p>
    
    <p>
        <div>
            <label>Credit Card Number: </label>
            <input id="cc-number" name="cardnumber" type="text" maxlength="20" autocomplete="off" value="" autofocus />
        </div>
	</p>
    
    <p>
		<div>
            <label>Name On Card: </label>
            <input id="cc-name" name="nameoncard" type="text" maxlength="20" autocomplete="off" value="" />
        </div>
	</p>
    
    <p>
        <div>
            <label>CVC: </label>
            <input id="cc-cvc" name="cvc" type="text" maxlength="4" autocomplete="off" value=""/>
        </div>
    </p> 
    
    <p>  
        <div>
            <label>Expiry Date: </label>
            <select id="cc-exp-month" name="expmonth">
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">Apr</option>
                <option value="05">May</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>
            <select id="cc-exp-year" name="expyear">
                <option value="14">2014</option>
                <option value="15">2015</option>
                <option value="16">2016</option>
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
            </select>
        </div>
     </p>
     </div>
      
        <div class="column-middle" id="billing" style="margin:auto" align="center">
        	<p>
        	<h4>Billing Address</h4><label><input id="cbBillingAddressId" name="cbBillingAddress" type="checkbox" onclick="billingonclick(this)"/>Same as Home Address</label>
            </p>
            
            <p>
            <div class="street-fields">
            <label for="TxtStreetId">Street Address</label>
            <input id="TxtStreetId" maxlength="50" name="TxtStreet" value="" type="text">
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
            <label for="TxtCityId">City</label>
            <input id="TxtCityId" maxlength="50" name="TxtCity" value="" type="text">
            <input name="_D:TxtCity" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div id="stateZipFind">
            <label for="TxtStateId">State</label>
            <input id="TxtStateId" maxlength="50" name="TxtState" value="" type="text">
            <input name="_D:TxtState" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div class="zip other-fields">
            <label for="zip-txt">ZIP Code</label>
            <input id="zip-txt" maxlength="10" name="TxtPostalCode" value="" type="text" size="25"><input name="_D:TxtPostalCode" value=" " type="hidden">
            <input name="TxtShipPostalCode" value="" type="hidden">
            <input name="_D:TxtShipPostalCode" value=" " type="hidden">
            <input name="TxtBillPostalCode" value="" type="hidden"><input name="_D:TxtBillPostalCode" value=" " type="hidden">
            </div>
            </p>
        </div>
        
        <div class="column-bottom" id="shipping" style="margin:auto" align="center">
        	<p>
        	<h4>Shipping Address</h4><label><input id="cbShippingAddressId" name="cbShipingAddress" type="checkbox" onclick="shippingonclick(this)"/>Same as Home Address</label>
            </p>
            
            <p>
            <div class="s-street-fields">
            <label for="STxtStreetId">Street Address</label>
            <input id="STxtStreetId" maxlength="50" name="STxtStreet" value="" type="text">
            <input name="_D:STxtStreet" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div class="s-Apartment-fields">
            <label for="STxtApartmentId">Apartment/Building</label>
            <input id="STxtApartmentId" maxlength="50" name="STxtApartment" value="" type="text">
            <input name="_D:STxtApartment" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div class="s-City-fields">
            <label for="STxtCityId">City</label>
            <input id="STxtCityId" maxlength="50" name="STxtCity" value="" type="text">
            <input name="_D:STxtCity" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div id="s-stateZipFind">
            <label for="STxtStateId">State</label>
            <input id="STxtStateId" maxlength="50" name="STxtState" value="" type="text">
            <input name="_D:STxtState" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div class="s-zip other-fields">
            <label for="Szip-txt">ZIP Code</label>
            <input id="Szip-txt" maxlength="10" name="STxtPostalCode" value="" type="text" size="25"><input name="_D:STxtPostalCode" value=" " type="hidden">
            <input name="STxtShipPostalCode" value="" type="hidden">
            <input name="_D:STxtShipPostalCode" value=" " type="hidden">
            <input name="STxtBillPostalCode" value="" type="hidden"><input name="_D:STxtBillPostalCode" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <button id="caSubmitBtn" type="submit">Submit</button>
            </p>
        </div>
        
        <div>
        	<input id="firstname-txt" maxlength="40" name="TxtFirstName" value="<?php echo $firstname;?>" type="hidden">
            <input id="lastname-txt" maxlength="40" name="TxtLastName" value="<?php echo $lastname;?>" type="hidden">
            <input id="TxtHomeStreetId" maxlength="50" name="TxtHomeStreet" value="<?php echo $street;?>" type="hidden">
            <input id="TxtHomeApartmentId" maxlength="50" name="TxtHomeApartment" value="<?php echo $apartment;?>" type="hidden">
            <input id="TxtHomeCityId" maxlength="50" name="TxtHomeCity" value="<?php echo $city;?>" type="hidden">
            <input id="TxtHomeStateId" maxlength="50" name="TxtHomeState" value="<?php echo $state;?>" type="hidden">
            <input id="homezip-txt" maxlength="10" name="TxtHomePostalCode" value="<?php echo $zip;?>" type="hidden">
            <input id="phone-txt" maxlength="50" name="TxtPhoneNumber" value="<?php echo $phone;?>" type="hidden">
            <input id="TxtEmailId" maxlength="50" name="TxtEmail" value="<?php echo $email;?>" type="hidden">
            <input id="PwdPasswordId" maxlength="100" name="PwdPassword" value="<?php echo $password;?>" type="hidden">
        </div>
        
    </form>
</div>
</body>
</html>