<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">      <!--Standaard informatie over de webpagina in de head-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gulzar&display=swap" rel="stylesheet">

    <title>New Yolo Project - HOME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><img src="img/NYP.png" max-width="830px"></center> <!--In Dit blok worden containers gemaakt voor de knoppen van het inloggen, hierin zit een foto waarvan de breedte wordt aangegeven samen met zijn class, verder staat hier nog meer opmaak-->
    <div class="flex-container">
        <a href="login.php#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Login</div></a>
        <a href="#signup"><div class="box" style="outline: solid 4px #7dd48c;"><img src="img/icon.png" width="100px" class="icon"><br>Sign up</div></a>
        <!-- <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Bezorger</div></a> -->
    </div>

    <center>
    <!--In het blok hieronder wordt de form gemaakt om een account aan te maken, hier wordt ook nog met inline CSS een aantal dingen aangepast-->
    <div class="flex-container-form" style="margin-top: 200px;" id="login">
    <h1 style="font-size: xx-large;">Sign up</h1><br>
    <Form action="includes/registerformhandler.php" method="POST" id="signup">
        <!--Als er iets fout gata bij het registreren dan zorgt het blok hieronder ervoor dat dit wordt aangegeven-->
        <?php 
        if (isset($_GET["error"])) {
                echo "<p style='color: red;'>Registreren mislukt probeer het opnieuw</p>";
        } 
        ?>
        <input type="email" name="email" placeholder="email"><br> <!--Dit blok is voor het sign up menu, er wordt gevraagd om een paar dingen zoals de email en naam-->
        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="text" placeholder="plaats" name="plaats"><br>
        <input type="text" placeholder="straat" name="straat"><br>
        <input type="text" placeholder="huisnummer" name="huisnummer"><br>
        <input type="submit" name="submit" value="Sign up">
    </Form>
    </div>
    </center>
</body>
</html>