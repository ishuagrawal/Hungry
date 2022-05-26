<?php

require '../config/config.php';

$data = json_decode(file_get_contents("php://input"));

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

// obtain id of recipe
$recipe_reg = "SELECT * FROM recipes WHERE name='" . $data->name . "';";
$recipe_results = $mysqli->query($recipe_reg);
if( !$recipe_results ) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}
if ($recipe_results->num_rows === 0) {
    exit();
}
$recipe = $recipe_results->fetch_assoc();
$recipe_id = $recipe["id"];

// Check to see if the user's watchlist already has this recipe
$sql = "SELECT * FROM users_has_recipes WHERE users_id='" . $user_id . "' AND recipes_id ='" . $recipe_id . "';";
$sql_results = $mysqli->query($sql);
if( !$sql_results ) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}
if ($sql_results->num_rows > 0) {
    echo "true";
}

$mysqli->close();

?>