<?php
class Connect {
	var $servername;
	var $username;
	var $password;
	var $dbname;
	var $con;
	
	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->set_default_values ();
		$this->connect ();
	}
	
	/**
	 * Sets the variables
	 */
	private function set_default_values() {
		$this->servername = "engr-cpanel-mysql.engr.illinois.edu";
		$this->username = "fruitide_gxie2";
		$this->password = "m?T;eV18_kf%";
		$this->dbname = "fruitide_fruit";
	}
	
	/**
	 * Connects to the given database
	 */
	private function connect() {
		try {
			// Start connection
			$this->con = new PDO ( "mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password, array (
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			) );
			
			//echo "Connected successfully";			// testing
		} catch ( Exception $e ) {
			echo $e->getMessage () . "<br>";
		}
	}
	
	/**
	 * Closes the connection
	 */
	private function close_connect() {
		// Close the connection
		$this->con = null;
	}
}
?>
