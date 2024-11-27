<?php
if (isset($_POST["submit"])) {
    $naam = $_POST["username"];
    $wachtwoord = $_POST["password"];

    require_once "functions.php";

    if (emptyInput($naam, $wachtwoord, $wachtwoord) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    $UserInfo = correctPassword($naam, $wachtwoord);
    if ($UserInfo != false) {
        session_start();
        $_SESSION["UserID"] = $UserInfo["id"];
        $_SESSION["Username"] = $UserInfo["usr"];
        header("location: ../klant.php");
        exit();
    } else {
        header("location: ../login.php?error=logginfailed");
        exit();
    }

}
else {
    header("location: ../login.php");
    echo "test";
    exit();
}