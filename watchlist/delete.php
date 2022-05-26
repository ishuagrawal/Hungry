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
$recipe = $recipe_results->fetch_assoc();
$recipe_id = $recipe["id"];

$statement = $mysqli->prepare("DELETE FROM users_has_recipes WHERE users_id = ? AND recipes_id = ?");
$statement->bind_param("ii", $user_id, $recipe_id);
$executed = $statement->execute();
if(!$executed) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}

$sql = "SELECT * FROM users_has_recipes WHERE users_id='" . $user_id . "';";
$results = $mysqli->query($sql);
if( !$results ) {
    echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
    exit();
}

while($r = $results->fetch_assoc()) {
    $rec_id = $r["recipes_id"];
    $rec_name = "SELECT * FROM recipes WHERE id='" . $rec_id . "';";
    $rec_results = $mysqli->query($rec_name);
    if( !$rec_results ) {
        echo "<script type='text/javascript'>alert('Error: $mysqli->error');</script>";
        exit();
    }

    $rows[] = $rec_results->fetch_assoc();
}
echo json_encode($rows);

$statement->close();
$mysqli->close();

?>