<?php
if (isset($_POST["submit"])) {
    require_once "functions.php";

    $naam = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $wachtwoord = test_input($_POST["password"]);
    $plaats = test_input($_POST["plaats"]);
    $straat = test_input($_POST["straat"]);
    $huisnummer = test_input($_POST["huisnummer"]);


    if (emptyInput($naam, $email, $wachtwoord) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (emptyInput($plaats, $straat, $huisnummer) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (alreadyTaken($naam, "usr") !== false) {
        header("location: ../register.php?error=usrtaken");
        exit();
    }
    if (alreadyTaken($email, "email") !== false) {
        header("location: ../register.php?error=emailtaken");
        exit();
    }
    // $con

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