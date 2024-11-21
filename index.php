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
        <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Klant</div></a>
        <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Medewerker</div></a>
        <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Bezorger</div></a>
    </div>

    <center>
    <div class="flex-container-form" style="margin-top: 200px;" id="login">
    <h1 style="font-size: xx-large;">Login</h1><br>
    <Form action="formhandler.php" method="POST">
        <?php 
        if (isset($_GET["error"])) {
            echo "<p style='color: red;'>Inloggen mislukt probeer het opnieuw</p>";
        } else if (isset($_GET["error"]) && $_GET["error"] == 2) {
            echo "<p style='color: green;'>Registratie gelukt, log nu in</p>";
        }
        ?>
        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="passsword" name="password"><br>
        <input type="submit" value="Login">
    </Form>
    </div>
    </center>
</body>
</html>