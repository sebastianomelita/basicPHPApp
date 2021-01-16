<?php
// Initialize the session
session_start();
 
// Libera (dealloca) tutte le variabili di sessione
session_unset();

// Distrugge tutti I dati registrati in una sessione.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
?>