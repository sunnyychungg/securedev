<?php
include 'headerfooter/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Handles empty usernames.
	if (empty($_POST['username'])) {
		echo '<div class="alert alert-secondary" role="alert">
						No username found!
					</div>';
	}

	// Handles empty emails.
	elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo '<div class="alert alert-secondary" role="alert">
						No valid email found!
					</div>';
	}

	// Password with less than 8 characters.
	elseif (strlen($_POST['password']) <= 8) {
    echo '<div class="alert alert-secondary" role="alert">
						Password must be atleast 8 characters long
					</div>';
	}

	// Must contain at least one letter and one number.
	elseif ((!preg_match("/[a-z]/i", $_POST['password'])) || (!preg_match("/[0-9]/", $_POST['password']))) {
    echo '<div class="alert alert-secondary" role="alert">
						Must contain at least one letter and one number.
					</div>';
	}

	// Matching for confirm passwords.
	elseif ($_POST['password'] !== $_POST['password_confirm']) {
		echo '<div class="alert alert-secondary" role="alert">
						Passwords do not match.
					</div>';
	}

	else {
		$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$sql = "INSERT INTO users(username, password, email) VALUES (?, ?, ?)";

		$stmt = $conn->stmt_init();

		// If connection error
		if (!$stmt->prepare($sql)) {
			echo '<div class="alert alert-secondary" role="alert">
						SQL error:'.$conn->error.'.
					</div>';
		}

		// Executes and inputs statement into server
		$stmt->bind_param("sss", $_POST['username'], $password_hash, $_POST['email']);

		if ($stmt->execute()) {
			echo '<div class="alert alert-secondary" role="alert">
							Sign up successfull!
						</div>';
		}
		else {
			echo '<div class="alert alert-secondary" role="alert">
						SQL error:'. $mysqli->error . ' ' . $mysqli->errno .'.
					</div>';
		}
	}
}
?>

<body>
	<br>
	<div class="container-fluid custom4-padding">
		<div class="row">
			<div class="col">
				<form action='signup.php' method='POST' novalidate>
									<div class="form-group">
										<label>Email address</label>
										<input class="form-control" type="email" name="email" placeholder="Enter email">
									</div>

									<div class="form-group">
										<label>Username:</label>
										<input class="form-control" type="text"  name="username" placeholder="Enter username">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input class="form-control" type="password" name="password" placeholder="Password">
									</div>

									<div class="form-group">
										<label>Confirm Password</label>
										<input class="form-control" type="password" name="password_confirm" placeholder="Confirm Password">
									</div>

									<br>

									<button type="submit" class="btn btn-primary">Submit</button>
								</form>
			</div>
		</div>
	</div>
</body>

<?php
include "headerfooter/footer.php";
?>
