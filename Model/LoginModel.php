<?php

class LoginModel{
	
	private $username;
	private $password;
	private $db;
	private $statusAry;

	/**
	 * @brief Initializes Model's database property
	 * @param $db Database connection to utilize
	 */
	public function __construct($db){
		$this->db = $db;
	}

    /**
     * @brief Returns any statuses stored within the model
     * @return Array of statuses (Strings)
     */
	public function getStatusAry(){
		return $this->statusAry;
	}

    /**
     * @brief Stores a new status within the model
     * @param $status Status to add to the model (String)
     */
	public function addStatus($status){
		$this->statusAry[] = $status;
	}

    /**
     * @brief Fetches a user from the database where the username and password match those stored within the model
     * @return Associative array of user data
     */
	public function fetchUser(){
		$query = "SELECT * FROM users WHERE username = ? AND password = ?";
		$data = $this->db->query($query, [$this->username, $this->password]);
		return isset($data[0]) ? $data[0] : NULL;
	}

	
    /**
     * @brief Sets the username variable within the model
     * @param $username Username to set in model
     */
	public function username($username){
		$this->username = $username;
	}

    /**
     * @brief Sets the password variable within the model
     * @param $password Password to set in model
     */
	public function password($password){
		$this->password = $password;
	}

	
}