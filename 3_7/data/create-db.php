<?php
$host = '127.0.0.1';
$user = 'mariadb';
$password = 'mariadb';
$database = 'mariadb';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Full SQL schema
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS studios (
  studio_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  logo VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS genres (
  genre_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS actors (
  actor_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS movies (
  movie_id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  synopsis TEXT,
  poster VARCHAR(255) DEFAULT NULL,
  rating VARCHAR(10),
  release_date YEAR,
  studio_id INT,
  genre_id INT,
  FOREIGN KEY (studio_id) REFERENCES studios(studio_id) ON DELETE SET NULL,
  FOREIGN KEY (genre_id) REFERENCES genres(genre_id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS movie_actor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT NOT NULL,
  actor_id INT NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
  FOREIGN KEY (actor_id) REFERENCES actors(actor_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  role ENUM('admin', 'user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
SQL;

// Run multi-query
if ($conn->multi_query($sql)) {
  do {
    if ($result = $conn->store_result()) {
      $result->free();
    }
  } while ($conn->next_result());
  echo "Database schema installed successfully.";
} else {
  echo "Error running SQL: " . $conn->error;
}

$conn->close();
