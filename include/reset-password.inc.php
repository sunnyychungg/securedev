<?php
    if (isset($_POST["reset-password-submit"]))
    {
        $selector = $_POST["selector"];# run an sql statment to grab token 
        $validator = $_POST["validator"];# validate the user
        $password = $_POST["pwd"];
        $passwordRepeat = $_POST ["pwd-repeat"];

        if (empty($password) || empty($passwordRepeat)){
            #header("Location: ../ signup.php");
            exit();
        }elseif ((strlen($password)) <= 8 )
        {
            #header("Location: ../ signup.php");
            exit();

        }elseif ((!preg_match("/[a-z]/i",$password)) || (!preg_match("/[0-9]/",$passwordRepeat)))
        {
            #header("Location: ../ signup.php");
            exit();

        }elseif ($password !== $passwordRepeat)
        {
            #header("Location: ../ signup.php");
            exit();

        }

        $curentDate = date("U");

        require 'dbh.inc.php';

        $sql = "SELECT * FROM pwdRest WHERE pwdResetSelector=? AND pwdResetExpires >=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error! ";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt,"s", $selector, $curentDate);
            mysqli_stmt_execute($stmt);
            $result= mysqli_stmt_get_result($stmt);
            if (!row = mysqli_fetch_assoc($result))
            {
                echo "Resubmission of request required";
                exit();
            }else 
            {
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin,$row["pwdRestToken"])
                if($tokenCheck === false )
                {
                    echo "Resubmission of request required";
                    exit();
                }

            }elseif($tokenCheck === true )
            {
                $tokenEmail= $row['pwdRestEmail'];
                $sql= "SELECT * FROM users WHERE emailUsers=?; ";
                $stmt= mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "error occured";
                    exit();
                }else {
                    mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result= mysqli_stmt_get_result($stmt);
                    if (!row = mysqli_fetch_assoc($result))
                    {
                        echo "error occured ";
                        exit();
                    }else
                    {
                        $sql= "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            echo"There was an error !";
                            exit();
                        }
                        $newPwdHash = password_hash($password,PASSWORD_DEFAULT,$tokenEmail);
                        mysqli_stmt_bind_param($stmt, "ss", $tokenEmail);
                        mysqli_stmt_execute($stmt);

                        $sql = "DELETE FROM pwdReset WHERE pwdRestEmail=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$sql))
                        {
                            echo"There was an error !";
                            exit();
                        }else
                        {
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../signup.php?newpwd=passwordupdated");

                        }


                    }

                }
            }
            
            $tokenBin

        }

    } else {
        #header("Location: ../index.php")
    }