<?php
// layout.php — Admin panel layout with sidebar and nav highlighting
function active($path) {
  return strpos($_SERVER['REQUEST_URI'], $path) !== false ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Movie DB</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Optional Custom CSS -->
  <link rel="stylesheet" href="/assets/css/admin.css" />
</head>
<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="/admin/index.php">🎬 Movie Admin</a>
    <div>
      <a href="/admin/logout.php" class="btn btn-sm btn-outline-light">Logout</a>
    </div>
  </nav>

  <!-- Sidebar + Main Content -->
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 d-none d-md-block bg-dark text-white sidebar py-4 min-vh-100">
        <div class="nav flex-column">
          <a class="nav-link text-white <?= active('/admin/index.php') ?>" href="/admin/index.php">Dashboard</a>
          <a class="nav-link text-white <?= active('/admin/movies') ?>" href="/admin/movies/list.php">Manage Movies</a>
          <a class="nav-link text-white <?= active('/admin/actors') ?>" href="/admin/actors/list.php">Manage Actors</a>
          <a class="nav-link text-white <?= active('/admin/studios') ?>" href="/admin/studios/list.php">Manage Studios</a>
          <a class="nav-link text-white <?= active('/admin/genres') ?>" href="/admin/genres/list.php">Manage Genres</a>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 py-4">
        <?php
          if (function_exists('renderPageContent')) {
            renderPageContent();
          } else {
            echo "<p>No content defined for this page.</p>";
          }
        ?>
      </main>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center py-4 small text-muted">
    &copy; <?= date('Y') ?> Movie Database Admin Panel
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

