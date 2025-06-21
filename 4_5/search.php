<?php
require_once 'includes/header.php';

$query = $_GET['q'] ?? '';
$filters = [
  'genre_id' => $_GET['genre_id'] ?? null,
  'studio_id' => $_GET['studio_id'] ?? null,
  'year' => $_GET['year'] ?? null,
  'actor' => $_GET['actor'] ?? null
];

// Optional: If "q" exists, apply as a partial title search too
if ($query !== '') {
  // Pass query to a custom filter method (title and other filters)
  $movies = $movieDB->filterMovies(array_merge($filters, ['title' => $query]));
  $search_label = 'Search Results for "' . htmlspecialchars($query) . '"';
} else {
  $movies = $movieDB->filterMovies($filters);
  $search_label = 'Filtered Results';
}
?>

<div class="container mt-4">
  <h2><?= $search_label ?></h2>

  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-3 mb-4">
      <?php include 'includes/filter_sidebar.php'; ?>
    </div>

    <!-- Movie Results -->
    <div class="col-md-9">
      <?php if (empty($movies)): ?>
        <div class="alert alert-warning">No movies found.</div>
      <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
          <?php foreach ($movies as $movie): ?>
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
  </div>
</div>

<?php include 'includes/footer.php'; ?>