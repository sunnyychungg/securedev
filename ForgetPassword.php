<?php 
#require "header.php"
?>

    <main>
        <div class="wrapper-main">
            <section class= "section-default">
                <h1>Reset your Password</h1>
                <p>An e-mail will be sent to you to aid in resetting your password.</p>
                <form action="includes/reset-request.inc.php" method="post">
                    <input type="text" name ="email" required="required" placeholder="Enter your e-mail address...">
                    <button type="submit" name="reset-request-submit">Receive an email request for a new password</button>
                </form>
                <?php
    
                ?>

            </section>
        </div>
    </main>

<?php
#require "footer.php" 
?>
