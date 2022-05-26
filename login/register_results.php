<?php

require '../config/config.php';

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$email = $data->email;
$password = $data->password;

$error = true;
$msg;

if ( !isset($email) || empty($email)
	|| !isset($username) || empty($username)
	|| !isset($password) || empty($password) ) {
    $msg = "Please fill out all required fields.";
} 

else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($mysqli->connect_errno) {
		$msg = $mysqli->connect_error;
		echo json_encode(['error'=> $error, 'msg'=> $msg]);
		exit();
	}

	// Run a SQL query to check if the users table already has this email address OR username
	$sql_registered = "SELECT * FROM users WHERE username='" . $username . "' OR email = '" . $email . "';";
	$results_registered = $mysqli->query($sql_registered);
	if (!$results_registered) {
        $msg = $mysqli->error;
		echo json_encode(['error'=> $error, 'msg'=> $msg]);
		exit();
	}

	// if num_rows is bigger than 0, it means there is already a record with that username OR email.
	if ($results_registered->num_rows > 0) {
		$msg = "Username or email address is already taken. Please try again.";
	} 
    
    else {
        // Hash the password before storing it into the db
		$password = hash("sha256", $password);

		// Write SQL to insert this new user into the users table
		$statement = $mysqli->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
		$statement->bind_param("sss", $username, $email, $password);

		$executed = $statement->execute();
		if(!$executed) {
			$msg = $mysqli->error;
			echo json_encode(['error'=> $error, 'msg'=> $msg]);
			exit();
		}

        if ($statement->affected_rows == 1) {
			$error = false;
		}

        $msg = $username . " was successfully registered! Please login by clicking 'Login'.";
		
		$statement->close();
		$mysqli->close();
    }
}

echo json_encode(['error'=> $error, 'msg'=> $msg]);

?>