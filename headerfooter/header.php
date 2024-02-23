<?php

if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

ob_start();

include "db_connect.php";

$login = 0;
$invalid = 0;

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['login'])) && ($_POST['login'] == "go")) {
	// Deals with empty boxes and correct info.
	if (empty($_POST['username']) || (empty($_POST['password'])))  {
		$invalid = 1;
	}
	else {
		$sql = sprintf("SELECT * FROM users WHERE username='%s'", $conn->real_escape_string($_POST['username']));

		$result = $conn->query($sql);
		$user = $result->fetch_assoc();

		if ($user) {
			if (password_verify($_POST['password'], $user['password'])) {
				session_start();
				$_SESSION['username'] = $_POST['username'];
				$login = 1;
				header('Location: profile.php');
				exit();
			}
			else {
				$invalid = 1;
			}
		}
		else {
			$invalid = 1;
		}
	}
}

?>
<!DOCTYPE html>
<html lang=en>
	<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<meta http-equiv="X-UA-Compatible" content="ie=edge">

				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
				<link rel="stylesheet" href="./stylesheets/styles.css">

				<title>ChatEZWS</title>
				 </head>

			 <body>
				<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark container-12">
					<!-- NavBar Logo-->
					<a class="navbar-brand px-4" href="homepage.php"><img width="180px" height="39px" src="logos/" alt="logo" /></a>

					<!-- If there is a SESSION with a username -->
					<div class="collapse navbar-collapse flex-row-reverse px-4 navbar-dark">
						<ul class="navbar-nav">
							<?php
						if (isset($_SESSION['username'])) :
								?>
										<li class="nav-item dropdown px-3" >
												<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<img width="30px" height="30px" src="./logos/userlogo.png" />
														<span class="px-3 username-text"><?=$_SESSION['username'];?> </span>
												</a>
												<div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="navbarDropdownMenuLink">
														<a class="dropdown-item text-light" href="profile.php">Profile</a>
														<hr>
														<a class="dropdown-item text-light" href="post.php">Forum</a>
														<hr>
														<a class="dropdown-item text-light" href="./logout.php">Logout</a>
												</div>
										</li>
										<?php
						else :
								?>
										<li class="nav-item px-3">
												<a class="nav-link text-light" data-toggle="modal" data-target="#signinPage" href="">
														<img width="30px" height="30px" src="./logos/userlogo.png" />
												</a>
										</li>
										<?php
						endif;
						?>
						</ul>
					</div>
				</nav>

				<!-- Modal Box for Log In/Sign Up-->
					<div class="modal fade text-dark" aria-hidden="true" tabindex="-1" id="signinPage">
			<div class="modal-dialog">
				<div class="modal-content">
							 		<div class="modal-header text-center">
							 			<h4 class="modal-title text-center font-weight-light d-inline-block w-100">Log In</h4>
						<button type="button" class="close d-inline-block float-right" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
						</button>
							 		</div>
							 		<div class="modal-body ">
							 			<form action='homepage.php' method='POST'>
													<div class="form-group">
														<label>Username:</label>
														<input type="text" class="form-control" name="username" placeholder="Enter username">
													</div>

													<div class="form-group">
														<label>Password:</label>
														<input type="password" class="form-control" id="password" name="password" placeholder="Password">
													</div>

													<hr>
													<button type="submit" class="btn btn-primary w-100" name="login" value="go">Log In</button>
													<hr>

													<!-- Sign Up Redirect -->
													<h6 class="text-center font-weight-light">Need an account? <a href='signup.php'>SIGN UP</a></h6>
											</form>
							 		</div>
				</div>
						 </div>
					 </div>

									 <?php
								if ($login) {
										echo '<div class="alert alert-secondary" role="alert">
	Successfully logged in!
</div>';
								}

								if ($invalid) {
										echo '<div class="alert alert-danger" role="alert">
	Invalid Credentials!
</div>';
								}
								?>

				<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		</body>
</html>