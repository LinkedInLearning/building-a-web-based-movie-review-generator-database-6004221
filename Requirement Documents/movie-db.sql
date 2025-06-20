-- 🎬 Movie Database SQL Schema

-- 🏢 Studios Table
CREATE TABLE studios (
  studio_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  logo VARCHAR(255) DEFAULT NULL
);

-- 🏷 Genres Table
CREATE TABLE genres (
  genre_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL
);

-- 🧑‍🎤 Actors Table
CREATE TABLE actors (
  actor_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

-- 🎞 Movies Table
CREATE TABLE movies (
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

-- 🎭 Movie-Actor Join Table
CREATE TABLE movie_actor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT NOT NULL,
  actor_id INT NOT NULL,
  FOREIGN KEY (movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
  FOREIGN KEY (actor_id) REFERENCES actors(actor_id) ON DELETE CASCADE
);

-- 👤 Users Table (for Admins + Future Public Users)
CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  role ENUM('admin', 'user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
