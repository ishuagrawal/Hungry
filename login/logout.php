<?php
	session_start(); // still need to start session to destroy the session
	session_destroy(); // clears out all session variables
	header("Location: ../home/home.php");
?>