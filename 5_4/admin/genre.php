<?php
require_once 'includes/header.php';

$success = $error = '';
$genre_id = $_GET['id'] ?? null;
$name = '';

// Fetch name if editing
if ($genre_id) {
  $name_from_db = $movieDB->getGenreNameById((int)$genre_id);
  if ($name_from_db) {
    $name = $name_from_db;
  } else {
    $error = "Genre not found.";
  }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);

  if ($name === '') {
    $error = 'Genre name cannot be empty.';
  } else {
    if ($genre_id) {
      $adminDB->updateGenre((int)$genre_id, $name);
      $success = 'Genre updated successfully.';
    } else {
      $adminDB->addGenre($name);
      $success = 'Genre added successfully.';
      $name = '';
    }
  }
}
?>

<div class="container mt-4">
  <h2><?= $genre_id ? 'Edit' : 'Add' ?> Genre</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="name" class="form-label">Genre Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary"><?= $genre_id ? 'Update' : 'Add' ?> Genre</button>
    <a href="genres.php" class="btn btn-secondary">Back</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>