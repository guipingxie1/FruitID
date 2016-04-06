<?php
require_once('simple_html_dom.php');
require_once('query.php');

class Images {
	public function imageArr($name) {
		$html = file_get_html('https://en.wikipedia.org/wiki/' . $name);

		$image_arr = $html -> find('img');

		$idx = 0;

		while ($idx < count($image_arr)) {
			if (strpos($image_arr[$idx], 'png') == FALSE)
				break;
		
			++$idx;
		}
	
		$arr = array();

		// get first three images from wikipedia
		if ($idx < count($image_arr)) {
			if (strpos($image_arr[$idx], 'png') == FALSE) 
				array_push($arr, 'https:' . $image_arr[$idx] -> src);
		}
	
		if ($idx + 1 < count($image_arr)) {
			if (strpos($image_arr[$idx + 1], 'png') == FALSE)
			array_push($arr, 'https:' . $image_arr[$idx + 1] -> src);
		}
		
		if ($idx + 2 < count($image_arr)) {
			if (strpos($image_arr[$idx + 2], 'png') == FALSE)
				array_push($arr, 'https:' . $image_arr[$idx + 2] -> src);
		}
		
		//print_r($arr);
		return $arr;
	}
}
?>

