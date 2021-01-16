<?php
// Logoff, basta impostare il cookie a stringa vuota e come già Scaduto da un’ora
setcookie("active", "", time() - 3600); // "Expires" 1 ora fa
setcookie("active", false);
unset($_COOKIE["active"]);
?>
