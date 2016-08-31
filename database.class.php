<?php


#	@ Desc: 	Programmed by Neorm 2O16/2O17
#	@ Contact: 	https://www.facebook.com/gonniy.officiel

	#=========| Database Diagram |=========#
	# id, username, password, email, level #
	#======================================#

class Database {

	protected $_dbHost; // database hostname
	protected $_dbName; // database name
	protected $_dbUser; // database user
	protected $_dbPass; // database password

	public $handler; // the holder

	// defined the infos of the database
	public function __construct($host, $name, $user, $pass = null) {
		$this->_dbHost = $host;
		$this->_dbName = $name;
		$this->_dbUser = $user;
		$this->_dbPass = $pass;
	}

	// connect with the database
	public function connect() {
		try{
			$this->handler = new PDO('mysql:host='. $this->_dbHost .';dbname='. $this->_dbName,$this->_dbUser,$this->_dbPass);
		}catch(PDOException $e) {
			echo 'Error connecting: '.$e->getMessage();
		}
	}

	// clear the database if we done of it
	public function __deconstruct() {
		unset($this->handler);
	}

}