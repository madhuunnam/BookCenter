<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Card</title>


<style>

  .column-top{
        border:1px solid;border-color:#09F;width:400px;margin:5px
   }
   .column-middle{
        border:1px solid;border-color:#09F;width:400px;margin:5px;border-top:none
   }
   
</style>


</head>

<?php 
if(!isset($_SESSION['custID']))
{
	header("location:Login.php");
}
?>

<?php include 'NavigationBar.php'; ?>


<body>

<?php

	ob_start(); 
		
	if(!isset($_SESSION['custID']))
	{
		header("location:Login.php");
	}

	$custID=$_GET['customer'];
	$cardnumber=$_GET['cardnumber'];

	$sql="SELECT * FROM `creditcards` WHERE custID='".$custID."' and cardnumber='".$cardnumber."'";

	$db = new DataBase();
	$db->conn();
	$k= $db->indb($sql);
	  
	if($card=mysql_fetch_row($k))
	{
		$nameoncard = $card[2];
		$cvc = $card[5];
		$expmonth = $card[3];
		$expyear = $card[4];
		$TxtStreet = $card[6];
		$TxtApartment = "";
		$TxtCity = $card[7];
		$TxtState = $card[8];
		$TxtPostalCode = $card[9];
	}
	else
	{  
		header("location:ManagePayment.php");
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



<div class="column-out" id="payment" style="margin:auto" align="center">
    <form id="simplify_payment_form" name="simplify_payment_form" action="EditCardSubmit.php" method="POST">
    <div class="column-top" id="credit" style="margin:auto" align="center">
    <p>
    	<h4>Credit Card Information</h4>
    </p>
    
    <p>
        <div style="margin:5px">
            <label>Credit Card Number: </label>
            <input id="cc-number" name="cardnumber" readonly="true" type="text" maxlength="20" autocomplete="off" value="<?php echo $cardnumber;?>" autofocus />
        </div>
	</p>
    
    <p>
		<div style="margin:5px">
            <label>Name On Card: </label>
            <input id="cc-name" name="nameoncard" type="text" maxlength="20" autocomplete="off" value="<?php echo $nameoncard;?>" />
        </div>
	</p>
    
    <p>
        <div style="margin:5px">
            <label>CVC: </label>
            <input id="cc-cvc" name="cvc" type="text" maxlength="4" autocomplete="off" value="<?php echo $cvc;?>"/>
        </div>
    </p> 
    
    <p>  
        <div style="margin:5px">
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
        	<h4>Billing Address</h4>
            </p>
            
            <p>
            <div style="margin:5px" class="street-fields">
            <label for="TxtStreetId">Street Address</label>
            <input id="TxtStreetId" maxlength="50" name="TxtStreet" value="<?php echo $TxtStreet;?>" type="text">
            <input name="_D:TxtStreet" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div style="margin:5px" class="Apartment-fields">
            <label for="TxtApartmentId">Apartment/Building</label>
            <input id="TxtApartmentId" maxlength="50" name="TxtApartment" value="" type="text">
            <input name="_D:TxtApartment" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div style="margin:5px" class="City-fields">
            <label for="TxtCityId">City</label>
            <input id="TxtCityId" maxlength="50" name="TxtCity" value="<?php echo $TxtCity;?>" type="text">
            <input name="_D:TxtCity" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div style="margin:5px" id="stateZipFind">
            <label for="TxtStateId">State</label>
            <input id="TxtStateId" maxlength="50" name="TxtState" value="<?php echo $TxtState;?>" type="text">
            <input name="_D:TxtState" value=" " type="hidden">
            </div>
            </p>
            
            <p>
            <div style="margin:5px" class="zip other-fields">
            <label for="zip-txt">ZIP Code</label>
            <input id="zip-txt" maxlength="10" name="TxtPostalCode" value="<?php echo $TxtPostalCode;?>" type="text" size="25"><input name="_D:TxtPostalCode" value=" " type="hidden">
            <input name="TxtShipPostalCode" value="" type="hidden">
            <input name="_D:TxtShipPostalCode" value=" " type="hidden">
            <input name="TxtBillPostalCode" value="" type="hidden"><input name="_D:TxtBillPostalCode" value=" " type="hidden">
            </div>
            </p>
        </div>
        <p style="margin:auto">
            <button name="card_submit" type="submit" value="Update" class="ybtn ybtn-small"><span>Update</span></button>
        </p>
        
    </form>
</div>



</body>
</html>