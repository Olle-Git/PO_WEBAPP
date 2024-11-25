<?php

// $serverNaam = "localhost";
// $dbUser = "root";
// $dbWachtwoord = "";
// $dbNaam = "nyp";

// $conn = mysqli_connect($serverNaam, $dbUser, $dbWachtwoord, $dbNaam);

// if (!$conn) {
//     die("Connection failed".mysqli_connect_error());
// } 

// komt van de loginpagina
if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["password"];

    require_once "functions.php";

    if (emptyInputSignup($naam, $email, $wachtwoord) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    // $conn = dbConnector();

    if (addUser($naam, $email, $wachtwoord) !== false) {
        header("location: ../login.php");
        exit();
    } else {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    echo "er is iets mis gegaan";

} 
else {
    header("location: ../signup.php?error=none");
    exit();
}
echo "er is iets gegaan";