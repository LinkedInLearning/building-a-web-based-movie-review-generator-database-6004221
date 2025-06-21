<?php
// /includes/MovieDB.php

require_once __DIR__ . '/db.php';

/**
 * Class MovieDB
 *
 * Provides methods for interacting with the movie database, including
 * retrieving movies, genres, studios, actors, and performing searches and filters.
 */
class MovieDB
{
  /**
   * @var Database Database connection instance
   */
  private Database $db;

  /**
   * MovieDB constructor.
   *
   * @param Database $db Database connection instance
   */
  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  /**
   * Retrieve a basic list of all movies with genre and studio information.
   *
   * @return array List of movies
   */
  public function getAllMovies(): array
  {
    $sql = "SELECT 
  m.movie_id,
  m.title,
  m.poster,
  m.release_date,
  m.genre_id,
  g.name AS genre_name,
  m.studio_id,
  s.name AS studio_name
FROM movies m
LEFT JOIN genres g ON m.genre_id = g.genre_id
LEFT JOIN studios s ON m.studio_id = s.studio_id
ORDER BY m.release_date DESC";
    return $this->db->fetchAll($sql);
  }

  /**
   * Retrieve full details for a single movie by its ID.
   *
   * @param int $id Movie ID
   * @return array|null Movie details or null if not found
   */
  public function getMovieById(int $id): ?array
  {
    $sql = "SELECT m.*, g.name AS genre_name, s.name AS studio_name
                FROM movies m
                LEFT JOIN genres g ON m.genre_id = g.genre_id
                LEFT JOIN studios s ON m.studio_id = s.studio_id
                WHERE m.movie_id = ?";
    return $this->db->fetch($sql, [$id]) ?: null;
  }

  /**
   * Retrieve all actors associated with a given movie.
   *
   * @param int $movie_id Movie ID
   * @return array List of actors
   */
  public function getActorsForMovie(int $movie_id): array
  {
    $sql = "SELECT a.actor_id, a.name
                FROM actors a
                INNER JOIN movie_actor ma ON a.actor_id = ma.actor_id
                WHERE ma.movie_id = ?";
    return $this->db->fetchAll($sql, [$movie_id]);
  }

  /**
   * Retrieve a list of all genres.
   *
   * @return array List of genres
   */
  public function getAllGenres(): array
  {
    $sql = "SELECT genre_id, name
                FROM genres
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  /**
   * Retrieve a list of all studios.
   *
   * @return array List of studios
   */
  public function getAllStudios(): array
  {
    $sql = "SELECT studio_id, name, logo
                FROM studios
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  /**
   * Retrieve a list of all actors.
   *
   * @return array List of actors
   */
  public function getAllActors(): array
  {
    $sql = "SELECT actor_id, name
                FROM actors
                ORDER BY name ASC";
    return $this->db->fetchAll($sql);
  }

  /**
   * Get the name of an actor by their ID.
   *
   * @param int $id Actor ID
   * @return string|null Actor name or null if not found
   */
  public function getActorNameById(int $id): ?string
  {
    $result = $this->db->query("SELECT name FROM actors WHERE actor_id = ?", [$id])->fetch();
    return $result ? $result['name'] : null;
  }

  /**
   * Get the name of a studio by its ID.
   *
   * @param int $id Studio ID
   * @return string|null Studio name or null if not found
   */
  public function getStudioNameById($id)
  {
    $sql = "SELECT name FROM studios WHERE studio_id = ?";
    $result = $this->db->fetch($sql, [$id]);
    return $result ? $result['name'] : null;
  }

  /**
   * Get the name of a genre by its ID.
   *
   * @param int $id Genre ID
   * @return string|null Genre name or null if not found
   */
  public function getGenreNameById($id)
  {
    $sql = "SELECT name FROM genres WHERE genre_id = ?";
    $result = $this->db->fetch($sql, [$id]);
    return $result ? $result['name'] : null;
  }

  /**
   * Retrieve a list of all unique release years.
   *
   * @return array List of years
   */
  public function getAllYears()
  {
    $sql = "SELECT DISTINCT release_date FROM movies ORDER BY release_date DESC";
    $results = $this->db->fetchAll($sql);
    return array_map(fn($row) => $row['release_date'], $results);
  }

  /**
   * Search for movies by title.
   *
   * @param string $query Search query
   * @return array List of matching movies
   */
  public function searchMoviesByTitle($query)
  {
    $sql = "SELECT * FROM movies WHERE title LIKE ?";
    return $this->db->fetchAll($sql, ["%{$query}%"]);
  }

  /**
   * Filter movies based on various criteria.
   *
   * @param array $filters Associative array of filters (q, genre, studio, year, actor, sort)
   * @return array List of filtered movies
   */
  public function filterMovies(array $filters): array
  {
    $sql = "SELECT DISTINCT m.*
            FROM movies m
            LEFT JOIN movie_actor ma ON m.movie_id = ma.movie_id
            WHERE 1=1";
    $params = [];

    if (!empty($filters['q'])) {
      $sql .= " AND m.title LIKE ?";
      $params[] = '%' . $filters['q'] . '%';
    }

    if (!empty($filters['genre'])) {
      $sql .= " AND m.genre_id = ?";
      $params[] = $filters['genre'];
    }

    if (!empty($filters['studio'])) {
      $sql .= " AND m.studio_id = ?";
      $params[] = $filters['studio'];
    }

    if (!empty($filters['year'])) {
      $sql .= " AND m.release_date = ?";
      $params[] = $filters['year'];
    }

    if (!empty($filters['actor'])) {
      $sql .= " AND ma.actor_id = ?";
      $params[] = $filters['actor'];
    }

    switch ($filters['sort'] ?? '') {
      case 'year_desc':
        $sql .= " ORDER BY m.release_date DESC";
        break;
      case 'year_asc':
        $sql .= " ORDER BY m.release_date ASC";
        break;
      default:
        $sql .= " ORDER BY m.title ASC";
    }

    return $this->db->fetchAll($sql, $params);
  }
}
