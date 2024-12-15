<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  session_regenerate_id(true);

  try {
    // Configurazione database
    $dsn = 'mysql:host=localhost;dbname=caliTracker';
    $username = 'nico';
    $password = 'Anna@1970';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);

    // Query per ottenere i dati
    $sql = "SELECT * FROM massimali";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CaliTracker - Massimali</title>
  <link rel="stylesheet" href="static/css/massimali.css">
</head>
<body>
  <div class="container">
    <h1>CaliTracker - Massimali</h1>
    <a class="backHomepage" href="/homepage.php">Torna alla homepage</a>
    <div class="interactive-container">
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Descrizione</th>
              <th>Max</th>
              <th>Azioni</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while ($fetch = $stmt->fetch()) {
                $id = $fetch['id'];
                $descrizione = $fetch['descrizione'];
                $max = $fetch['max'];
            ?>
            <tr class="border-bottom">
              <td><?php echo htmlspecialchars($fetch['descrizione']); ?></td>
              <td><?php echo htmlspecialchars($fetch['max']); ?></td>
              <td>
              <a href="javascript:void(0);" class="btn-edit" onclick="confirmEdit(<?php echo $id; ?>, '<?php echo addslashes($fetch['descrizione']); ?>', '<?php echo $fetch['max']; ?>')">✏️</a>
                <a href="javascript:void(0);" class="btn-remove" onclick="confirmDelete(<?php echo $fetch['id']; ?>)">❌</a>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Modulo per aggiungere una Task -->
      <div class="add-task-container">
        <h2>Aggiungi un esercizio</h2>

        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <form action="api/add_task.php" method="post">
          <input type="text" id="descrizione-add" name="descrizione" placeholder="Descrizione" required>
          <input type="text" id="max-add" name="max" placeholder="Massimali">
          <button type="submit">Conferma</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal di conferma di eliminazione-->
  <div id="confirmationModalDelete" class="modalDelete" style="display: none;">
    <div class="modal-content-delete">
      <p>Sei sicuro di voler eliminare questa task?</p>
      <button id="confirmActionDelete">Conferma</button>
      <button id="cancelActionDelete">Annulla</button>
    </div>
  </div>

    <!-- Modal di conferma di modifica-->
  <div id="confirmationModalEdit" class="modalEdit" style="display: none;">
    <div class="modal-content-edit">
      <p>Modifica task</p>
      <form method="post">
        <input type="text" name="descEdit" id="descEdit" placeholder="Push Up, Chin Up..."></input>
        <input type="text" name="maxEdit" id="maxEdit" placeholder="Massimali"></input>
      </form>

      <button id="confirmActionEdit">Conferma</button>
      <button id="cancelActionEdit">Annulla</button>
    </div>
  </div>

  <script src="./static/js/editBtn.js"></script>
  <script src="./static/js/removeBtn.js"></script>
</body>
</html>

<?php
  } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }
} else {
  header("Location: index.php");
  exit();
}
?>
