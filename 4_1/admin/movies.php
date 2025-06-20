<?php
// admin/movies.php
require_once 'includes/auth.php';
require_once __DIR__ . '/../data/movies.php'; // loads $movies array
require_once 'includes/header.php';
?>

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Manage Movies</h1>
    <a href="movie.php" class="btn btn-primary">+ Add Movie</a>
  </div>

  <?php if (empty($movies)): ?>
    <div class="alert alert-info">No movies found. Click "Add Movie" to create one.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Studio</th>
            <th colspan="2" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($movies as $movie): ?>
            <tr>
              <td><?= htmlspecialchars($movie['movie_id']) ?></td>
              <td>
                <img src="../images/<?= htmlspecialchars($movie['poster']) ?>" alt="" width="50">
              </td>
              <td><?= htmlspecialchars($movie['title']) ?></td>
              <td><?= htmlspecialchars($movie['release_year']) ?></td>
              <td><?= htmlspecialchars($movie['genre']) ?></td>
              <td><?= htmlspecialchars($movie['studio']) ?></td>
              <td class="text-center">
                <a href="movie.php?id=<?= urlencode($movie['movie_id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
              </td>
              <td class="text-center">
                <form method="POST" action="movie_delete.php" onsubmit="return confirm('Delete this movie?');">
                  <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movie['movie_id']) ?>">
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>