<?php
include_once "models/Major.php";

class MajorController
{
    private $model;

    // Konstruktor untuk inisialisasi model Major
    public function __construct($conn){
        $this->model = new Major($conn);
    }

    // LIST
    public function index(){
        return $this->model->getAll();
    }

    // SHOW EDIT FORM
    public function editPage($id){
        return $this->model->getById($id);
    }

    // CREATE
    public function createMajor(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
            $this->model->create(
                $_POST["name"],
                $_POST["established_year"],
                $_POST["student_count"]
            );
            header("Location: index.php?entity=majors");
            exit();
        }
    }

    // UPDATE
    public function updateMajor(){
        if ($_POST) {
            try {
                $success = $this->model->update(
                    $_POST["id"],
                    $_POST["name"],
                    $_POST["established_year"],
                    $_POST["student_count"]
                );

                if ($success) {
                    header("Location: index.php?page=majors&success=Major updated successfully");
                    exit();
                }
            } catch (Exception $e) {
                header("Location: index.php?page=majors&action=edit&id=" . $_POST["id"] . "&error=" . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    // DELETE
    public function deleteMajor($id){
        $this->model->delete($id);
        header("Location: index.php?entity=majors");
        exit();
    }
}
?>