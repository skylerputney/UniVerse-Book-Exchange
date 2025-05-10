<?php

require_once $basePath . "/Model/UserModel.php";

trait MessageModel{
    private $db;
    private $senderID;
    private $receiverID;
    private $message;
    private $otherUsername;
    use UserModel;

    /**
     * @brief setter
     */
    public function senderID($senderID){
        $this->senderID = $senderID;
    }

    /**
     * @brief setter
     */
    public function receiverID($receiverID){
        $this->receiverID = $receiverID;
    }


    /**
     * @brief setter
     */
    public function message($message){
        $this->message = $message;
    }

    /**
     * @brief inserts new row into messages db
     * @return  true if succesful, false if not
     */
    public function insertMessage($senderID, $receiverID, $message){
        $query = "INSERT INTO messages (senderID, receiverID, message) VALUES (?, ?, ?)";
        $data = $this->db->query($query, [$senderID, $receiverID, $message]);
        return $data;
    }


    /**
     * @brief fetches other users
     * @return array of user row
     */
    public function getOtherUser(){
        if($_SESSION['user_id'] == $this->senderID){
            $otherUserID = $this->receiverID;
        }
        else{
            $otherUserID = $this->senderID;
        }
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$otherUserID]);
        return $data;
    }
}