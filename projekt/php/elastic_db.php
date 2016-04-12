<?php
require_once('query.php');

class ElasticDB {
	public function getDescript($fruit) {
		//$fruit = str_replace(' ', '_', $fruit);	
		//$fruit_lower = strtolower($fruit);
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://198.199.84.154:9200/fruit-index/_search');
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "query": {"match" : {"name" : {"query": "' . $fruit . '", "operator": "and" }}} }'); 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close ($ch);
		 
	 	$clean_str = substr($result, strpos($result, '"full": "') + 9);	
		$cleaner_str = substr($clean_str, 0, strpos($clean_str, '", "description": "'));
		$cleanest_str = str_replace('\"', '"', $cleaner_str); 
		//print_r($cleanest_str);
		
		$arr = explode('\n', $cleanest_str);
		
		return $arr;
	}
}

?>

