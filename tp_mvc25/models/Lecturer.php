<?php
class Lecturer
{
    private $conn;
    
    public function __construct($db){
        $this->conn = $db;
    }

    // READ all dengan join subject
    public function getAll(){
        $sql = "SELECT l.*, s.name as subject_name, s.subject_code 
                FROM lecturers l 
                LEFT JOIN subjects s ON l.subject_id = s.id";
        return $this->conn->query($sql);
    }

    // READ one dengan join subject
    public function getById($id){
        $sql = "SELECT l.*, s.name as subject_name, s.subject_code 
                FROM lecturers l 
                LEFT JOIN subjects s ON l.subject_id = s.id 
                WHERE l.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // CREATE (tambah subject_id)
    public function create($name, $nidn, $phone, $join_date, $subject_id = null){
        try {
            // Cek duplikat NIDN
            $checkSql = "SELECT id FROM lecturers WHERE nidn = ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("s", $nidn);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("NIDN already exists");
            }

            $sql = "INSERT INTO lecturers (name, nidn, phone, join_date, subject_id)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $nidn, $phone, $join_date, $subject_id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to create lecturer: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // UPDATE (tambah subject_id)
    public function update($id, $name, $nidn, $phone, $join_date, $subject_id = null){
        try {
            // Cek duplikat NIDN (kecuali untuk record yang sama)
            $checkSql = "SELECT id FROM lecturers WHERE nidn = ? AND id != ?";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bind_param("si", $nidn, $id);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                throw new Exception("NIDN already exists");
            }

            $sql = "UPDATE lecturers SET name=?, nidn=?, phone=?, join_date=?, subject_id=?
                    WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssii", $name, $nidn, $phone, $join_date, $subject_id, $id);
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to update lecturer: " . $stmt->error);
            }
            
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // DELETE (tetap sama)
    public function delete($id){
        $sql = "DELETE FROM lecturers WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>