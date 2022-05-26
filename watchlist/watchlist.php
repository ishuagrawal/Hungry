<?php

require '../config/config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( $mysqli->connect_errno) {
	echo "<script type='text/javascript'>alert('Error: $mysqli->connect_error');</script>";
	exit();
}

// obtain id of user
$user_reg = "SELECT * FROM users WHERE username='" . $_SESSION["username"] . "';";
$user_results = $mysqli->query($user_reg);
if( !$user_results ) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}
$row = $user_results->fetch_assoc();
$user_id = $row["id"];

$sql = "SELECT * FROM users_has_recipes WHERE users_id='" . $user_id . "';";
$results = $mysqli->query($sql);
if( !$results ) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}

$mysqli->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="watchlist.css">
    
    <title>Watchlist</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> 
    <?php include '../navbar/nav.php'; ?>
    <style>
        <?php include '../navbar/nav.css'; ?>
    </style>

    <div class="container-fluid">
        <header class="row">
			<h1 class="col-12 mt-4 mb-4 name">My Recipe Book</h1>
        </header>

        <!-- PHP here -->
        <div class="row" id="data">

            <?php while($row = $results->fetch_assoc()): ?>
                <?php
                    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $sql = "SELECT * FROM recipes WHERE id='" . $row["recipes_id"] . "';";
                    $result = $mysqli->query($sql);
                    $info = $result->fetch_assoc();

                    $mysqli->close();
                echo 
                "<div class='result col-6 col-md-4 col-lg-3'>
                    <div class='card'>
                        <img src='" . $info["image"] . "' alt='image' class='card-img-top'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . $info["name"] . "</h5>
                            <div class='buttons'>
                                <a href='../details/details.php?watchlist=true&recipe_name=" . $info["name"] . "'target=_blank' class='btn details'>Details</a>
                                <button type='button' class='btn watchlist'>Remove</button>
                            </div>
                        </div>
                    </div>
                </div>";
                ?>
            <?php endwhile;?>
          
        </div>
    </div>

    <!-- Import jquery library -->
	<script
    src="http://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
    </script>

    <!-- Add external JS file -->
    <script src="watchlist.js"></script>
    
    <!-- Import Font Awesome -->
    <script src="https://kit.fontawesome.com/5ae13c65df.js" crossorigin="anonymous"></script>
</body>
</html>