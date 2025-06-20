<?php
include 'includes/header.php';
include 'data/movies.php';

$query = $_GET['q'] ?? '';
$filtered_movies = [];

// Simple case-insensitive title match
if ($query !== '') {
  foreach ($movies as $movie) {
    if (stripos($movie['title'], $query) !== false) {
      $filtered_movies[] = $movie;
    }
  }
}
?>

<h2>Search Results for "<?= htmlspecialchars($query) ?>"</h2>

<?php if (empty($filtered_movies)): ?>
  <div class="alert alert-warning">No movies found.</div>
<?php else: ?>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    <?php foreach ($filtered_movies as $movie): ?>
      <div class="col">
        <div class="card h-100">
          <img src="uploads/posters/<?= $movie['poster'] ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
            <p class="card-text"><?= $movie['release_year'] ?></p>
            <a href="movie.php?id=<?= $movie['movie_id'] ?>" class="btn btn-sm btn-outline-primary">View Details</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>