<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  session_regenerate_id(true);

  $dsn = 'mysql:host=localhost;dbname=caliTracker';
  $username = 'nico';
  $password = 'Anna@1970';
  $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ];

  try {
      $pdo = new PDO($dsn, $username, $password, $options);

      // Recupero e sanitizzazione dei dati
      $task_id = filter_input(INPUT_GET, 'task_id', FILTER_SANITIZE_NUMBER_INT);
      $descrizione = filter_input(INPUT_GET, 'descrizione', FILTER_SANITIZE_STRING);
      $max = filter_input(INPUT_GET, 'max', FILTER_SANITIZE_STRING);
      
      // Prepara la query di aggiornamento
      $sql = "UPDATE massimali SET descrizione = :descrizione, max = :max WHERE id = :id;";
      $stmt = $pdo->prepare($sql);

      // Bind dei parametri
      $stmt->bindParam(':descrizione', $descrizione);
      $stmt->bindParam(':max', $max);
      $stmt->bindParam(':id', $task_id, PDO::PARAM_INT);

      // Esecuzione della query
      if ($stmt->execute()) {
          $rowsAffected = $stmt->rowCount();
          if ($rowsAffected > 0) {
              echo "Riga aggiornata con successo!";
          } else {
              echo "Nessuna riga aggiornata. Probabile che il record non esista o i dati siano uguali.";
          }
      } else {
          echo "Errore durante l'esecuzione della query.";
      }

      // Redirezione
      header('Location: ../massimali.php');
      exit();

  } catch (PDOException $e) {
      echo 'Errore: ' . $e->getMessage();
  }

} else {
  header("Location: ../index.php");
  exit();
}