<?php
require '../config/config.php';

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$oldPassword = $data->oldPassword;
$newPassword = $data->newPassword;

$error = true;
$msg;

if ( isset($username) && isset($oldPassword) && isset($newPassword) && !empty($username) && !empty($oldPassword) && !empty($newPassword) ) {

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($mysqli->connect_errno) {
        $msg = $mysqli->connect_error;
        echo json_encode(['error'=> $error, 'msg'=> $msg]);
        exit();
    }

    $oldpasswordInput = hash("sha256", $oldPassword);
    $newpasswordInput = hash("sha256", $newPassword);
    
    $sql = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $sql->bind_param("ss", $username, $oldpasswordInput);

    $results = $sql->execute();
    if(!$results) {
        $msg = $mysqli->error;
        echo json_encode(['error'=> $error, 'msg'=> $msg]);
        exit();
    }

    $sql->store_result();

    if($sql->num_rows > 0) {

        if ($oldPassword == $newPassword) {
            $msg = "Please enter a NEW password.";
            echo json_encode(['error'=> $error, 'msg'=> $msg]);
            exit();
        }
        
        $statement = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ? AND password = ?");
		$statement->bind_param("sss", $newpasswordInput, $username, $oldpasswordInput);

		$executed = $statement->execute();
		if(!$executed) {
			$msg = $mysqli->error;
            echo json_encode(['error'=> $error, 'msg'=> $msg]);
            exit();
		}
        
        $error = false;
        $msg = $username . "'s password was successfully changed! Please login by clicking 'Login'.";
        $statement->close();

    }

    else {
        $msg = "Invalid username or password.";
    }

    $sql->close();
    $mysqli->close();

}

else {
    $msg = "Please fill out all required fields.";
}

echo json_encode(['error'=> $error, 'msg'=> $msg]);
?>
