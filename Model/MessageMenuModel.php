<?php

trait MessageMenuModel{
    private $db;


    /**
     * @brief fetches user by ID
     * @return first in data array 
     */
    public function fetchChatUserByID($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$id]);
        return $data[0];
    }

}