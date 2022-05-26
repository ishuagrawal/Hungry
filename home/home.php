<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="home.css">
    
    <title>Home</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> 
    <?php include '../navbar/nav.php'; ?>
    <style>
        <?php include '../navbar/nav.css'; ?>
    </style>

    <div class="container-fluid">
        <header class="row">
            <div class="main">Hungry!</div>
            <div class="slogan">What's Cooking?</div>
        </header>

        <div class="row features">
			<div class="col-12 col-md-6 col-lg-3 feature">
                <div class="img" id="img1"></div> 
                <h2>Discover your next favorite dish from a huge collection of recipes!</h2>
			</div>
			<div class="col-12 col-md-6 col-lg-3 feature">
				<div class="img" id="img2"></div>  
                <h2>Find the ingredients for your recipe!</h2>
			</div>
            <div class="col-12 col-md-6 col-lg-3 feature">
                <div class="img" id="img3"></div>
                <h2>Find out how many calories are in your dish!</h2>
			</div>
            <div class="col-12 col-md-6 col-lg-3 feature">
                <div class="img" id="img4"></div>
                <h2>Save your favorite recipes for the future!</h2>
			</div>
        </div> 
    </div>



</body>
</html>