<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
?>

<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home/home.php">
            <div id="name">Hungry!</div>
        </a>
        
        <!-- If not logged in, show buttons for login and register -->
        <?php 
            if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]):
        ?>
            <form class="d-flex">
                <a href="../login/login.php" class="btn btn-color" role="button">Login</a>
                <a href="../login/register_form.php" class="btn btn-color" role="button">Register</a>
            </form>

        <?php else: ?>
            <form class="d-flex">
                <a class="p-2 text-right item" href="../home/home.php">Home</a>
                <a class="p-2 text-right item" href="../explore/explore.php">Explore</a>
                <a class="p-2 text-right item" href="../watchlist/watchlist.php">Watchlist</a>
                <div class="p-2 text-right item logged">Hello <?php echo $_SESSION["username"];?>!</div>
                <a href="../login/logout.php" class="btn btn-color" role="button">Logout</a>
            </form>
        <?php endif; ?>
    </div>
</nav>