<?php
function renderPageContent() {
?>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Admin Dashboard</h1>
  </div>

  <div class="row g-4">
    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <h5 class="card-title">🎬 Movies</h5>
          <p class="card-text">Add, edit, or remove movies</p>
          <a href="/admin/movies/list.php" class="btn btn-primary btn-sm">Manage Movies</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <h5 class="card-title">🎭 Actors</h5>
          <p class="card-text">Edit actor names and associations</p>
          <a href="/admin/actors/list.php" class="btn btn-primary btn-sm">Manage Actors</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <h5 class="card-title">🏢 Studios</h5>
          <p class="card-text">Add or modify studio records</p>
          <a href="/admin/studios/list.php" class="btn btn-primary btn-sm">Manage Studios</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
          <h5 class="card-title">📂 Genres</h5>
          <p class="card-text">Maintain the fixed list of genres</p>
          <a href="/admin/genres/list.php" class="btn btn-primary btn-sm">Manage Genres</a>
        </div>
      </div>
    </div>
  </div>
<?php
}
include 'layout.php';
