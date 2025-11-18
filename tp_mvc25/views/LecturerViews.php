<?php

$lecturerController = new LecturerController($conn);
$subjectModel = new Subject($conn);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Handle actions
if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $lecturerController->createLecturer();
} elseif ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $lecturerController->updateLecturer();
} elseif ($action === 'delete' && $id) {
    $lecturerController->deleteLecturer($id);
}

// Get data
$result = $lecturerController->index();
$lecturers = [];
while ($r = $result->fetch_assoc()) {
    $lecturers[] = $r;
}

$subjects = $subjectModel->getAll();
$lecturer = null;
if ($action === 'edit' && $id && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $lecturer = $lecturerController->editPage($id);
}

// Template variables
$title = "Lecturers Management";
$active_page = "lecturers";
$page = "lecturers";
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= htmlspecialchars($_GET['success']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (in_array($action, ['create', 'edit'])): ?>
    <!-- CREATE/EDIT FORM -->
    <h2><?= $action === 'create' ? 'Create' : 'Edit' ?> Lecturer</h2>
    
    <form method="post" action="index.php?page=lecturers&action=<?= $action ?><?= $id ? '&id='.$id : '' ?>">
        <?php if ($action === 'edit'): ?>
            <input type="hidden" name="id" value="<?= $lecturer['id'] ?>">
        <?php endif; ?>
        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $lecturer['name'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input type="text" name="nidn" class="form-control" value="<?= $lecturer['nidn'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= $lecturer['phone'] ?? '' ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-control">
                <option value="">-- Select Subject --</option>
                <?php while ($subject = $subjects->fetch_assoc()): ?>
                    <option value="<?= $subject['id'] ?>" 
                        <?= isset($lecturer['subject_id']) && $lecturer['subject_id'] == $subject['id'] ? 'selected' : '' ?>>
                        <?= $subject['name'] ?> (<?= $subject['subject_code'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Join Date</label>
            <input type="date" name="join_date" class="form-control" value="<?= $lecturer['join_date'] ?? '' ?>" required>
        </div>
        
        <?php 
        $submit_label = $action === 'create' ? 'Create' : 'Update';
        include "templates/form_actions.php"; 
        ?>
    </form>
    
<?php else: ?>
    <!-- INDEX PAGE -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lecturers</h2>
        <a href="index.php?page=lecturers&action=create" class="btn btn-primary">Add New Lecturer</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIDN</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($lecturers as $l): ?>
            <tr>
                <td><?= $l["id"] ?></td>
                <td><?= $l["name"] ?></td>
                <td><?= $l["nidn"] ?></td>
                <td><?= $l["phone"] ?></td>
                <td><?= $l["subject_name"] ? $l["subject_name"] . " (" . $l["subject_code"] . ")" : '-' ?></td>
                <td><?= $l["join_date"] ?></td>
                <?php 
                $page = "lecturers";
                $id = $l["id"];
                include "templates/table_actions.php"; 
                ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include "templates/footer.php"; ?>