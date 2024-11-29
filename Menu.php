<!--in het php blok hieronderde wordt gekeken of er een sessie bezig is en als dat zo is wordt hij leeggemaakt-->
<?php
session_start();
if (!isset($_SESSION["UserID"]) || $_SESSION["UserID"] != true) {
    header("location: index.php");
    exit();
}
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
    
    <!-- Internal CSS voor de opmaak van tabellen en foto's
     In het table blok wordt de breedte van de tabel bepaald, de zeijkanten van de tabel saengevoegd & de tekst in het midden gezet
     In het blok van th, td wordt ook de tekst in het midden gezet en wordt er een padding toegevoegd van 5 pixels
     In het blok img wordt de afbeelding in een block weergegeven en de breedte wordt bepaald
     In het blok td wordt er alleen een solid border toegevoegd aan de data cellen in de tabel
     De hover zorgt voor een achtergrond kleur in een vak als hier op wordt gestaan met de cursor
     Als iets op is wordt met empty de achtergond grijs gemaakt, of wordt het item helemaal weggehaald-->
    <style>  
    table {
        width: 80%;
        border-collapse: collapse;  
        text-align: center; 
    }
    
    th, td {
        text-align: center;
        padding: 5px; 
    }

    img {
        display: block;
        margin: 0 auto;
        width: 50%;
    }

    td {
        border: 1px solid #ccc; 
    }

    td:hover {
    background-color:#7dd48c; /* Hover effect*/
    }
    .empty {
        background-color: gray;
    }
    .empty input[type="number"], label {
        display: none;
    }
</style>
</head>

    

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li>
            <li class="navitems"><a href="index.php">Home</a></li>
            <li class="navitems"><a href="#">Menu</a></li>
            <li class="navitem"><a href="klant.php">Mijn bestellingen</a></li>
            <?php if (isset($_SESSION["bezorger"])) if ($_SESSION["bezorger"] == true) { {echo "<li class='navitem'><a href='bezorger.php'>bezorgers</a></li>";}}?>
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <br><br>
    <table>
        <form action="includes/bestellingenhandler.php" method="post">
        <th colspan="3">MENU</th>
        <?php 
            require_once "includes/functions.php";
            $result = menuTable();
            drawMenu($result);
        ?>
      </table>
            <br><br><br><br><br>
      <center>
            <input type="submit" name="submit" value="Bestelling plaatsen" style="width: auto; background-color:white; color:black;">
        </form></center>
</body>
</html>