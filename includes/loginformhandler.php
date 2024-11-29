<?php
//kijkt of je van de loginpagina komt en stuurt je terug als je daar niet vandaan komt
if (isset($_POST["submit"])) {
    require_once "functions.php";
    // haalt de data uit het loginform en test het voor gevaarlijke karakters zoals die voor xss aanvallen
    $naam = test_input($_POST["username"]);
    $wachtwoord = test_input($_POST["password"]);

    // kijkt of een input van het formulier leeg was toen het opgestuurd werd
    if (emptyInput($naam, $wachtwoord, $wachtwoord) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    //controleert of het wachtwoord overeenkomt met het wachtwoord in de database en retouneert alle collommen uit de users tabel
    $UserInfo = correctPassword($naam, $wachtwoord);
    // kijkt of de gebruiker een bezorger is of een klant en start een sessie en zet het userid, de username en of de gebruiker een bezorger is in de variabelen 
    // als het wachtwoord incorrect was gaat hij terug naar de inlogpagina 
    if ($UserInfo !== false) {
        if ($UserInfo["pos"] == 1) {
            session_start();
            $_SESSION["UserID"] = $UserInfo["id"];
            $_SESSION["Username"] = $UserInfo["usr"];
            $_SESSION["bezorger"] = true;
            header("location: ../bezorger.php");
            exit();
        }
        session_start();
        $_SESSION["UserID"] = $UserInfo["id"];
        $_SESSION["Username"] = $UserInfo["usr"];
        $_SESSION["bezorger"] = false;
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