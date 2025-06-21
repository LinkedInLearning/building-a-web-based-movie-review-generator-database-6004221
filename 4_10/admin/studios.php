<?php
require_once 'includes/header.php';

$success = '';
$error = '';

// Handle delete first (before fetching list)
if (isset($_GET['delete'])) {
  $studio_id = (int) $_GET['delete'];
  $adminDB->deleteStudio($studio_id);
  $success = 'Studio deleted successfully.';
}

$studios = $movieDB->getAllStudios();
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Studios</h2>
    <a href="studio.php" class="btn btn-success">+ Add Studio</a>
  </div>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (empty($studios)): ?>
    <div class="alert alert-warning">No studios found.</div>
  <?php else: ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($studios as $studio): ?>
          <tr>
            <td><?= $studio['studio_id'] ?></td>
            <td><?= htmlspecialchars($studio['name']) ?></td>
            <td>
              <a href="studio.php?id=<?= $studio['studio_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="studios.php?delete=<?= $studio['studio_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this studio?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>