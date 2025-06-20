<?php
// /includes/MovieDB.php

require_once __DIR__ . '/db.php';

class MovieDB
{
  private Database $db;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  // Retrieve a basic list of all movies
  public function getAllMovies(): array
  {
    $sql = "SELECT movie_id, title, poster, release_date
                FROM movies
                ORDER BY release_date DESC";
    return $this->db->fetchAll($sql);
  }

  // Retrieve full details for a single movie by ID
  public function getMovieById(int $id): ?array
  {
    $sql = "SELECT m.*, g.name AS genre_name, s.name AS studio_name
                FROM movies m
                LEFT JOIN genres g ON m.genre_id = g.genre_id
                LEFT JOIN studios s ON m.studio_id = s.studio_id
                WHERE m.movie_id = ?";
    return $this->db->fetch($sql, [$id]) ?: null;
  }

  // Retrieve all actors associated with a given movie
  public function getActorsForMovie(int $movie_id): array
  {
    $sql = "SELECT a.actor_id, a.name
                FROM actors a
                INNER JOIN movie_actor ma ON a.actor_id = ma.actor_id
                WHERE ma.movie_id = ?";
    return $this->db->fetchAll($sql, [$movie_id]);
  }

  // Retrieve a list of all genres
  public function getAllGenres(): array
  {
    $sql = "SELECT genre_id, name
                FROM genres
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  // Retrieve a list of all studios
  public function getAllStudios(): array
  {
    $sql = "SELECT studio_id, name, logo
                FROM studios
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  // Retrieve a list of all actors
  public function getAllActors(): array
  {
    $sql = "SELECT actor_id, name
                FROM actors
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  public function getStudioNameById($id)
  {
    $sql = "SELECT name FROM studios WHERE studio_id = ?";
    $result = $this->db->fetch($sql, [$id]);
    return $result ? $result['name'] : null;
  }

  public function getGenreNameById($id)
  {
    $sql = "SELECT name FROM genres WHERE genre_id = ?";
    $result = $this->db->fetch($sql, [$id]);
    return $result ? $result['name'] : null;
  }

  public function getAllYears()
  {
    $sql = "SELECT DISTINCT release_date FROM movies ORDER BY release_date DESC";
    $results = $this->db->fetchAll($sql);
    return array_map(fn($row) => $row['release_date'], $results);
  }
}
