<?php

require_once $basePath . "/Model/MessagesMenuModel.php";

class ProfileModel{
    use MessagesMenuModel;
	private $userID;
    private $db;

	public function __construct($db){
		$this->db = $db;
		$this->userID = $_SESSION['user_id'];
	}

	public function fetchUser(){
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$this->userID]);
        return $data[0];
    }

	public function fetchUserByID($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$id]);
        return $data[0];
    }
}