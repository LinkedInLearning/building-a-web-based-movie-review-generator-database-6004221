<?php
require_once 'includes/header.php';

$movie_id = $_GET['id'] ?? null;
$is_edit = !empty($movie_id);
$errors = [];
$success = false;

// Load necessary data
$studios = $movieDB->getAllStudios();
$genres = $movieDB->getAllGenres();
$actors = $movieDB->getAllActors();

if ($is_edit) {
  $movie = $movieDB->getMovieById($movie_id);
  $selected_actors = array_column($movieDB->getActorsForMovie($movie_id), 'actor_id');
} else {
  $movie = [
    'title' => '',
    'synopsis' => '',
    'poster' => '',
    'rating' => '',
    'release_date' => '',
    'genre_id' => '',
    'studio_id' => ''
  ];
  $selected_actors = [];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $synopsis = trim($_POST['synopsis']);
  $rating = $_POST['rating'];
  $release_date = $_POST['release_date'];
  $studio_id = $_POST['studio_id'];
  $genre_id = $_POST['genre_id'];
  $actor_ids = $_POST['actors'] ?? [];

  // Validate inputs
  if ($title === '') $errors[] = "Title is required.";
  if (!empty($_FILES['poster']['name'])) {
    $poster_name = uniqid() . '_' . basename($_FILES['poster']['name']);
    $target_path = "../uploads/posters/$poster_name";
    if (!move_uploaded_file($_FILES['poster']['tmp_name'], $target_path)) {
      $errors[] = "Poster upload failed.";
    }
  } else {
    $poster_name = $movie['poster'] ?? null;
  }

  if (empty($errors)) {
    $data = compact('title', 'synopsis', 'poster_name', 'rating', 'release_date', 'studio_id', 'genre_id', 'actor_ids');
    if ($is_edit) {
      $adminDB->updateMovie($movie_id, $data);
    } else {
      $adminDB->addMovie($data);
    }
    $success = true;
    header("Location: movies.php?msg=saved");
    exit;
  }
}
?>

<div class="container mt-4">
  <h2><?= $is_edit ? 'Edit Movie' : 'Add New Movie' ?></h2>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach ($errors as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($movie['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="synopsis" class="form-label">Synopsis</label>
      <textarea class="form-control" name="synopsis" id="synopsis"><?= htmlspecialchars($movie['synopsis']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="poster" class="form-label">Poster</label>
      <?php if (!empty($movie['poster'])): ?>
        <img src="../uploads/posters/<?= htmlspecialchars($movie['poster']) ?>" alt="" style="max-height: 100px;" class="d-block mb-2">
      <?php endif; ?>
      <input class="form-control" type="file" name="poster" id="poster" accept=".jpg,.jpeg,.png">
    </div>

    <div class="mb-3">
      <label for="rating" class="form-label">Rating</label>
      <input type="text" class="form-control" name="rating" id="rating" value="<?= htmlspecialchars($movie['rating']) ?>">
    </div>

    <div class="mb-3">
      <label for="release_date" class="form-label">Release Year</label>
      <input type="number" class="form-control" name="release_date" id="release_date" value="<?= htmlspecialchars($movie['release_date']) ?>" min="1900" max="<?= date('Y') + 5 ?>">
    </div>

    <div class="mb-3">
      <label for="studio_id" class="form-label">Studio</label>
      <select class="form-select" name="studio_id" id="studio_id" required>
        <option value="">Choose Studio</option>
        <?php foreach ($studios as $studio): ?>
          <option value="<?= $studio['studio_id'] ?>" <?= $studio['studio_id'] == $movie['studio_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($studio['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="genre_id" class="form-label">Genre</label>
      <select class="form-select" name="genre_id" id="genre_id" required>
        <option value="">Choose Genre</option>
        <?php foreach ($genres as $genre): ?>
          <option value="<?= $genre['genre_id'] ?>" <?= $genre['genre_id'] == $movie['genre_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($genre['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="actors" class="form-label">Actors</label>
      <select class="form-select" name="actors[]" id="actors" multiple>
        <?php foreach ($actors as $actor): ?>
          <option value="<?= $actor['actor_id'] ?>" <?= in_array($actor['actor_id'], $selected_actors) ? 'selected' : '' ?>>
            <?= htmlspecialchars($actor['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-success"><?= $is_edit ? 'Update Movie' : 'Add Movie' ?></button>
    <a href="movies.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<?php require_once 'includes/footer.php'; ?>