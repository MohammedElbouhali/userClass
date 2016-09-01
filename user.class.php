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

	private static $_username; // decalred username
	private static $_password; // declared password
	private static $_email; 	  // declared email
	/*
		@Notice: You can add more properties and set your database compatible with the class
	*/

	// set and get value from the username propertie
	public static function setUsername($username) {
		self::$_username = $username;
	}

	public static function getUsername() {
		return self::_username !== null ? self::$_username : '';
	}

	// set and get value from the password propertie
	public static function setPassword($password) {
		self::$_password = $password;
	}

	public static function getPassword() {
		return self::$_password !== null ? self::$_password : '';;
	}

	// set and get value from the email propertie
	public static function setEmail($email) {
		self::$_email = $email;
	}

	public static function getEmail() {
		return self::$_email !== null ? self::$_email : '';
	}

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
		$query->bindParam(1, self::$_username);
		$query->bindParam(2, self::$_password);
		$query->bindParam(3, self::$_email);
		return $query->execute();
	}

	// create or add user [Exemple: Register page.]
	public function createUser() {
		global $database;
		$query = "INSERT INTO {$this->_tableName} (username, password, email) VALUES(?, ?, ?)";
		$prepare = $database->handler->prepare($query);
		$prepare->bindParam(1, self::$_username);
		$prepare->bindParam(2, self::$_password);
		$prepare->bindParam(3, self::$_email);
		return $prepare->execute();
	}

	// check if a particular person is an user
	public function isUser($username, $password = null) {
		global $database;
		$sql = "SELECT * FROM {$this->_tableName} WHERE username = '$username' AND password= '$password'";
		return $database->handler->query($sql)->rowCount() >= 1 ? true : false;
	}

	// delete user
	public function deleteUser($id) {
		global $database;
		$sql = "DELETE FROM {$this->_tableName} WHERE id= '$id'";
		return $database->handler->exec($sql) >= 1 ? true : false;
	}

	public function gradedUser($userId, $status) {
		global $database;
		$sql = "UPDATE {$this->_tableName} SET level= {$status} WHERE id= {$userId}";
		return $database->handler->query($sql) ? true : false;
	}

}