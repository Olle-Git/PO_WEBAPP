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

    if (emptyInput($naam, $email, $wachtwoord) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    // $conn = dbConnector();
    $addUser = addUser($naam, $email, $wachtwoord);
    if ($addUser !== false) {
        header("location: ../login.php");
        exit();
    } else {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

} 
else {
    header("location: ../signup.php?error=none");
    exit();
}