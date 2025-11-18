<?php
class Subject
{
    private $conn;
    
    // Konstructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // READ all dengan join major
    public function getAll(){
        $sql = "SELECT s.*, m.name as major_name 
                FROM subjects s 
                LEFT JOIN majors m ON s.major_id = m.id";
        return $this->conn->query($sql);
    }

    // READ one dengan join major
    public function getById($id){
        $sql = "SELECT s.*, m.name as major_name 
                FROM subjects s 
                LEFT JOIN majors m ON s.major_id = m.id 
                WHERE s.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE
    public function create($name, $credits, $subject_code, $major_id = null){
        try {
            // Cek duplikat subject code
            $checkSql = "SELECT id FROM subjects WHERE subject_code = ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("s", $subject_code);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("Subject code already exists");
            }

            $sql = "INSERT INTO subjects (name, credits, subject_code, major_id) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sisi", $name, $credits, $subject_code, $major_id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to create subject: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // UPDATE
    public function update($id, $name, $credits, $subject_code, $major_id = null){
        try {
            // Cek duplikat subject code (kecuali untuk record yang sama)
            $checkSql = "SELECT id FROM subjects WHERE subject_code = ? AND id != ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("si", $subject_code, $id);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("Subject code already exists");
            }

            $sql = "UPDATE subjects SET name=?, credits=?, subject_code=?, major_id=?
                    WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sisii", $name, $credits, $subject_code, $major_id, $id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to update subject: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Delete subject berdasarkan id
    public function delete($id){
        $sql = "DELETE FROM subjects WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Get subjects berdasarkan major_id
    public function getByMajor($major_id){
        $sql = "SELECT * FROM subjects WHERE major_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $major_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>