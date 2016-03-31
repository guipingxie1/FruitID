<?php
require_once('query.php');
 
// need to have exact name 

class Wiki {
	//var $name;
	
	public function wikiArr($name) {
		//echo $name;
		$name = str_replace(' ', '_', $name);
		$url = 'https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=' . $name;

		// gets json file
		$str = file_get_contents($url);	
		//echo $str;		
		//echo $url;
		$str = substr($str, strpos($str, 'extract') + 10);
		$str = str_replace('"}}}}', "", $str);

		//echo $str;
		$paragraphs = explode('\n', $str);

		//print_r($paragraphs);

		// can change how many paragraphs to get
		$len = min(2, count($paragraphs));

		$arr = array();

		for ($i = 0; $i < $len; ++$i)
			array_push($arr, $paragraphs[$i]);

		//print($arr[0]);
		return $arr;
	}
}
?>
