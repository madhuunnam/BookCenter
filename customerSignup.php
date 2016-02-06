<?php
session_start();
include 'NavigationBar.php'; 
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
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                if ($firstname == null || $firstname == "") {
                    $result = $result . "$('#firstName').addClass('markRed');\n";
                }
                if ($lastname == null || $lastname == "") {
                    $result = $result . "$('#lastName').addClass('markRed');\n";
                }
                if ($email == null || $email == "") {
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

                    $max = mysql_query("SELECT MAX(custID) AS max_id FROM customers");
                    $row = mysql_fetch_array($max);
                    $custID =  intval($row["max_id"]) + 1;
                    
                    $checkingduplicate = "select * from customers where emailAddress='".$email."'";
                    $sql="INSERT INTO `customers`(`custID`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES ('".$custID."','".$firstname."','".$lastname."','".$email."','".$password."')";
        
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
                            $_SESSION['name'] = $firstname. ' ' .$lastname;
                            $_SESSION['type'] = 'Customer';
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['custID'] = $custID ;
                            echo 'window.location.href = "homepage.php";';
                        }
                    }  
                }

                if ($message != "") {
                    echo "$(document).ready(function() { \n";
                    echo $result;
                    echo "alert('" . $message . "');\n";
                    echo "$('#firstName').val('" . $firstname .  "');\n";
                    echo "$('#lastName').val('" . $lastname .  "');\n";
                    echo "$('#email').val('" . $email .  "');\n";
                    echo "$('#password').val('" . $password .  "');\n";
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
                    <th> Last Name<sup>*</sup></th>
                    <td> <input type=text id="lastName" name="lastName"/> </td>
                </tr>
                <tr>
                    <th> Email<sup>*</sup></th>
                    <td > <input type=text id="email" name="email" /> </td>
                    <th> Password<sup>*</sup></th>
                    <td> <input type=password id="password" name="password"/> </td>
                </tr>
            </table>
            <input type="submit" value=" Submit "/>
        </form>
        </div>
    </body>

</html>