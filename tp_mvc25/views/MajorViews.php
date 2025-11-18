<?php

$majorController = new MajorController($conn);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Handle actions
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $majorController->createMajor();
} elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $majorController->updateMajor();
} elseif ($action === 'delete' && $id) {
    $majorController->deleteMajor($id);
}

// Get data
$result = $majorController->index();
$majors = [];
while ($r = $result->fetch_assoc()) {
    $majors[] = $r;
}

$major = null;
if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $major = $majorController->editPage($id);
}

// Template variables
$title = "Majors Management";
$active_page = "majors";
$page = "majors";
?>

<?php include "templates/header.php"; ?>

<?php if (in_array($action, ['create', 'edit'])): ?>
    <!-- CREATE/EDIT FORM -->
    <h2><?= $action === 'create' ? 'Create' : 'Edit' ?> Major</h2>
    
    <form method="post" action="index.php?page=majors&action=<?= $action ?><?= $id ? '&id='.$id : '' ?>">
        <?php if ($action === 'edit'): ?>
            <input type="hidden" name="id" value="<?= $major['id'] ?>">
        <?php endif; ?>
        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $major['name'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Established Year</label>
            <input type="number" name="established_year" class="form-control" 
                   value="<?= $major['established_year'] ?? '' ?>" min="1900" max="2030" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Student Count</label>
            <input type="number" name="student_count" class="form-control" 
                   value="<?= $major['student_count'] ?? 0 ?>" min="0" required>
        </div>
        
        <?php 
        $submit_label = $action === 'create' ? 'Create' : 'Update';
        include "templates/form_actions.php"; 
        ?>
    </form>
    
<?php else: ?>
    <!-- INDEX PAGE -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Majors</h2>
        <a href="index.php?page=majors&action=create" class="btn btn-primary">Add New Major</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Established Year</th>
                <th>Student Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($majors as $m): ?>
            <tr>
                <td><?= $m["id"] ?></td>
                <td><?= $m["name"] ?></td>
                <td><?= $m["established_year"] ?></td>
                <td><?= $m["student_count"] ?></td>
                <?php 
                $page = "majors";
                $id = $m["id"];
                include "templates/table_actions.php"; 
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include "templates/footer.php"; ?>