<?php

class crudModel
{
    private $dbCon;
    public function __construct($host = 'localhost', $user = 'root', $password = '', $dbName = 'crm')
    {
        $this->dbCon = new mysqli($host, $user, $password, $dbName);
        if ($this->dbCon->connect_error) {
            die("Connection failed :" . $this->dbCon->connect_error);
        }
    }

    public function  fetchAllData($tableName)
    {
        $stmt = $this->dbCon->prepare("SELECT * FROM $tableName");
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function insertData($tableName, $data)
    {
        // INSERT INTO `admin` (`id`, `name`, `email`, `password`, `parent`, `phone`, `role`, `status`) VALUES (NULL, 'hanki', '', '', NULL, '', 'dealer', 'active');
        // Extract columns and values
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        // Prepare SQL
        $sql = "INSERT INTO `$tableName` ($columns) VALUES ($placeholders)";
        $stmt = $this->dbCon->prepare($sql);

        // Dynamically bind values
        $types = str_repeat('s', count($data)); // assuming all are strings; adjust as needed
        $values = array_values($data);
        $stmt->bind_param($types, ...$values);

        // Execute and return result
        if ($stmt->execute()) {
            return "Insert successful.";
        } else {
            return "Insert failed: " . $stmt->error;
        }
    }

    public function editData($tableName, $id)
    {
        $stmt = $this->dbCon->prepare("SELECT * FROM $tableName WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function updateData($tableName, $data, $id)
    {
        $set = implode(',', array_map(fn($key) => "$key = ?", array_keys($data)));
        $sql = "UPDATE `$tableName` SET $set WHERE id = ?";
        $stmt = $this->dbCon->prepare($sql);
        if (!$stmt) {
            return "SQL Error: " . $this->dbCon->error;
        }

        $types = str_repeat('s', count($data)) . 'i';
        $values = array_values($data);
        $values[] = $id;
        $stmt->bind_param($types, ...$values);
        if ($stmt->execute()) {
            return "Update successful.";
        } else {
            return "Update failed: " . $stmt->error;
        }
    }

    public function deleteData($tableName, $id)
    {
        $stmt = $this->dbCon->prepare("DELETE FROM $tableName WHERE  id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();        
        if ($stmt->execute()) {
            return "Delete successful.";
        } else {
            return "Delete failed: " . $stmt->error;
        }

    }
}
