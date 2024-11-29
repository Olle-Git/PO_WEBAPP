<?php
session_start();
if (!isset($_SESSION["bezorger"]) || $_SESSION["bezorger"] != true) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!--Basis informatie in de head over de webpagina-->
    <meta name="author" content="Adrian Bleeker, Olle van Damme">
    <link rel="stylesheet" href="style_paginas.css">
    <link rel="stylesheet" href="style.css">
    <title>Uw bestellingen</title>  

    <style>
      tr:hover {
      background-color:#7dd48c; /* Hover effect*/
      }

      th{
        text-align: center;
      }
    </style>

    </head>

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li> <!--Dit is voor de navigatie bar bovenin de pagina-->
            <li class="navitems"><a href="index.php">Home</a></li>                    <!--In dit blok words de afbeelging toegevoegd, en de knoppen naar de juiste pagina, dit wordt gedaan door meerdere ordered lists in een unordered list te plaatsen-->
            <li class="navitems"><a href="Menu.php">Menu</a></li>
            <li class="navitem"><a href="klant.php">Mijn bestellingen</a></li>
            <li class="navitem"><a href="#">bezorgers</a></li>
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <br><br>
    <table>
        <th colspan="4">Bestellingen</th>
        <!--In het blok hieronder wordt met php uit de database alle bestellingen gehaald en weergven-->
        <?php
        require_once "includes/functions.php";
        $result = bezorger();
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" .$row['straat']." ".$row['huisnummer']." ". $row['plaats']. "</td>";
            echo "<td>" . $row['aantal']."x ".$row['naam'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        ?>

        <!-- <tr>
          <th style="text-align: left;">Bestellingen</th>
          <th style="text-align: left;">Adres</th>
          <th style="text-align: left;">Details</th>
          <th style="text-align: left;">Telefoonnummer</th>
        </tr>
        <tr>
          <td>0000123</td>
          <td>Assendelft Blauwe Ring 8</td>
          <td>1x Pizza Peperoni, 2x...</td>
          <td>0658827700</td>
        </tr>
        <tr>
          <td>0000246</td>
          <td>Assendelft Rode Ring 10</td>
          <td>1x Frisdrank, 1x Pizza....</td>
          <td>0438128901</td>
        </tr>
        <tr>
            <td>0000931</td>
            <td>Assendelft Witte Ring 17</td>
            <td>2x MilkShake</td>
            <td>0567914362</td>
          </tr> -->
      </table>
</body>
</html>