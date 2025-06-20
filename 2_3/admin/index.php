<?php
// admin/index.php
require_once 'includes/auth.php'; // Optional if you're using .htaccess
require_once 'includes/header.php';
?>

<div class="container my-5">
  <h1 class="mb-4">Admin Dashboard</h1>

  <div class="row g-4">
    <div class="col-md-6 col-lg-3">
      <a href="admin/movies.php" class="text-decoration-none">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Manage Movies</h5>
            <p class="card-text">Add, edit, or delete movies.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="actors.php" class="text-decoration-none">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Manage Actors</h5>
            <p class="card-text">Edit the actor list.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="studios.php" class="text-decoration-none">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Manage Studios</h5>
            <p class="card-text">Update studio info and logos.</p>
          </div>
        </div>
      </a>
    </div>

    <div class="col-md-6 col-lg-3">
      <a href="genres.php" class="text-decoration-none">
        <div class="card text-center shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">Manage Genres</h5>
            <p class="card-text">Maintain the genre list.</p>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>