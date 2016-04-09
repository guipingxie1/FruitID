<?php
require_once('simple_html_dom.php');


for ($i = 0; $i < 1; ++$i) {
	$html = file_get_html("http://world-crops.com/sweet-briar/");
	
	echo $html -> plaintext;
/*	
	$text = $html -> find('text');
	for ($i = 0; $i < count($text); ++$i)
		echo $text[$i] . "\n";
		
	$html -> clear();
	unset($html);
*/
}

?>

