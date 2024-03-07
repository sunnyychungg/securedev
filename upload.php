<!DOCTYPE html>
<html>
<head>
    <title>Image Upload Using PHP </title>
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

if (isset($_POST['submit']) && isset ($_FILES['my_image'])) {

    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmo_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {
            $em = "Sorry, your file is too large.";
            header("Location: index.php?error=$em");            
        }else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_image_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insert into Database
                $sql = "INSERT INTO images(image_url)
                        VALUES('$new_image_name')";
                        mysqli_query($conn, $sql);
                        header("Location: view.php");
            }else {
                $em = "You can't upload files of this type";
                header ("Location: index.php?error=$em");
            }

        }
    }else { 
        $em = "uknown error occurred!";
        header("Location: index.php?error=$em");
    }

}else {
    header("Location: index.php");
}

?>
<?php
include "headerfooter/footer.php";
?>
