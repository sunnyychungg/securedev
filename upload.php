<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;           
        }
    </style>
</head>
<body>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">
           
           <input type="file"
                  name="my_image">
              
           <input type="submit"
                  name="submit"
                  value="Upload">
          
      </form>
</body>
</html>

<?php
include "headerfooter/header.php";

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {

    // Get information about the uploaded file
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    // Check for upload errors
    if ($error === 0) {
        //directory of stored images
        $upload_directory = 'uploads/';

        //unique file name to avoid overwriting existing files
        $new_image_name = uniqid('IMG-', true) . '_' . $img_name;

        //full path to the upload directory
        $img_upload_path = $upload_directory . $new_image_name;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($tmp_name, $img_upload_path)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Upload failed with error code: $error";
    }
} else {
    echo "No file uploaded.";
}
?>
<?php
include "headerfooter/footer.php";
?>
