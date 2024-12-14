<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
  session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CaliTracker - HomePage</title>
  <link rel="stylesheet" href="static/css/homepage.css">
</head>
<body>
  <div class="container">
    <h1>CaliTracker</h1>

    <div class="mode-selector-container">
      <a style="background-color:#2F2F2F;" href="massimali.php" class="modeBtn">Massimali</a>
      <a style="background-color:#003366;" href="" class="modeBtn">Timer</a>
      <a style="background-color:#556B2F;" href="" class="modeBtn">Cronometro</a>
      <a style="background-color:#800020;" href="" class="modeBtn">Amrap</a>
      <a style="background-color:#3E2723;" href="" class="modeBtn">Emom</a>
      <a style="background-color:#004D4D;" href="" class="modeBtn">Registri</a>
    </div>
  </div>
</body>
</html>

<?php
} else {
  header("location: index.php");
} 