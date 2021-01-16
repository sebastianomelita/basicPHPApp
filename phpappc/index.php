<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
//print_r($_COOKIE);

if(!isset($_COOKIE['active']) || ($_COOKIE['active'] != "true")){
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
