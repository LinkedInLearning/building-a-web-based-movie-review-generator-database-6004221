<?php
// search-suggest.php
require_once 'includes/db.php';
require_once 'includes/MovieDB.php';

header('Content-Type: application/json');

$db = new Database();
$movieDB = new MovieDB($db);

$q = $_GET['q'] ?? '';
$q = trim($q);

if (strlen($q) < 2) {
  echo json_encode([]);
  exit;
}

$results = $movieDB->searchMoviesByTitle($q);
$titles = array_map(fn($movie) => $movie['title'], $results);

echo json_encode($titles);
