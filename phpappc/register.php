<?php
require_once "config.php"; // Include del file di configurazione
$username = $password = $confirm_password = "";
$reg_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){//Processamento del form
		$username = test_input($_POST["username"]);
		if(validate_usr($reg_err, $username)){
			$password = test_input($_POST["password"]); 
			$confirm_password = test_input($_POST["confirm_password"]);
			if(validate_psw($reg_err, $password, $confirm_password )){
				if(insert_user($username,$password)){
					header("location: login.php");//Redirect to login page
				} else{
					echo "Errore insert. ";
				}
			}else{
				echo "Errore validate password: ".$reg_err;
			}
		}else{
			echo "Errore validate user: ".$reg_err;
		}
}
?>
	<!-- CODICE HTML DEL FORM  -->
<html>
<head>    
<title>Register</title></head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="Login_Form">
        <h2 >Please Register</h2>
        <label for="username" >Username</label>
        <input name="username" type="username" id= " username"  placeholder="Username" required autofocus>
        <label for="password">Password</label>
        <input name="password" type="password" id="password"  placeholder="Password" required>
		<label for="confirmPassword">Confirm password</label>
		<input name="confirm_password" type="password" id="confirm_password"  placeholder="Confirm password" required></br>
        <button name="Submit" value="Login"  type="submit">Sign in</button>
</form>
</body>
</html>
