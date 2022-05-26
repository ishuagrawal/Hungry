<?php

require '../config/config.php';

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;
$star = $data->star;
$image = $data->image;
$user_id;
$recipe_id;

if ($star == "starred") {    // Insert the recipe into user's watchlist
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($mysqli->connect_errno) {
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

    // Run a SQL query to check if the recipes table already has this recipe
    $sql_registered = "SELECT * FROM recipes WHERE name='" . $name . "';";
    $results_registered = $mysqli->query($sql_registered);
    if( !$results_registered ) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }

    // Insert recipe into database
    if ($results_registered->num_rows == 0) {
		$statement = $mysqli->prepare("INSERT INTO recipes (name, image) VALUES (?, ?)");
		$statement->bind_param("ss", $name, $image);
        $executed = $statement->execute();
        if(!$executed) {
			echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
			exit();
		}
        $statement->close();
	}
    
    // obtain id of recipe
    $recipe_reg = "SELECT * FROM recipes WHERE name='" . $name . "';";
    $recipe_results = $mysqli->query($recipe_reg);
    if( !$recipe_results ) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }
    $recipe = $recipe_results->fetch_assoc();
    $recipe_id = $recipe["id"];

    // Insert recipe into user's watchlist
    $statement = $mysqli->prepare("INSERT INTO users_has_recipes (users_id, recipes_id) VALUES (?, ?)");
    $statement->bind_param("ii", $user_id, $recipe_id);
    $executed = $statement->execute();
    if(!$executed) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }

    $statement->close();
    $mysqli->close();

    echo "true";
} 

else {     // Remove the recipe from user's watchlist
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // obtain id of user
    $user_reg = "SELECT * FROM users WHERE username='" . $_SESSION["username"] . "';";
    $user_results = $mysqli->query($user_reg);
    if( !$user_results ) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }
    $row = $user_results->fetch_assoc();
    $user_id = $row["id"];

    // obtain id of recipe
    $recipe_reg = "SELECT * FROM recipes WHERE name='" . $name . "';";
    $recipe_results = $mysqli->query($recipe_reg);
    if( !$recipe_results ) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }
    $recipe = $recipe_results->fetch_assoc();
    $recipe_id = $recipe["id"];

    $statement = $mysqli->prepare("DELETE FROM users_has_recipes WHERE users_id = ? AND recipes_id = ?");
    $statement->bind_param("ii", $user_id, $recipe_id);
    $executed = $statement->execute();
    if(!$executed) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }
    
    $statement->close();
    $mysqli->close();

    echo "false";
}

?>
