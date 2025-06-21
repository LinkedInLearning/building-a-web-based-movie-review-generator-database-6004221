<?php
require_once 'includes/header.php';

// Instantiate both classes
$adminDB = new AdminMovieDB($db);
$movieDB = new MovieDB($db);

// Get all movies
$movies = $movieDB->getAllMovies();
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Movies</h2>
    <a href="movie.php" class="btn btn-primary">Add New Movie</a>
  </div>

  <?php if (empty($movies)): ?>
    <div class="alert alert-warning">No movies found.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Studio</th>
            <th>Actors</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($movies as $movie): ?>
            <?php
            $genre = $movieDB->getGenreNameById($movie['genre_id']);
            $studio = $movieDB->getStudioNameById($movie['studio_id']);
            $actors = $movieDB->getActorsForMovie($movie['movie_id']);
            ?>
            <tr>
              <td>
                <img src="../uploads/posters/<?= htmlspecialchars($movie['poster'] ?? 'placeholder.png') ?>" alt="" class="img-thumbnail" style="max-width: 80px;">
              </td>
              <td><?= htmlspecialchars($movie['title']) ?></td>
              <td><?= htmlspecialchars($movie['release_date']) ?></td>
              <td><?= htmlspecialchars($genre) ?></td>
              <td><?= htmlspecialchars($studio) ?></td>
              <td>
                <?php if (!empty($actors)): ?>
                  <ul class="mb-0 ps-3">
                    <?php foreach ($actors as $actor): ?>
                      <li><?= htmlspecialchars($actor['name']) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <em>No actors</em>
                <?php endif; ?>
              </td>
              <td>
                <a href="movie.php?id=<?= $movie['movie_id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="delete_movie.php?id=<?= $movie['movie_id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this movie?')">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>