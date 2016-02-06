<?php
session_start();

define('DB_NAME', 'bookstore');
define('DB_USER', 'webclient');
define('DB_PASSWORD', '12345678');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected) {
    die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
} 

$target_dir = "uploads/";
$target_file = $target_dir .time().basename($_FILES["logo"]["name"]);
$uploadOk = 1;
// $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["logo"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }
// // Check if file already exists
// // Check file size
// if ($_FILES["logo"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//     echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//     if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
//         echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
// }
$orgname = $_POST['orgname'];
$value2 = $_POST['cname'];
$value3 = $target_file;
$value4 = $_POST['foundYear'];
$value5 = $_POST['type'];
$value6 = $_POST['keywords'];
$value7 = $_POST['phone'];
$value8 = $_POST['phone1'];
$value9 = $_POST['email'];
$value10 = $_POST['username'];
$value11 = $_POST['passwd'];
$value12 = $_POST['pastor'];
$value13 = $_POST['cpastor'];
$value14 = $_POST['contact'];
$value15 = $_POST['ccontact'];
$value16 = $_POST['addrL1'];
$value17 = $_POST['addrL2'];
$value18 = $_POST['city'];
$value19 = $_POST['state'];
$value20 = 'USA';//$_POST['country'];
$value21 = $_POST['zip'];
$value22 = $_POST['status'];
$value23 = $_POST['numAdults'];
$value24 = $_POST['numKids'];
$value25 = $_POST['workshipTime'];
$value26 = $_POST['prayerTime'];
$value27 = $_POST['bibleStudyTime'];



$sql = "INSERT INTO organizations (name,cname,foundYear,type,keywords,telephoneNumber,otherPhone,emailAddress,username,password,pastor,cpastor,contact,ccontact,addrStNum,addrL2,city,state,country,zip,status,numAdults,numKids,worshipTime,prayerTime,bibleStudyTime) VALUES ('$orgname', '$value2','$value4','$value5','$value6','$value7','$value8','$value9','$value10','$value11','$value12','$value13','$value14','$value15','$value16','$value17','$value18','$value19','$value20','$value21','$value22','$value23','$value24','$value25','$value26','$value27') ";

//$sql=("INSERT into organisation(orgname) values ('".$orgname."')");
$result = mysql_query($sql);
?>

<html>
    <head>
        <script type="text/javascript">
            <?php 
            if (!$result) {
                echo 'alert("Unable to add the organization. Please try again");';
                echo "//" . $sql;
            } else {
                echo 'alert("Organization Added Successfully");';
                echo 'window.location.href="LookupDirectory.php";';
            }

            mysql_close();
            ?>
        </script>
    </head>
</html>



