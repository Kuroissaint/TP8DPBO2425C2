<?php
class Major
{
    private $conn;
    
    // Konstruktor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // READ all
    public function getAll(){
        $sql = "SELECT * FROM majors";
        return $this->conn->query($sql);
    }

    // READ one
    public function getById($id){
        $sql = "SELECT * FROM majors WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE
    public function create($name, $established_year, $student_count){
        try {
            // Cek duplikat nama major
            $checkSql = "SELECT id FROM majors WHERE name = ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("s", $name);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("Major name already exists");
            }

            $sql = "INSERT INTO majors (name, established_year, student_count) 
                    VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sii", $name, $established_year, $student_count);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to create major: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // UPDATE
    public function update($id, $name, $established_year, $student_count){
        try {
            // Cek duplikat nama major (kecuali untuk record yang sama)
            $checkSql = "SELECT id FROM majors WHERE name = ? AND id != ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("si", $name, $id);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("Major name already exists");
            }

            $sql = "UPDATE majors SET name=?, established_year=?, student_count=? 
                    WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siii", $name, $established_year, $student_count, $id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to update major: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // DELETE
    public function delete($id){
        $sql = "DELETE FROM majors WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>