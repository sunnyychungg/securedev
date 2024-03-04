<?php
include 'headerfooter/header.php';

// Check if the form is submitted for posting a message
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['message'])) {
    // Insert message into the database
    $$sname = "localhost";
    $uname = "root";
    $password = "";
    
    $db_name = "testdb";
    
    $conn = mysqli_connect($sname, $uname, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = $_GET['message'];
    $username = $_SESSION['username'];

    $insertQuery = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
    $conn->query($insertQuery);

    $conn->close();
}

// Fetch messages from the database
$conn = mysqli_connect($sname, $uname, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM messages ORDER BY message_id DESC");
$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <style>
        body.black-background {
            background-color: black;
            color: white;
        }

        .container-fluid.custom4-padding {
            padding: 20px;
        }

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
</head>
<body class="black-background">
    <div class="container-fluid custom4-padding text-white">
        <div class="row">
            <div class="col">
                <form action='./post.php' method='GET'>
                    <div class="form-group">
                    <label style="font-size: 24px; font-weight: bold;">ChatEZWS Forum</label>
                        <input type="message" class="form-control" name="message" placeholder="Enter a Message!" required>
                    </div>
                    <button type="submit" class="btn btn-primary message-submit-button">Submit</button>
                </form>
            </div>
        </div>

        <!-- Display messages from the database -->
        <div>
            <?php foreach ($messages as $msg): ?>
                <div>
                    <strong><?php echo $msg['username']; ?>:</strong>
                    <?php echo $msg['message']; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
