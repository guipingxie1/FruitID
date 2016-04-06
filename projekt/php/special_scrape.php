<?php
require_once('simple_html_dom.php');
require_once('query.php');

class SpecialProduce {
	public function specProduceArr($name) {
		$html = file_get_html("http://www.specialtyproduce.com/produce/Swiss_Gourmet_Apples_9630.php");
		
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
		return $arr;
	}
}

?>

