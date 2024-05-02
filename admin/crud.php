<?php

class Crud
{
    public $con;

    public function __construct()
    {
        $this->con = new mysqli('localhost', 'root', '', 'crm'); //Connection with database

        // Check for connection errors
        // if ($this->con->connect_error) {
        //     die("Connection failed: " . $this->con->connect_error);
        // }
    }


    public function createData($table, $datas): array
    {
        // Prepare the INSERT query
        $columns = [];
        $placeholders = [];
        $params = [];
        $types = '';
    
        // Build the INSERT columns and values dynamically based on $datas
        foreach ($datas as $key => $value) {
            $columns[] = "`$key`"; // Using backticks for column names to prevent reserved word issues
            $placeholders[] = '?'; // Parameterized query placeholder
            $params[] = $value; // Add value to parameters
            $types .= 's'; 
        }
    
        // Combine query components
        $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        // var_dump($sql);
        // Prepare the query to avoid SQL injection
        $stmt = $this->con->prepare($sql);
    
        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->con->error);
        }
    
        // Bind the parameters to the prepared statement
        $stmt->bind_param($types, ...$params);
    
        // Execute the query and check for errors
        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute insert: " . $stmt->error);
        }
    
        $insertedId = $stmt->insert_id; // Get the last inserted ID
        $stmt->close();
    
        return [
            'status' => 'success',
            'message' => 'Data created successfully',
            'inserted_id' => $insertedId,
        ];
    }
    


    public function updateData($table, $id, $datas): array
    {
        // Prepare the base SQL update query
        $setClause = [];
        $params = [];
        $types = '';

        // Build the SET clause dynamically based on $datas
        foreach ($datas as $key => $value) {
            $setClause[] = "`$key` = ?";
            $params[] = $value;
            $types .= 's'; // For strings data
        }

        // Add the ID to the parameter list and set clause
        $params[] = $id;
        $types .= 'i'; // For integer data

        // Combine the query components        
        $sql = "UPDATE $table SET " . implode(' , ', $setClause) . " WHERE id = ?";

        // Prepare the query to avoid SQL injection
        $stmt = $this->con->prepare($sql);

        if (!$stmt) {
            throw new \Exception("Failed to prepare statement: " . $this->con->error);
        }

        // Bind the parameters to the prepared statement
        $stmt->bind_param($types, ...$params);

        // Execute the query and check for errors
        if (!$stmt->execute()) {
            throw new \Exception("Failed to execute update: " . $stmt->error);
        }

        $stmt->close();

        return [
            'status' => 'success',
            'message' => 'Data updated successfully',
            'updated_id' => $id,
        ];
    }



    public function editData($table, $id): array
    {
        // Prepare the SQL query to avoid SQL injection
        $stmt = $this->con->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bind_param('i', $id);

        if (!$stmt->execute()) {
            // Handle query execution error
            throw new \Exception("Query execution failed: " . $stmt->error);
        }

        // Fetch the result as an associative array
        $result = $stmt->get_result();
        $data = $result->fetch_assoc(); // Fetch a single record
        $stmt->close();

        if ($data === null) {
            throw new \Exception("No record found for ID: $id");
        }

        return $data;
    }

    public function deleteData($table, $id): bool
    {
        // Prepare the SQL query to avoid SQL injection
        $stmt = $this->con->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result; // Return true if the deletion was successful, otherwise false
    }
}
