<?php
header('Content-Type: text/plain;charset=utf-8');
$url = "https://shop.campus.org.tw/searchResults.aspx?SearchItem=+".$_GET['isbn']."+&x=0&y=0";
# Create a DOM parser object
$dom = new DOMDocument();
$html = file_get_contents($url);
@$dom->loadHTML($html);
$title = $dom->getElementById('lblRecordCount');
$count = intval($title->textContent);

if ($count > 0) {
	$topTable = $dom->getElementById('MyList');

	$anchors = $topTable->getElementsByTagName('a');
	foreach($anchors as $anchor) {
		if($anchor->hasAttribute('href') && substr( $anchor->getAttribute('href'), 0, 20 ) === "/ProductDetails.aspx") {
			$newURL = "https://shop.campus.org.tw".$anchor->getAttribute('href');
			$newDom = new DOMDocument();
			$newHTML = file_get_contents($newURL);
			@$newDom->loadHTML($newHTML);
			if($newDom->getElementById('lbISBN')->textContent === $_GET['isbn']) {
				$returnJSON = "{";
				$title = explode('／', $newDom->getElementById('lbProductName')->textContent);
				$returnJSON = $returnJSON . '"title": "'. $title[0] . '",';	
				if (sizeof($title) > 1)
					$returnJSON = $returnJSON . '"altTitle": "'. $title[1] . '",';	
				$returnJSON = $returnJSON . '"author": "'.$newDom->getElementById('lbAuthor')->textContent. '",';
				$returnJSON = $returnJSON . '"translator": "'.$newDom->getElementById('lbTranslator')->textContent. '",';
				$returnJSON = $returnJSON . '"publisher": "'.$newDom->getElementById('lbPublisher')->textContent. '",';
				$returnJSON = $returnJSON . '"publishedDate": "'.$newDom->getElementById('lbPublishDate')->textContent. '",';
				$returnJSON = $returnJSON . '"pages": "'.$newDom->getElementById('lbPageCount')->textContent. '",';
				$returnJSON = $returnJSON . '"isbn13": "'.$newDom->getElementById('lbISBN')->textContent. '",';
				$returnJSON = $returnJSON . '"description": "' . $newDom->getElementById('lblDescription')->textContent . '",';
				$categories = explode('／', $newDom->getElementById('lbClass123')->textContent);
				$returnJSON = $returnJSON . '"category": "'. $categories[0] . '",';	
				$returnJSON = $returnJSON . '"subCategory": "'. $categories[1] . '",';
				$returnJSON = $returnJSON . '"audience": "'.$newDom->getElementById('lbTarget')->textContent. '",';	
				$returnJSON = $returnJSON . '"listPrice": "'. $newDom->getElementById('lbListPrice')->textContent . '"';	
				$returnJSON = $returnJSON . "}";
				$returnJSON = str_replace('\n', '', json_encode($returnJSON));
				$returnJSON = str_replace('\t', '', $returnJSON);
				echo json_decode($returnJSON);
				return;
			}
		}
	}

	$returnJSON = str_replace('\n', '', json_encode("{'result' : 'Didn't find book information for the isbn provided}"));
	$returnJSON = str_replace('\t', '', $returnJSON);
	echo json_decode($returnJSON);
} else {
	$returnJSON = str_replace('\n', '', json_encode("{'result' : 'Didn't find book information for the isbn provided}"));
	$returnJSON = str_replace('\t', '', $returnJSON);
	echo json_decode($returnJSON);
}

?>