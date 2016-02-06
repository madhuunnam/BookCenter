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
            $adminID = $_SESSION['adminID'];
            if(isset($_POST['submitted']) && $_POST['submitted'] == '1') {
                $result = "";
                $message = "";
                $firstname = $_POST['firstName'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $password = 'Not Assigned';
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
                if ($password == null || $password == "") {
                    $result = $result . "$('#password').addClass('markRed');\n";
                }
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
                    $con = mysql_connect('localhost', 'webclient', '12345678');

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $db_selected = mysql_select_db("bookstore");

                    if (!$db_selected) {
                        die('Can\'t use the db :' . mysql_error());
                    }
                    
                    $sql="UPDATE `admins` SET `name`='".$firstname."', `phone`='".$phone."', `otherPhone`='".$otherPhone."', `mailAddr`='".$address."', `question`='".$question1."', `answer`='".$answer1."' WHERE `adminID`='".$adminID."'";
                    
                    
                    $update = mysql_query($sql);
                    if (!$update) {
                        $message="Unable to Update. Please try again " . $sql ;
                    } else {
                        echo "alert('Updated successful');";
                        echo 'window.location.href = "homepage.php";';
                    }
                     
                }

                if ($message != "") {
                    echo "$(document).ready(function() { \n";
                    echo $result;
                    echo "alert('" . $message . "');\n";
                    echo "$('#firstName').val('" . $firstname .  "');\n";
                    echo "$('#address').val('" . $address .  "');\n";
                    echo "$('#email').val('" . $email .  "');\n";
                    echo "$('#password').val('" . $password .  "');\n";
                    echo "$('#phone').val('" . $phone .  "');\n";
                    echo "$('#otherPhone').val('" . $otherPhone .  "');\n"; 
                    echo "$('#securityQuestion').val('" . $question1 .  "');\n";
                    echo "$('#securityQuestionAnswer').val('" . $answer1 .  "');\n";
                    echo "});\n";
                }
            } else {
                if ($adminID == null) {
                     echo 'window.location.href = "login.php";';
                } else {
                    $con = mysqli_connect('localhost', 'webclient', '12345678', "bookstore");

                    if (!$con) {
                        die("Failed to conect to MySQL: " . mysqli_error());
                    }

                    $sql = "SELECT * FROM admins WHERE adminID='".$adminID."'";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($user = mysqli_fetch_assoc($result)) {
                            echo "$(document).ready(function() { \n";
                            echo "$('#firstName').val('" . $user['name'] .  "');\n";
                            echo "$('#phone').val('" . $user['phone'] .  "');\n";
                            echo "$('#otherPhone').val('" . $user['otherPhone'] .  "');\n"; 
                            echo "$('#email').val('" . $user['email'] .  "');\n";
                            
                            $addrStNum = $user['mailAddr'];

                            echo "$('#address').val('" . $addrStNum .  "');\n";
                            echo "$('#securityQuestion').val('" . $user['question'] .  "');\n";
                            echo "$('#securityQuestionAnswer').val('" . $user['answer'] .  "');\n";
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
        include 'NavigationBar.php';
    ?>

    <h2> Admin Profile </h2>
        <div style="text-align:center;">
        <form method="post" action="adminProfile.php">
            <input type="hidden" name="submitted" value="1"/>
            <table>
                <tr>
                    <th> First Name<sup>*</sup>:</th>
                    <td> <input type=text id="firstName" name="firstName"/> </td>
                </tr>
                <tr>
                    <th> Address<sup>*</sup>:</th>
                    <td colspan="2"> <input type=text id="address" name="address" size=40/> </td>
                </tr>
                <tr>
                    <th> Email<sup>*</sup>:</th>
                    <td > <input type=text id="email" name="email" /> </td>
                </tr>
                <tr>
                    <th> Phone<sup>*</sup>:</th>
                    <td > <input type=text id="phone" name="phone" /> </td>
                    <th> Other Phone: </th>
                    <td> <input type=text id="otherPhone" name="otherPhone"/> </td>
                </tr>
                <tr>
                    <th> Security Question<sup>*</sup>:</th>
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
                    <th> Answer: </th>
                    <td> <input type="text" name="securityQuestionAnswer" id="securityQuestionAnswer"> </td>
                </tr>
            </table>
            <input type="submit" value=" Update "/>
        </form>
        </div>
    </body>

</html>