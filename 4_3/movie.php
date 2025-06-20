<?php
include 'includes/header.php';

$movie_id = $_GET['id'] ?? null;

if (!$movie_id) {
  echo "<div class='alert alert-danger'>No movie ID provided.</div>";
  include 'includes/footer.php';
  exit;
}

// Get movie details
$movie = $movieDB->getMovieById($movie_id);
$actors = $movieDB->getActorsForMovie($movie_id);

if (!$movie) {
  echo "<div class='alert alert-warning'>Movie not found.</div>";
  include 'includes/footer.php';
  exit;
}
?>

<div class="row">
  <div class="col-md-4">
    <img src="<?= getImageOrDefault($movie['poster']) ?>" class="img-fluid" alt="<?= htmlspecialchars($movie['title']) ?>">
  </div>
  <div class="col-md-8">
    <h1><?= htmlspecialchars($movie['title']) ?></h1>
    <p><strong>Release Year:</strong> <?= date('Y', strtotime($movie['release_date'])) ?></p>
    <p><strong>Rating:</strong> <?= $movie['rating'] ?></p>
    <p><strong>Genre:</strong> <?= $movieDB->getGenreNameById($movie['genre_id']) ?></p>
    <p><strong>Studio:</strong> <?= $movieDB->getStudioNameById($movie['studio_id']) ?></p>
    <p><strong>Synopsis:</strong> <?= nl2br(htmlspecialchars($movie['synopsis'])) ?></p>
    <p><strong>Actors:</strong>
      <?= empty($actors)
        ? 'None listed.'
        : implode(', ', array_column($actors, 'name')) ?>
    </p>
  </div>
</div>

<?php include 'includes/footer.php'; ?>