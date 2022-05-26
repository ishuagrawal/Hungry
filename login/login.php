<?php
require '../config/config.php';

// if user is not logged in, do the usual things like checking for user input, etc.
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {

	// Will go into this if statement ONLY if username and password inputs were submitted via the POST method (aka a user clicked on the login button to submit the login form).
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {

			// Check if user input matches a username/password combo in the database
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				$error = $mysqli->connect_error;
				exit();
			}

			// hash the user's input for password (and compare this with the hashed password stored in the database)
			$passwordInput = hash("sha256", $_POST["password"]);
			
			$sql = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
			$sql->bind_param("ss", $_POST['username'], $passwordInput);

			$results = $sql->execute();
			if(!$results) {
				$error = $mysqli->error;
				exit();
			}

			$sql->store_result();

			// If there is a match, we will get a result back. num_rows returns the number of results from the above sql query
			if($sql->num_rows > 0) {
				// login is successful
				// store this user's username in a session
				$_SESSION["username"] = $_POST["username"];
				$_SESSION["logged_in"] = true;

				// Redirect user to the home page using a relative path
				header("Location: ../home/home.php");
			}
			else {
				$error = "Invalid username or password.";
			}

			$sql->close();
			$mysqli->close();
		} 
	}
} else {
	// user is logged in, kick them out of this page. Redirect user to home page
	header("Location: ../home/home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="login.css">
    
    <title>Login</title>
</head>
<body>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> 
    
	<nav class="navbar navbar-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="../home/home.php">
				<div id="name">Hungry!</div>
			</a>
		</div>
	</nav>

	<div class="container-fluid">
        <header class="row">
			<h1 class="col-12 mt-4 mb-4 name">Login</h1>
        </header>

		<div class="row" id="data">
			<form action="login.php" method="POST">

				<div class="form-row error">
					<div class="font-italic text-danger col-sm-9 ml-sm-auto">
						<!-- Show errors here. -->
						<?php
							if ( isset($error) && !empty($error) ) {
								echo $error;
							}
						?>
					</div>
				</div> <!-- .row -->

				<div class="form-group row" id="user">
					<label for="username-id" class="col-sm-3 col-form-label text-sm-right"><strong>Username:</strong></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username-id" name="username">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="pass">
					<label for="password-id" class="col-sm-3 col-form-label text-sm-right"><strong>Password:</strong></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="password-id" name="password">
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="buttons">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-color">Login</button>
						<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-light">Cancel</a>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row link">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 ml-sm-auto">
						<a href="register_form.php">Create an account</a>
					</div>
				</div>

				<div class="form-group row link">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 ml-sm-auto">
						<a href="reset_password_form.php">Change password</a>
					</div>
				</div>
			</form>
		</div>
	</div> <!-- .container -->
</body>
</html>