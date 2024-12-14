<?php
$dsn = 'mysql:host=localhost;dbname=caliTracker';
$username = 'nico';
$password = 'Anna@1970';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $username, $password, $options);

$sql = "DELETE FROM massimali WHERE id = :id";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':id', $_GET['task_id']);

$stmt->execute();

header('Location: ../massimali.php');