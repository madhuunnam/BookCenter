
<?php
	$sourcePath = $_FILES['fileToUpload']['tmp_name']; 
	$date = date_create();
	$filename = date_timestamp_get($date) . '-' .$_FILES['fileToUpload']['name'];
	$targetPath = "coverimages/".$filename; // Target path where file is to be stored
	move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file
	echo $filename;
?>