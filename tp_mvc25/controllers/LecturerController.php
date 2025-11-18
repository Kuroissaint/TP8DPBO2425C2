<?php
include_once "models/Lecturer.php";

class LecturerController
{
    private $model;

    // Konstruktor untuk inisialisasi model Lecturer
    public function __construct($conn)
    {
        $this->model = new Lecturer($conn);
    }

    // LIST
    public function index()
    {
        return $this->model->getAll();
    }

    // SHOW EDIT FORM
    public function editPage($id)
    {
        return $this->model->getById($id);
    }

    // UPDATE
    public function updateLecturer()
    {
        if ($_POST) {
            try {
                $subject_id = !empty($_POST["subject_id"]) ? $_POST["subject_id"] : null;
                
                $success = $this->model->update(
                    $_POST["id"],
                    $_POST["name"],
                    $_POST["nidn"],
                    $_POST["phone"],
                    $_POST["join_date"],
                    $subject_id
                );

                if ($success) {
                    header("Location: index.php?page=lecturers&success=Lecturer updated successfully");
                    exit();
                }
            } catch (Exception $e) {
                // Redirect kembali ke form edit dengan error message
                header("Location: index.php?page=lecturers&action=edit&id=" . $_POST["id"] . "&error=" . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    // CREATE
    public function createLecturer(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
            try {
                $subject_id = !empty($_POST["subject_id"]) ? $_POST["subject_id"] : null;
                
                $success = $this->model->create(
                    $_POST["name"],
                    $_POST["nidn"],
                    $_POST["phone"],
                    $_POST["join_date"],
                    $subject_id
                );

                if ($success) {
                    // Redirect dengan success message
                    header("Location: index.php?page=lecturers&success=Lecturer created successfully");
                    exit();
                }
            } catch (Exception $e) {
                // Redirect dengan error message
                header("Location: index.php?page=lecturers&action=create&error=" . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    // DELETE
    public function deleteLecturer($id)
    {
        $this->model->delete($id);
        header("Location: index.php");
        exit();
    }
}
