<?php
session_start();
?>
<html>
<style type="text/css">
    h2 {
        text-align: center;
        margin:50px;
    }

    table {
        text-align: left;
        margin-left:auto;
        margin-right:auto;
        margin-bottom:20px;
    }

    td {
        margin:20px;
    }

    input[type=submit], input[type=button] {
        -webkit-appearance: none;
        height: 2em;
        width: 12em;
        font-size: 1em;
        border-radius: 5px;
    }

    sup {
        color: RED;
    }

    .markRed {
        border: solid 2px RED;
    }
</style>
<script type="text/javascript" src='jquery-1.4.1.js'></script>
<script type="text/javascript">
    <?php
        $custID = null;
        if (isset($_SESSION['custID'])) {
            $custID = $_SESSION['custID'];
        }
        if(isset($_POST['submitted']) && $_POST['submitted'] == '1') {
            $result = "";
            $message = "";
            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $middleInitial = $_POST['middleInitial'];
            $address = $_POST['address'];
            $address2 = $_POST['address2'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $otherPhone = $_POST['otherPhone'];
            $favLibrary = $_POST['favLibrary'];
            $cardNum = $_POST['cardNum'];
            $cardType = $_POST['cardType'];
            $cardName = $_POST['cardName'];
            $expDate = $_POST['expDate'];
            $secCode = $_POST['secCode'];
            $billingAddr = $_POST['billingAddr'];

            if ($result != "") {
                $message = 'Please fill all the required fields';
            } else {
                $con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                if (!$con) {
                    die("Failed to conect to MySQL: " . mysqli_error());
                }

                $sql="UPDATE `customers` SET `firstName`='".$firstname."', `middleName`='".$middleInitial."', `lastName`='".$lastname."', `telephoneNumber`='".$phone."', `otherPhone`='".$otherPhone."', `addrStNum`='".$address."', `addrL2`='".$address2."', `city`='".$city."', `state`='".$state."', `zip`='".$zip."', `emailAddress`='".$email."', `password`='".$password."', `cardNumber`='".$cardNum."', `cardType`='".$cardType."', `cardName`='".$cardName."', `cardExp`='".$expDate."', `cardCode`='".$secCode."', `billingAddr`='".$billingAddr."', `homeLib`='".$favLibrary."' WHERE `custID`='".$custID."'";


                if (!mysqli_query($con, $sql)) {
                    $message="Unable to Update. Please try again " . $sql;
                } else {
                    echo "alert('Successfully Updated');";
                    echo 'window.location.href = "homepageCN.php";';
                }

            }

            if ($message != "") {
                echo "$(document).ready(function() { \n";
                echo "alert('" . $message . "');\n";
                echo "$('#firstName').val('" . $firstname .  "');\n";
                echo "$('#lastName').val('" . $lastname .  "');\n";
                echo "$('#address').val('" . $address .  "');\n";
                echo "$('#middleInitial').val('" . $middleInitial .  "');\n";
                echo "$('#address2').val('" . $address2 .  "');\n";
                echo "$('#city').val('" . $city .  "');\n";
                echo "$('#state').val('" . $state .  "');\n";
                echo "$('#zip').val('" . $zip .  "');\n";
                echo "$('#email').val('" . $custID .  "');\n";
                echo "$('#password').val('" . $password .  "');\n";
                echo "$('#phone').val('" . $phone .  "');\n";
                echo "$('#otherPhone').val('" . $otherPhone .  "');\n";
                echo "$('#cardNum').val('" . $cardNum .  "');\n";
                echo "$('#cardType').val('" . $cardType .  "');\n";
                echo "$('#cardName').val('" . $cardName .  "');\n";
                echo "$('#expDate').val('" . $expDate .  "');\n";
                echo "$('#secCode').val('" . $secCode .  "');\n";
                echo "$('#billingAddr').val('" . $billingAddr .  "');\n";
                echo "$('#favLibrary').val('" . $favLibrary .  "');\n";
                echo "});\n";
            }
        } else {
            if ($custID == null) {
                 echo 'window.location.href = "login.php";';
            } else {
                $con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                if (!$con) {
                    die("Failed to conect to MySQL: " . mysqli_error());
                }

                $sql = "SELECT * FROM customers WHERE custID='".$custID."'";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($user = mysqli_fetch_assoc($result)) {
                        echo "$(document).ready(function() { \n";
                        echo "$('#firstName').val('" . $user['firstName'] .  "');\n";
                        echo "$('#middleInitial').val('" . $user['middleName'] .  "');\n";
                        echo "$('#lastName').val('" . $user['lastName'] .  "');\n";
                        echo "$('#phone').val('" . $user['telephoneNumber'] .  "');\n";
                        echo "$('#otherPhone').val('" . $user['otherPhone'] .  "');\n";
                        echo "$('#email').val('" . $user['emailAddress'] .  "');\n";
                        echo "$('#password').val('" . $user['password'] .  "');\n";
                        echo "$('#address').val('" . $user['addrStNum'] .  "');\n";
                        echo "$('#address2').val('" . $user['addrL2'] .  "');\n";
                        echo "$('#city').val('" . $user['city'] .  "');\n";
                        echo "$('#state').val('" . $user['state'] .  "');\n";
                        echo "$('#zip').val('" . $user['zip'] .  "');\n";
                        echo "$('#cardNum').val('" . $user['cardNumber'] .  "');\n";
                        echo "$('#cardType').val('" . $user['cardType'] .  "');\n";
                        echo "$('#cardName').val('" . $user['cardName'] .  "');\n";
                        echo "$('#expDate').val('" . $user['cardExp'] .  "');\n";
                        echo "$('#secCode').val('" . $user['cardCode'] .  "');\n";
                        echo "$('#billingAddr').val('" . $user['billingAddr'] .  "');\n";
                        echo "$('#favLibrary').val('" . $user['homeLib'] .  "');\n";
                        echo "});\n";
                    }
                } else {
                    echo "alert('0 results');";
                }


            }
        }
    ?>
