<?php

trait MessagesMenuModel{
    private $otherUserID;
    /**
     * @brief fetches all chats you have with others
     * @return array of messages which match both sender and receiver id
     */
    public function fetchChattedUsers() {
        $query = "SELECT DISTINCT senderID, receiverID FROM messages WHERE senderID = ? OR receiverID = ?";
        $data = $this->db->query($query, [$_SESSION['user_id'], $_SESSION['user_id']]);
        return $data;
    }

    /**
     * @brief fetches all messages between users in order of timestamp
     * @return array of rows from db
     */
    public function fetchMessages($currentUserID, $otherUserID) {
        $query = "SELECT * FROM messages WHERE (senderID = ? AND receiverID = ?) OR (senderID = ? AND receiverID = ?) ORDER BY timestamp";
        $data = $this->db->query($query, [$currentUserID, $otherUserID, $otherUserID, $currentUserID]);
        return $data;
    }

    /**
     * @brief inserts new row into messages db
     * @return  true if succesful, false if not
     */
    public function insertMessage($senderID, $receiverID, $message) {
        $query = "INSERT INTO messages (senderID, receiverID, message) VALUES (?, ?, ?)";
        $data = $this->db->query($query, [$senderID, $receiverID, $message]);
        return $data;
    }


    public function setOtherUserID($otherUserID) {
        $this->otherUserID = $otherUserID;
    }

    public function getOtherUserID() {
        return $this->otherUserID;
    }


}