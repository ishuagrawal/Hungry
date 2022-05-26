<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="explore.css">
    
    <title>Explore</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> 
    <?php include '../navbar/nav.php'; ?>
    <style>
        <?php include '../navbar/nav.css'; ?>
    </style>

    <div class="container-fluid">
        <header class="row">
			<h1 class="col-12 mt-4 mb-4 name">Explore</h1>
        </header>
        
        <div class="row" id="search">
			<form action="" method="" class="col-12" id="search-form">
				<div class="form-row">
					<div class="col-12 mt-4 col-sm-6 col-lg-4">
						<label for="search-id" class="visually-hidden"></label>
						<input type="text" name="search" class="form-control" id="search-id" placeholder="Search...">
					</div>

					<div class="col-12 mt-4 col-sm-auto">
						<button type="submit" class="btn btn-color">Search</button>
					</div>
				</div>				
			</form>
		</div>

        <div class="row" id="data">

		</div>
    </div>
    
    <!-- Import jquery library -->
    <script
    src="http://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>

    <!-- Add external JS file -->
    <script src="explore.js"></script>

    <!-- Import Font Awesome -->
    <script src="https://kit.fontawesome.com/5ae13c65df.js" crossorigin="anonymous"></script>

</body>
</html>