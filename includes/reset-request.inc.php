<?php 

if(isset($_POST["reset-request-submit"])){
    #two token used to aviod timing attacks making the software secure 
    $selector = bin2hex(random_bytes(8));# used to pinpoint the user to check the actual data "SSD"
    $token = random_bytes(32);# used to authenticate the user 
   # $url= "localhost/SSD/securedev/forgotpassword/create-new-password.php?selector=" . $selector . "&Validator=". bin2hex($token);
   $token2h= bin2hex($token);
    $expiries= date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?" ; # not adding data directly to increase security 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error! ";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt,"s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    $sql = "INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpiries) VALUES (?,?,?,?);";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error! ";
        exit();
    } else {
        $hashToken= password_hash($token,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashToken,$expiries);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

   
    

}else
{
    #header("Location: ../for.php");
}
?>
<?php
echo " success\n";
echo "<a href='../create-new-password.php?selector=$selector&Validator=$token2h'>Click here to continue</a>";
?>
