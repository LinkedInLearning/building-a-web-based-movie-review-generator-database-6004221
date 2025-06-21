<?php
// admin/includes/header.php

// Start session if needed
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Protect admin access (optional if using .htaccess or planning login system)
require_once __DIR__ . '/auth.php';
check_auth();


// Shared DB connection + admin DB logic
require_once '../includes/db.php';
require_once '../includes/MovieDB.php';
require_once __DIR__ . '/AdminMovieDB.php';

$db = new Database();
$movieDB = new MovieDB($db);
$adminDB = new AdminMovieDB($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Movie Database Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Movie Admin</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>