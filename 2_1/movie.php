<?php
include 'includes/header.php';
include 'data/movies.php';

$id = $_GET['id'] ?? null;
$movie = null;

foreach ($movies as $m) {
  if ($m['movie_id'] == $id) {
    $movie = $m;
    break;
  }
}

if (!$movie): ?>
  <div class="alert alert-danger">Movie not found.</div>
<?php else: ?>
  <div class="row">
    <div class="col-md-4">
      <img src="uploads/posters/<?= $movie['poster'] ?>" class="img-fluid mb-3" alt="<?= htmlspecialchars($movie['title']) ?>">
    </div>
    <div class="col-md-8">
      <h1><?= htmlspecialchars($movie['title']) ?></h1>
      <p><strong>Release Year:</strong> <?= $movie['release_year'] ?></p>
      <p><strong>Genre:</strong> <?= $movie['genre'] ?></p>
      <p><strong>Studio:</strong> <?= $movie['studio'] ?></p>
      <p><strong>Actors:</strong> <?= implode(', ', $movie['actors']) ?></p>
      <p><?= nl2br(htmlspecialchars($movie['synopsis'])) ?></p>
    </div>
  </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>