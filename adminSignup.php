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
            width: 8em;
            font-size: 1em;
            border-radius: 5px;
        }

        #requestBtn {
            height: 2em;
            width: 10em;
            font-size: 0.75em;
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
        function requestPassword() {
            if ($('#email').val() == "") {
                alert("Please enter email, before requesting password");
                return
            }
            $.post("requestPassword.php",
                {
                    email: $('#email').val(),
                    type: 'Admin',
                    show: 'show'
                },
                function(data, status){
                    $('#password').val(data);
                    alert('Password emailed');
                });
        }
        <?php
            if(isset($_POST['submitted']) && $_POST['submitted'] == '1') {
                $result = "";
                $message = "";
                $firstname = $_POST['firstName'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                //$password = $_POST['password'];
                $password = 'b256_N1137'; // -------------------------------
                $phone = $_POST['phone'];
                $otherPhone = $_POST['otherPhone'];
                $question1 = $_POST['securityQuestion'];
                $answer1 = $_POST['securityQuestionAnswer'];
                
                if ($firstname == null || $firstname == "") {
                    $result = $result . "$('#firstName').addClass('markRed');\n";
                }
                if ($address == null || $address == "") {
                    $result = $result . "$('#address').addClass('markRed');\n";
                }
                if ($email == null || $email == "") {
                    $result = $result . "$('#email').addClass('markRed');\n";
                }
               // if ($password == null || $password == "") {
               //     $result = $result . "$('#password').addClass('markRed');\n";
               // }
                if ($phone == null || $phone == "") {
                    $result = $result . "$('#phone').addClass('markRed');\n";
                }
                if ($question1 == null || $question1 == "") {
                    $result = $result . "$('#securityQuestion').addClass('markRed');\n";
                }
                if ($answer1 == null || $answer1 == "") {
                    $result = $result . "$('#securityQuestionAnswer').addClass('markRed');\n";
                }

                if ($result != "") {
                    $message = 'Please fill all the required fields';
                } else {

                    //connect to database 
                    $con = mysql_connect('localhost', 'webclient', '12345678');

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $db_selected = mysql_select_db("bookstore");

                    if (!$db_selected) {
                        die('Can\'t use the db :' . mysql_error());
                    }


                    $max = mysql_query("SELECT MAX(adminID) AS max_id FROM admins");
                    $row = mysql_fetch_array($max);
                    $adminID =  intval($row["max_id"]) + 1;

                    $checkingduplicate = "select * from admins where emailAddress='".$email."'";
                    $sql="INSERT INTO `admins`(`adminID`, insertDate, `name`, `phone`, `otherPhone`, `mailAddr`, `email`, `password`, `question`, `answer`) VALUES ('".$adminID."',now(),'".$firstname."','".$phone."','".$otherPhone."','".$address."','".$email."','".$password."','".$question1."','".$answer1."')";
        
                    $emailExists= mysql_query($checkingduplicate);
                      
                    if($emailExists)
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
                            echo "alert('Sign-up successful. Please ask password from webmaster and login');";
                            $_SESSION['name'] = $firstname;
							//$_SESSION['type'] = 'Admin';
							//$_SESSION['loggedIn'] = true;
							//$_SESSION['adminID'] = $adminID;
							//$loggedIn = true;
                                                        // comment out and redirect on 7/30/15 -----------------
                            echo 'window.location.href = "Login.php";';
                        }
                    }  
                }

                if ($message != "") {
                    echo "$(document).ready(function() { \n";
                    echo $result;
                    echo "alert('" . $message . "');\n";
                    echo "$('#firstName').val('" . $firstname .  "');\n";
                    echo "$('#address').val('" . $address .  "');\n";
                    echo "$('#email').val('" . $email .  "');\n";
                    //echo "$('#password').val('" . $password .  "');\n";
                    echo "$('#phone').val('" . $phone .  "');\n";
                    echo "$('#otherPhone').val('" . $otherPhone .  "');\n"; 
                    echo "$('#securityQuestion').val('" . $question1 .  "');\n";
                    echo "$('#securityQuestionAnswer').val('" . $answer1 .  "');\n";
                    echo "});\n";
                }
            } 
        ?>
    </script>
    <body>
    <?php
        include 'NavigationBar.php';
    ?>
        <h2> Admin Sign-up </h2>
        <div style="text-align:center;">
        <form method="post" action="adminSignup.php">
            <input type="hidden" name="submitted" value="1"/>
            <table>
                <tr>
                    <th> Name<sup>*</sup></th>
                    <td> <input type=text id="firstName" name="firstName"/> </td>
                </tr>
                <tr>
                    <th> Address <sup>*</sup></th>
                    <td colspan="2"> <input type=text id="address" name="address" size=40/> </td>
                </tr>
                <tr>
                    <th> Email<sup>*</sup></th>
                    <td > <input type=text id="email" name="email" /> </td>
                
                </tr>
                <tr>
                    <th> Phone <sup>*</sup></th>
                    <td > <input type=text id="phone" name="phone" /> </td>
                    <th> Other Phone </th>
                    <td> <input type=text id="otherPhone" name="otherPhone"/> </td>
                </tr>
                <tr>
                    <th> Security Question <sup>*</sup> </th>
                    <td colspan=3 > 
                        <select name="securityQuestion" id="securityQuestion"> 
                            <option value=""/>
                            <option value="1">Name of your pet </option>
                            <option value="2">Your first car make </option>
                            <option value="3">Where did you meet your wife for the first time </option>
                            <option value="4">Which school did you graduate from </option>
                            <option value="4">What is your major </option>
                        </select> 
                    </td>
                    <th> Answer </th>
                    <td> <input type="text" name="securityQuestionAnswer" id="securityQuestionAnswer"> </td>
                </tr>
            </table>
            <input type="submit" value=" Sign me Up "/>
        </form>
        </div>
    </body>

</html>