<?php
	 require_once "config.php"; // Include del file di configurazione
	 $sbmtuname = $sbmtpassword = "";
     if(isset($_POST['Submit'])){			 // Controlla se il form � stato sottomesso
		$sbmtuname = test_input($_POST["username"]);
		$sbmtpassword = test_input($_POST["password"]);
		$result = password_verify($sbmtpassword, getHashedPsw($sbmtuname)); //Controlla hash
		if($result === true){  
			setcookie("active", "", time() - 3600); // "Expires" 1 ora fa
	    	// Salvataggio dello stato dell�utente 	    
	    	setcookie("active", "true", time() + 7200); //2 hours
	    	header("location:index.php");    // Redirezione pagina autenticata
	    	exit;
		}else {
			echo "ERRORE DI AUTENTICAZIONE";
?>
	 <!-- CODICE HTML ERRORE DI AUTENTICAZIONE -->
<?php
		}
	}
	echo "PAGINA NON AUTENTICATA";
?>     
	<!-- CODICE HTML DEL FORM E DELLA PAGINA NON AUTENTICATA -->
<html>
<head>    
<title>Sign in</title></head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Please sign in</h2>
        <label for="username" >Username</label>
        <input name="username" type="username" id= "username"  placeholder="Username" required 	autofocus>
        <label for="password">Password</label>
        <input name="password" type="password" id="password"  placeholder="Password" required>
        <button name="Submit" value="Login"  type="submit">Sign in</button>
</form>
</body>
</html>

 
	 