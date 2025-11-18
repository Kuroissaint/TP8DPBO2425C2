<!-- Template untuk action buttons di table -->
<td>
    <a href="index.php?page=<?= $page ?>&action=edit&id=<?= $id ?>" class="btn btn-success btn-sm">Edit</a>
    <a href="index.php?page=<?= $page ?>&action=delete&id=<?= $id ?>" 
       class="btn btn-danger btn-sm" 
       onclick="return confirmDelete()">Delete</a>
</td>