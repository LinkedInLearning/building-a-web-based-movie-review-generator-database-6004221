<?php
require_once 'includes/header.php';

$success = $error = '';
$studio_id = $_GET['id'] ?? null;
$name = '';

// If editing, fetch existing name
if ($studio_id) {
  $name_from_db = $movieDB->getStudioNameById((int)$studio_id);
  if ($name_from_db) {
    $name = $name_from_db;
  } else {
    $error = "Studio not found.";
  }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);

  if ($name === '') {
    $error = 'Studio name cannot be empty.';
  } else {
    if ($studio_id) {
      $adminDB->updateStudio((int)$studio_id, $name);
      $success = 'Studio updated successfully.';
    } else {
      $adminDB->addStudio($name);
      $success = 'Studio added successfully.';
      $name = '';
    }
  }
}
?>

<div class="container mt-4">
  <h2><?= $studio_id ? 'Edit' : 'Add' ?> Studio</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Studio Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary"><?= $studio_id ? 'Update' : 'Add' ?> Studio</button>
    <a href="studios.php" class="btn btn-secondary">Back</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>