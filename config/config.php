<?php

session_start(); // for every page that requires the config file, we will also start session for that page

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

define('DB_HOST', $server);
define('DB_USER', $username);
define('DB_PASS', $password);
define('DB_NAME', $db);

$api_key = getenv("EDAMAM_API_KEY");
$api_id = getenv("EDAMAM_API_ID");
define('API_KEY', $api_key);
define('API_ID', $api_id);

?>