</script>
<body>
<?php
include 'NavigationBarCN.php';
?>
<h2> 个人资料 </h2>
<div style="text-align:center;">
    <form method="post" action="customerProfileCN.php">
        <input type="hidden" name="submitted" value="1"/>
        <table>
            <tr>
                <th> First Name</th>
                <td> <input type=text id="firstName" name="firstName"/> </td>
                <th> MI <input type=text id="middleInitial" name="middleInitial" size="2" />
                    Last Name</th>
                <td>    <input type=text id="lastName" name="lastName"/> </td>
            </tr>
            <tr>
                <th> Address Line 1</th>
                <td colspan="2"> <input type=text id="address" name="address" size=40/> </td>
            </tr>
            <tr>
                <th> Address Line 2 </th>
                <td colspan="2"> <input type=text id="address2" name="address2" size=40/> </td>
            </tr>
            <tr>
                <th> City</th>
                <td > <input type=text id="city" name="city" /> </td>
                <th colspan=2> State
                    <select id="state" name="state" tabindex="30" >
                        <option value="">Select</option>
                        <option value="AL">AL - Alabama</option>
                        <option value="AK">AK - Alaska</option>
                        <option value="AZ">AZ - Arizona</option>
                        <option value="AR">AR - Arkansas</option>
                        <option value="CA">CA - California</option>
                        <option value="CO">CO - Colorado</option>
                        <option value="CT">CT - Connecticut</option>
                        <option value="DE">DE - Delaware</option>
                        <option value="DC">DC - District of Columbia</option>
                        <option value="FL">FL - Florida</option>
                        <option value="GA">GA - Georgia</option>
                        <option value="GU">GU - Guam</option>
                        <option value="HI">HI - Hawaii</option>
                        <option value="ID">ID - Idaho</option>
                        <option value="IL">IL - Illinois</option>
                        <option value="IN">IN - Indiana</option>
                        <option value="IA">IA - Iowa</option>
                        <option value="KS">KS - Kansas</option>
                        <option value="KY">KY - Kentucky</option>
                        <option value="LA">LA - Louisiana</option>
                        <option value="ME">ME - Maine</option>
                        <option value="MD">MD - Maryland</option>
                        <option value="MA">MA - Massachusetts</option>
                        <option value="MI">MI - Michigan</option>
                        <option value="MN">MN - Minnesota</option>
                        <option value="MS">MS - Mississippi</option>
                        <option value="MO">MO - Missouri</option>
                        <option value="MT">MT - Montana</option>
                        <option value="NE">NE - Nebraska</option>
                        <option value="NV">NV - Nevada</option>
                        <option value="NH">NH - New Hampshire</option>
                        <option value="NJ">NJ - New Jersey</option>
                        <option value="NM">NM - New Mexico</option>
                        <option value="NY">NY - New York</option>
                        <option value="NC">NC - North Carolina</option>
                        <option value="ND">ND - North Dakota</option>
                        <option value="OH">OH - Ohio</option>
                        <option value="OK">OK - Oklahoma</option>
                        <option value="OR">OR - Oregon</option>
                        <option value="PA">PA - Pennsylvania</option>
                        <option value="PR">PR - Puerto Rico</option>
                        <option value="RI">RI - Rhode Island</option>
                        <option value="SC">SC - South Carolina</option>
                        <option value="SD">SD - South Dakota</option>
                        <option value="TN">TN - Tennessee</option>
                        <option value="TX">TX - Texas</option>
                        <option value="UT">UT - Utah</option>
                        <option value="VT">VT - Vermont</option>
                        <option value="VA">VA - Virginia</option>
                        <option value="WA">WA - Washington</option>
                        <option value="WV">WV - West Virginia</option>
                        <option value="WI">WI - Wisconsin</option>
                        <option value="WY">WY - Wyoming</option>
                    </select>
                </th>
                <th>Zip<input type=text id="zip" name="zip" size=5/> </th>
            </tr>
            <tr>
                <th> Email</th>
                <td > <input type=text id="email" name="email" /> </td>
                <th> Password</th>
                <td> <input type=password id="password" name="password"/> </td>
            </tr>
            <tr>
                <th> Phone</th>
                <td > <input type=text id="phone" name="phone" /> </td>
                <th> Other Phone </th>
                <td> <input type=text id="otherPhone" name="otherPhone"/> </td>
            </tr>
            <tr>
                <th> Home Library </th>
                <td > <input type=text id="favLibrary" name="favLibrary" /> </td>
            </tr>
            <tr>
                <th> Card # </th>
                <td > <input type=text id="cardNum" name="cardNum" /> </td>
                <th> Type </th>
                <td > <Select  id="cardType" name="cardType">
                        <option value="Amex">Amex</option>
                        <option value="Discover">Discover</option>
                        <option value="Master">Master</option>
                        <option value="Visa">Visa</option>
                    </Select>
                </td>
            </tr>
            <tr>
                <th> Name on Card </th>
                <td > <input type=text id="cardName" name="cardName" /> </td>
                <th> Exp. Date </th>
                <td > <input type=text id="expDate" name="expDate" /></td>
                <th> CVV </th>
                <td > <input type=text id="secCode" name="secCode" /></td>
            </tr>
            <tr>
                <th> Billing Address </th>
                <td colspan="3"> <input size=80 type=text id="billingAddr" name="billingAddr" /> </td>
            </tr>
        </table>
        <input name="Go" type="button" value="阅毕" onclick="window.location.href='homepageCN.php';"/>
        <input type="submit" value="修改"/>
    </form>
</div>
</body>

</html>