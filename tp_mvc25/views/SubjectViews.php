<?php

$subjectController = new SubjectController($conn);
$majorModel = new Major($conn);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Handle actions
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectController->createSubject();
} elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectController->updateSubject();
} elseif ($action === 'delete' && $id) {
    $subjectController->deleteSubject($id);
}

// Get data
$result = $subjectController->index();
$subjects = [];
while ($r = $result->fetch_assoc()) {
    $subjects[] = $r;
}

$majors = $majorModel->getAll();
$subject = null;
if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $subject = $subjectController->editPage($id);
}

// Template variables
$title = "Subjects Management";
$active_page = "subjects";
$page = "subjects";
?>

<?php include "templates/header.php"; ?>

<?php if (in_array($action, ['create', 'edit'])): ?>
    <!-- CREATE/EDIT FORM -->
    <h2><?= $action === 'create' ? 'Create' : 'Edit' ?> Subject</h2>
    
    <form method="post" action="index.php?page=subjects&action=<?= $action ?><?= $id ? '&id='.$id : '' ?>">
        <?php if ($action === 'edit'): ?>
            <input type="hidden" name="id" value="<?= $subject['id'] ?>">
        <?php endif; ?>
        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $subject['name'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Credits</label>
            <input type="number" name="credits" class="form-control" value="<?= $subject['credits'] ?? '' ?>" min="1" max="6" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Subject Code</label>
            <input type="text" name="subject_code" class="form-control" value="<?= $subject['subject_code'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Major</label>
            <select name="major_id" class="form-control">
                <option value="">-- Select Major --</option>
                <?php while ($major = $majors->fetch_assoc()): ?>
                    <option value="<?= $major['id'] ?>" 
                        <?= isset($subject['major_id']) && $subject['major_id'] == $major['id'] ? 'selected' : '' ?>>
                        <?= $major['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <?php 
        $submit_label = $action === 'create' ? 'Create' : 'Update';
        include "templates/form_actions.php"; 
        ?>
    </form>
    
<?php else: ?>
    <!-- INDEX PAGE -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Subjects</h2>
        <a href="index.php?page=subjects&action=create" class="btn btn-primary">Add New Subject</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Credits</th>
                <th>Code</th>
                <th>Major</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($subjects as $s): ?>
            <tr>
                <td><?= $s["id"] ?></td>
                <td><?= $s["name"] ?></td>
                <td><?= $s["credits"] ?></td>
                <td><?= $s["subject_code"] ?></td>
                <td><?= $s["major_name"] ?? '-' ?></td>
                <?php 
                $page = "subjects";
                $id = $s["id"];
                include "templates/table_actions.php"; 
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include "templates/footer.php"; ?>