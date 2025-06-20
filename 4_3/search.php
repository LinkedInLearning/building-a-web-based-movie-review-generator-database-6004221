<?php
require_once 'includes/header.php';

$query = $_GET['q'] ?? '';
$filtered_movies = [];

if ($query !== '') {
  $filtered_movies = $movieDB->searchMoviesByTitle($query);
}
?>

<div class="container mt-4">
  <h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>

  <?php if (empty($filtered_movies)): ?>
    <div class="alert alert-warning">No movies found.</div>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
      <?php foreach ($filtered_movies as $movie): ?>
        <div class="col">
          <div class="card h-100">
            <img src="uploads/posters/<?= htmlspecialchars($movie['poster']) ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($movie['release_date']) ?></p>
              <a href="movie.php?id=<?= $movie['movie_id'] ?>" class="btn btn-sm btn-outline-primary">View Details</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>