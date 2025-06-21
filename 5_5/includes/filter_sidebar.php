<?php
// For sidebar filter options
$genres  = $movieDB->getAllGenres();
$studios = $movieDB->getAllStudios();
$years   = $movieDB->getAllYears();
$actors  = $movieDB->getAllActors();
?>


<form method="GET" class="mb-4" action="search.php">
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

  <div class="mb-3">
    <label for="sort" class="form-label">Sort By</label>
    <select class="form-select" name="sort" id="sort">
      <option value="title" <?= $filters['sort'] === 'title' ? 'selected' : '' ?>>Title (A–Z)</option>
      <option value="year_desc" <?= $filters['sort'] === 'year_desc' ? 'selected' : '' ?>>Year (Newest)</option>
      <option value="year_asc" <?= $filters['sort'] === 'year_asc' ? 'selected' : '' ?>>Year (Oldest)</option>
    </select>
  </div>


  <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
</form>