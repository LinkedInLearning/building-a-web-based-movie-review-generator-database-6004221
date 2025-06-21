<form method="GET" action="search.php">
  <div class="mb-3">
    <label for="genre" class="form-label">Genre</label>
    <select name="genre_id" id="genre" class="form-select">
      <option value="">All Genres</option>
      <?php foreach ($movieDB->getAllGenres() as $genre): ?>
        <option value="<?= $genre['genre_id'] ?>" <?= ($_GET['genre_id'] ?? '') == $genre['genre_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($genre['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="studio" class="form-label">Studio</label>
    <select name="studio_id" id="studio" class="form-select">
      <option value="">All Studios</option>
      <?php foreach ($movieDB->getAllStudios() as $studio): ?>
        <option value="<?= $studio['studio_id'] ?>" <?= ($_GET['studio_id'] ?? '') == $studio['studio_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($studio['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="mb-3">
    <label for="year" class="form-label">Year</label>
    <input type="number" name="year" id="year" class="form-control" placeholder="e.g. 2023" value="<?= htmlspecialchars($_GET['year'] ?? '') ?>">
  </div>

  <div class="mb-3">
    <label for="actor" class="form-label">Actor Name</label>
    <input type="text" name="actor" id="actor" class="form-control" placeholder="e.g. Jane Ray" value="<?= htmlspecialchars($_GET['actor'] ?? '') ?>">
  </div>

  <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
</form>