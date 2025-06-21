<?php
// admin/includes/auth.php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

define('ADMIN_PASSWORD', 'letmein123'); // Change this to your preferred password

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
  if ($_POST['password'] === ADMIN_PASSWORD) {
    $_SESSION['logged_in'] = true;

    // Redirect to the original page or fallback
    $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
    unset($_SESSION['redirect_after_login']);
    header("Location: $redirect");
    exit;
  } else {
    $error = "Incorrect password.";
  }
}

// Check auth status
function check_auth()
{
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit;
  }
}
