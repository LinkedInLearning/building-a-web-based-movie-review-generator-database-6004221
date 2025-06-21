<?php
// /includes/db.php

class Database
{
  private $host = '127.0.0.1';
  private $user = 'mariadb';
  private $pass = 'mariadb';
  private $db = 'mariadb';
  private $charset = 'utf8mb4';

  private $pdo;

  public function __construct()
  {
    $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false, // true can lead to security issues with edge cases
    ];

    try {
      $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      // Log error to a file in production instead
      exit('Database connection failed: ' . $e->getMessage());
    }
  }

  // Run a prepared statement with optional parameters
  public function query(string $sql, array $params = [])
  {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  // Get one row
  public function fetch(string $sql, array $params = [])
  {
    return $this->query($sql, $params)->fetch();
  }

  // Get all rows
  public function fetchAll(string $sql, array $params = [])
  {
    return $this->query($sql, $params)->fetchAll();
  }

  // Get the ID of the last inserted row
  public function lastInsertId(): string
  {
    return $this->pdo->lastInsertId();
  }

  // Optional: expose raw PDO object if needed
  public function getPDO(): PDO
  {
    return $this->pdo;
  }
}
