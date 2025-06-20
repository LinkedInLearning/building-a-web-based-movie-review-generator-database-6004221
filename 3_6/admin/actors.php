<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/actors.php'; // loads $actors array
require_once 'includes/header.php';
?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Actors</h1>
    <a href="actor.php" class="btn btn-primary">+ Add Actor</a>
  </div>

  <?php if (empty($actors)): ?>
    <div class="alert alert-info">No actors found. Add a new one to get started.</div>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($actors as $actor): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?= htmlspecialchars($actor['name']) ?>
          <div>
            <a href="actor.php?id=<?= urlencode($actor['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form method="POST" action="actor_delete.php" class="d-inline" onsubmit="return confirm('Delete this actor?');">
              <input type="hidden" name="id" value="<?= htmlspecialchars($actor['id']) ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>