<?php
  require_once "config.php"; // Include del file di configurazione
  session_start(); /* Starts the session */

  if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
	  exit;
  }
  $rows = array_column(getAllUsers(), 'username');
?>

<!-- Inserire sotto i contenuti protetti da password -->

<!DOCTYPE html>
<html>
  <head>
    <title>Logged in</title>
  </head>
  <body>
    <h2>Lista degli utenti registrati:</h2> 
    <ol>
        <?php foreach ($rows as $row): ?>
            <li><?php echo htmlspecialchars($row); ?> <a href='oneuser.php?username=<?php echo htmlspecialchars($row); ?>'>Dettaglio</a></li>
        <?php endforeach; ?>
    </ol>
    <p><a href="index.php">Vai indietro</a></p>
  </body>
</html>
