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
        <a href="index.php?klant=true#login" onclick="isKlant()"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Klant</div></a>
        <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Medewerker</div></a>
        <a href="#login"><div class="box"><img src="img/icon.png" width="100px" class="icon"><br>Bezorger</div></a>
    </div>

    <center>
    <div class="flex-container-form" style="margin-top: 200px;" id="login">
    <h1 style="font-size: xx-large;">Login</h1><br>
    <Form action="formhandler.php" method="POST">
        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="passsword" name="password"><br>
        <input type="submit" value="Login">
    </Form>
    </div>
    </center>
<?php
$username = $wachtwoord = null;
function isKlant() {
    $isklant = True;
    echo "klant";
}
function isMedewerker() {
    $isMedewerker = True;
    echo 'medewerker';
}
function isBezorger() {
    $isBezorger = True;
    echo 'bezorger';
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_POST['username'] ?? null && $_POST['wachtwoord'] ?? null) {
    $username = test_input($_POST['username']);
    $wachtwoord = test_input($_POST['wachtwoord']);
    $hashedwachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    submit($username, $hashedwachtwoord, $wachtwoord);
}

?>
<?php
$username = $wachtwoord = null;
function isKlant() {
    $isklant = True;
    echo "klant";
}
function isMedewerker() {
    $isMedewerker = True;
    echo 'medewerker';
}
function isBezorger() {
    $isBezorger = True;
    echo 'bezorger';
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_POST['username'] ?? null && $_POST['wachtwoord'] ?? null) {
    $username = test_input($_POST['username']);
    $wachtwoord = test_input($_POST['wachtwoord']);
    $hashedwachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    submit($username, $hashedwachtwoord, $wachtwoord);
}

?>
</body>
</html>