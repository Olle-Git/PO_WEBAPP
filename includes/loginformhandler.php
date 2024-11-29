<?php
if (isset($_POST["submit"])) {
    require_once "functions.php";
    $naam = test_input($_POST["username"]);
    $wachtwoord = test_input($_POST["password"]);


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