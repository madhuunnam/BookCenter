<?php
session_start();

if (isset($_POST['ID'])) {


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

$myData = mysql_query("SELECT organID,name FROM `organizations` WHERE `organID`='".$_POST['ID']."'");


 $row = mysql_fetch_array($myData);
 echo "<br><br>".isset($_FILES["logo"])."<br><br><br>";
if(file_exists($_FILES['logo']['tmp_name']) || is_uploaded_file($_FILES['logo']['tmp_name'])){
$target_dir = "uploads/";
$target_file = $target_dir .time().basename($_FILES["logo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
// Check file size
if ($_FILES["logo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["logo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}
else{
$target_file="";//$row['logo'];
}

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
$value11 = $_POST['password'];
$value12 = $_POST['pastor'];
$value13 = $_POST['cpastor'];
$value14 = $_POST['contact'];
$value15 = $_POST['ccontact'];
$value16 = $_POST['addrL1'];
$value17 = $_POST['addrL2'];
$value18 = $_POST['city'];
$value19 = $_POST['state'];
$value20 = "USA";//$_POST['country'];
$value21 = $_POST['zip'];
$value22 = $_POST['status'];
$value23 = $_POST['numAdults'];
$value24 = $_POST['numKids'];
$value25 = $_POST['worshipTime'];
$value26 = $_POST['prayerTime'];
$value27 = $_POST['bibleStudyTime'];
$value28 = $_POST['sunSchoolTime'];
$value29 = $_POST['meetingName'];
$value30 = $_POST['meetingTime'];
$value31 = $_POST['meetingName1'];
$value32 = $_POST['meetingTime1'];
$value33 = $_POST['website'];

echo "submit". $_POST['submit'];

/*if (isset($_POST['submit'])) {
$sql = "INSERT INTO branch (bname,cbname,orgID,orgname,phone,phone1,email,address,contact,ccontact) VALUES ('$value','$value2','$value9','$value10','$value3',
'$value4','$value5','$value6','$value7','$value8') ";
}*/

$sql="UPDATE organizations
SET name='$orgname',cname='$value2' ,foundYear='$value4',type='$value5',keywords='$value6',telephoneNumber='$value7',otherPhone='$value8',
emailAddress='$value9',username='$value10', password='$value11', pastor='$value12',cpastor='$value13',contact='$value14',ccontact='$value15',addrStNum='$value16',
addrL2='$value17',city='$value18',state='$value19',country='$value20',zip='$value21',status='$value22',numAdults='$value23',numKids='$value24', website = '$value33',
worshipTime='$value25',prayerTime='$value26',bibleStudyTime='$value27', sunSchoolTime='$value28', meetingName = '$value29', meetingTime='$value30', meetingName1 = '$value31', meetingTime1='$value32'
WHERE organID='".$_POST['ID']."'";

if(!mysql_query($sql)) {
    die('Error: ' . mysql_error());
} else {
?>
    <html>
    <head>
        <script type="text/javascript">
            alert("Organization Update Successfully");
            window.location.href="LookupDirectory.php";
        </script>
    </head>
</html>
<?php
}

mysql_close();
}
?>



