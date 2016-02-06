<?php

$url = 'http://greensboro.craigslist.org/search/apa?query=' . $_GET['searchKey'] . '&sort=rel#list';
# Create a DOM parser object
$dom = new DOMDocument();
$html = file_get_contents($url);
@$dom->loadHTML($html);
foreach($dom->getElementsByTagName('div') as $element)  {
	foreach($element->attributes as $attr) {
		if ($attr->name == 'class' && $attr->value == 'content') {
			echo $dom->saveHTML($element);
		}
	}
	// if ($element->attributes['class'] == 'content') {
	// 	echo 'F=ound';
	// 	echo $element->saveHTML();
	// }
	// echo var_dump($element->attributes);
}

?>