<?php
require_once('simple_html_dom.php');

$name = 'apple';
$html = file_get_html('https://en.wikipedia.org/wiki/' . $name);

$image_arr = $html -> find('img');

$idx = 0;

while ($idx < count($image_arr)) {
	if (strpos($image_arr[$idx], 'png') == FALSE)
		break;
		
	++$idx;
}

// get first three images from wikipedia
if ($idx < count($image_arr)) 
	print('https:' . $image_arr[$idx] -> src . "\n");
	
if ($idx + 1 < count($image_arr)) 
	print('https:' . $image_arr[$idx + 1] -> src . "\n");
	
if ($idx + 2 < count($image_arr)) 
	print('https:' . $image_arr[$idx + 2] -> src . "\n");

?>

