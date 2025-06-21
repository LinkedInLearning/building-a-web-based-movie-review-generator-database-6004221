<?php include 'includes/header.php'; ?>

<h1>Actors</h1>

<?php
$message = null;
$messageType = 'success'; // or 'danger' for errors

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
  $name = trim($_POST['name']);

  if ($name !== '') {
    try {
      $adminDB->addActor($name);
      $message = "Actor \"{$name}\" added successfully.";
    } catch (Exception $e) {
      $message = "Error adding actor: " . $e->getMessage();
      $messageType = 'danger';
    }
  } else {
    $message = "Actor name cannot be empty.";
    $messageType = 'danger';
  }
}

// Handle Delete
if (isset($_GET['delete'])) {
  $actor_id = (int) $_GET['delete'];

  try {
    $adminDB->deleteActor($actor_id);
    $message = "Actor deleted successfully.";
  } catch (Exception $e) {
    $message = "Error deleting actor: " . $e->getMessage();
    $messageType = 'danger';
  }
}

// Fetch actors
$actors = $movieDB->getAllActors();
?>

<?php if ($message): ?>
  <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($message) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<h2>Add New Actor</h2>
<form method="POST">
  <input type="text" name="name" required placeholder="Actor name">
  <button type="submit">Add Actor</button>
</form>

<h2>All Actors</h2>
<ul>
  <?php foreach ($actors as $actor): ?>
    <li>
      <?= htmlspecialchars($actor['name']) ?>
      <a href="?delete=<?= $actor['actor_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </li>
  <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>