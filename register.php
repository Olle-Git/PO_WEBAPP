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
        <a href="login.php"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Login</div></a>
        <a href="#"><div class="box" style="outline: solid 4px #7dd48c;"><img src="img/icon.png" width="100px" class="icon"><br>Sign up</div></a>
        <!-- <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Bezorger</div></a> -->
    </div>

    <center>
    <div class="flex-container-form" style="margin-top: 200px;" id="login">
    <h1 style="font-size: xx-large;">Sign up</h1><br>
    <Form action="includes/registerformhandler.php" method="POST">
        <?php 
        if (isset($_GET["error"])) {
            echo "<p style='color: red;'>Inloggen mislukt probeer het opnieuw</p>";
        } 
        ?>
        <input type="text" name="email" placeholder="email">
        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="passsword" name="password"><br>
        <input type="submit" name="submit" value="Sign up">
    </Form>
    </div>
    </center>
</body>
</html>