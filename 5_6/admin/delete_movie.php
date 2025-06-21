<?php
require_once 'includes/header.php';

$movie_id = $_GET['id'] ?? null;

if ($movie_id && is_numeric($movie_id)) {
  $movie_id = (int) $movie_id;

  // Clear actor associations first
  $adminDB->clearActorsForMovie($movie_id);

  // Then delete the movie itself
  $adminDB->deleteMovie($movie_id);

  $success = true;
} else {
  $error = "Invalid movie ID.";
}
?>

<div class="container mt-4">
  <h2>Delete Movie</h2>

  <?php if (!empty($success)): ?>
    <div class="alert alert-success">Movie deleted successfully.</div>
    <a href="movies.php" class="btn btn-primary">Back to Movie List</a>
  <?php elseif (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <a href="movies.php" class="btn btn-secondary">Back to Movie List</a>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>