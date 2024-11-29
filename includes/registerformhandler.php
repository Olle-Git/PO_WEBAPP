<?php
//kijkt of je van de registratiepagina komt en stuurt je terug als je er niet vandaan komt en sluit dit bestand
if (isset($_POST["submit"])) {
    require_once "functions.php";

    // haalt alle data uit het formulier van de resistratiepagina en test ze op gevaarlijke karakters zoals 
    $naam = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $wachtwoord = test_input($_POST["password"]);
    $plaats = test_input($_POST["plaats"]);
    $straat = test_input($_POST["straat"]);
    $huisnummer = test_input($_POST["huisnummer"]);

    // controleert of de invoervelden leeg zijn en gaat terug naar de registreerpagina als dat zo is
    if (emptyInput($naam, $email, $wachtwoord) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    if (emptyInput($plaats, $straat, $huisnummer) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }
    // controleert of de gebruikersnaam en email al in de database staan en gaat terug naar de registreerpagina als dat zo is
    if (alreadyTaken($naam, "usr") !== false) {
        header("location: ../register.php?error=usrtaken");
        exit();
    }
    if (alreadyTaken($email, "email") !== false) {
        header("location: ../register.php?error=emailtaken");
        exit();
    }
    // voegt de gebruiker toe aan de database en gaat terug naar de inlogpagina
    // als het toevoegen niet gelukt is gaat hij terug naar de registreerpagina
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