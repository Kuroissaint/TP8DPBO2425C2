<!-- Template untuk action buttons -->
<div class="mb-3">
    <button type="submit" name="submit" class="btn btn-primary">
        <?= $submit_label ?? 'Submit' ?>
    </button>
    <a href="index.php?page=<?= $page ?>" class="btn btn-secondary">Cancel</a>
</div>