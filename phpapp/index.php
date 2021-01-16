<?php
  session_start(); /* Starts the session */

  if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
	  exit;
  }
?>

<!-- Inserire sotto i contenuti proteti da password -->

<!DOCTYPE html>
<html>
  <head>
    <title>Logged in</title>
  </head>
  <body>
    <h1>Ciao sei autenticato</h1>
  </body>
</html>
