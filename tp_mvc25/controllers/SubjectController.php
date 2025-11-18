<?php
include_once "models/Subject.php";

class SubjectController
{
    private $model;

    // Konstruktor untuk inisialisasi model Subject
    public function __construct($conn)
    {
        $this->model = new Subject($conn);
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

    // CREATE
    public function createSubject(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
            try {
                $major_id = !empty($_POST["major_id"]) ? $_POST["major_id"] : null;
                
                $success = $this->model->create(
                    $_POST["name"],
                    $_POST["credits"],
                    $_POST["subject_code"],
                    $major_id
                );

                if ($success) {
                    header("Location: index.php?page=subjects&success=Subject created successfully");
                    exit();
                }
            } catch (Exception $e) {
                header("Location: index.php?page=subjects&action=create&error=" . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    // UPDATE
    public function updateSubject(){
        if ($_POST) {
            try {
                $major_id = !empty($_POST["major_id"]) ? $_POST["major_id"] : null;
                
                $success = $this->model->update(
                    $_POST["id"],
                    $_POST["name"],
                    $_POST["credits"],
                    $_POST["subject_code"],
                    $major_id
                );

                if ($success) {
                    header("Location: index.php?page=subjects&success=Subject updated successfully");
                    exit();
                }
            } catch (Exception $e) {
                header("Location: index.php?page=subjects&action=edit&id=" . $_POST["id"] . "&error=" . urlencode($e->getMessage()));
                exit();
            }
        }
    }

    // DELETE
    public function deleteSubject($id){
        $this->model->delete($id);
        header("Location: index.php?entity=subjects");
        exit();
    }
}
?>