<?php
include 'headerfooter/header.php';

if (! isset($_SESSION['username'])) { // if session variable 'username' is not set
    header("Location: homepage.php"); // redirect to login page
    exit(); // stop script execution
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['message'])) {
        $message = $_POST['message'];
        $username = $_SESSION['username']; 



    }
}
?>

<body class="black-background">
	<div class="container-fluid custom4-padding text-white">
		<div class="row">
			<div class="col">
				<form action='./post.php' method='POST'>
                  <div class="form-group">
                    <label>Message</label>
                    <input type="message" class="form-control" name="message" placeholder="Enter a Message!">
                  </div>

                <style>
                    .message-submit-button {
                        border-radius: 8px; 
                        background-color: black;
                        color: white;
                        border: 2px solid white; 
                        padding: 10px 20px; 
                    }

                    .message-submit-button:hover {
                        border-radius: 8px; 
                        background-color: white;
                        color: black;
                        border: 2px solid black; 
                        padding: 10px 20px; 
                    }

  
                </style>

                <button type="submit" class="btn btn-primary message-submit-button">Submit</button>

                </form>
			</div>
		</div>
	</div>
</body>


<?php
include "headerfooter/footer.php";
?>