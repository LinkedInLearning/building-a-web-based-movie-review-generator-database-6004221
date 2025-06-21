<?php
require_once 'includes/header.php';

$success = $error = '';
$actor_id = $_GET['id'] ?? null;
$name = '';

// Fetch name if editing
if ($actor_id) {
  $name_from_db = $movieDB->getActorNameById((int)$actor_id);
  if ($name_from_db) {
    $name = $name_from_db;
  } else {
    $error = "Actor not found.";
  }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);

  if ($name === '') {
    $error = 'Actor name cannot be empty.';
  } else {
    if ($actor_id) {
      $adminDB->updateActor((int)$actor_id, $name);
      $success = 'Actor updated successfully.';
    } else {
      $adminDB->addActor($name);
      $success = 'Actor added successfully.';
      $name = '';
    }
  }
}
?>

<div class="container mt-4">
  <h2><?= $actor_id ? 'Edit' : 'Add' ?> Actor</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Actor Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary"><?= $actor_id ? 'Update' : 'Add' ?> Actor</button>
    <a href="actors.php" class="btn btn-secondary">Back</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>