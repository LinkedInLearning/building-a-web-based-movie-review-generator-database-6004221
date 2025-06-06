<?php
function renderPageContent() {
  // Placeholder: Replace this with a real DB call
  $movies = [
    ['id' => 1, 'title' => 'Inception', 'year' => 2010, 'rating' => 'PG-13'],
    ['id' => 2, 'title' => 'The Matrix', 'year' => 1999, 'rating' => 'R']
  ];
?>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Movies</h1>
    <a href="form.php" class="btn btn-success">Add New Movie</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Year</th>
        <th>Rating</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($movies as $movie): ?>
        <tr>
          <td><?= htmlspecialchars($movie['title']) ?></td>
          <td><?= $movie['year'] ?></td>
          <td><?= $movie['rating'] ?></td>
          <td>
            <a href="form.php?id=<?= $movie['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="form.php?id=<?= $movie['id'] ?>&delete=1" class="btn btn-sm btn-danger" onclick="return confirm('Delete this movie?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php
}
include '../layout.php';
