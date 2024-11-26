<?php
if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $email = $_POST["email"];
    $wachtwoord = $_POST["password"];

    require_once "functions.php";

    if (emptyInput($naam, $email, $wachtwoord) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    // $conn = dbConnector();
    $addUser = addUser($naam, $email, $wachtwoord);
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