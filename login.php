<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Basis informatie in de head over de webpagina-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">

    <title>New Yolo Project - HOME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><img src="img/NYP.png" max-width="830px"></center>
    <!--In het blok hieronder worden de inlogknoppen gemaakt en weergegeven-->
    <div class="flex-container">
        <a href="#login"><div class="box" style="outline: solid 4px #7dd48c;"><img src="img/icon.png" width="100px" class="icon"><br>Login</div></a>
        <a href="register.php#signup"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Sign up</div></a>
        <!-- <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Bezorger</div></a> -->
    </div>

    <center>
<!--In dit blok wrodt de form opgesteld voor het inloggen, als er iets fout gaat bij het inloggen zorgt de php er voor dat dit wordt aangegeven op de pagina-->
    <div class="flex-container-form" style="margin-top: 200px;" id="login">
    <h1 style="font-size: xx-large;">Login</h1><br>
    <Form action="includes\loginformhandler.php" method="POST" id="login">
        
        <?php 
        if (isset($_GET["error"])) {
            echo "<p style='color: red;'>Inloggen mislukt probeer het opnieuw</p>";
        } 
        ?>
        <input type="text" placeholder="username or email" name="username"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="submit" name="submit" value="Login">
    </Form>
    </div>
    </center>
</body>
</html>