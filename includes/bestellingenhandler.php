<?php
// zorgt dat de functies uit het functiebestand beschikbaar zijn in dit bestand
require_once "functions.php";

// start een sessie zodat we de informatie daaruit kunnen halen
session_start();
//kijkt of je bent ingelogt als gebruiker en stuurt je terug als je dat niet bent en sluit dit bestand
if (!isset($_SESSION["UserID"])) {
    header("location: ../login.php");
    exit();
}
$userID = $_SESSION["UserID"];

// kijkt of er op de bestelknop geklikt. zoniet, ga terug naar de bestelpagina
if (isset($_POST["submit"])) {
    // voegt een order toe aan de database en retouneert het order_id uit de orders tabel voor de bestelregels
    $orderIDRow = addOrder($userID);
    $orderID = $OrderIDRow['id'];
    // haalt alle informatie uit de productentabel voor de bestelregels
    $result = menuTable(); 
    // zet de resultaten van de bestelling in de bestelregelstabel
    $i=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        if ($_POST["$i"]) {
            $productID = $i;
            $aantal = $_POST["$i"];
            addBestelregels($orderID, $productID, $aantal);
        }
    }
    // gaat naar de mijnbestellingen pagina 
    header("location: ../klant.php");
    exit();
} else {
    header("location: ../Menu.php");
    exit();
}