<?php
// /includes/AdminMovieDB.php

require_once '../includes/db.php';

class AdminMovieDB
{
  private Database $db;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }

  // ===== MOVIES =====

  public function addMovie(array $data): int
  {
    $sql = "INSERT INTO movies (title, synopsis, poster, rating, release_date, genre_id, studio_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    $this->db->query($sql, [
      $data['title'],
      $data['synopsis'],
      $data['poster'],
      $data['rating'],
      $data['release_date'],
      $data['genre_id'],
      $data['studio_id']
    ]);
    return (int) $this->db->lastInsertId();
  }

  public function updateMovie(int $movie_id, array $data): void
  {
    $sql = "UPDATE movies SET title = ?, synopsis = ?, poster = ?, rating = ?, release_date = ?, genre_id = ?, studio_id = ?
                WHERE movie_id = ?";
    $this->db->query($sql, [
      $data['title'],
      $data['synopsis'],
      $data['poster'],
      $data['rating'],
      $data['release_date'],
      $data['genre_id'],
      $data['studio_id'],
      $movie_id
    ]);
  }

  public function deleteMovie(int $movie_id): void
  {
    $this->db->query("DELETE FROM movies WHERE movie_id = ?", [$movie_id]);
  }

  // ===== MOVIE ACTOR RELATIONSHIPS =====

  public function setMovieActors(int $movie_id, array $actor_ids): void
  {
    $this->db->query("DELETE FROM movie_actor WHERE movie_id = ?", [$movie_id]);

    foreach ($actor_ids as $actor_id) {
      $this->db->query("INSERT INTO movie_actor (movie_id, actor_id) VALUES (?, ?)", [
        $movie_id,
        $actor_id
      ]);
    }
  }

  public function clearActorsForMovie(int $movie_id): void
  {
    $sql = "DELETE FROM movie_actor WHERE movie_id = ?";
    $this->db->query($sql, [$movie_id]);
  }


  public function addActorToMovie(int $movie_id, int $actor_id): void
  {
    $sql = "INSERT INTO movie_actor (movie_id, actor_id) VALUES (?, ?)";
    $this->db->query($sql, [$movie_id, $actor_id]);
  }


  // ===== GENRES =====

  public function addGenre(string $name): void
  {
    $this->db->query("INSERT INTO genres (name) VALUES (?)", [$name]);
  }

  public function updateGenre(int $genre_id, string $name): void
  {
    $this->db->query("UPDATE genres SET name = ? WHERE genre_id = ?", [$name, $genre_id]);
  }

  public function deleteGenre(int $genre_id): void
  {
    $this->db->query("DELETE FROM genres WHERE genre_id = ?", [$genre_id]);
  }

  // ===== STUDIOS =====

  public function addStudio(string $name, ?string $logo): void
  {
    $this->db->query("INSERT INTO studios (name, logo) VALUES (?, ?)", [$name, $logo]);
  }

  public function updateStudio(int $studio_id, string $name, ?string $logo): void
  {
    $this->db->query("UPDATE studios SET name = ?, logo = ? WHERE studio_id = ?", [$name, $logo, $studio_id]);
  }

  public function deleteStudio(int $studio_id): void
  {
    $this->db->query("DELETE FROM studios WHERE studio_id = ?", [$studio_id]);
  }

  // ===== ACTORS =====

  public function addActor(string $name): void
  {
    $this->db->query("INSERT INTO actors (name) VALUES (?)", [$name]);
  }

  public function updateActor(int $actor_id, string $name): void
  {
    $this->db->query("UPDATE actors SET name = ? WHERE actor_id = ?", [$name, $actor_id]);
  }

  public function deleteActor(int $actor_id): void
  {
    $this->db->query("DELETE FROM actors WHERE actor_id = ?", [$actor_id]);
  }
}
