<?php

/*
	@Desc: Programmed by Neorm 2O16/2O17
	@Contact: https://www.facebook.com/gonniy.officiel
*/

// Let's first include the database
require_once('database.class.php');

// connect with the database class
global $database;
$database = new Database('127.0.0.1', 'classtest', 'root');
$database->connect();

class User{

	public $username; // decalred username
	public $password; // declared password
	public $email; 	  // declared email
	/*
		@Notice: You can add more properties and set your database compatible with the class
	*/

	protected $_tableName; // table name

	// define the columns
	public function __construct($table) {
		// define tablename
		$this->_tableName = $table;
	}

	// update columns by id
	public function updateUser($id) {
		global $database;
		$sql = "UPDATE {$this->_tableName} SET username= ?, password= ?, email= ? WHERE id= {$id}";
		$query = $database->handler->prepare($sql);
		$query->bindParam(1, $this->username);
		$query->bindParam(2, $this->password);
		$query->bindParam(3, $this->email);
		return $query->execute();
	}

	// create or add user [Exemple: Register page.]
	public function createUser() {
		global $database;
		$query = "INSERT INTO {$this->_tableName} (username, password, email) VALUES(?, ?, ?)";
		$prepare = $database->handler->prepare($query);
		$prepare->bindParam(1, $this->username);
		$prepare->bindParam(2, $this->password);
		$prepare->bindParam(3, $this->email);
		return $prepare->execute();
	}

	// check if a particular person is an user
	public function isUser($username, $password = null) {
		global $database;
		$sql = "SELECT * FROM {$this->_tableName} WHERE username = '$username' AND password= '$password'";
		if($database->handler->query($sql)->rowCount() >= 1) {
			return TRUE;
		} else{
			return FALSE;
		}
	}

	// delete user
	public function deleteUser($id) {
		global $database;
		$sql = "DELETE FROM {$this->_tableName} WHERE id= '$id'";
		if($database->handler->exec($sql) >= 1) {
			return TRUE;
		} else{
			return FALSE;
		}
	}

	public function gradedUser($userId, $status) {
		global $database;
		$sql = "UPDATE {$this->_tableName} SET level= {$status} WHERE id= {$userId}";
		return $database->handler->query($sql) ? true : false;
	}

}