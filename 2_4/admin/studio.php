<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/studios.php';
require_once 'includes/header.php';

$isEdit = isset($_GET['id']);
$studioData = ['id' => '', 'name' => '', 'logo' => ''];

if ($isEdit) {
  foreach ($studios as $s) {
    if ($s['id'] == $_GET['id']) {
      $studioData = $s;
      break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Location: studios.php');
  exit;
}
?>

<div class="container my-5">
  <h1><?= $isEdit ? 'Edit' : 'Add' ?> Studio</h1>
  <form method="POST" enctype="multipart/form-data">
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($studioData['id']) ?>">
    <?php endif; ?>
    <div class="mb-3">
      <label class="form-label">Studio Name</label>
      <input type="text" name="name" class="form-control" required
        value="<?= htmlspecialchars($studioData['name']) ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Logo Image</label>
      <input type="file" name="logo" class="form-control">
      <?php if ($isEdit && $studioData['logo']): ?>
        <small>Current: <?= htmlspecialchars($studioData['logo']) ?></small>
      <?php endif; ?>
    </div>
    <button class="btn btn-success"><?= $isEdit ? 'Update' : 'Create' ?> Studio</button>
    <a href="studios.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>