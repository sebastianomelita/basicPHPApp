<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'b_utente21');
define('DB_PASSWORD', 'b_utente21');
define('DB_NAME', 'b_phpapp_utente21');
 
// Create connection
$conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

// Check connection
if ($conn -> connect_errno) {
  echo "Non rieco a connettermi: " . $mysqli -> connect_error;
  exit();
}

// funzioni
function test_input($x) {
  $x = trim($x);
  $x = stripslashes($x);
  $x = htmlspecialchars($x);
  return $x;
}

function validate_usr(&$err,$username){
    $ok=false;
	global $conn;
	
    if(empty($username)){
        $err = "Prego inserire un nome utente.";
    }else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
		if($stmt){
			$stmt->bind_param ("s", $param_username);
			$param_username = $username;
			if($stmt->execute()){
				$stmt->store_result();
                if ($stmt->num_rows == 0){
					$ok = true;
				}else{
                    $err = "Questo username è già in uso."; 
                } 
            }else{
				$err = "Errore non definito. Riprovare più tardi.";
            }
			$stmt->close();
        }
   }
   return $ok;
}

function validate_psw(&$err,$password,$conf_password){
    $ok = false;
	
    if(empty($password)){
        $err = "Prego inserire una password.";     
    }elseif(strlen($password) < 6){
        $err = "La password deve avere almeno 6 caratteri.";
    }else{
		$conf_password = trim($conf_password);
		if(empty($conf_password)){
			$err = "Prego inserire la conferma della password.";     
		}else{
			if($password == $conf_password){
				$ok = true;
			}else{
				$err = "Le due password non corrispondono.";
			}
		}
    } 
    return $ok;
}


function getHashedPsw($username){
    $hashed_password="";
	global $conn;
	
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if($stmt){
		$stmt->bind_param("s", $param_username);
		$param_username = $username; 
		$stmt->execute();
		$stmt->store_result();
		$nrows = $stmt->num_rows;
		if($nrows == 1){ 
			$stmt->bind_result($id,$username,$hashed_password);	  			
			$stmt->fetch();
		}
		$stmt->close();
	}
    return $hashed_password;
}

function insert_user($username,$password){
   $ok = false;
   global $conn;
   
   // Prepare an insert statement
   $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
   $stmt = $conn->prepare($sql);
   if($stmt){
		$stmt->bind_param("ss", $param_username, $param_password);
		// Set parameters
		$param_username = $username;
		$param_password = password_hash($password, PASSWORD_DEFAULT); 
		// Attempt to execute the prepared statement
		if($stmt->execute()){
			$ok = true;
		}
		$stmt->close();
   }
   return $ok;
}

function getAllUsers(){
    global $conn;
    $rows = [];
    
    $sql = "SELECT username FROM users";
    $result = $conn -> query($sql);
    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)){
            array_push($rows,$row);
        }
    }
    $result -> free_result();
    return $rows;
}

function getOneUser($username){
    global $conn;
	$row = [];
    $sql = "SELECT id, username, created_at FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if($stmt){
		$stmt->bind_param("s", $param_username);
		$param_username = $username; 
		$stmt->execute();
		$result = $stmt->get_result(); 
	    if(!empty($result)){ 
			$row = $result->fetch_assoc();
		}
		$stmt->close();
	}
	
    return $row;
}

?>
