<?php

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

ob_start ();
            $title = $_POST ['title'];
            $author = $_POST ['author'];
            $publisher = $_POST ['publisher'];
            $bookPublishedYear = $_POST ['publishedDate'];
            $bookProductFormatDetails = $_POST ['productFormat'];
            $bookPages = $_POST ['pages'];
            $bookLanguage = $_POST ['language'];
            $isbn = $_POST ['isbn'];
            $isbn10 = $_POST ['isbn10'];
            $bookProductDimensions = $_POST ['dimensions'];
            $bookShippingWeight = $_POST ['shippingWeight'];
            $bookAmazonStar = $_POST ['rating'];
            $bookAmazonReview = $_POST ['reviews'];
            $bookFromBackCover = str_replace ( "'", "\'", $_POST ['description'] );
            $bookAmazonURL = $_POST ['url'];

            $bookAltTitle = $_POST ['altTitle'];
            $bookSubTitle = $_POST ['subTitle'];
            $bookEdition = $_POST ['edition'];
            $bookEditionType = $_POST ['editionType'];
            $bookCallNumber = $_POST ['callNum'];
            $audience = $_POST ['audience'];
            $bookContent = $_POST ['content'];
            $bookCategory = $_POST ['category'];
            $bookSubCategory = $_POST ['subCategory'];
            $bookSubSubCategory = $_POST ['subSubCategory'];
            $bookKeywords = $_POST ['keywords'];



$sql = "UPDATE books SET title = '" .$title . "',   author = '" .$author 
                ."', publisherName = '" .$publisher ."', callNum = '" .$bookCallNumber . "', subTitle = '" .$bookSubTitle 
                ."', altTitle = '" .$bookAltTitle . "', audience = '" .$audience . "', language = '" .$bookLanguage . "', editionType = '" .$bookEditionType
                ."', editionNumber = '" .$bookEdition ."', amazonStar = '" .$bookAmazonStar . "', amazonReviews = '" .$bookAmazonReview
                ."', amazonRevLink = '" .$bookAmazonURL ."', category = '" .$bookCategory . "', subCat = '" .$bookSubCategory 
                ."', subSubCat = '" .$bookSubSubCategory ."', pubDate = '" .$bookPublishedYear . "', keywords = '" .$bookKeywords
                ."', contents = '" .$bookContent ."', fromBackCover = '" .$bookFromBackCover . "', productFormatDetail = '" .$bookProductFormatDetails
                ."', productDimensions = '" .$bookProductDimensions . "', shippingWeight = '" .$bookShippingWeight . "', pages = '" .$bookPages
                ."' WHERE isbn = '" .$isbn . "' or isbn10 = '" .$isbn ."';";


//echo $sql;
if(!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    else { 
        
        echo "<html>  <head> 
        <script type='text/javascript'>
            alert('Book is Updated Successfully');
            window.location.href='updateBookForm.php';
        </script>
        </head> </html> ";
                            
    }

mysql_close();

?>