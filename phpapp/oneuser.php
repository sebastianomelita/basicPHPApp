<?php
  require_once "config.php"; // Include del file di configurazione
  session_start(); /* Starts the session */

  if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
	exit;
  }
  
  if(isset($_GET['username'])){			 // Controlla se il form è stato sottomesso
		$user = test_input($_GET["username"]);
		$row = getOneUser($user);
		if(!empty($row)){
		    extract($row); //restituisce tante variabili quanti sono i campi aventi il nome del campo stesso
		}else{
		    header("location:index.php");
		}
 ?>
	<!DOCTYPE html>
	<html>
	  <head>
		<title>Logged in</title>
	  </head>
	  <body>
		<h2>Dettaglio utente <?php echo $username ?></h2> 
		<p><strong>ID:</strong> <?php echo $id ?></p>
		<p><strong>Data inserimento:</strong> <?php echo $created_at ?></p>
		<p><a href="index.php">Vai indietro</a></p>
	  </body>
	</html>	
<?php		
  }else{ 
?>
	<!DOCTYPE html>
	<html>
	<head>    
	<title>Sign in</title></head>
	<body>
	<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Please give your username</h2>
			<label for="username" >Username</label>
			<input name="username" type="username" id= "username"  placeholder="Username" required 	autofocus>
			<button name="Submit" value="Submit"  type="submit">Submit</button>
	</form>
	</body>
	</html>
<?php		
  }
?>
