<?php

trait UserModel {

    /**
     * @brief Fetches the User with a matching ID from database and returns an array of user info, NULL if not found
     * @param mixed $id 
     * @return mixed
     */
    public function fetchUserByID($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$id]);
        return isset($data[0]) ? $data[0] : NULL;
    }
}