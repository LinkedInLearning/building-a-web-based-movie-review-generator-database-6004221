<?php
require_once 'includes/header.php';

$query = $_GET['q'] ?? '';
$filters = [
  'q'      => $query,
  'genre'  => $_GET['genre'] ?? '',
  'studio' => $_GET['studio'] ?? '',
  'year'   => $_GET['year'] ?? '',
  'actor'  => $_GET['actor'] ?? ''
];

$filtered_movies = $movieDB->filterMovies($filters);

// For sidebar filter options
$genres  = $movieDB->getAllGenres();
$studios = $movieDB->getAllStudios();
$years   = $movieDB->getAllYears();
$actors  = $movieDB->getAllActors();
?>

<div class="container mt-4">
  <h2>Search Results<?= $query ? ' for "' . htmlspecialchars($query) . '"' : '' ?></h2>

  <div class="row">
    <div class="col-md-3">
      <form method="GET" class="mb-4">
        <input type="hidden" name="q" value="<?= htmlspecialchars($query) ?>">

        <div class="mb-3">
          <label for="genre" class="form-label">Genre</label>
          <select class="form-select" name="genre" id="genre">
            <option value="">All</option>
            <?php foreach ($genres as $genre): ?>
              <option value="<?= $genre['genre_id'] ?>" <?= $filters['genre'] == $genre['genre_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($genre['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="studio" class="form-label">Studio</label>
          <select class="form-select" name="studio" id="studio">
            <option value="">All</option>
            <?php foreach ($studios as $studio): ?>
              <option value="<?= $studio['studio_id'] ?>" <?= $filters['studio'] == $studio['studio_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($studio['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="year" class="form-label">Year</label>
          <select class="form-select" name="year" id="year">
            <option value="">All</option>
            <?php foreach ($years as $year): ?>
              <option value="<?= $year ?>" <?= $filters['year'] == $year ? 'selected' : '' ?>>
                <?= $year ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="actor" class="form-label">Actor</label>
          <select class="form-select" name="actor" id="actor">
            <option value="">All</option>
            <?php foreach ($actors as $actor): ?>
              <option value="<?= $actor['actor_id'] ?>" <?= $filters['actor'] == $actor['actor_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($actor['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
      </form>
    </div>

    <div class="col-md-9">
      <?php if (empty($filtered_movies)): ?>
        <div class="alert alert-warning">No movies found.</div>
      <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
          <?php foreach ($filtered_movies as $movie): ?>
            <div class="col">
              <div class="card h-100">
                <img src="uploads/posters/<?= htmlspecialchars($movie['poster'] ?? 'placeholder.png') ?>" class="card-img-top" alt="<?= htmlspecialchars($movie['title']) ?>">
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

<?php require_once 'includes/footer.php'; ?>