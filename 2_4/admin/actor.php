<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/actors.php'; // $actors array
require_once 'includes/header.php';

$isEdit = isset($_GET['id']);
$actorData = ['id' => '', 'name' => ''];

if ($isEdit) {
  foreach ($actors as $a) {
    if ($a['id'] == $_GET['id']) {
      $actorData = $a;
      break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Save logic goes here...
  header('Location: actors.php');
  exit;
}
?>

<div class="container my-5">
  <h1><?= $isEdit ? 'Edit' : 'Add' ?> Actor</h1>
  <form method="POST">
    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($actorData['id']) ?>">
    <?php endif; ?>
    <div class="mb-3">
      <label for="name" class="form-label">Actor Name</label>
      <input type="text" id="name" name="name" class="form-control" required
        value="<?= htmlspecialchars($actorData['name']) ?>">
    </div>
    <button type="submit" class="btn btn-success">
      <?= $isEdit ? 'Update' : 'Create' ?> Actor
    </button>
    <a href="actors.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>