<?php
include "headerfooter/header.php";

if (! isset($_SESSION['username'])) { // if session variable 'username' is not set
    header("Location: homepage.php"); // redirect to login page
    exit(); // stop script execution
}

?>



<!DOCTYPE html>
<html>
	<head>
    	<link rel="stylesheet" href="./styles.css">
    	<meta charset="UTF-8">
    </head>

    <body class="text-light" style="background-color: black;">
    	<div class="container mt-4">
    		<div class="row">
    			<div class="col-1.5">
					<!-- UPLOAD IMAGE OF PFP? -->
    				<img height=128px src="logos/userlogo.png" />
    			</div>
    			<div class="col-9">
    				<h1 class="font-weight-light">Welcome, <?=$_SESSION['username'];?></h1>
    			</div>
    		</div>
    	</div>

    </body>
</html>

<?php
include "headerfooter/footer.php";
?>