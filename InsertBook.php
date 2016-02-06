<?php
session_start ();
$responseJSON = array();
	error_log("In InsertBook");
	
	ob_start ();
	$storeID = $_SESSION ['storeID'];
	$title = $_GET ['title'];
	$author = $_GET ['author'];
	$publisher = $_GET ['publisher'];
	$bookPublishedYear = $_GET ['bookPublishedYear'];
	$bookProductFormatDetails = $_GET ['bookProductFormatDetails'];
	$bookPages = $_GET ['bookPages'];
	$bookLanguage = $_GET ['bookLanguage'];
	$isbn = $_GET ['isbn'];
	$isbn13 = $_GET ['isbn13'];
	$bookProductDimensions = $_GET ['bookProductDimensions'];
	$bookShippingWeight = $_GET ['bookShippingWeight'];
	$bookAmazonStar = $_GET ['bookAmazonStar'];
	$bookAmazonReview = $_GET ['bookAmazonReview'];
	$bookFromBackCover = str_replace ( "'", "\'", $_GET ['bookFromBackCover'] );
	$bookAmazonURL = $_GET ['bookAmazonURL'];
	
	$bookAltTitle = $_GET ['bookAltTitle'];
	$bookSubTitle = $_GET ['bookSubTitle'];
	$bookEdition = $_GET ['bookEdition'];
	$bookEditionType = $_GET ['bookEditionType'];
	$bookCallNumber = $_GET ['bookCallNumber'];
	$audience = $_GET ['audience'];
	$bookContent = $_GET ['bookContent'];
	$bookCategory = $_GET ['bookCategory'];
	$bookSubCategory = $_GET ['bookSubCategory'];
	$bookSubSubCategory = $_GET ['bookSubSubCategory'];
	$bookKeywords = $_GET ['bookKeywords'];
	//$imgpath = $_GET ['fileUploadid'];
	//error_log($isbn. $title .$imgpath);
	
	if ($title == null || $isbn == null || $author == null || $bookSubCategory == null || $bookCategory == null) {
		echo 'alert("One of the required field is missing. Please make sure all the fields marked with * are filled correctly");';
	} else {
		
		$checkingduplicate = "select * from books where isbn='" . $isbn . "' or isbn10='" . $isbn . "'";
		$sql = "INSERT INTO `books`(`title`, `insertDate`, `isbn`, `isbn10`, `author`, `publisherName`, 
                                    `callNum`, `subTitle`, `altTitle`, `audience`, `language`, `editionType`, `editionNumber`, `amazonStar`, 
                                    `amazonReviews`, `amazonRevLink`, `category`, `subCat`, `subSubCat`, `pubDate`, `keywords`, `contents`, 
                                    `fromBackCover`, `productFormatDetail`, `productDimensions`, `shippingWeight`, `pages`) VALUES ('" . $title . "', CURRENT_DATE, '" . $isbn . "','" . $isbn13 . "','" . $author . "','" . $publisher . "','" . $bookCallNumber . "','" . $bookSubTitle . "','" . $bookAltTitle . "','" . $audience . "','" . $bookLanguage . "','" . $bookEditionType . "','" . $bookEdition . "','" . $bookAmazonStar . "','" . $bookAmazonReview . "','" . $bookAmazonURL . "','" . $bookCategory . "','" . $bookSubCategory . "','" . $bookSubSubCategory . "','" . $bookPublishedYear . "','" . $bookKeywords . "','" . $bookContent . "','" . $bookFromBackCover . "','" . $bookProductFormatDetails . "','" . $bookProductDimensions . "','" . $bookShippingWeight . "','" . $bookPages . "')";
		$dbconn = mysql_connect ( "localhost", "webclient", "12345678" ) or die ( "database error!" . mysql_error () );
		mysql_select_db ( "bookstore" ) or die ( "can not connect database：" . mysql_error () );
		
		$result_indb = mysql_query ( $checkingduplicate ) or die ( "can not run the sql language:" . mysql_error () );
		
		if (mysql_fetch_row ( $result_indb )) {
			echo 'alert("Book matching the isbn-10/isbn-13 already exists");';
		} else {
			$result = mysql_query ( $sql );
			if (! $result) {
				$responseJSON = array('error' => 'Query failed');
			} else {
				$responseJSON = array('success' => 'Book Insert Successful');
				
			}
		}
		mysql_close ( $dbconn );
	}
	echo json_encode($responseJSON);
// }
?>