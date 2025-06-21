<?php
require_once 'includes/header.php';

$success = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
  $actor_id = (int) $_GET['delete'];
  $adminDB->deleteActor($actor_id);
  $success = 'Actor deleted successfully.';
}

$actors = $movieDB->getAllActors();
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Actors</h2>
    <a href="actor.php" class="btn btn-success">+ Add Actor</a>
  </div>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (empty($actors)): ?>
    <div class="alert alert-warning">No actors found.</div>
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
        <?php foreach ($actors as $actor): ?>
          <tr>
            <td><?= $actor['actor_id'] ?></td>
            <td><?= htmlspecialchars($actor['name']) ?></td>
            <td>
              <a href="actor.php?id=<?= $actor['actor_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="actors.php?delete=<?= $actor['actor_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this actor?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>