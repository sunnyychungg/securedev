<?php

$uploadsDirectory = __DIR__ . '/uploads';

// Check if the directory doesn't already exist
if (!file_exists($uploadsDirectory) && !is_dir($uploadsDirectory)) {
    // Create the "uploads" directory
    mkdir($uploadsDirectory);

    echo 'The "uploads" directory has been created successfully.';
} else {
    echo 'The "uploads" directory already exists.';
}
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

}
?>
