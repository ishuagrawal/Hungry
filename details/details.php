<?php

require '../config/config.php';

if ( !isset($_GET['recipe_name']) || empty($_GET['recipe_name']) ) {
    $error = "Invalid Recipe.";
}

if (isset($_GET['watchlist']) || !empty($_GET['watchlist']) ) {
    $star = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="details.css">
    
    <title>Recipe Info</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> 
    <?php include '../navbar/nav.php'; ?>
    <style>
        <?php include '../navbar/nav.css'; ?>
    </style>

    <div class="container-fluid">
        <header class="row">
			<h1 class="col-12 mt-4 mb-4 name">Recipe Info</h1>
        </header>

        <div class="card-group">
            <?php if ( isset($_GET['watchlist']) && !empty($_GET['watchlist']) ) : ?>
            <div class="card containsIcon">
                <i class="fas fa-star icon"></i>
            <?php else : ?>
            <div class="card">
            <?php endif; ?>
                <img id="image" src="" alt="Image">
                <div class="buttons">
                    <?php if ( isset($_GET['watchlist']) && !empty($_GET['watchlist']) ) : ?>
                        <button type="button" class="btn watchlist" id="watchlist_id" name="watchlist" value="starred">Remove</button>
                    <?php else : ?>
                        <button type="button" class="btn watchlist" id="watchlist_id" name="watchlist" value="not-starred">Save</button>
                    <?php endif; ?>
                    <a href="" target="_blank" class="btn" id="source">Recipe</a>
                </div>
            </div>
            <div class="card text">
                <div class="card-body">
                    <h5 class="card-title" id="title"><?php echo $_GET['recipe_name']?></h5>
                    <p class="card-text" id="calories"><strong>Calories:</strong> </p>
                    <p class="card-text" id="ingredients"><strong>Ingredients:</strong> </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add external JS file -->
    <script src="details.js"></script>

    <!-- Import Font Awesome -->
    <script src="https://kit.fontawesome.com/5ae13c65df.js" crossorigin="anonymous"></script>

</body>
</html>