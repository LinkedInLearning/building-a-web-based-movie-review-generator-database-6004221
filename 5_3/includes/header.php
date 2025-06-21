<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/MovieDB.php';
require_once __DIR__ . '/functions.php';

$db = new Database(); // Create Database connection
$movieDB = new MovieDB($db); // Pass it into MovieDB

$query = $_GET['q'] ?? '';
$filters = [
  'q'      => $query,
  'genre'  => $_GET['genre'] ?? '',
  'studio' => $_GET['studio'] ?? '',
  'year'   => $_GET['year'] ?? '',
  'actor'  => $_GET['actor'] ?? '',
  'sort'  => $_GET['sort'] ?? '',
];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movie Database</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg mb-4 bg-dark navbar-dark">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand" href="index.php">MovieDB</a>

      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="search.php">Search and Filter</a></li>
      </ul>

      <form class="d-flex ms-auto" action="search.php" method="get" role="search">
        <input
          class="form-control me-2"
          type="search"
          name="q"
          placeholder="Search movies..."
          value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
          aria-label="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <div class="container">