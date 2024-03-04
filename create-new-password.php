<?php 
#require "header.php"
?>

    <main>
        <div class="wrapper-main">
            <section class= "section-default">
            <?php
                $selector= $_GET["selector"];
                $validitor= $_GET["validator"];
                if (empty($selector) || empty($validitor)){
                    die("Couldnt validate your request ! ");
                }
                else{
                    if(ctype_xdigit($selector)!== false && ctype_xdigit($validitor) !== false )
                    ?>
                    {
                         
                        <form class="" action="includes/reset-password.inc.php" method="post">
                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" value="<?php echo $validitor ?>">
                            <input type="password" name="pwd" placeholder = "Enter a new password ...">
                            <input type="password" name="pwd_repeat" placeholder = "Confrim new password ...">
                            <button type="submit" name="reset-password-submit">Reset password</button>
                        </form>
                        
                 
                    }
                }



                

               
            </section>
        </div>
    </main>

<?php
#require "footer.php" 
?>
