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
echo "Connected successfully";

$conn->close();
