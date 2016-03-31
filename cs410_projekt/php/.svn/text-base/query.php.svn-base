<?php
require_once('connect.php');
require_once('image_scrape.php');
require_once('wiki_scrape.php');

class Query {
	var $connect;
	var $fruit_name;
	var $nutri_info;
	var $wiki;
	var $images;
	
	// constructor
	public function __construct() {
		$this -> connect = new Connect(); 
		$this -> wiki = new Wiki();
		$this -> images = new Images();
		$this -> fruit_name = $this -> connect -> con -> prepare( 'SELECT Name FROM Fruits' );
		$this -> nutri_info = $this -> connect -> con -> prepare( 'SELECT * FROM Fruits WHERE Name = :fruit' );
	}
	
	// returns the fruit name
	public function getAllFruit() {
		$this -> fruit_name -> execute();
		$fruits = $this -> fruit_name -> fetchAll();
		return $fruits;
	}
	
	// returns the nutrition info
	public function getNutri($fruit) {
		$this -> nutri_info -> bindParam( ':fruit', $fruit );
		$this -> nutri_info -> execute();
		$nutri = $this -> nutri_info -> fetchAll();
		return $nutri;
	}
	
	public function getImages($fruit) {
		return $this -> images -> imageArr($fruit);
	}
	
	public function getDes($fruit) {
		return $this -> wiki -> wikiArr($fruit);
	}
}

?>
