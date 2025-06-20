<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/genres.php';
require_once 'includes/header.php';

$isEdit = isset($_GET['id']);
$genreData = ['id' => '', 'name' => ''];

if ($isEdit) {
  foreach ($genres as $g) {
    if ($g['id'] == $_GET['id']) {
      $genreData = $g;
      break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Location: genres.php');
  exit;
}
?>

<div class="container my-5">
  <h1><?= $isEdit ? 'Edit' : 'Add' ?> Genre</h1>
  <form method="POST">
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($genreData['id']) ?>">
    <?php endif; ?>
    <div class="mb-3">
      <label class="form-label">Genre Name</label>
      <input type="text" name="name" class="form-control" required
        value="<?= htmlspecialchars($genreData['name']) ?>">
    </div>
    <button class="btn btn-success"><?= $isEdit ? 'Update' : 'Create' ?> Genre</button>
    <a href="genres.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>