<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'University Management' ?></title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">University Management</a>
        <div class="navbar-nav">
            <a class="nav-link <?= $active_page === 'lecturers' ? 'active' : '' ?>" 
               href="index.php?page=lecturers">Lecturers</a>
            <a class="nav-link <?= $active_page === 'majors' ? 'active' : '' ?>" 
               href="index.php?page=majors">Majors</a>
            <a class="nav-link <?= $active_page === 'subjects' ? 'active' : '' ?>" 
               href="index.php?page=subjects">Subjects</a>
        </div>
    </div>
</nav>

<div class="container mt-4">