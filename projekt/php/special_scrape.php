<?php
require_once('simple_html_dom.php');
require_once('query.php');

class SpecialProduce {
	public function specProduceArr($link) {
		$html = file_get_html($link);
		
		$arr = array();
		
		$img = $html -> find('#prodPic', 0);
		$img_link = $img -> src;
		array_push($arr, 'http://www.specialtyproduce.com/produce/' . $img_link);
	
		//$prodInfo = $html -> find('#prodInfo', 0);
		$header_h2 = $html -> find('h2'); 
		$text = $html -> find('text');
	
		$flag = 0;
		$idx = 0;
		
		$info = array("Description/Taste", "Seasons/Availability", "Current Facts", "Applications", "Geography/History");
	
		// dump way to do it but it is faster for some weird reason
		for ($j = 0; $j < count($text); ++$j) {
			for ($k = 0; $k < 5; ++$k) {
				if ( strcmp(trim($text[$j]), $info[$k]) == 0 ) {
					$flag = 1;
					$idx = $j;
					break;
				}
			}
		
			if ($flag == 1)
				break;
		}
	
		for ($j = 0; $j < 3 * count($header_h2); ++$j) {
			//echo trim($text[$idx + $j]) . "\n";
			array_push( $arr, trim($text[$idx + $j]) );
		}
			
		//echo count($arr);	
		//print_r($arr);
/*		
		// thank you stackoverflow
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://198.199.84.154:9200/fruit-index/_search');
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "query": {"term" : {"name" : "' . $fruit . '" }} }'); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result= curl_exec($ch);
		//print_r($ch);
		curl_close ($ch);
*/		
		return $arr;
	}
}

?>

