<?php
	$content = file_get_contents('http://amazon.com/dp/' . $_GET['isbn']);
	if( $content !== FALSE ) {
  		// add your JS into $content
  	echo $content;
	}
?>
