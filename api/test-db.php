<?php
$dsn = 'mysql:host=localhost;dbname=caliTracker';
$username = 'nico';
$password = 'Anna@1970';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $username, $password, $options);

if($pdo) {
  echo "Connected to database";
} else {
  echo "Failed to connect to database";
}