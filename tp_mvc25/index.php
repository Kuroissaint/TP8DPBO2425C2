<?php
include "connection.php";
include "controllers/LecturerController.php";
include "controllers/MajorController.php";
include "controllers/SubjectController.php";

$lecturerController = new LecturerController($conn);
$majorController = new MajorController($conn);
$subjectController = new SubjectController($conn);

$page = $_GET['page'] ?? 'lecturers';
$action = $_GET['action'] ?? 'index';

// Simple routing
switch($page) {
    case 'majors':
        // Handle majors
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $majorController->createMajor();
        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $majorController->updateMajor();
        } elseif ($action === 'delete') {
            $majorController->deleteMajor($_GET['id']);
        } else {
            include "views/MajorViews.php";
        }
        break;
        
    case 'subjects':
        // Handle subjects
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $subjectController->createSubject();
        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $subjectController->updateSubject();
        } elseif ($action === 'delete') {
            $subjectController->deleteSubject($_GET['id']);
        } else {
            include "views/SubjectViews.php";
        }
        break;
        
    default: // lecturers
        // Handle lecturers
        if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $lecturerController->createLecturer();
        } elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $lecturerController->updateLecturer();
        } elseif ($action === 'delete') {
            $lecturerController->deleteLecturer($_GET['id']);
        } else {
            include "views/LecturerViews.php";
        }
        break;
}
?>