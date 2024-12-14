<!-- index.php -->

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CaliTracker - Login</title>
  <link rel="stylesheet" href="static/css/index.css">
</head>
<body>
  <div class="container">
    <div class="welcome-section">
      <h1>Benvenuto nel CaliTracker</h1>
      <p>Accedi per gestire i tuoi allenamenti di calisthenics e monitorare i progressi. Con il nostro sistema, puoi impostare massimali, timer e scegliere tra varie modalità di allenamento come EMOM e AMRAP.</p>
    </div>

    <div class="login-container">
      <h2>Accedi</h2>
      <form action="api/loginSystem.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label for="uname">Nome utente</label>
        <input type="text" id="uname" name="uname">

        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass">

        <button type="submit">Accedi</button>

        <p class="copyright">Nicolò D'Aniello</p>
      </form>
    </div>
  </div>
</body>
</html>
