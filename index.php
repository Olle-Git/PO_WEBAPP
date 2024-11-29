<?php
if (isset($_SESSION)) {
session_start();
session_unset();
session_destroy();
header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">

    <title>New Yolo Project - HOME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><img src="img/NYP.png" max-width="830px"></center>
    <div class="flex-container">
        <a href="login.php#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Login</div></a>
        <a href="register.php#signup"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Sign up</div></a>
    </div>
        <?php 
        if (isset($_GET["error"])) {
            echo "<p style='color: red;'>Inloggen mislukt probeer het opnieuw</p>";
        } 
        ?>
    </center>
</body>
</html>