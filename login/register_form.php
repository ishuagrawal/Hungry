<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="login.css">
    
    <title>Register</title>
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
			<h1 class="col-12 mt-4 mb-4 name">Register</h1>
        </header>

		<div class="row" id="data">
			<form action="" method="POST">

				<div class="form-group row" id="user">
					<label for="username-id" class="col-sm-3 col-form-label text-sm-right"><strong>Username:</strong></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username-id" name="username">
						<small id="username-error" class="invalid-feedback">Username is required.</small>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="email">
					<label for="email-id" class="col-sm-3 col-form-label text-sm-right"><strong>Email:</strong></label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="email-id" name="email">
						<small id="email-error" class="invalid-feedback">Email is required.</small>
					</div>
				</div> <!-- .form-group -->	

				<div class="form-group row" id="pass">
					<label for="password-id" class="col-sm-3 col-form-label text-sm-right"><strong>Password:</strong></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="password-id" name="password">
						<small id="password-error" class="invalid-feedback">Password is required.</small>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="buttons">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-3">
						<button type="submit" class="btn btn-color">Register</button>
						<a href="../home/home.php" role="button" class="btn btn-light">Cancel</a>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 ml-sm-auto">
						<a href="login.php">Already have an account</a>
					</div>
				</div> <!-- .row -->
			</form>
		</div>
	</div> <!-- .container -->

	<!-- Import jquery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<!-- Add external JS file -->
    <script src="register.js"></script>
</body>
</html>