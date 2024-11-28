<?php
if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["password"];
    $plaats = $_POST["plaats"];
    $straat = $_POST["straat"];
    $huisnummer = $_POST["huisnummer"];

    require_once "functions.php";

    if (emptyInput($naam, $email, $wachtwoord) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (emptyInput($plaats, $straat, $huisnummer) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    // $conn = dbConnector();
    $addUser = addUser($naam, $email, $wachtwoord, $plaats, $straat, $huisnummer);
    if ($addUser !== false) {
        header("location: ../login.php");
        exit();
    } else {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

} 
else {
    header("location: ../register.php?error=none");
    exit();
}