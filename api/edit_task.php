<?php
header('Content-Type: application/json');
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

        // Verifica che i dati siano validi
        if (!$task_id || !$descrizione || !$max) {
            $_SESSION['error'] = "I dati non sono validi o mancanti.";
            header('Location: ../massimali.php');
            exit();
        }

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
                $_SESSION['success'] = "Riga aggiornata con successo!";
            } else {
                $_SESSION['warning'] = "Nessuna riga aggiornata. Probabile che il record non esista o i dati siano uguali.";
            }
        } else {
            $_SESSION['error'] = "Errore durante l'esecuzione della query.";
        }

        // Redirezione con messaggi di stato
        header('Location: ../massimali.php');
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = 'Errore: ' . $e->getMessage();
        header('Location: ../massimali.php');
        exit();
    }

} else {
    header("Location: ../index.php");
    exit();
}
