<?php
require_once('query.php');
 
// need to have exact name 

class Wiki {
	//var $name;
	
	public function wikiArr($name) {
		$url = 'https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=' . $name;

		// gets json file
		$str = file_get_contents($url);			
		$str = substr($str, strpos($str, 'extract') + 10);
		$str = str_replace('"}}}}', "", $str);

		$paragraphs = explode('\n', $str);

		$len = min(3, count($paragraphs));

		$arr = array();

		for ($i = 0; $i < $len; ++$i)
			$arr[$i] = $paragraphs[$i] . "\n";

		return $arr;
	}
}

/*
 *			Will NOT use
 *
 *			WILL NOT USE
 *
 *			DO not USE
 *
 *			TEMP
 */

/*
// for thumbnail
$size = 100;
$image = 'https://en.wikipedia.org/w/api.php?action=query&titles=' . $name . '&prop=pageimages&format=json&pithumbsize=' . $size;

$link = file_get_contents($image);
$link = substr($link, strpos($link, 'source') + 9);
$link = substr($link, 0, strpos($link, ',') - 1);	

echo $link . "\n";
*/	
?>
