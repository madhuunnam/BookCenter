<?php

$url = "http://amazon.com/dp/" . $_GET['isbn'];
# Create a DOM parser object
$dom = new DOMDocument();
$html = file_get_contents($url);
@$dom->loadHTML($html);
$titleStrip = $dom->getElementsByTagName('title')->item(0)->textContent;
$title = $dom->getElementById('productTitle');
$returnJSON = "{ ";
if ($title == null && $titleStrip == null) {
	$returnJSON = $returnJSON . '"error": "Could not find any book with given ISBN"';
	$returnJSON = $returnJSON . "}";
	//$returnJSON = $returnJSON . $dom->saveHTML();
} else {
	$titleStrip = str_replace('Amazon.com:', '', $titleStrip);
	$titleArray = explode(":", $titleStrip);
	if (sizeof($titleArray) > 3) {
		$count = sizeOf($titleArray);
		$bookTitle = implode (":", array_slice($titleArray, 0, $count - 3));
	
		$returnJSON = $returnJSON . '"title": "'. trim($bookTitle) . '",';		
		$returnJSON = $returnJSON . '"author": "' .trim($titleArray[$count - 3]) . '",';

	} else {
		$returnJSON = $returnJSON . '"title": "'. trim($title->textContent) . '",';

		$byline = $dom->getElementByID('byline');
		if ( $byline != null ) {
			$bylineText = $byline->textContent;
			if(strpos($bylineText, "Visit Amazon's") !== false) {
				$bylineText = substr(explode("Visit Amazon's", explode("}", $byline->textContent)[1])[0], 0, -4);
			} else {
				$bylineText = explode('&', explode("by", $bylineText)[1])[0];
			}
			$returnJSON = $returnJSON . '"author": "' . trim($bylineText)  . '",';
		} else {
			$returnJSON = $returnJSON . '"author": "",';
		}
	
	}
	
	$tags = get_meta_tags($url);

	$returnJSON = $returnJSON . '"keywords": "' . trim($tags['keywords']). '",'; 
	
	$description = str_replace(" on Amazon.com. *FREE* shipping on qualifying offers", "", htmlspecialchars(trim($tags['description'])));
	$returnJSON = $returnJSON . '"description": "' . $description . '",';
	foreach($dom->getElementById('productDetailsTable')->firstChild->firstChild->lastChild->previousSibling->firstChild->nextSibling->childNodes as $child) {
		$content = $child->textContent;
		if (strpos($content, 'Hardcover:') !== false) {
			$returnJSON = $returnJSON . '"productFormat": "Hardcover",';
			$returnJSON = $returnJSON . '"pages": ' . trim(explode(":", str_replace('pages', '', $content))[1]) . ',';
		} else if (strpos($content, 'Paperback:') !== false) {
			$returnJSON = $returnJSON . '"productFormat": "Paperback",';
			$returnJSON = $returnJSON . '"pages": ' . trim(explode(":", str_replace('pages', '', $content))[1]) . ',';
		} else if (strpos($content, 'Publisher:') !== false) {
			$publisher =  htmlspecialchars(explode("(", $content)[0]);
			$publisher =  htmlspecialchars(explode(":", $publisher)[1]);
			$publishedDate = trim(explode(")", explode("(", $content)[1])[0]);

			if (strpos($publisher, ";") !== false) {
				$returnJSON = $returnJSON . '"publisher": "' . str_replace("'", "-", trim(explode(";", $publisher)[0])) . '",';
				$returnJSON = $returnJSON . '"edition": "' . trim(explode(";", $publisher)[1]) . '",';
			} else {
				$returnJSON = $returnJSON . '"publisher": "' . str_replace("'", "-", trim($publisher)) . '",';
				$returnJSON = $returnJSON . '"edition": "",';
			}
			$returnJSON = $returnJSON . '"publishedDate": "' . $publishedDate . '",';
		} else if (strpos($content, 'Language:') !== false) {
			$returnJSON = $returnJSON . '"language": "' . trim(explode(":", $content)[1]) . '",';
		} else if (strpos($content, 'Product Dimensions:') !== false) {
			$returnJSON = $returnJSON . '"productDimensions": "' . trim(explode(":", $content)[1]) . '",';
		} else if (strpos($content, 'Shipping Weight:') !== false) {
			$returnJSON = $returnJSON . '"shippingWeight": "' . trim(explode("(", explode(":", $content)[1])[0]) . '",';
		}  else if (strpos($content, 'ISBN-13:') !== false) {
		 	$returnJSON = $returnJSON . '"isbn13": "' . trim(explode(":", $content)[1]) . '",';
 			$returnJSON = $returnJSON . '"isbn10": "' . $_GET['isbn'] . '",';
 		}
	}


	$rating = $dom->getElementById('acr-dpReviewsSummaryWithQuotes-'.$_GET['isbn']);
	if ($rating != null && strpos($rating->textContent, "out of") !== false) {
		$returnJSON = $returnJSON . '"rating": ' . explode("out of", $dom->getElementById('acr-dpReviewsSummaryWithQuotes-'.$_GET['isbn'])->textContent)[0] . ',';
		$returnJSON = $returnJSON . '"reviews": ' . explode(")",explode("(", $dom->getElementById('acr-dpReviewsSummaryWithQuotes-'.$_GET['isbn'])->textContent)[1])[0] . ',';
		$returnJSON = $returnJSON . '"backCover": "' . htmlspecialchars(trim($dom->getElementById('outer_postBodyPS')->textContent)) . '",';
	} else {
		if ($dom->getElementById('avgRating') != null) {
			$returnJSON = $returnJSON . '"rating": ' . trim(explode("out of", $dom->getElementById('avgRating')->textContent)[0]) . ',';
		} else {
			$returnJSON = $returnJSON . '"rating": 0,';
		}

		if ($dom->getElementById('summaryStars') != null) {
			$returnJSON = $returnJSON . '"reviews": ' . explode(")",explode("(", $dom->getElementById('summaryStars')->textContent)[1])[0] . ',';
		} else {
			$returnJSON = $returnJSON . '"reviews": 0,';
		}
		$returnJSON = $returnJSON . '"backCover": "",';
	}
	$returnJSON = $returnJSON . '"url": "' . $url . '"';
	$returnJSON = $returnJSON . "}";

	$returnJSON = str_replace('\n', '', json_encode($returnJSON));
	$returnJSON = str_replace('\t', '', $returnJSON);
	echo json_decode($returnJSON);
}
//$returnJSON = $returnJSON . $dom->saveHTML();
?>