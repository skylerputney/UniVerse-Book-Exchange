<?php

class Database {
    
    /**
     * @brief Initializes database connection using info from config file
     * @return $conn DB conection
     */
    private function connect() {
        // Initialize database connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Return database connection
        return $conn;
    }

    /**
     * @brief Queries database using prepared statements
     * @param $query Query string
     * @param $data Array of data to bind to query
     * @return True|False for INSERT, DELETE query success; Associative array of DB rows for SELECT query
     */
    public function query($query, $data = []) {
        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        // Check if $data is not empty before binding parameters
        if (!empty($data)) {
            // Assuming $data is an array of parameters, bind them to the statement
            $types = str_repeat('s', count($data)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$data);
        }

        $check = $stmt->execute();

        if ($check) {
            // Handle INSERT, DELETE queries
            if (stripos($query, 'INSERT') === 0 || stripos($query, 'DELETE') === 0) {
                $affectedRows = $stmt->affected_rows;
                $stmt->close();
                return $affectedRows > 0;
            }
            // Handle SELECT queries
            else if (stripos($query, 'SELECT') === 0) {
                $result = $stmt->get_result();
                $rows = [];

                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                }

                $stmt->close();
                return $rows;
            }
        }

        // Close the statement in case of failure
        $stmt->close();

        return false;
    }
}