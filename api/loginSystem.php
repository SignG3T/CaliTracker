<?php
session_start();

if(isset($_POST['uname']) && isset($_POST['pass'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['pass']);

    if(empty($uname)) {
        header('Location: ../index.php?error=Username is required');
        exit();
    } else if(empty($pass)) {
        header('Location: ../index.php?error=Password is required');
        exit();
    } else {
        try {
            $dsn = 'mysql:host=localhost;dbname=caliTracker';
            $username = 'nico';
            $password = 'Anna@1970';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $pdo = new PDO($dsn, $username, $password, $options);

            $sql = "SELECT * FROM users WHERE user_name = :uname AND pass = :pass";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':uname', $uname);
            $stmt->bindParam(':pass', $pass);

            $stmt->execute();

            if($stmt->rowCount() == 1) {
                $row = $stmt->fetch();

                if($row['user_name'] == $uname && $row['pass'] == $pass) {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['id'] = $row['id'];
                    var_dump($_SESSION);
                    session_regenerate_id(true);
                    header('Location: ../homepage.php');
                    exit();
                } else {
                    header('Location: ../index.php?error=Mi sa che hai sbagliato le credenziali! Attento a TE!');
                    exit();
                }
            } else {
                header('Location: ../index.php?error=Mi sa che hai sbagliato le credenziali! Attento a TE!');
                exit();
            }
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
