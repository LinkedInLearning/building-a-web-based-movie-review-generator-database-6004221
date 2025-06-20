<?php
include 'includes/header.php';
$movies = $movieDB->getAllMovies();
?>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
  <?php foreach ($movies as $movie): ?>
    <div class="col">
      <div class="card h-100">
        <img src="<?= getImageOrDefault($movie['poster']) ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($movie['title']) ?></h5>
          <p class="card-text"><?= $movie['release_date'] ?></p>
          <a href="movie.php?id=<?= $movie['movie_id'] ?>" class="btn btn-sm btn-outline-primary">View Details</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>