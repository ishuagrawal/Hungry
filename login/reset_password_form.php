<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="login.css">
    
    <title>Change Password</title>
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
			<h1 class="col-12 mt-4 mb-4 name">Change Password</h1>
        </header>

		<div class="row" id="data">
			<form action="" method="POST">
				
				<div class="form-group row" id="user">
					<label for="username-id" class="col-sm-6 col-md-6 col-form-label text-sm-right"><strong>Username:</strong></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="username-id" name="username">
                        <small id="username-error" class="invalid-feedback">Username is required.</small>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="oldPass">
					<label for="old-password-id" class="col-sm-6 col-md-6 col-form-label text-sm-right"><strong>Old Password:</strong></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="old-password-id" name="old-password">
                        <small id="password-error" class="invalid-feedback">Password is required.</small>
					</div>
				</div> <!-- .form-group -->

                <div class="form-group row" id="newPass">
					<label for="new-password-id" class="col-sm-6 col-md-6 col-form-label text-sm-right"><strong>New Password:</strong></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" id="new-password-id" name="new-password">
                        <small id="password-error" class="invalid-feedback">Password is required.</small>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row" id="buttons">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-color">Change</button>
						<a href="login.php" role="button" class="btn btn-light">Cancel</a>
					</div>
				</div> <!-- .form-group -->
			</form>
		</div>
	</div> <!-- .container -->

	<!-- Import jquery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<!-- Add external JS file -->
    <script src="reset_password.js"></script>
</body>
</html>