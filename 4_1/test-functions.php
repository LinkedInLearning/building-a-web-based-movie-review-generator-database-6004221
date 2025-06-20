<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/MovieDB.php';

$db = new Database();
$movieDB = new MovieDB($db);

// Test: Get all movies
echo "<h2>All Movies</h2>";
$movies = $movieDB->getAllMovies();
foreach ($movies as $movie) {
  echo "<p>{$movie['title']} ({$movie['release_date']})</p>";
}

// Test: Get one movie by ID
echo "<h2>Movie Details (ID = 1)</h2>";
$movie = $movieDB->getMovieById(1);
if ($movie) {
  echo "<p><strong>Title:</strong> {$movie['title']}</p>";
  echo "<p><strong>Genre:</strong> {$movie['genre_name']}</p>";
  echo "<p><strong>Studio:</strong> {$movie['studio_name']}</p>";
} else {
  echo "<p>Movie not found.</p>";
}

// Test: Get actors for movie
echo "<h2>Actors for Movie ID 1</h2>";
$actors = $movieDB->getActorsForMovie(1);
if (count($actors)) {
  echo "<ul>";
  foreach ($actors as $actor) {
    echo "<li>{$actor['name']}</li>";
  }
  echo "</ul>";
} else {
  echo "<p>No actors found.</p>";
}

// Test: Get all genres
echo "<h2>All Genres</h2>";
$genres = $movieDB->getAllGenres();
foreach ($genres as $genre) {
  echo "<p>{$genre['name']}</p>";
}

// Test: Get all studios
echo "<h2>All Studios</h2>";
$studios = $movieDB->getAllStudios();
foreach ($studios as $studio) {
  echo "<p>{$studio['name']}</p>";
}

// Test: Get all actors
echo "<h2>All Actors</h2>";
$allActors = $movieDB->getAllActors();
foreach ($allActors as $actor) {
  echo "<p>{$actor['name']}</p>";
}
