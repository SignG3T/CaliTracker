<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $descrizione= validate($_POST['descrizione']);
    $max = validate($_POST['max']);

    if(empty($descrizione)) {
        header('Location: ../massimali.php?error=Description is required');
        exit();
    } else {
        if(empty($max)) {
            $max = '0x0';
        }
        try {
            $dsn = 'mysql:host=localhost;dbname=caliTracker';
            $username = 'nico';
            $password = 'Anna@1970';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $pdo = new PDO($dsn, $username, $password, $options);

            $sql = "INSERT INTO `massimali`(`descrizione`, `max`) VALUES (:descrizione, :max)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descrizione', $descrizione);
            $stmt->bindParam(':max', $max);

            $stmt->execute();

            header('Location: ../massimali.php');
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
