<?php
require_once 'includes/header.php';

$success = '';
$error = '';

// Handle delete
if (isset($_GET['delete'])) {
  $genre_id = (int) $_GET['delete'];
  $adminDB->deleteGenre($genre_id);
  $success = 'Genre deleted successfully.';
}

$genres = $movieDB->getAllGenres();
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Genres</h2>
    <a href="genre.php" class="btn btn-success">+ Add Genre</a>
  </div>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (empty($genres)): ?>
    <div class="alert alert-warning">No genres found.</div>
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
        <?php foreach ($genres as $genre): ?>
          <tr>
            <td><?= $genre['genre_id'] ?></td>
            <td><?= htmlspecialchars($genre['name']) ?></td>
            <td>
              <a href="genre.php?id=<?= $genre['genre_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
              <a href="genres.php?delete=<?= $genre['genre_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this genre?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>