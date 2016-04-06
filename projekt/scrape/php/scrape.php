<?php
require_once('simple_html_dom.php');


// parse data (only for raw fruits)
for ($i = 0; $i < 106; $i += 35) {
	$html = file_get_html('https://ndb.nal.usda.gov/ndb/foods?format=&count=&max=35&sort=&fgcd=Fruits+and+Fruit+Juices&manu=&lfacet=&qlookup=raw&offset=' . $i . '&order=desc');

	$table = $html -> find('.wbox', 1);
	$outer_links = $table -> find('td a');
	
	// get links
	for ($j = 0; $j < count($outer_links); $j += 2) {
		$num = substr($outer_links[$j] -> href, 16, 4);
		//echo $num;
	
		// don't know a better method
		$html2 = file_get_html('https://ndb.nal.usda.gov/ndb/foods/show/' . $num . '?fgcd=Fruits+and+Fruit+Juices&manu=&lfacet=&format=&count=&max=35&offset=0&sort=&qlookup=');
		
		$outer_name = $html2 -> find('#view-name', 0);
		//echo $outer_name;
		$inner_name = $outer_name -> plaintext;
		$name = substr($inner_name, 53);					// manually trial and error offset
		$name = trim($name);
		$name = substr($name, 0, strpos($name, '</h1>'));
		$name = substr($name, 0, strpos($name, '&#') - 1);
		
		$countMe = $html2 -> find('th[style=width:130px;line-height:1.2em;text-align:center]');
		$incre = count($countMe);
		
		if (strpos($name, 'juice') == FALSE) {
			echo 'Name: ' . $name . "\n";		
		
			$name_data = $html2 -> find('tr');
		
			for ($k = 2; $k < count($name_data); ++$k) {
				$data = $name_data[$k] -> find('td');
				//echo count($data);
		
				$x = 0;
				$dataLen = count($data);
			
				//echo $x . ' ' . $dataLen . "\n";
			
				/*
				 *			$str = unit
				 *			$str1 = value
				 *			$str2 = nutrition name
				 *
				 */
			
				while ($x < $dataLen) {
					if ($x + 2 < $dataLen) {
						// make everything look cleaner
						$str = trim($data[$x + 1] -> plaintext);
						$str = str_replace('&micro;', 'µ', $str);
					
						$str2 = trim($data[$x] -> plaintext);
						$str2 = str_replace('Total lipid (fat)', 'Fat', $str2);
						$str2 = str_replace('Energy', 'Calories', $str2);
						$str2 = str_replace('Carbohydrate, by difference', 'Carbohydrates', $str2);
						$str2 = str_replace('total', '', $str2);
					
						if (strpos($str2, 'atty acids') == 1) {
							$str2 = substr($str2, strpos($str2, ',') + 3) . ' fat';
							$str2 = ucfirst($str2);
						}
						else {
							if (strpos($str2, ',') != FALSE)
								$str2 = substr($str2, 0, strpos($str2, ','));
						}
						
						if (strpos($str2, '(') != FALSE)
							$str2 = substr($str2, 0, strpos($str2, '(') - 1);
							
						if ((strcmp($str2, 'Vitamin A') != 0) && (strcmp($str2, 'Vitamin D') != 0)) {
							echo $str2 . ': ' . trim($data[$x + 2] -> plaintext) . ' ' . $str . "\n";
							//echo 'Unit: ' . trim($data[$x + 1] -> plaintext) . "\n";
							//echo 'Value: ' . trim($data[$x + 2] -> plaintext) . ' ' . trim($data[$x + 1] -> plaintext) . "\n";
						}
						
						if (strcmp($str2, 'Vitamin A') == 0) {
							if (strcmp($str, 'µg') != 0)
								echo $str2 . ': ' . trim($data[$x + 2] -> plaintext) . ' ' . $str . "\n";
						}
						
						if (strcmp($str2, 'Vitamin D') == 0) {
							if (strcmp($str, 'µg') != 0)
								echo $str2 . ': ' . trim($data[$x + 2] -> plaintext) . ' ' . $str . "\n";
						}
					}
				
					$x += ($incre + 1);
				}			
			}
		
			echo "\n";
		}
		
		$html2 -> clear();
		unset($html2);
	}

	$html -> clear();
	unset($html);
}

?>

