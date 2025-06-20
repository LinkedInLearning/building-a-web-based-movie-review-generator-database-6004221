<?php
// admin/movie.php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/movies.php'; // loads $movies array
require_once 'includes/header.php';

// Initialize form variables
$isEdit = false;
$movieData = [
  'movie_id'     => '',
  'title'        => '',
  'poster'       => '',
  'release_year' => '',
  'genre'        => '',
  'studio'       => '',
  'actors'       => [],
  'synopsis'     => ''
];

// Detect edit mode
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  foreach ($movies as $m) {
    if ($m['movie_id'] === $id) {
      $isEdit = true;
      $movieData = $m;
      break;
    }
  }
}

// Handle form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Here, you’ll add validation and save logic (update in $movies or append new)
  // Redirect back to movies list after saving
  header('Location: movies.php');
  exit;
}
?>

<div class="container my-5">
  <h1><?= $isEdit ? 'Edit' : 'Add' ?> Movie</h1>
  <form method="POST" enctype="multipart/form-data">
    <?php if ($isEdit): ?>
      <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movieData['movie_id']) ?>">
    <?php endif; ?>

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" id="title" name="title" class="form-control"
        value="<?= htmlspecialchars($movieData['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="poster" class="form-label">Poster Image</label>
      <input type="file" id="poster" name="poster" class="form-control">
      <?php if ($isEdit && $movieData['poster']): ?>
        <small>Current file: <?= htmlspecialchars($movieData['poster']) ?></small>
      <?php endif; ?>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="release_year" class="form-label">Release Year</label>
        <input type="number" id="release_year" name="release_year" class="form-control"
          value="<?= htmlspecialchars($movieData['release_year']) ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" id="genre" name="genre" class="form-control"
          value="<?= htmlspecialchars($movieData['genre']) ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="studio" class="form-label">Studio</label>
        <input type="text" id="studio" name="studio" class="form-control"
          value="<?= htmlspecialchars($movieData['studio']) ?>" required>
      </div>
    </div>

    <div class="mb-3">
      <label for="actors" class="form-label">Actors (comma-separated)</label>
      <input type="text" id="actors" name="actors" class="form-control"
        value="<?= htmlspecialchars(implode(', ', $movieData['actors'])) ?>">
    </div>

    <div class="mb-3">
      <label for="synopsis" class="form-label">Synopsis</label>
      <textarea id="synopsis" name="synopsis" class="form-control" rows="4"
        required><?= htmlspecialchars($movieData['synopsis']) ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">
      <?= $isEdit ? 'Update' : 'Create' ?> Movie
    </button>
    <a href="movies.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>