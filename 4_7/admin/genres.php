<?php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/genres.php'; // $genres array
require_once 'includes/header.php';
?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Genres</h1>
    <a href="genre.php" class="btn btn-primary">+ Add Genre</a>
  </div>

  <?php if (empty($genres)): ?>
    <div class="alert alert-info">No genres defined yet.</div>
  <?php else: ?>
    <ul class="list-group">
      <?php foreach ($genres as $genre): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <?= htmlspecialchars($genre['name']) ?>
          <div>
            <a href="genre.php?id=<?= urlencode($genre['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
            <form method="POST" action="genre_delete.php" class="d-inline" onsubmit="return confirm('Delete this genre?');">
              <input type="hidden" name="id" value="<?= htmlspecialchars($genre['id']) ?>">
              <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>