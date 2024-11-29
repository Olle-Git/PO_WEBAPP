<?php
session_start();
include_once "includes/functions.php";
if (!isset($_SESSION["UserID"]) || $_SESSION["UserID"] != true) {
    header("location: index.php");
    exit();
}
$userID = $_SESSION["UserID"];
$result = tableData($userID);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Standaard informatie over de webpagina in de head-->
    <meta name="author" content="Adrian Bleeker, Olle van Damme">
    <link rel="stylesheet" href="style_paginas.css">
    <link rel="stylesheet" href="style.css">
    <title>Uw bestellingen</title>    
    <style>
        tr:hover {
            background-color:#7dd48c; /* Hover effect*/
        }
    </style>

    </head>

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li> <!-- Dit is voor de navigatiebar boven in de pagina-->
            <li class="navitems"><a href="index.php">Home</a></li> <!--In dit blok words de afbeelging toegevoegd, en de knoppen naar de juiste pagina, dit wordt gedaan door meerdere ordered lists in een unordered list te plaatsen-->
            <li class="navitems"><a href="Menu.php">Menu</a></li>
            <li class="navitem"><a href="#">Mijn bestellingen</a></li>
            <!--In het php blok hieronder wordt gechecked of de ingelogde persoon een bezorger is, zo ja kan hij bij de openstaande bestellingen kijken via de nav bar-->
            <?php if (isset($_SESSION["bezorger"])) if ($_SESSION["bezorger"] == true) { {echo "<li class='navitem'><a href='bezorger.php'>bezorgers</a></li>";}}?>
            <!--In het blok hieronder wordt de log uit functie aangemaakt-->
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <table>
    <thead>
        <tr>
            <!--In het blok hieronder wordt met php gecheked of er bestellingen zijn, zo nee wordt dit aangegeven op de pagina-->
            <?php
            if ($result == false) {
                echo "bestelregels niet gevonden<br>";
            } 
            else {
                TableHead();
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <!--In het blok hieronder wordt met php uit de database alle bestellingen gehaald en weergven-->
            <?php 
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>". $row["besteldatum"] ."</td>";
                    echo "<td>". $row["aantal"] . "x " . $row['naam'] . "</td>";
                    echo "</tr>";
                }
            ?>

    </tbody>
    </table>
</body>
</html>