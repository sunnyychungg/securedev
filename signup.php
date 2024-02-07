<?php
include 'headerfooter/header.php';

if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['email']))) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

  
}

?>

<body class="black-background">
	<div class="container-fluid custom4-padding text-white">
		<div class="row">
			<div class="col">
				<form action='./signup.php' method='POST'>
                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                  </div>

                  <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
			</div>
		</div>
	</div>
</body>

<?php
include "headerfooter/footer.php";
?>
