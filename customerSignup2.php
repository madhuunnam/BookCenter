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

                if ($firstname == null || $firstname == "") {
                    $result = $result . "$('#firstName').addClass('markRed');\n";
                }
                if ($lastname == null || $lastname == "") {
                    $result = $result . "$('#lastName').addClass('markRed');\n";
                }if ($email == null || $email == "") {
                    $result = $result . "$('#email').addClass('markRed');\n";
                }
                if ($password == null || $password == "") {
                    $result = $result . "$('#password').addClass('markRed');\n";
                }
                if ($result != "") {
                    $message = 'Please fill all the required fields';
                } else {
                    $con = mysql_connect('localhost', 'webclient', '12345678');

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $db_selected = mysql_select_db("bookstore");

                    if (!$db_selected) {
                        die('Can\'t use the db :' . mysql_error());
                    }
                    
                    $checkingduplicate = "select * from customers where custID='".$email."'";
                    $sql="INSERT INTO `customers`(`custID`, `firstName`, `middleName`, `lastName`, `telephoneNumber`, `otherPhone`, `addrStNum`, `addrL2`, `city`, `state`, `zip`, `emailAddress`, `password`, `homeLib`) VALUES ('".$email."','".$firstname."','".$middleInitial."','".$lastname."','".$phone."','".$otherPhone."','".$address."','".$address2."','".$city."','".$state."','".$zip."','".$email."','".$password."','".$favLibrary."')";
        
                    $emailExists= mysql_query($checkingduplicate);
                      
                    if(mysql_fetch_row($emailExists))
                    {
                        echo "alert('Email is already used. Please login');";
                        echo 'window.location.href = "login.php";';
                    }
                    else
                    {  
                        $insert = mysql_query($sql);
                        if (!$insert) {
                            $message="Unable to Sign-up. Please try again " . $sql ;
                        } else {
                            echo "alert('Sign-up successful');";
                            echo 'window.location.href = "login.php";';
                        }
                    }  
                }

                if ($message != "") {
                    echo "$(document).ready(function() { \n";
                    echo $result;
                    echo "alert('" . $message . "');\n";
                    echo "$('#firstName').val('" . $firstname .  "');\n";
                    echo "$('#lastName').val('" . $lastname .  "');\n";
                    echo "$('#address').val('" . $address .  "');\n";
                    echo "$('#middleInitial').val('" . $middleInitial .  "');\n";
                    echo "$('#address2').val('" . $address2 .  "');\n";
                    echo "$('#city').val('" . $city .  "');\n";
                    echo "$('#state').val('" . $state .  "');\n";
                    echo "$('#zip').val('" . $zip .  "');\n";
                    echo "$('#email').val('" . $email .  "');\n";
                    echo "$('#password').val('" . $password .  "');\n";
                    echo "$('#phone').val('" . $phone .  "');\n";
                    echo "$('#otherPhone').val('" . $otherPhone .  "');\n"; 
                    echo "$('#favLibrary').val('" . $favLibrary .  "');\n";
                    echo "});\n";
                }
            } 
        ?>
    </script>
    <body>
        <h2> Customer Sign-up </h2>
        <div style="text-align:center;">
        <form method="post" action="customerSignup.php">
            <input type="hidden" name="submitted" value="1"/>
            <table>
                <tr>
                    <th> First Name<sup>*</sup></th>
                    <td> <input type=text id="firstName" name="firstName"/> </td>
                    <th> MI <input type=text id="middleInitial" name="middleInitial" size="2" /> 
                        Last Name<sup>*</sup></th>
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
                            <option value="AS">AS - American Samoa</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District of Columbia</option>
                            <option value="FM">FM - Federated States of Micronesia</option>
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
                            <option value="MH">MH - Marshall Islands</option>
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
                            <option value="MP">MP - Northern Mariana Islands</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PW">PW - Palau</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="PR">PR - Puerto Rico</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT">UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VI">VI - Virgin Islands</option>
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
                    <th> Email<sup>*</sup></th>
                    <td > <input type=text id="email" name="email" /> </td>
                    <th> Password<sup>*</sup></th>
                    <td> <input type=password id="password" name="password"/> </td>
                </tr>
                <tr>
                    <th> Phone</th>
                    <td > <input type=text id="phone" name="phone" /> </td>
                    <th> Other Phone </th>
                    <td> <input type=text id="otherPhone" name="otherPhone"/> </td>
                </tr>
                <tr>
                    <th> Favorite Library </th>
                    <td > <input type=text id="favLibrary" name="favLibrary" /> </td>
                </tr>
            </table>
            <input type="submit" value=" Sign me up "/>
        </form>
        </div>
    </body>

</html>