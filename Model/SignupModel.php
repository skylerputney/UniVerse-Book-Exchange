<?php

class SignupModel{
	private $email;
	private $username;
	private $password;
	private $db;
	private $errors;
	private $university;

	/**
	 * @brief Initializes Model's database property and error array
	 * @param $db Database connection to utilize
	 * @param $errors Array of errors to initialize with
	 */
	public function __construct($db, $errors = []){
		$this->db = $db;
		$this->errors = $errors;
	}


    /**
     * @brief Returns errors currently stored within model
     * @return Array of errors (Strings)
     */
	public function getErrors(){
		return $this->errors;
	}

    /**
     * @brief Adds an error to the model's error array
     * @param $error Error to add to model
     */
	public function addError($error){
		$this->errors[] = $error;
	}

    /**
     * @brief Sets the model's email variable
     * @param $email Email to set
     */
	public function email($email){
		$this->email = $email;
	}

    /**
     * @brief Sets the model's username variable
     * @param $username Username to set
     */
	public function username($username){
		$this->username = $username;
	}


    /**
     * @brief Sets the model's password variable
     * @param $password Password to set
     */
	public function password($password){
		$this->password = $password;
	}
	
	/**
	* @brief Sets the model's university variable'
	* @param $university University to set
	*/
	public function university($university){
		$this->university = $university;
	}


    /**
     * @brief Fetches user from the database where username and email match what's stored in the model
     * @return Associative array with user info, NULL if does not exist
     */
	public function fetchUser(){
		$query = "SELECT * FROM users WHERE username = ? OR email = ?";
		$data = $this->db->query($query, [$this->username, $this->email]);
		return isset($data[0]) ? $data[0] : NULL;
	}


    /**
     * @brief Inserts a user into the database with the information stored within the model
     * @return true if successfully inserted, false otherwise
     */
	public function insertUser(){
		$query = "INSERT INTO users (username, password, email, university) VALUES (?, ?, ?, ?)";
		$data = $this->db->query($query, [$this->username, $this->password, $this->email, $this->university]);
		return $data;
	}
}
